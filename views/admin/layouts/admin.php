<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?? 'Page' ?></title>
        <link rel="stylesheet" href="/assets/admin/css/style.min.css?v=<?=time();?>">
    </head>
    <body>

        <div class="container">
            <?= $content ?>
        </div>

        <!-- jQuery din CDN -->
        <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
        <!-- Load local if remote script is not connected -->
        <script>
            if (typeof window.jQuery === 'undefined') {
                document.write('<script src="/assets/js/jquery-4.0.0.min.js?v=<?=time();?>"><\/script>');
            }
        </script>
        <script src="/assets/admin/js/main.min.js?v=<?=time();?>"></script>
    </body>
</html>