<?php

use App\Core\Router;
use App\Controllers\IndexController;

return function($router) {
    $router->add('GET', '/', [IndexController::class, 'index']);
    $router->add('GET', '/about', [IndexController::class, 'about']);
};