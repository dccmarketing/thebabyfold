<?php
/**
 * thebabyfold functions and definitions
 *
 * @package thebabyfold
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'thebabyfold_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function thebabyfold_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on thebabyfold, use a find and replace
	 * to change 'thebabyfold' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'thebabyfold', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top_header' 	=> __( 'Top Header Menu', 'thebabyfold' ),
		'bottom_header' => __( 'Bottom Header Menu', 'thebabyfold' ),
		'main' 			=> __( 'Main Menu', 'thebabyfold' ),
		'social' 		=> __( 'Social Links Menu', 'thebabyfold' ),
		'footer' 		=> __( 'Footer Menu', 'thebabyfold' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	/*
	add_theme_support( 'custom-background', apply_filters( 'thebabyfold_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	*/
}
endif; // thebabyfold_setup
add_action( 'after_setup_theme', 'thebabyfold_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function thebabyfold_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'thebabyfold' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div><!-- .content_wrap --></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1><span class="show_hide">+</span><div class="content_wrap">',
	) );
}
add_action( 'widgets_init', 'thebabyfold_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thebabyfold_scripts() {
	wp_enqueue_style( 'thebabyfold-style', get_stylesheet_uri() );

	wp_enqueue_script( 'thebabyfold-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'thebabyfold-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thebabyfold_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Load Fonts
 */
function load_fonts() {

	wp_register_style( 'et-googleFonts', 'http://fonts.googleapis.com/css?family=Cabin:400,500,600,700' );
	wp_enqueue_style( 'et-googleFonts' );

} // load_fonts()
add_action( 'wp_print_styles', 'load_fonts' );




/**
 * Customize footer
 */
function custom_footer_left() {

	// Footer left

} // custom_footer_left()
//add_action( 'footer_left', 'custom_footer_left' );

function custom_site_info() {

	printf( __( '<span class="copyright">&copy %1$s <a href="%2$s" title="Login">%3$s</a></span>', 'thebabyfold' ), date( 'Y' ), get_admin_url(), get_bloginfo( 'name' ) );

	get_template_part( 'menu', 'footer' );

	_e( '<span class="credits">Site designed & developed by <a href="http://dccmarketing.com" title="author">DCC Marketing</a></span><!-- .credits -->', 'thebabyfold' );

} // custom_site_info()
add_action( 'site_info', 'custom_site_info' );

function custom_footer_right() {

	// Footer right

} // custom_footer_right()
//add_action( 'footer_right', 'custom_footer_right' );

/**
 * Echos the HTML style tags
 *
 * @access 	protected
 * @global 	slushman_sbgs_settings
 * @since 	0.1
 * 
 * @param 	array 	$atts 	An array containing all the images on the page and their attributes
 *
 * @return  mixed 			The HTML style tags and their contents
 */
function add_style_tags() {

	$img_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

	?><style>@media screen and (min-width: 769px) {.site-footer{background-image:url(<?php echo $img_array[0]; ?>);}}</style><?php

} // End of add_style_tags()

add_action( 'wp_footer', 'add_style_tags' );

/**
 * Returns an ACF field, if its not empty
 * 
 * @param 	string 		$field 		The name of the ACF field to grab
 *
 * @uses 	get_field()
 * 
 * @return 	mixed 					The data from the ACF field, or FALSE if empty
 */
function return_field_info( $field, $group = null ) {

	if ( empty( $group ) ) {

		$output = get_field( $field );

	} else {

		$output = get_field( $field, $group );

	}

	$output = get_field( $field, $group );

	if ( empty( $output ) ) { return FALSE; }

	return $output;

} // return_field_info()

function get_contact_info( $pageID ) {

	$group 	= return_field_info( 'group_name', $pageID );

	$output = '';
	$output .= return_field_info( 'name', $group ) . '<br />';
	$output .= return_field_info( 'address', $group ) . '<br />';
	$output .= return_field_info( 'city_state_zip', $group ) . '<br />';
	$output .= 'Phone: ' . return_field_info( 'phone', $group ) . '<br />';
	$output .= 'Fax: ' . return_field_info( 'fax', $group );

	return $output;

} // get_contact_info()


function get_lunch_menu( $pageID ) {

	$group 	= return_field_info( 'group_name', $pageID );
	$field 	= return_field_info( 'lunch_menu_file', $group );
	$output = '';

	if ( FALSE !== $field ) {

		$output .= '<p><a href="' . $field . '">Lunch Menu</a></p>';

	} 

	return $output;

} // get_lunch_menu()

function get_forms_links() {

	$group 	= return_field_info( 'group_name', $pageID );
	$rows 	= return_field_info( 'forms_links', $group );
	$output = '';

	if( $rows ) {

		foreach( $rows as $row ) {

			$output .= '<p><a href="' . $row['form'] . '">' . $row['form_name'] .'</a></p>';

		} // foreach

	} // have $rows

	return $output;

} // get_forms_links()




