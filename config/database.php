<?php

declare(strict_types=1);

return [
    'host'     => \App\Bootstrap\Env::env('DB_HOST', 'localhost'),
    'port'     => (int) \App\Bootstrap\Env::env('DB_PORT', '3306'),
    'database' => \App\Bootstrap\Env::env('DB_DATABASE', 'crud'),
    'username' => \App\Bootstrap\Env::env('DB_USERNAME', 'root'),
    'password' => \App\Bootstrap\Env::env('DB_PASSWORD', ''),
    'charset'  => \App\Bootstrap\Env::env('DB_CHARSET', 'utf8mb4'),
];