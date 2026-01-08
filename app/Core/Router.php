<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function add(string $method, string $url, array $callback): void
    {
        $this->routes[$method][$url] = $callback;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method][$url])) {
            [$controller, $action] = $this->routes[$method][$url];
            $controllerInstance = new $controller();

            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
                return;
            } else {
                http_response_code(404);

                echo "404 - Method Not Found";
                return;
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}