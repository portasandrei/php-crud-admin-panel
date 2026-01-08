<?php
    namespace App\Core;

    class Autoloader
    {
        public static function register(): void
        {
            spl_autoload_register([self::class, 'autoload']);
        }

        private static function autoload(string $class): void 
        {
            $prefix = 'App\\';
            $baseDir = dirname(__DIR__) . '/';
            
            if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
                return;
            }

            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require $file;
            }   
        }

    }