<?php
require '_data.php';
?>

<article id="post-<?php the_ID(); ?>">
    <main id="actors" class="actors-page <?php echo $container_class; ?>">
        <div>
            <article id="actors__body">
                <?php
                // get the content
                get_template_part($actors_slug . 'content');
                ?>
            </article>

            <footer id="actors__footer">
                <?php
                // get the footer
                get_template_part($actors_slug . 'footer');

                ?>
            </footer>
        </div>
    </main>

</article>