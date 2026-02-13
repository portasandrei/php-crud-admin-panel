<?php
declare(strict_types=1);

namespace App\Controllers\Dev;

use App\Bootstrap\Env;

class AssetController
{
    // Source and destination folders
    private array $assets = [
        ['src' => '/assets/admin/css', 'dst' => '/public/assets/admin/css', 'minify' => 'minifyCss', 'ext' => 'css'],
        ['src' => '/assets/css', 'dst' => '/public/assets/css', 'minify' => 'minifyCss', 'ext' => 'css'],
        ['src' => '/assets/admin/js', 'dst' => '/public/assets/admin/js', 'minify' => 'minifyJs', 'ext' => 'js'],
        ['src' => '/assets/js', 'dst' => '/public/assets/js', 'minify' => 'minifyJs', 'ext' => 'js']
    ];

    public function build(): void
    {
        if (Env::env('APP_ENV', 'prod') !== 'dev') {
            http_response_code(403);
            echo 'Forbidden';
            return;
        }

        $output = '';
        $nl = php_sapi_name() === 'cli' ? PHP_EOL : '<br>';

        foreach ($this->assets as $asset) {
            if (!is_dir(ROOT . $asset['dst'])) {
                mkdir(ROOT . $asset['dst'], 0777, true);
            }

            foreach (glob(ROOT . $asset['src'] . '/*.' . $asset['ext']) as $file) {
                $content = file_get_contents($file);
                $minified = $this->{$asset['minify']}($content);
                $basename = basename($file);
                $filename = preg_replace('/\.([^.]+)$/', '.min.$1', $basename);
                file_put_contents(ROOT . $asset['dst'] . '/' . $filename, $minified);
                $output .= "Processed: {$asset['src']}{$basename} → {$asset['dst']}{$filename}{$nl}";
            }
        }

        $output .= "Build complete!";
        echo $output;
    }


    // Simple CSS minify function 
    public function minifyCss(string $css): string {
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
    public function minifyJs(string $js): string {
        $js = preg_replace('!/\*.*?\*/!s', '', $js); // block comments
        $js = preg_replace('/\/\/.*?\n/', "\n", $js); // line comments
        $js = preg_replace('/\s+/', ' ', $js);
        return trim($js);
    }

}