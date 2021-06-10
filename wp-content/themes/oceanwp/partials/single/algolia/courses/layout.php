<?php
require '_data.php';
?>

<article id="post-<?php the_ID(); ?>">
    <main id="course" class="course-page <?php echo $container_class; ?>">
        <?php echo $post->post_content; ?>
    </main>
</article>