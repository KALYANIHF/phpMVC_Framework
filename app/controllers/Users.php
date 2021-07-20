<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // $data = [
        //     'title' => 'Welcome',
        //     'description' => 'You are in Register Page',
        // ];
        // $this->view('users/register', $data);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            // saitize the post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // form validation

            ## validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please Enter Email';
            } else {
                // check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email already Taken';
                }
            }
            ## validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please Enter Name';
            }

            ## password validate
            if (empty($data['password'])) {
                $data['password_err'] = 'Please Enter Password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be atleast 6 Charector long';
            }

            ## confirm passwrod
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please Confirm Password';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Password does not Match';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // validated
                ## hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                ## call a model function
                ## register user
                if ($this->userModel->register($data)) {
                    flash('register_success', 'you are registered and can login');
                    redirect('users/login');
                } else {
                    die('Somethig Went Wrong');
                }
            } else {
                $this->view('users/register', $data);
            }

        } else {
            ## inti data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            // load the view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // $data = [
        //     'title' => 'Welcome to Login Page',
        //     'description' => 'You are in Login Page',
        // ];
        // $this->view('users/login', $data);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            ## validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please Enter Email';
            }

            ## validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please Enter Password';
            }

            if ($this->userModel->findUserByEmail($data['email'])) {
                // user found

            } else {
                $data['email_err'] = 'No user found';
            }

            //Check if the password is empty or not
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // check and set login user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // create session varible
                    $this->createSessionUser($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }

            ## validate password
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // load the view
            $this->view('users/login', $data);
        }
    }
    public function createSessionUser($loggedInUser)
    {
        $_SESSION['user_id'] = $loggedInUser->id;
        $_SESSION['user_email'] = $loggedInUser->email;
        $_SESSION['user_name'] = $loggedInUser->name;
        redirect('posts/index');
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

}
