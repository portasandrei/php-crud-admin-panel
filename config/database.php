<?php

declare(strict_types=1);

use App\Bootstrap\Env;

return [
    'host'     => Env::env('DB_HOST', 'localhost'),
    'port'     => Env::env('DB_PORT', '3306'),
    'database' => Env::env('DB_DATABASE', 'crud_db'),
    'username' => Env::env('DB_USERNAME', 'root'),
    'password' => Env::env('DB_PASSWORD', ''),
    'charset'  => Env::env('DB_CHARSET', 'utf8mb4'),
];