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
		'name'			=> __( 'Sidebar', 'thebabyfold' ),
		'id'			=> 'sidebar-1',
		'description'	=> '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div><!-- .content_wrap --></aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1><span class="show_hide">+</span><div class="content_wrap">',
	) );
	register_sidebar( array(
		'name'			=> __( 'Schools Sidebar', 'thebabyfold' ),
		'id'			=> 'sidebar-school',
		'description'	=> '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div><!-- .content_wrap --></aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1><span class="show_hide">+</span><div class="content_wrap">',
	) );
	register_sidebar( array(
		'name'			=> __( 'Treatment Sidebar', 'thebabyfold' ),
		'id'			=> 'sidebar-treatment',
		'description'	=> '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div><!-- .content_wrap --></aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1><span class="show_hide">+</span><div class="content_wrap">',
	) );
	register_sidebar( array(
		'name'			=> __( 'Foster Care Sidebar', 'thebabyfold' ),
		'id'			=> 'sidebar-foster',
		'description'	=> '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div><!-- .content_wrap --></aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1><span class="show_hide">+</span><div class="content_wrap">',
	) );
	register_sidebar( array(
		'name'			=> __( 'Family Services Sidebar', 'thebabyfold' ),
		'id'			=> 'sidebar-family',
		'description'	=> '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div><!-- .content_wrap --></aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1><span class="show_hide">+</span><div class="content_wrap">',
	) );
	register_sidebar( array(
		'name'			=> __( 'News Sidebar', 'thebabyfold' ),
		'id'			=> 'sidebar-news',
		'description'	=> '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div><!-- .content_wrap --></aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1><span class="show_hide">+</span><div class="content_wrap">',
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

	wp_enqueue_script( 'thebabyfold-public-script', get_template_directory_uri() . '/js/public.min.js', array( 'jquery' ) );

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
 * Prints whatever in a nice, readable format
 */
function pretty( $input ) {

	echo '<pre>'; print_r( $input ); echo '</pre>';

} // pretty()



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

/**
 * Performs a WordPress Query for posts in a particular category
 *
 * @uses 	WP_Query()
 *
 * @return  object 				A query object containing the results of the query
 */
function get_category_posts( $category, $quantity = 10, $paged = 1 ) {

	$args['cat'] 			= $category;
	$args['order']			= 'ASC';
	$args['paged'] 			= $paged;
	$args['posts_per_page'] = $quantity;
	$args['post_type'] 		= 'post';
	
	$query = new WP_Query( $args );

	return $query;

} // End of get_category_posts()



/**
 * Add Extra Code to a Menu
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/customizing-wordpress-menus/
 *
 * @param 	string 		$item_output		//
 * @param 	object 		$item				//
 * @param 	int 		$depth 				//
 * @param 	array 		$args 				//
 * 
 * @return 	string 							modified menu
 */
function babyfold_menu_svgs( $item_output, $item, $depth, $args ) {

	if ( 'social' !== $args->theme_location && 'bottom_header' !== $args->theme_location ) { return $item_output; }

	$host 	= parse_url( $item->url, PHP_URL_HOST );
	$output = '<a href="' . $item->url . '" class="icon-menu">';
	$class 	= get_svg_by_class( $item->classes );

	if ( ! empty( $class ) ) {

		$output .= $class;

	} else {

		if ( $host !== parse_url( get_site_url(), PHP_URL_HOST ) ) { 

			$output .= get_svg_by_url( $item->url );

		} else {

			$output .= get_svg_by_pageID( $item->object_id );

		}

	} // class check

	if ( 'bottom_header' == $args->theme_location ) {

		$output .= '<div class="menu-icon-label">' . $item->title . '</div>';

	} // menu check

	$output .= '</a>';

	return $output;

} // babyfold_menu_svgs()

add_filter( 'walker_nav_menu_start_el', 'babyfold_menu_svgs', 10, 4 );



/**
 * Gets the appropriate SVG based on a menu item class
 * 
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function get_svg_by_class( $classes ) {

	$output = '';

	foreach ( $classes as $class ) {

		$check = get_svg( $class );

		if ( ! is_null( $check ) ) { $output .= $check; break; }

	} // foreach

	return $output;

} // get_svg_by_class()



/**
 * Gets the appropriate SVG based on a URL
 * 
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function get_svg_by_pageID( $ID ) {

	$output = '';
	$page 	= get_post( $ID );

	switch( $page->post_title ) {

		case 'Calendar' 			: $output .= get_svg( 'calendar' ); break;
		case 'Camping' 				: $output .= get_svg( 'camping' ); break;
		case 'Events & Festivals' 	: $output .= get_svg( 'calendar' ); break;
		case 'Hotels' 				: $output .= get_svg( 'hotel' ); break;
		case 'Motels' 				: $output .= get_svg( 'hotel' ); break;
		case 'Travel Guides' 		: $output .= get_svg( 'map-location' ); break;

	} // switch

	return $output;

} // get_svg_by_pageID()



/**
 * Gets the appropriate SVG based on a URL
 * 
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function get_svg_by_url( $url ) {

	$output = '';
	$host 	= parse_url( $url, PHP_URL_HOST );

	switch( $host ) {

		case 'facebook.com' 	: $output .= get_svg( 'facebook' ); break;
		case 'instagram.com' 	: $output .= get_svg( 'instagram' ); break;
		case 'linked.com' 		: $output .= get_svg( 'linkedin' ); break;
		case 'twitter.com' 		: $output .= get_svg( 'twitter' ); break;
		case 'youtube.com' 		: $output .= get_svg( 'youtube' ); break;

	} // switch

	return $output;

} // get_svg_by_url()



/**
 * Returns the requested SVG
 * 
 * @param 	string 		$icon 		The name of the icon to return
 * 
 * @return 	mixed 					The SVG code
 */
function get_svg( $icon ) {

	$output = '';

	switch( $icon ) {

		case 'calendar' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path fill="#2F5987" d="M18.5 0.1c2.5 0 4.9 0.5 7.1 1.5 2.2 1 4.2 2.3 5.8 3.9 1.7 1.7 3 3.6 3.9 5.8 1 2.2 1.4 4.6 1.4 7.1 0 1.7-0.2 3.3-0.7 4.9s-1.1 3-1.9 4.4c-0.8 1.4-1.7 2.6-2.9 3.7 -1.1 1.1-2.3 2.1-3.7 2.9 -1.4 0.8-2.8 1.4-4.4 1.9 -1.6 0.4-3.2 0.7-4.9 0.7s-3.3-0.2-4.9-0.7 -3-1.1-4.4-1.9c-1.4-0.8-2.6-1.7-3.7-2.9s-2.1-2.3-2.9-3.7c-0.8-1.4-1.4-2.8-1.9-4.4S0.1 20.2 0.1 18.5c0-1.7 0.2-3.3 0.7-4.9 0.4-1.6 1.1-3 1.9-4.4 0.8-1.4 1.8-2.6 2.9-3.7C6.6 4.4 7.8 3.4 9.2 2.6c1.4-0.8 2.8-1.4 4.4-1.9S16.8 0.1 18.5 0.1M22.2 10.8c0 0.5 0.3 0.7 0.8 0.7 0.5 0 0.8-0.2 0.8-0.7V9.1c0-0.5-0.3-0.7-0.8-0.7 -0.5 0-0.8 0.2-0.8 0.7V10.8zM13.2 10.8c0 0.5 0.3 0.7 0.8 0.7s0.8-0.2 0.8-0.7V9.1c0-0.5-0.3-0.7-0.8-0.7s-0.8 0.2-0.8 0.7V10.8zM27 15.6c0-0.2-0.1-0.3-0.3-0.3H10.3c-0.2 0-0.3 0.1-0.3 0.3v11.7c0 0.2 0.1 0.3 0.3 0.3h16.3c0.2 0 0.3-0.1 0.3-0.3V15.6zM27 10.3c0-0.2-0.1-0.3-0.3-0.3h-1.7v0.8c0 0.4-0.1 0.8-0.4 1.2 -0.3 0.4-0.8 0.6-1.4 0.6 -0.7 0-1.2-0.2-1.5-0.6 -0.3-0.4-0.4-0.8-0.4-1.2V10h-5.3v0.8c0 0.4-0.1 0.8-0.4 1.2 -0.3 0.4-0.8 0.6-1.5 0.6s-1.2-0.2-1.5-0.6c-0.3-0.4-0.4-0.8-0.4-1.2V10h-1.8c-0.2 0-0.3 0.1-0.3 0.3v3.4c0 0.2 0.1 0.3 0.3 0.3h16.3c0.2 0 0.3-0.1 0.3-0.3V10.3zM17.3 21.3c0.3 0.1 0.6 0.3 0.9 0.6 0.3 0.2 0.4 0.6 0.4 1.1 0 0.7-0.3 1.2-0.8 1.6 -0.5 0.4-1.2 0.6-2.1 0.6 -0.6 0-1.1-0.1-1.7-0.3 -0.1-0.1-0.1-0.1-0.1-0.2l0.1-1.1c0 0 0-0.1 0.1-0.1h0.1c0.5 0.2 1.1 0.3 1.5 0.3 0.3 0 0.5-0.1 0.7-0.2 0.2-0.1 0.3-0.3 0.3-0.5 0-0.2-0.1-0.4-0.3-0.6 -0.2-0.1-0.6-0.2-1.2-0.3 -0.1 0-0.1-0.1-0.1-0.2v-1.1c0-0.1 0.1-0.1 0.1-0.2 0.6 0 0.9-0.1 1-0.3 0.1-0.1 0.2-0.3 0.2-0.4 0-0.1 0-0.2-0.1-0.3 -0.1-0.1-0.3-0.1-0.7-0.1 -0.4 0-0.8 0.1-1.2 0.3 -0.1 0-0.1 0-0.2 0 0 0-0.1 0-0.1-0.1l-0.1-1.1c0 0 0-0.1 0.1-0.2 0.6-0.2 1.2-0.4 1.9-0.4 0.7 0 1.2 0.1 1.7 0.4 0.4 0.3 0.6 0.7 0.6 1.1C18.4 20.4 18 20.9 17.3 21.3M22.6 18.2c0.1 0 0.2 0.1 0.2 0.2v6.5c0 0.1-0.1 0.1-0.2 0.1h-1.4c-0.1 0-0.1 0-0.1-0.1v-4.6l-0.9 0.3c0 0-0.1 0-0.1 0 0 0 0 0-0.1 0 0 0-0.1-0.1-0.1-0.1l-0.2-1.1c0-0.1 0-0.1 0.1-0.2l2-1c0 0 0 0 0.1 0H22.6z"/></svg>'; break;
		case 'check' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 16 16" enable-background="new 0 0 16 16"><path d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8S12.5 0 8 0zM8 15c-3.9 0-7-3.1-7-7 0-3.9 3.1-7 7-7 3.9 0 7 3.1 7 7C15 11.9 11.9 15 8 15zM11.5 4.8c-0.3-0.2-0.8-0.1-1 0.2L7.2 10.2 5.6 8.7C5.3 8.4 4.9 8.4 4.6 8.7 4.3 9 4.4 9.5 4.6 9.7l2.2 2.1 0 0 0.1 0.1 0.1 0 0.1 0 0.1 0 0.2 0 0.1 0 0.2-0.1 0 0 0.1-0.1 0.1-0.1 0 0 3.8-5.9C12 5.5 11.9 5 11.5 4.8z"/></svg>'; break;
		case 'contact' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path fill="#2F5987" d="M18.5 0.1C8.3 0.1 0.1 8.3 0.1 18.5c0 10.1 8.2 18.4 18.4 18.4 0.6 0 1.1-0.5 1.1-1.1 0-0.6-0.5-1.1-1.1-1.1 -8.9 0-16.1-7.2-16.1-16.1S9.6 2.4 18.5 2.4c8.9 0 16.1 7.2 16.1 16.1 0 3.7-2 7.4-4.8 8.9 -1 0.6-2.1 0.8-3.3 0.9 0.7-0.4 1.3-1 1.8-1.7 0.1-0.1 0.2-0.3 0.3-0.4 0.4-0.9 0.4-1.9 0.6-2.8 0.3-1.2-5.2-3.5-5.7-2 -0.2 0.6-0.4 2.3-0.8 2.8 -0.3 0.4-1.1 0.2-1.5-0.2 -1.3-1.1-2.7-2.6-3.9-3.9 0 0-0.1-0.1-0.1-0.1 0 0-0.1-0.1-0.1-0.1v0c-1.2-1.2-2.8-2.6-3.9-3.9 -0.4-0.5-0.6-1.2-0.2-1.5 0.5-0.3 2.2-0.6 2.8-0.8 1.5-0.5-0.8-6-2-5.7 -0.9 0.2-1.9 0.3-2.8 0.6 -0.2 0.1-0.3 0.2-0.4 0.3 -3.1 2-3.6 6.8-0.5 10.4 1.2 1.4 2.4 2.7 3.6 4l0 0c0 0 0.1 0.1 0.1 0.1 0 0 0.1 0.1 0.1 0.1l0 0c1.3 1.3 2.8 3.1 5.4 4.8 5.3 3.5 9.3 2.5 11.7 1.2 4.1-2.3 6-7.1 6-10.9C36.8 8.3 28.6 0.1 18.5 0.1"/></svg>'; break;
		case 'donate' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 18 18" enable-background="new 0 0 18 18"><path fill="#FEBC11" d="M11.5 12.5c-0.4 0.5-1.1 0.8-1.9 0.9v1.3H8.5v-1.3c-1.4-0.1-2.3-1-2.6-2.4l1.6-0.4c0.2 0.9 0.7 1.4 1.5 1.4 0.4 0 0.7-0.1 0.9-0.3 0.2-0.2 0.3-0.4 0.3-0.7 0-0.3-0.1-0.5-0.3-0.7C9.7 10.1 9.3 9.9 8.7 9.6 8.1 9.4 7.6 9.2 7.3 9 7 8.8 6.7 8.6 6.5 8.2c-0.2-0.4-0.3-0.8-0.3-1.3 0-0.6 0.2-1.2 0.6-1.7C7.1 4.8 7.7 4.5 8.5 4.4V3.4h1.1v1c1.2 0.1 2 0.8 2.3 2l-1.5 0.6c-0.3-0.8-0.7-1.2-1.3-1.2 -0.3 0-0.5 0.1-0.7 0.3 -0.2 0.2-0.3 0.4-0.3 0.7 0 0.3 0.1 0.5 0.3 0.6 0.2 0.1 0.6 0.3 1.1 0.5 0.6 0.2 1.1 0.4 1.5 0.7 0.4 0.2 0.6 0.5 0.9 0.9 0.2 0.4 0.3 0.8 0.3 1.3C12.1 11.4 11.9 12 11.5 12.5M9 0c-5 0-9 4-9 9s4 9 9 9c5 0 9-4 9-9S14 0 9 0"/></svg>'; break;
		case 'employ' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 18 18" enable-background="new 0 0 18 18"><path fill="#FEBC11" d="M9 0c1.2 0 2.4 0.2 3.5 0.7s2.1 1.1 2.9 1.9c0.8 0.8 1.5 1.8 1.9 2.9C17.8 6.6 18 7.8 18 9c0 0.8-0.1 1.6-0.3 2.4 -0.2 0.8-0.5 1.5-0.9 2.2 -0.4 0.7-0.9 1.3-1.4 1.8s-1.2 1-1.8 1.4c-0.7 0.4-1.4 0.7-2.2 0.9C10.6 17.9 9.8 18 9 18s-1.6-0.1-2.4-0.3c-0.8-0.2-1.5-0.5-2.1-0.9 -0.7-0.4-1.3-0.9-1.8-1.4s-1-1.2-1.4-1.8c-0.4-0.7-0.7-1.4-0.9-2.2C0.1 10.6 0 9.8 0 9c0-0.8 0.1-1.6 0.3-2.4C0.5 5.8 0.8 5.1 1.2 4.5c0.4-0.7 0.9-1.3 1.4-1.8 0.5-0.5 1.2-1 1.8-1.4 0.7-0.4 1.4-0.7 2.2-0.9C7.4 0.1 8.2 0 9 0M4.8 10.6c0-0.2 0.1-0.4 0.2-0.6C5.1 9.8 5.2 9.7 5.4 9.6L6.8 9C6.9 8.9 7 8.8 7 8.7 6.9 8.5 6.8 8.3 6.7 8 6.6 7.7 6.6 7.4 6.6 7.1c0-0.2 0-0.4 0.1-0.6 0-0.2 0.1-0.4 0.2-0.5 -0.2-0.2-0.5-0.2-0.7-0.2 -0.4 0-0.8 0.2-1 0.5S4.6 7 4.6 7.5c0 0.3 0.1 0.6 0.2 0.9C5 8.6 5.1 8.9 5.4 9L3.4 9.9c-0.1 0.1-0.2 0.2-0.2 0.4v1.6c0 0.1 0 0.2 0.1 0.3 0.1 0.1 0.1 0.1 0.2 0.1h1.3V10.6zM12.5 10.6c0-0.2-0.1-0.4-0.3-0.4l-1.7-0.8 -0.7-0.3c0.2-0.1 0.3-0.2 0.4-0.4s0.2-0.3 0.3-0.5c0.1-0.1 0.1-0.3 0.2-0.5S10.8 7.3 10.8 7.1c0-0.1 0-0.2 0-0.3 0-0.1 0-0.2-0.1-0.3 -0.1-0.5-0.3-0.8-0.6-1.1C9.8 5.1 9.4 5 9 5c-0.4 0-0.8 0.1-1.1 0.4 -0.3 0.3-0.5 0.6-0.6 1.1 -0.1 0.2-0.1 0.4-0.1 0.6 0 0.4 0.1 0.7 0.2 1C7.6 8.5 7.8 8.8 8.1 9L7.5 9.3l-1.8 0.8c-0.2 0.1-0.3 0.2-0.3 0.5v1.7 0.3c0 0.1 0 0.2 0.1 0.3 0.1 0.1 0.2 0.1 0.3 0.1h6.3c0.1 0 0.2 0 0.3-0.1 0.1-0.1 0.1-0.2 0.1-0.3V12.2 10.6zM14.8 10.3c0-0.2-0.1-0.3-0.2-0.4l-2-0.9c0.2-0.1 0.4-0.3 0.5-0.6 0.1-0.3 0.2-0.6 0.2-0.9 0-0.5-0.1-0.9-0.4-1.2 -0.3-0.3-0.6-0.5-1-0.5 -0.1 0-0.3 0-0.4 0.1s-0.2 0.1-0.4 0.2c0.1 0.4 0.2 0.7 0.2 1.1 0 0.6-0.2 1.1-0.5 1.6 0.1 0.1 0.1 0.1 0.2 0.2 0.1 0 0.1 0.1 0.2 0.1l1.3 0.6c0.2 0.1 0.3 0.2 0.4 0.4 0.1 0.2 0.2 0.4 0.2 0.6v1.7h1.4c0.1 0 0.2 0 0.2-0.1 0.1-0.1 0.1-0.2 0.1-0.3V10.3z"/></svg>'; break;
		case 'facebook'			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path style="fill:#fdbc12;" d="M82.2 21.1H72.1c-7.9 0-9.4 3.8-9.4 9.2v12.1h18.8l-2.5 19H62.8v48.7H43.1V61.5H26.8v-19h16.4v-14c0-16.2 9.9-25.1 24.5-25.1 6.9 0 12.9 0.5 14.6 0.8V21.1z"/></svg>'; break;
		case 'forms' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 27.3 36.7" enable-background="new 0 0 27.317 36.72"><path fill="#2F5987" d="M15 16.6l3.7-3.7c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0l-3.1 3.1 -1.2-1.2c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2l1.8 1.8c0.2 0.2 0.4 0.2 0.6 0.2C14.7 16.8 14.9 16.7 15 16.6M15.3 17.1v0.6h-5v-5h5v0.6l1.1-1.1v0c0-0.3-0.2-0.6-0.6-0.6H9.8c-0.3 0-0.6 0.3-0.6 0.6v6.1c0 0.3 0.2 0.6 0.6 0.6h6.1c0.3 0 0.6-0.2 0.6-0.6v-2.2l-1 1C15.4 17 15.4 17 15.3 17.1M10.4 22.7h4.9v4.9h-4.9V22.7zM9.1 22.1v6.1c0 0.4 0.3 0.6 0.6 0.6h6.1c0.4 0 0.6-0.3 0.6-0.6v-6.1c0-0.3-0.3-0.6-0.6-0.6H9.7C9.4 21.4 9.1 21.7 9.1 22.1M5.6 7.6h16.1V5.9H5.6V7.6zM24.9 29.1h-5.6v5.2l-0.1 0.1H2.4V2.4h22.5V29.1zM27.3 29.8V1.2c0-0.7-0.5-1.2-1.2-1.2H1.2c-0.7 0-1.2 0.5-1.2 1.2v34.3c0 0.7 0.5 1.2 1.2 1.2h18.5c0.3 0 0.6-0.1 0.8-0.3l6.4-5.8C27.2 30.4 27.3 30.1 27.3 29.8"/></svg>'; break;
		case 'linkedin' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M14.2 25.9H14c-6.8 0-11.2-4.7-11.2-10.5 0-6 4.5-10.5 11.4-10.5 6.9 0 11.2 4.5 11.3 10.5C25.6 21.2 21.2 25.9 14.2 25.9zM24.3 95H4V34.2h20.3V95zM97.1 95H77V62.5c0-8.2-2.9-13.8-10.3-13.8 -5.6 0-8.9 3.7-10.4 7.4 -0.5 1.4-0.7 3.1-0.7 5V95H35.5c0.2-55.1 0-60.8 0-60.8h20.2V43h-0.1c2.6-4.2 7.4-10.3 18.4-10.3 13.3 0 23.3 8.7 23.3 27.4V95z"/></svg>'; break;
		case 'lunch' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path fill="#2F5987" d="M29.5 13.4l-4.7 4.7 0 0c-1.6 1.5-3.8 0.4-3.8 0.4l-0.6 0.6 7.1 7.1 -2.1 2.1 -7.1-7.1 -0.3 0.3 0 0 -7 7c0 0-1.5 0.2-1.5-1.5l7.3-7.3 -0.8-0.8 -1.9 1.9c-5.7-3.6-6.5-10.2-6.5-10.2L9.6 8.5l9.2 9.2 0.6-0.6 0 0c-0.6-1.4-1.2-2.3 0.3-3.9l0 0 4.7-4.7 0.8 0.8 -4.2 5 0.9 0.9 4.8-4.6 0.7 0.7 -4.6 4.8 1.1 1.1 4.8-4.3L29.5 13.4zM34.1 18.5c0-8.6-7-15.6-15.6-15.6 -8.6 0-15.6 7-15.6 15.6 0 8.6 7 15.6 15.6 15.6C27.1 34.1 34.1 27.1 34.1 18.5M35.2 18.5c0 9.2-7.5 16.8-16.8 16.8 -9.2 0-16.8-7.5-16.8-16.8S9.2 1.7 18.5 1.7C27.7 1.7 35.2 9.2 35.2 18.5M36.8 18.5c0-10.1-8.2-18.4-18.4-18.4C8.4 0.1 0.1 8.3 0.1 18.5s8.2 18.4 18.4 18.4C28.6 36.8 36.8 28.6 36.8 18.5"/></svg>'; break;
		case 'news' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path fill="#2F5987" d="M9.3 31.7c0 0.3 0.3 0.6 0.6 0.6h9.2c0.3 0 0.6-0.3 0.6-0.6 0-0.3-0.3-0.6-0.6-0.6H9.9C9.5 31.1 9.3 31.4 9.3 31.7M9.3 28.2c0 0.3 0.3 0.6 0.6 0.6h9.2c0.3 0 0.6-0.3 0.6-0.6 0-0.3-0.3-0.6-0.6-0.6H9.9C9.5 27.7 9.3 27.9 9.3 28.2M9.3 24.8c0 0.3 0.3 0.6 0.6 0.6h9.2c0.3 0 0.6-0.3 0.6-0.6 0-0.3-0.3-0.6-0.6-0.6H9.9C9.5 24.2 9.3 24.5 9.3 24.8M17.3 12.7h-5.7V7h5.7V12.7zM19.6 13.9V5.9c0-0.6-0.5-1.1-1.1-1.1h-8c-0.6 0-1.1 0.5-1.1 1.1v8c0 0.6 0.5 1.1 1.2 1.1h8C19.1 15 19.6 14.5 19.6 13.9M32.2 7.6c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 8.2 32.2 7.9 32.2 7.6M32.2 11c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 11.6 32.2 11.3 32.2 11M32.2 14.5c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6s0.3 0.6 0.6 0.6h9.2C32 15 32.2 14.8 32.2 14.5M32.2 17.9c0-0.3-0.3-0.6-0.6-0.6h-21.8c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h21.8C32 18.5 32.2 18.2 32.2 17.9M32.2 21.3c0-0.3-0.3-0.6-0.6-0.6h-21.8c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h21.8C32 21.9 32.2 21.7 32.2 21.3M32.2 24.8c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 25.4 32.2 25.1 32.2 24.8M32.2 28.2c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 28.8 32.2 28.5 32.2 28.2M32.2 31.7c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 32.2 32.2 32 32.2 31.7M34.5 32.2c0 1.3-1 2.3-2.3 2.3H4.7c-1.3 0-2.3-1-2.3-2.3V9.3c0-0.6 0.5-1.1 1.1-1.1h1.1v22.9c0 0.6 0.5 1.1 1.1 1.1 0.6 0 1.2-0.5 1.2-1.1V3.6c0-0.6 0.5-1.1 1.1-1.1h25.2c0.6 0 1.1 0.5 1.1 1.1V32.2zM36.8 32.2V3.6c0-1.9-1.5-3.4-3.4-3.4H8.1c-1.9 0-3.4 1.5-3.4 3.4v2.3H3.6c-1.9 0-3.4 1.5-3.4 3.4v22.9c0 2.5 2.1 4.6 4.6 4.6h27.5C34.8 36.8 36.8 34.8 36.8 32.2"/></svg>'; break;
		case 'trees' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 180 31" enable-background="new 0 0 180 30.961"><path fill="#000000" d="M15.1 25.5c1.9 0.8 4.5 0 5.6-1.1 -0.5-0.8-1.3 0.1-2.2 0.4 -1.1 0.4-2.1 0.6-3.5 0.4 -0.2 0-0.1 0.1-0.1 0.2C15 25.4 15 25.4 15.1 25.5M6.1 24c0.4 0.8 1.5 1 2.6 0.9 0.6 0.4 1.5 0.5 2.4 0.5 0.1-0.1 0.2-0.3 0.3-0.4 -0.6-0.3-1.3 0.1-2-0.2 0.6-0.3 1.2-0.6 1.6-1.1 -0.1-0.3-0.4-0.4-0.7-0.5 -0.5 1-1.5 1.4-3 1.4C7 24.3 6.8 23.9 6.1 24M12.5 2.7c0-0.4-0.5-0.4-0.7-0.7 0-0.2 0.2-0.5 0.1-0.7 -0.2-0.1-0.4 0.2-0.7 0.2 -0.3-0.2-0.4-0.5-0.8-0.5 -0.2 0.2 0 0.6 0.1 0.8 -0.2 0.2-0.8 0.3-0.7 0.6 0.1 0.3 0.7 0.1 0.8 0.4 0 0.3-0.1 0.9 0.2 0.9 0.3-0.2 0.3-0.7 0.6-0.9C11.8 2.7 12.3 2.9 12.5 2.7M12.7 5.1c-0.4 0.2-0.4 0.9-0.8 1.2 0.1-0.5 0.3-0.9 0.4-1.4C12.5 4.9 12.6 5 12.7 5.1M20.1 11.4c0.1-0.7-0.9-1.1-1.5-1.2 -1.9-0.2-4.4 0-5.1-1.1 0.6 0.2 1.4 0.5 2.1 0.5 0.9 0 2.2-0.6 2.2-1.4 -1.1-0.6-2.9-0.6-3.5-1.7 0.6 0 1-0.4 1.1-0.9 -0.8-0.5-2-1-2.7-1.5 -0.3-0.2-0.4-0.6-0.7-0.6 -0.8-0.2-0.3 0.6-0.2 1 0.2 1-0.5 2-0.9 2.8 0.3 0.2 0.4-0.1 0.7-0.1 -1.1 1.4-2.6 2.5-4.3 3.4 -0.1 0.3-0.4 0.3-0.3 0.7 1.1 0.5 2 0.2 2.8-0.3 1-0.6 2.1-1.6 2.5-2.5 -0.2 0-0.4-0.1-0.7-0.1 -0.4 0.5-0.9 1-1.4 1.5 -0.7 0.6-1.5 1.5-2.4 1.2 0.5-0.7 1.4-1 2-1.5 0.9-0.7 1.8-1.5 2.5-2.3C12.4 7.3 12.4 7.3 12.4 7.3c-0.1 0.1-0.1 0.5 0 0.6 0.3 0 0.3 0 0.6 0 0.1-0.1 0.1-0.3 0.1-0.6 -0.1-0.2-0.5-0.2-0.6-0.2 0 0 0-0.1 0-0.1 0-0.1 0.1-0.2 0.1-0.3 0-0.2-0.3 0.1-0.2-0.2 0.2-0.3 0.4-0.7 0.6-1.1 0.1 0.1 0.3 0.1 0.4 0.2 -0.1 0.3-0.4 0.3-0.5 0.6 0.2 0.1 0.5 0.3 0.7 0.4 -0.1 0.2 0 0.2 0.1 0.4 0.8 0.8 2.2 0.9 3.3 1.4 -0.5 0.5-1.1 0.9-1.8 0.9 -1 0-1.8-1.1-2.7-0.9 0 0.4 0.4 0.3 0.4 0.6 -0.2 0.1-0.4 0.3-0.4 0.6h-0.4c-1.1 1.9-3.3 3.2-5.3 4.5 -0.5 0.3-1.5 0.9-1.3 1.5 0.2 0.6 1.3 0.3 1.7 0.4 -1.1 0.9-2.5 1.5-3 3 1.1 1 2.7 0.3 3.8-0.2 2.7-1.2 4.9-3.2 6.6-5.1 -0.2-0.1-0.5-0.1-0.7-0.2 -1.9 2.2-4.5 4.3-7.5 5.4 -0.4 0.1-1 0.5-1.4 0.1 0.7-1.7 2.7-2.1 3.8-3.5 -0.1 0-0.3 0.1-0.2-0.1 1.8-0.8 3.1-2.1 4.3-3.5 -0.1-0.2-0.5-0.1-0.6-0.2 -1.3 1.3-2.5 2.4-4.1 3.3 -0.6 0.3-1.2 0.8-1.9 0.7 0.8-1.3 2.5-1.8 3.6-2.7 1.2-0.9 2.1-1.9 3-3 0.6 0.4 1.3 0.8 2.2 0.9 0 0 0.1 0 0.1 0 -0.2 0.2-0.1 0.7 0.1 0.8 0.7 0.1 0.7-0.2 0.8-0.7 0 0 0 0 0 0 0 0 0.1 0 0.1 0 1.3 0.1 2.9-0.1 3.3 1 -1.8 1.6-4.7 0.1-5.9-1 -0.3 0.1-0.4 0.3-0.6 0.4 0.9 0.8 2.1 1.8 3.8 1.9C17.9 13 20.1 12.2 20.1 11.4M5.4 20.8L5.4 20.8H5.4C5.4 20.8 5.4 20.8 5.4 20.8M5.4 20.8c0.2 0.1 0.4 0 0.6 0 1.6-0.9 3.7-1.5 5.2-2.5 0.5-0.3 1.1-0.8 1.3-1.3 -1-0.1-1.6 0.9-2.5 1.3 -1.5 0.7-3.1 1.3-4.6 2.1C5.3 20.6 5.3 20.8 5.4 20.8M9.5 20.4c0.7 0.1 1.1-0.5 0.9-1C9.6 18.9 8.9 19.8 9.5 20.4M11.5 14.7c0.7 0 0.9-1.5-0.1-1.2C10.7 13.6 10.8 14.7 11.5 14.7M15.4 14.3c-0.3-0.1-0.4 0.3-0.3 0.4 0.1 0 0.1 0.1 0.3 0.1C15.5 14.7 15.5 14.4 15.4 14.3M21.8 14.6c-1.3-1.2-4.7-0.2-6.1-1.5 -0.1 0-0.1 0-0.1 0.1 0 0-0.1 0.1-0.1 0.1 1.2 1 3.4 1.1 5.3 1.2 -1.7 1.6-4.7 1.9-7.5 1.2 0.3 0.5 0.9 0.7 1.5 0.7C17.5 16.8 20.6 16.1 21.8 14.6M26.6 28.9c-0.4-0.5-1-0.7-1.5-0.9 -0.6-0.3-1.1-0.5-1.4-1 -0.4-0.7-0.2-1.3-0.1-2 0-0.4-0.1-0.7-0.2-1 -0.1-1 0-2.1-0.1-3.2 0.9-0.6 0.4-2.3-1-1.9 0 0 0 0 0 0 -0.1-1.2-0.9-1.9-2.3-2 -1.8 0-4.2 0.3-5.9-0.1 0.3 0.6 1.2 0.5 2.2 0.6 1.5 0.2 3.3 0.1 4.8 0.1 0.2 0.3 0.4 0.6 0.5 1.1 -1.6 0.8-4 0.3-5.5-0.3 -0.7-0.3-1.1-0.9-1.7-0.9 1.5 1.5 5.4 2.8 7.9 1.7 0 0 0 0 0 0 -0.5 0.5-0.3 1.4 0.1 1.9 -0.8 1.1-1.9 1.8-3.6 1.9 -0.2-0.1-0.1-0.4-0.4-0.4 -0.4 0.2-0.3 0.5-0.7 0.6 -0.9 0.4-2.2-0.2-2.8-0.6 -0.4-0.3-1-1-0.3-1.2 0.2 0.1 0 0.5 0.1 0.6 0.2 0 0.2-0.3 0.4-0.3 -0.4-0.5 0.1-1.5-0.4-2 -0.2-0.2-0.7-0.2-0.9-0.2 0 0-0.1 0-0.1 0 0 0 0 0 0 0 0.1-0.2 0.4-0.8 0.1-1 -0.2 0.4-0.5 0.8-0.7 1.2 -0.2 0.2-0.2 0.7-0.2 1 -0.2 0.3-0.7 0.3-0.6 0.9 0.6 0.3 0.7-0.3 0.9-0.3 0.1 0.6-0.7 0.7-1.2 0.9 0 0 0 0 0 0 0-0.2 0.2-0.5-0.1-0.5 -0.4-0.1-0.5 0.5-0.9 0.6 0 0 0 0 0 0 -0.4 0.1-0.8-0.3-1.2-0.4 0 0 0 0 0 0 1.6-1.4 3.1-3.1 4-5.2 -0.2 0-0.4-0.2-0.7-0.1 -1 2-2.4 3.6-4.1 5 0 0 0 0 0 0 -0.3-0.1-0.2-0.5-0.6-0.6 -0.7 0.4-1.9 0.1-2.7-0.1 0 0 0 0 0 0 -0.2 0-0.4 0-0.6 0 -1-0.2-1.7-0.6-1.9-1.7 0.2-0.4 0.4-0.4 0.4-0.7 0.3-1.7-2.3-1.7-1.9 0 0.1 0.3 0.4 0.3 0.5 0.7 0.1 0.4-0.2 1.7-0.3 2.5 -0.1 0.5-0.4 0.8-0.4 1.2 -0.1 0.5 0.2 1 0.2 1.4 0 0.8-0.5 1.7-0.9 2.4C0.7 27.5 0.1 28.2 0 28.8c0.4 0 0.9-0.4 1.2-0.7 1-0.9 1.7-2.3 2.2-3.6 1 0.4 1.4 1.5 1.3 2.9 0 0.6-0.4 1.4 0.1 1.8 0.5-0.6 0.5-1.6 0.6-2.4 0-0.4 0.1-1 0.1-1.4 -0.1-1-1.3-1.3-1.5-2 -0.2-0.6 0.2-1.4 0.2-1.9 0.9 0.7 3.1 0.4 4.1-0.1 0.1 0.2 0.4 0.1 0.6 0.2 0 0 0 0 0 0 -0.1 0.4-0.5 0.5-0.7 0.6 -0.7 0.4-1.4 0.9-2.4 0.9 -0.4-0.2-0.5-0.8-0.5-1.2 -0.3-0.1-0.6 0.1-0.7 0.2 0.3 2.5 3.9 0.8 4.9 0 0 0 0 0 0 0 0.7 0.7 1.9 1.1 3.4 0.9 -0.6 0.8-1 2-1.5 2.9 -0.2 0.3-0.6 0.5-0.6 0.9 0.3 0.1 0.6-0.2 0.8-0.1 -0.2 0.6-0.4 1.4-0.7 2.1 -0.2 0.7-0.8 1.4-0.4 2 1.1-1.1 1.8-2.6 2.5-4.1h1c0.8 1.6-0.7 2.9-0.9 4.1 0.6 0.2 0.9-0.6 1.3-1.2 0.6-0.9 1.2-2.2 0.6-3.3 0.3-0.2 0.5-0.6 0.4-0.9 0 0 0 0 0 0 -0.1 0-0.1-0.1-0.1-0.1 0 0 0 0.1-0.1 0.1 -0.3-0.3-0.4-1.3-0.1-1.7 1 0.8 2.6 0 3.3-0.6 0.9 0.1 2.5 0.4 3.5-0.1 -0.5 0.7 0.1 1.7 0 2.5 0 0.5-0.4 1-0.6 1.6 -0.1 0.4-0.1 0.8-0.1 1.2 -0.1 1 0.1 2 0.8 2.5 0.5-0.6 0.2-1.8 0.2-2.8 0.1-0.6 0.2-1.2 0.4-1.5C22.7 28.3 24.5 29.1 26.6 28.9M19.5 21.5c0.5 0.1 1.2 0.1 1.5 0.1 1.2-0.3 0.7-1.8-0.4-1.8 0 0.4 0.4 0.4 0.4 0.9 -0.3 0.6-1.3 0.5-1.8 0.4 -1-0.2-2.5-0.7-3.3-1.4 -0.7-0.6-0.9-1.7-1.8-1.5C15.1 19.7 17.4 21 19.5 21.5M15.2 20.5c0 0-0.1 0.1-0.1 0.1 0.7 1.1 2.1 1.6 3.8 1.8 0.2 0.1 0.3 0.2 0.4 0.2 0.1-0.1 0.3-0.1 0.5-0.1 -1-0.9-2.8-0.6-3.8-1.5C15.9 20.7 15.6 20.3 15.2 20.5M18.2 18.3c0.2 0.3 0.7 0.2 0.9-0.1C19.3 17.4 17.9 17.4 18.2 18.3M12 20.7c0.2 0 0.3-0.1 0.4-0.1 0.1-0.6-0.7-0.6-0.6 0C11.9 20.6 12 20.7 12 20.7M30.1 8.7h4.6V6.1h-7.8v18.1h3.2V15.7h3.3v-2.6h-3.3V8.7zM36.5 24.2h8.2v-2.6H39.8V15.7h3.3v-2.6H39.8V8.7h4.6V6.1h-7.8V24.2zM50.5 12.1c-0.7-0.9-0.9-1.4-0.9-2.2 0-0.8 0.6-1.4 1.5-1.4 0.8 0 1.4 0.7 1.4 2v0.7h3.2V9.9c0-2.4-1.9-4-4.7-4 -2.8 0-4.7 1.6-4.7 4 0 2.5 0.7 3.1 2.4 5.1l2.7 2.8c0.7 0.8 1.1 1.5 1.1 2.5 0 1.1-0.6 1.7-1.4 1.7 -0.8 0-1.4-0.5-1.4-1.7v-1.7h-3.3v1.9c0 2.6 2.1 4.1 4.7 4.1 2.6 0 4.8-1.4 4.8-4.1 0-2.1-0.8-3.1-2.1-4.6L50.5 12.1zM63.6 8.7h3.3V6.1h-9.9v2.6h3.3v15.6h3.2V8.7zM68.9 24.2h3.2V6.1h-3.2V24.2zM81.4 24.2l4.2-18.1h-3.4L79.8 19.5h-0.1L77.5 6.1h-3.5l4 18.1H81.4zM91.1 17.4h-2.1l1-6.5h0.1L91.1 17.4zM92.3 24.2h3.2L91.8 6.1h-3.2l-3.7 18.1h3.1l0.6-4.2h3.1L92.3 24.2zM97.4 24.2h7.5v-2.6h-4.2V6.1h-3.2V24.2zM123.2 2.1c0 2.4-2.8 9.7-5.2 11.9 2-8.3 3.5-12.8 4.7-12.8C123.1 1.1 123.2 1.5 123.2 2.1M116.7 20.2c0.5 1.1 0.7 2.2 0.7 3.2 0 1.7-0.6 3-1.2 3 -0.3 0-0.4-0.3-0.4-0.9C115.8 24.9 115.9 24.2 116.7 20.2M112.2 9.6c0 1.7-0.4 4-1 5.8 -1.2-0.7-1.7-2.3-1.7-3.8 0-2.3 0.9-4.4 1.8-4.4C112 7.3 112.2 8.3 112.2 9.6M110.9 16.3c-0.4 1.2-0.9 2-1.4 2 -0.1 0-0.2 0-0.2 0 -0.9 0-1.2-1-1.2-2.4 0-0.8 0.1-1.6 0.3-2.4C108.7 14.8 109.5 15.9 110.9 16.3M124.3 3.1c0-1.4-0.6-2-1-2.2 -0.1-0.4-0.6-0.8-1.2-0.8 -3.5 0-4.9 6.4-6.5 13.6 0 0.2-0.1 0.4-0.1 0.5 -0.6 1.1-1.6 1.6-2.5 1.6 0.9-1.7 1.4-3.8 1.4-5.6 0-2.2-0.9-4-2.9-4 -1.6 0-2.7 1.2-3.2 2.9 -0.6-0.1-1.1 0.5-1.3 1 -0.7 1.4-1.2 3.3-1.2 5.2 0 2.4 0.9 4.3 2.9 4.3 1.5 0 2.8-1.3 3.9-3.1 1.1 0 2-0.5 2.7-1 -0.6 3-1.1 5.7-1.1 7.8 0 2.3 0.6 3.8 2.1 3.8 1.9 0 2.5-1.6 2.5-3.3 0-1.9-0.7-3.9-1.7-4.3 3.2-0.6 5.6-1.9 6.9-5 0.1-0.1 0.1-0.3 0.1-0.4 0-0.2-0.1-0.3-0.2-0.3 -0.1 0-0.3 0.1-0.4 0.4 -1.3 2.8-3.6 3.6-6.5 4 0.2-1.3 0.5-2.4 0.7-3.4C120.3 14.7 124.3 9.3 124.3 3.1M133.2 8.7h3.3V6.1h-9.9v2.6h3.3v15.6h3.2V8.7zM145.3 11.3c0 2.6-0.6 2.9-2.7 2.9h-1V8.7h2.1C145 8.7 145.3 9.8 145.3 11.3M149.1 24.2l-3.4-7.7c1.6-0.8 2.7-2.5 2.7-5.2 0-2.9-1.5-5.2-4.6-5.2h-5.4v18.1h3.2v-7.3h1l3.1 7.3H149.1zM150.7 24.2h8.2v-2.6h-4.9V15.7h3.3v-2.6h-3.3V8.7h4.6V6.1h-7.8V24.2zM160.7 24.2h8.2v-2.6h-4.9V15.7h3.3v-2.6h-3.3V8.7h4.6V6.1h-7.8V24.2zM176.7 11.2h3.2V9.9c0-2.4-1.9-4-4.7-4 -2.8 0-4.7 1.6-4.7 4 0 2.5 0.7 3.1 2.4 5.1l2.7 2.8c0.7 0.8 1.1 1.5 1.1 2.5 0 1.1-0.6 1.7-1.4 1.7 -0.8 0-1.4-0.5-1.4-1.7v-1.7h-3.3v1.9c0 2.6 2.1 4.1 4.7 4.1 2.6 0 4.8-1.4 4.8-4.1 0-2.1-0.8-3.1-2.1-4.6l-3.2-3.7c-0.7-0.9-0.9-1.4-0.9-2.2 0-0.8 0.6-1.4 1.4-1.4 0.8 0 1.4 0.7 1.4 2V11.2z"/></svg>'; break;
		case 'twitter' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path d="M101.2 33.6c0.1 1 0.1 2 0.1 3 0 30.5-23.2 65.6-65.6 65.6 -13.1 0-25.2-3.8-35.4-10.4 1.9 0.2 3.6 0.3 5.6 0.3 10.8 0 20.7-3.6 28.6-9.9 -10.1-0.2-18.6-6.9-21.6-16 1.4 0.2 2.9 0.4 4.4 0.4 2.1 0 4.1-0.3 6.1-0.8C12.7 63.7 4.8 54.4 4.8 43.2c0-0.1 0-0.2 0-0.3 3.1 1.7 6.6 2.8 10.4 2.9C9 41.7 4.9 34.6 4.9 26.6c0-4.3 1.1-8.2 3.1-11.6 11.4 14 28.4 23.1 47.6 24.1 -0.4-1.7-0.6-3.5-0.6-5.3 0-12.7 10.3-23.1 23.1-23.1 6.6 0 12.6 2.8 16.9 7.3 5.2-1 10.2-2.9 14.6-5.6 -1.7 5.4-5.4 9.9-10.1 12.7 4.6-0.5 9.1-1.8 13.3-3.6C109.6 26.2 105.7 30.3 101.2 33.6z" fill="#fdbc12"/></svg>'; break;
		case 'youtube' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M89.5 90.4c-1 4.4-4.6 7.6-8.8 8 -10.2 1.2-20.4 1.2-30.7 1.2 -10.2 0-20.5 0-30.7-1.2 -4.3-0.4-7.8-3.6-8.8-8 -1.4-6.2-1.4-13-1.4-19.3 0-6.4 0.1-13.2 1.4-19.3 1-4.4 4.6-7.6 8.9-8.1 10.1-1.1 20.4-1.1 30.6-1.1 10.2 0 20.5 0 30.7 1.1 4.3 0.5 7.8 3.7 8.8 8.1 1.4 6.2 1.4 12.9 1.4 19.3C90.9 77.4 90.9 84.2 89.5 90.4zM32.4 57.3v-5.2H15.2v5.2H21v31.4h5.5V57.3H32.4zM41.4 0.5l-6.7 22v15h-5.5v-15c-0.5-2.7-1.6-6.6-3.4-11.7C24.6 7.4 23.4 4 22.3 0.5h5.9L32 15.1l3.8-14.5H41.4zM47.4 88.7V61.4h-4.9v20.9c-1.1 1.5-2.2 2.3-3.1 2.3 -0.7 0-1-0.4-1.2-1.2 -0.1-0.2-0.1-0.8-0.1-1.9V61.4h-4.9V83c0 1.9 0.2 3.2 0.4 4 0.4 1.4 1.6 2 3.2 2 1.8 0 3.6-1.1 5.6-3.4v3H47.4zM56.2 28.6c0 2.9-0.5 5.1-1.5 6.5 -1.4 1.9-3.3 2.8-5.9 2.8 -2.5 0-4.4-0.9-5.8-2.8 -1-1.4-1.5-3.6-1.5-6.5v-9.7c0-2.9 0.5-5.1 1.5-6.5 1.4-1.9 3.3-2.8 5.8-2.8 2.5 0 4.5 0.9 5.9 2.8 1 1.4 1.5 3.5 1.5 6.5V28.6zM51.2 17.9c0-2.5-0.7-3.8-2.4-3.8 -1.6 0-2.4 1.3-2.4 3.8v11.6c0 2.5 0.8 3.9 2.4 3.9 1.7 0 2.4-1.3 2.4-3.9V17.9zM66.1 69.7c0-2.5-0.1-4.4-0.5-5.5 -0.6-2-2-3.1-3.9-3.1 -1.8 0-3.5 1-5.1 3v-12h-4.9v36.6h4.9v-2.7c1.7 2 3.4 3 5.1 3 1.9 0 3.3-1 3.9-3 0.4-1.2 0.5-3 0.5-5.5V69.7zM61.2 80.9c0 2.5-0.7 3.7-2.2 3.7 -0.8 0-1.7-0.4-2.5-1.2V66.8c0.8-0.8 1.7-1.2 2.5-1.2 1.4 0 2.2 1.3 2.2 3.7V80.9zM74.8 37.6h-5v-3c-2 2.3-3.9 3.4-5.7 3.4 -1.6 0-2.8-0.7-3.3-2 -0.3-0.8-0.4-2.2-0.4-4.1V10h5v20.3c0 1.2 0 1.8 0.1 1.9 0.1 0.8 0.5 1.2 1.2 1.2 1 0 2-0.8 3.1-2.4V10h5V37.6zM84.8 79.3h-5c0 2-0.1 3.1-0.1 3.4 -0.3 1.3-1 2-2.2 2 -1.7 0-2.5-1.3-2.5-3.8V76h9.9v-5.7c0-2.9-0.5-5-1.5-6.4 -1.4-1.9-3.4-2.8-5.9-2.8 -2.5 0-4.5 0.9-5.9 2.8 -1 1.4-1.5 3.5-1.5 6.4v9.6c0 2.9 0.6 5.1 1.6 6.4 1.4 1.9 3.4 2.8 6 2.8 2.6 0 4.6-1 6-2.9 0.6-0.9 1-1.9 1.2-3 0.1-0.5 0.1-1.6 0.1-3.2V79.3zM79.9 71.9h-5v-2.5c0-2.5 0.8-3.8 2.5-3.8 1.7 0 2.5 1.3 2.5 3.8V71.9z"/></svg>'; break;

	} // switch
	
	return $output;

} // get_svg()

