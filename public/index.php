<?php

    declare(strict_types=1); 

    define('ROOT', dirname(__DIR__));

    require_once __DIR__ . '/../app/Core/Autoloader.php';

    use App\Core\Autoloader;
    use App\Core\Router;

    // Register the autoloader
    Autoloader::register();

    // Initialize Router
    $router = new Router();

    // Load routes
    $routes = require_once ROOT . '/routes/web.php';
    $routes($router);

    // Dispatch the request
    $router->dispatch();