<?php

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\Admin;
use App\Controllers\Dev\AssetController;

return function($router) {

    // Public routes
    $router->add('GET', '/', [IndexController::class, 'index']);
    $router->add('GET', '/about', [IndexController::class, 'about']);

    // Admin routes
    $router->add('GET', '/admin/login', [Admin\LoginController::class, 'index']);
    $router->add('GET', '/admin', [Admin\IndexController::class, 'index']);

    // Dev routes
    $router->add('GET', '/dev/build-assets', [AssetController::class, 'build']);
};