<?php

/**
 * Search result page entry content
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

global $post;

// Excerpt length.
$length = apply_filters('ocean_search_results_excerpt_length', '30');
$category = get_the_category();


?>

<div class="search-entry-summary clr" <?php oceanwp_schema_markup('entry_content'); ?>>
	<p>
		<?php
		// Display excerpt.
		if (has_excerpt($post->ID)) {
			the_excerpt();
		} else {
			if (is_array($category) || is_object($category))
				foreach ($category as $cat) {
					if ($cat->cat_name != 'Provider') {
						// Display custom excerpt.
						echo wp_trim_words(strip_shortcodes($post->post_content), $length); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}
		}
		?>
	</p>
</div><!-- .search-entry-summary -->