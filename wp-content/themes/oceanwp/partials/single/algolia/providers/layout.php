<?php
require '_data.php';
?>

<article id="post-<?php the_ID(); ?>">
    <main id="provider" class="provider-page <?php echo $container_class; ?>">

        <header id="provider__header">
            <?php
            // get the header
            get_template_part($provider_slug . 'header');

            // get additional info
            if (!$is_free && $provider_meta['other_info'])
                get_template_part($provider_slug . 'other_info');
            ?>
        </header>

        <article id="provider__body">
            <?php
            // get the content
            get_template_part($provider_slug . 'content');
            ?>
        </article>

        <?php if (!$is_free && $provider_meta['images']) {  ?>
            <article id="provider__gallery">
                <?php
                // get the gallery
                get_template_part($provider_slug . 'gallery');
                ?>
            </article>
        <?php } ?>

        <footer id="provider__footer">
            <?php
            // get the footer
            get_template_part($provider_slug . 'footer');
            ?>
        </footer>

    </main>

</article>