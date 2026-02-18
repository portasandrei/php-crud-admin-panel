<?php

namespace App\Core;

class Controller extends Auth
{

    protected function view(string $view, array $data = [], ?string $layout = null): void
    {

        $classNamespace = get_class($this);

        if (str_contains($classNamespace, '\Admin\\')) {
            $zone = 'admin';

            // Skip authentication check for login page
            $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            if ($currentUrl !== '/admin/login') {
                Auth::check();
            }

            $defaultLayout = 'admin';
        } else {
            $zone = 'frontend';
            $defaultLayout = 'main';
        }

        $layout = $layout ?? $defaultLayout;

        $viewPath = ROOT . "/resources/views/{$zone}/pages/{$view}.php";

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }

        extract($data);
        ob_start();

        require $viewPath;

        $content = ob_get_clean();

        $layoutPath = ROOT . "/resources/views/{$zone}/layouts/{$layout}.php";
        if (!file_exists($layoutPath)) {
            throw new \Exception("Layout {$layout} not found in {$zone}/layouts");
        }

        require $layoutPath;

    }

}