<section>
    <h1><?= $title ?? '' ?></h1>
</section>

<section>
    <h2>Welcome to the Home Page!</h2>
    <p>This is the main landing page of the website.</p>
</section>
 
<section>
    <p><?= $content ?? '' ?></p>
    <p>Current HTTP Status: 
        <?php
            var_dump($httpCodeMessage); 
        ?>
    </p>
</section>