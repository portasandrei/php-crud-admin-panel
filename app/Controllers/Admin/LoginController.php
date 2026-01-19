<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class LoginController extends Controller
{

    public function index(): void
    {
        $this->view('auth/login', [
            'title' => 'Admin Login',
            // 'content' => 'Admin Login Page'
        ]);
    }

 
}