<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?? 'Page' ?></title>
        <link rel="stylesheet" href="/assets/css/style.min.css">
    </head>
    <body>

        <div class="container">
            <?= $content ?>
        </div>

        <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
        <!-- Load local if remote script is not connected -->
        <script>
            if (typeof window.jQuery === 'undefined') {
                document.write('<script src="/assets/js/jquery-4.0.0.min.js"><\/script>');
            }
        </script>
        <script src="/assets/js/script.min.js"></script>

    </body>
</html>