<?php

    declare(strict_types=1); 

    define('ROOT', dirname(__DIR__));

    require_once ROOT . '/bootstrap/Env.php';
    require_once ROOT . '/app/Core/Autoloader.php';

    use App\Core\Autoloader;
    use App\Core\Router;
    use App\Bootstrap\Env;

    Env::getInstance(ROOT . '/.env');


    // Register the autoloader
    Autoloader::register();


    // Initialize Router
    $router = new Router();

    // Load routes
    $routes = require_once ROOT . '/routes/web.php';
    $routes($router);

    // Dispatch the request
    $router->dispatch();