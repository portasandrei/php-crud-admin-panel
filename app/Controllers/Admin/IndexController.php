<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class IndexController extends Controller
{

    public function index(): void
    {
        $this->view('dashboard', [
            'title' => 'Dashboard',
            'content' => 'Welcome to the Dashboard!'
        ]);
    }
 
}