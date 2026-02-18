<?php

declare(strict_types=1);

namespace App\Bootstrap;

class Env
{
    private static ?self $instance = null;
    private array $variables = [];

    private function __construct(string $file)
    {
        $this->load($file);
    }

    public static function getInstance(?string $file = null): self
    {
        if (self::$instance === null) {
            if ($file === null) {
                throw new \RuntimeException('Env not initialized. Call getInstance($pathToEnv) first.');
            }
            self::$instance = new self($file);
        }
        return self::$instance;
    }

    private function load(string $file): void
    {
        if (!file_exists($file)) {
            throw new \RuntimeException("Environment file not found: {$file}");
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            throw new \RuntimeException("Could not read environment file: {$file}");
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            $parts = explode('=', $line, 2);
            $name = trim($parts[0] ?? '');
            $value = isset($parts[1]) ? trim($parts[1]) : '';

            if ($name === '') {
                continue;
            }

            // Support "export KEY=value"
            if (str_starts_with($name, 'export ')) {
                $name = trim(substr($name, 7));
            }

            // Remove surrounding quotes and inline # comments
            $value = preg_replace('/\s+#.*$/', '', $value);
            $value = trim($value, "\"'");

            $this->variables[$name] = $value;
            $_ENV[$name] = $value;
            putenv("{$name}={$value}");
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->variables[$key] ?? $default;
    }

    /**
     * Static shorthand: read a key from the singleton (e.g. Env::env('APP_ENV')).
     * Use from anywhere after bootstrap; fails fast if Env was never initialized.
     */
    public static function env(string $key, mixed $default = null): mixed
    {
        return self::getInstance()->get($key, $default);
    }
}
