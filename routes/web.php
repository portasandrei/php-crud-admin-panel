<?php

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\Admin;

return function($router) {
    $router->add('GET', '/', [IndexController::class, 'index']);
    $router->add('GET', '/about', [IndexController::class, 'about']);

    $router->add('GET', '/admin/login', [Admin\LoginController::class, 'index']);
    $router->add('GET', '/admin', [Admin\IndexController::class, 'index']);
};