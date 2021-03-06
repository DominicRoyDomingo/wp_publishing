<?php

/**
 * The Header for our theme.
 *
 * @package OceanWP WordPress theme
 */ ?>

<!DOCTYPE html>
<html class="<?php echo esc_attr(oceanwp_html_classes()); ?>" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122805847-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-122805847-1');
	</script>
</head>

<body <?php body_class(); ?> <?php oceanwp_schema_markup('html'); ?>>

	<?php wp_body_open(); ?>

	<?php do_action('ocean_before_outer_wrap'); ?>

	<div id="outer-wrap" class="site clr">

		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'oceanwp'); ?></a>

		<?php do_action('ocean_before_wrap'); ?>

		<div id="wrap" class="clr">

			<?php do_action('ocean_top_bar'); ?>

			<?php do_action('ocean_header'); ?>

			<?php do_action('ocean_before_main'); ?>

			<main id="main" class="site-main clr" <?php oceanwp_schema_markup('main'); ?> role="main">

				<?php
				$category = get_the_category();

				foreach ($category as $cat)
					if ($cat->cat_name != 'Provider')
						do_action('ocean_page_header');

				?>