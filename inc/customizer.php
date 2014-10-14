<?php
/**
 * thebabyfold Theme Customizer
 *
 * @package thebabyfold
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @uses 	get_setting()
 */
function thebabyfold_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

} // thebabyfold_customize_register()
add_action( 'customize_register', 'thebabyfold_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @uses 	wp_enqueue_script()
 * @uses 	get_template_directory_uri()
 */
function thebabyfold_customize_preview_js() {

	wp_enqueue_script( 'thebabyfold_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );

} // thebabyfold_customize_preview_js()
add_action( 'customize_preview_init', 'thebabyfold_customize_preview_js' );
