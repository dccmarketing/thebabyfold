<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package thebabyfold
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function thebabyfold_wpcom_setup() {

	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
	
		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);
	
	}

} // thebabyfold_wpcom_setup()
add_action( 'after_setup_theme', 'thebabyfold_wpcom_setup' );
