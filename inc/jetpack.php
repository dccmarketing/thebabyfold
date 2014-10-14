<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package thebabyfold
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 * 
 * @uses 	add_theme_support()
 */
function thebabyfold_jetpack_setup() {

	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );

} // thebabyfold_jetpack_setup()
add_action( 'after_setup_theme', 'thebabyfold_jetpack_setup' );
