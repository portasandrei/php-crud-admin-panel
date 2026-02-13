<?php
    declare(strict_types=1);

    // Optional: run only from CLI or from dev environment (browser)
    if (php_sapi_name() !== 'cli' || $_ENV['APP_ENV'] !== 'dev') {
        echo "This script should only be run in dev mode or from CLI.";
        exit;
    }

    // define('ROOT', dirname(__DIR__));

    // Simple CSS minify function 
    function minifyCss(string $css): string {
        // removes comments, unused spaces and newlines
        $css = preg_replace('!/\*.*?\*/!s', '', $css);
        $css = preg_replace('/\s+/', ' ', $css);
        $css = str_replace([' {', '{ '], '{', $css);
        $css = str_replace([' }', '} '], '}', $css);
        $css = str_replace(['; ', ' ;'], ';', $css);
        $css = str_replace([' :', ': '], ':', $css);
        return trim($css);
    }

    // Simple JS minify
    function minifyJs(string $js): string {
        $js = preg_replace('!/\*.*?\*/!s', '', $js); // block comments
        $js = preg_replace('/\/\/.*?\n/', "\n", $js); // line comments
        $js = preg_replace('/\s+/', ' ', $js);
        return trim($js);
    }

    // Source and destination folders
    $assets = [
        ['src' => ROOT . '/assets/admin/css', 'dst' => ROOT . '/public/assets/admin/css', 'minify' => 'minifyCss', 'ext' => 'css'],
        ['src' => ROOT . '/assets/css', 'dst' => ROOT . '/public/assets/css', 'minify' => 'minifyCss', 'ext' => 'css'],
        ['src' => ROOT . '/assets/admin/js', 'dst' => ROOT . '/public/assets/admin/js', 'minify' => 'minifyJs', 'ext' => 'js'],
        ['src' => ROOT . '/assets/js', 'dst' => ROOT . '/public/assets/js', 'minify' => 'minifyJs', 'ext' => 'js']
    ];

    foreach ($assets as $asset) {
        if (!is_dir($asset['dst'])) {
            mkdir($asset['dst'], 0777, true);
        }

        $files = glob($asset['src'] . '/*.' . $asset['ext']);

        foreach ($files as $file) {
            $content = file_get_contents($file);
            $minified = $asset['minify']($content);
            $filename = basename($file);
            file_put_contents($asset['dst'] . '/' . $filename, $minified);
            echo "Processed: {$filename}\n";
        }
    }

    echo "Build complete!\n";
