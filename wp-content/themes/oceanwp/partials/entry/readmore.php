<?php

/**
 * Displays post entry read more
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

$title = oceanwp_theme_strings('owp-string-post-continue-reading', 'oceanwp');

?>

<?php do_action('ocean_before_blog_entry_readmore'); ?>

<div class="blog-entry-readmore clr">
	<a href="<?php the_permalink(); ?>" title="<?php echo $title; ?>"><?php oceanwp_theme_strings('owp-string-post-continue-reading', 'oceanwp'); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<span class="screen-reader-text"><?php the_title(); ?></span>
</div><!-- .blog-entry-readmore -->

<?php do_action('ocean_after_blog_entry_readmore'); ?>