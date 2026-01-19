<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class IndexController extends Controller
{

    public function login(): void
    {
        $this->view('auth/login', [
            'title' => 'Admin Login',
            'content' => 'Admin Login Page'
        ]);
    }

    public function index(): void
    {
        $this->view('dashboard', [
            'title' => 'Dashboard',
            'content' => 'Welcome to the Dashboard!'
        ]);
    }
 
}