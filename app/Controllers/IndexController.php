<?php

namespace App\Controllers;

use App\Core\Controller;

class IndexController extends Controller
{

    public function index(): void
    {
        $this->view('home', [
            'title' => 'Home Page',
            'content' => 'Welcome to the Home Page!'
        ]);
    }

    public function about(): void
    {
        $this->view('about', [
            'title' => 'About Us',
            'content' => 'This is the About Us page.'
        ]);
    }
 
}