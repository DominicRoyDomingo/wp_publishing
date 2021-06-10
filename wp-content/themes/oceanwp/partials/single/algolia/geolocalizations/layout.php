<?php
require '_data.php';
?>

<article id="post-<?php the_ID(); ?>">
    <main id="geolocalization" class="geolocalization-page <?php echo $container_class; ?>">
        <div>
            <header id="geolocalization__header">
                <?php
                get_template_part($geolocalization_slug . '../../header');

                // get the header
                get_template_part($geolocalization_slug . 'header');

                // get the description
                get_template_part($geolocalization_slug . 'description');
                ?>
            </header>

            <article id="geolocalization__body">
                <?php
                // get the content
                get_template_part($geolocalization_slug . 'content');
                ?>
            </article>

            <footer id="geolocalization__footer">
                <?php
                // get the footer
                get_template_part($geolocalization_slug . 'footer');

                ?>
            </footer>
        </div>

        <aside id="geolocalization__sidebar">
            <?php
            get_template_part('sidebar');
            ?>
        </aside>

    </main>

</article>