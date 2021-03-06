<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package thebabyfold
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param 	array 		$args 		Configuration arguments.
 * 
 * @return 	array
 */
function thebabyfold_page_menu_args( $args ) {

	$args['show_home'] = true;
	
	return $args;

} // thebabyfold_page_menu_args()
add_filter( 'wp_page_menu_args', 'thebabyfold_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param 	array 		$classes 		Classes for the body element.
 *
 * @uses 	is_multi_author()
 * 
 * @return 	array
 */
function thebabyfold_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
	
		$classes[] = 'group-blog';
	
	}

	return $classes;

} // thebabyfold_body_classes()
add_filter( 'body_class', 'thebabyfold_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param 	string 		$title 		Default title text for current view.
 * @param 	string 		$sep 		Optional separator.
 *
 * @uses 	is_feed()
 * @uses 	get_bloginfo()
 * @uses 	is_home()
 * @uses 	is_front_page()
 * 
 * @return 	string 					The filtered title.
 */
function thebabyfold_wp_title( $title, $sep ) {

	if ( is_feed() ) { return $title; }

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {

		$title .= " $sep $site_description";

	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {

		$title .= " $sep " . sprintf( __( 'Page %s', 'thebabyfold' ), max( $paged, $page ) );

	}

	return $title;

} // thebabyfold_wp_title()
add_filter( 'wp_title', 'thebabyfold_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 *
 * @uses 	is_author()
 * @uses 	get_userdata()
 * 
 * @return 	void
 */
function thebabyfold_setup_author() {
	
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {

		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	
	}

} // thebabyfold_setup_author()
add_action( 'wp', 'thebabyfold_setup_author' );
