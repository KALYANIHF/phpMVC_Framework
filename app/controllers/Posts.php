<?php
class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('post');
        $this->userModel = $this->model('user');
    }

    public function index()
    {
        $post = $this->postModel->getPost();
        $data = [
            'Posts' => $post,
        ];
        $this->view('posts/index', $data);
    }
    public function add()
    {
        // check the server request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize the data
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // validate title
            if (empty($_POST['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            // validate body text
            if (empty($_POST['body'])) {
                $data['body_err'] = 'Please enter description about your post';
            }

            // check if the error  massage are empty or not
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->addPost($data)) {
                    flash("post_added", 'Your Post is Added');
                    redirect('posts/index');
                } else {
                    die('Something Went Wrong');
                }
            } else {
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'user_id' => '',
                'title_err' => '',
                'body_err' => '',
            ];
            $this->view('posts/add', $data);
        }

    }

    ## edit method
    public function edit($id)
    {
        // check the server request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize the data
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // validate title
            if (empty($_POST['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            // validate body text
            if (empty($_POST['body'])) {
                $data['body_err'] = 'Please enter description about your post';
            }

            // check if the error  massage are empty or not
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->editPost($data)) {
                    flash("post_edited", 'Your Post is Edited');
                    redirect('posts');
                } else {
                    die('Something Went Wrong');
                }
            } else {
                $this->view('posts/edit', $data);
            }
        } else {
            // Get existing post from model
            $post = $this->postModel->getPostById($id);
            // Check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
            ];
            $this->view('posts/edit', $data);
        }

    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user,
        ];
        $this->view('posts/show', $data);
    }
    public function delete($id)
    {
        if ($this->postModel->deleteById($id)) {
            flash("post_deleted", 'The Post is Removed', 'alert alert-danger');
            redirect('posts');
        } else {
            die('something went wrong');
        }
    }

}
