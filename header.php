<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package thebabyfold
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php

wp_head();

?></head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TM74VS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TM74VS');</script>
<!-- End Google Tag Manager -->
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'thebabyfold' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrapper">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bf_logo.png" /></a>
			</div><!-- .site-branding --><?php

			get_search_form();

			get_template_part( 'menu', 'top_header' );

			/*?>

			<div class="fest-logo">
				<a href="http://thebabyfold.net/" class="fest-logo-link" target="_blank"><?php

					echo babyfold_get_svg( 'trees' );

				?></a>
			</div><!-- .fest-logo-container --><?php
			*/

			get_template_part( 'menu', 'bottom_header' );

		?></div><!-- .header-wrapper -->
	</header><!-- #masthead -->
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle"><?php _e( 'Menu', 'thebabyfold' ); ?></button><?php

			wp_nav_menu( array( 'theme_location' => 'main' ) );

	?></nav><!-- #site-navigation -->
	<div id="content" class="site-content">