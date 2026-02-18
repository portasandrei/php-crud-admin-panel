<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Http;

class IndexController extends Controller
{

    public function index(): void
    {
        $httpCodeMessage = Http::getRemoteResponse("https://kazinst.md");

        $this->view('home', [
            'title' => 'Home Page',
            'content' => 'Welcome to the Home Page!',
            'httpCodeMessage' => $httpCodeMessage
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