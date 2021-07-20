<?php
class Pages extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }
        $data = [
            'title' => 'Welcome',
            'description' => 'You are in the HOME Page',
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'You are in ABOUT Page',
        ];

        $this->view('pages/about', $data);
    }
}
