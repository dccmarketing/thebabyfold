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
}
add_action( 'widgets_init', 'thebabyfold_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thebabyfold_scripts() {
	wp_enqueue_style( 'thebabyfold-style', get_stylesheet_uri(), array( 'dashicons' ) );

	wp_enqueue_script( 'thebabyfold-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

	wp_enqueue_script( 'thebabyfold-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	wp_enqueue_script( 'thebabyfold-public-script', get_template_directory_uri() . '/js/public.min.js', array( 'jquery' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'thebabyfold-google-fonts', babyfold_fonts_url(), array(), '20150424' );

}
add_action( 'wp_enqueue_scripts', 'thebabyfold_scripts' );

/**
 * Enqueue scripts and styles.
 */
function thebabyfold_admin_scripts() {

	wp_enqueue_style( 'thebabyfold-admin-style', get_template_directory_uri() . '/admin.css', array() );

}
add_action( 'admin_enqueue_scripts', 'thebabyfold_admin_scripts' );

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
 * Properly encode a font URLs to enqueue a Google font
 *
 * @return 	mixed 		A properly formatted, translated URL for a Google font
 */
function babyfold_fonts_url() {

	$return 	= '';
	$families 	= '';
	$fonts[] 	= array( 'font' => 'Cabin', 'weights' => '400,500,600,700', 'translate' => _x( 'on', 'Cabin font: on or off', 'thebabyfold' ) );

	foreach ( $fonts as $font ) {

		if ( 'off' == $font['translate'] ) { continue; }

		$families[] = $font['font'] . ':' . $font['weights'];

	}

	if ( ! empty( $families ) ) {

		$query_args['family'] 	= urlencode( implode( '|', $families ) );
		$query_args['subset'] 	= urlencode( 'latin,latin-ext' );
		$return 				= add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	}

	return $return;

} // babyfold_fonts_url()

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

	$output 	= '';
	$img_array 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

	if ( empty( $img_array ) ) {

		$default = get_theme_mod( 'default_footer_image' );
		$output .= '<style>@media screen and (min-width: 769px) {.site-footer{background-image:url(' . $default . ');}}</style>';

	} else {

		$output .= '<style>@media screen and (min-width: 769px) {.site-footer{background-image:url(' . $img_array[0] . ');}}</style>';

	}

	echo $output;

} // End of add_style_tags()

add_action( 'wp_footer', 'add_style_tags' );

/**
 * Performs a WordPress Query for posts in a particular category
 *
 * @uses 	WP_Query()
 *
 * @return  object 				A query object containing the results of the query
 */
function babyfold_get_category_posts( $category, $quantity = 100, $paged = 1 ) {

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
	$class 	= babyfold_get_svg_by_class( $item->classes );

	if ( ! empty( $class ) ) {

		$output .= $class;

	} else {

		if ( $host !== parse_url( get_site_url(), PHP_URL_HOST ) ) {

			$output .= babyfold_get_svg_by_url( $item->url );

		} else {

			$output .= babyfold_get_svg_by_pageID( $item->object_id );

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
function babyfold_top_header_menu_svgs( $item_output, $item, $depth, $args ) {

	if ( 'top_header' !== $args->theme_location ) { return $item_output; }

	$class = babyfold_get_svg_by_class( $item->classes );

	$output = '<a href="' . $item->url . '" class="icon-menu">';
	$output .= '<span class="fest-icon">' . $class . '</span>';
	$output .= '<span class="menu-icon-label">' . $item->title . '</span>';
	$output .= '</a>';

	return $output;

} // babyfold_top_header_menu_svgs()

add_filter( 'walker_nav_menu_start_el', 'babyfold_top_header_menu_svgs', 10, 4 );

/**
 * Gets the appropriate SVG based on a menu item class
 *
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function babyfold_get_svg_by_class( $classes ) {

	$output = '';

	foreach ( $classes as $class ) {

		$check = babyfold_get_svg( $class );

		if ( ! is_null( $check ) ) { $output .= $check; break; }

	} // foreach

	return $output;

} // babyfold_get_svg_by_class()



/**
 * Gets the appropriate SVG based on a URL
 *
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function babyfold_get_svg_by_pageID( $ID ) {

	$output = '';
	$page 	= get_post( $ID );

	switch( $page->post_title ) {

		case 'Calendar' 			: $output .= babyfold_get_svg( 'calendar' ); break;
		case 'Camping' 				: $output .= babyfold_get_svg( 'camping' ); break;
		case 'Events & Festivals' 	: $output .= babyfold_get_svg( 'calendar' ); break;
		case 'Hotels' 				: $output .= babyfold_get_svg( 'hotel' ); break;
		case 'Motels' 				: $output .= babyfold_get_svg( 'hotel' ); break;
		case 'Travel Guides' 		: $output .= babyfold_get_svg( 'map-location' ); break;

	} // switch

	return $output;

} // babyfold_get_svg_by_pageID()



/**
 * Gets the appropriate SVG based on a URL
 *
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function babyfold_get_svg_by_url( $url ) {

	$output = '';
	$host 	= parse_url( $url, PHP_URL_HOST );

	switch( $host ) {

		case 'facebook.com' 	: $output .= babyfold_get_svg( 'facebook' ); break;
		case 'instagram.com' 	: $output .= babyfold_get_svg( 'instagram' ); break;
		case 'linked.com' 		: $output .= babyfold_get_svg( 'linkedin' ); break;
		case 'twitter.com' 		: $output .= babyfold_get_svg( 'twitter' ); break;
		case 'youtube.com' 		: $output .= babyfold_get_svg( 'youtube' ); break;

	} // switch

	return $output;

} // babyfold_get_svg_by_url()

/**
 * Returns the requested SVG
 *
 * @param 	string 		$icon 		The name of the icon to return
 *
 * @return 	mixed 					The SVG code
 */
function babyfold_get_svg( $icon ) {

	$output = '';

	switch( $icon ) {

		case 'calendar' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path d="M18.5 0.1c2.5 0 4.9 0.5 7.1 1.5 2.2 1 4.2 2.3 5.8 3.9 1.7 1.7 3 3.6 3.9 5.8 1 2.2 1.4 4.6 1.4 7.1 0 1.7-0.2 3.3-0.7 4.9s-1.1 3-1.9 4.4c-0.8 1.4-1.7 2.6-2.9 3.7 -1.1 1.1-2.3 2.1-3.7 2.9 -1.4 0.8-2.8 1.4-4.4 1.9 -1.6 0.4-3.2 0.7-4.9 0.7s-3.3-0.2-4.9-0.7 -3-1.1-4.4-1.9c-1.4-0.8-2.6-1.7-3.7-2.9s-2.1-2.3-2.9-3.7c-0.8-1.4-1.4-2.8-1.9-4.4S0.1 20.2 0.1 18.5c0-1.7 0.2-3.3 0.7-4.9 0.4-1.6 1.1-3 1.9-4.4 0.8-1.4 1.8-2.6 2.9-3.7C6.6 4.4 7.8 3.4 9.2 2.6c1.4-0.8 2.8-1.4 4.4-1.9S16.8 0.1 18.5 0.1M22.2 10.8c0 0.5 0.3 0.7 0.8 0.7 0.5 0 0.8-0.2 0.8-0.7V9.1c0-0.5-0.3-0.7-0.8-0.7 -0.5 0-0.8 0.2-0.8 0.7V10.8zM13.2 10.8c0 0.5 0.3 0.7 0.8 0.7s0.8-0.2 0.8-0.7V9.1c0-0.5-0.3-0.7-0.8-0.7s-0.8 0.2-0.8 0.7V10.8zM27 15.6c0-0.2-0.1-0.3-0.3-0.3H10.3c-0.2 0-0.3 0.1-0.3 0.3v11.7c0 0.2 0.1 0.3 0.3 0.3h16.3c0.2 0 0.3-0.1 0.3-0.3V15.6zM27 10.3c0-0.2-0.1-0.3-0.3-0.3h-1.7v0.8c0 0.4-0.1 0.8-0.4 1.2 -0.3 0.4-0.8 0.6-1.4 0.6 -0.7 0-1.2-0.2-1.5-0.6 -0.3-0.4-0.4-0.8-0.4-1.2V10h-5.3v0.8c0 0.4-0.1 0.8-0.4 1.2 -0.3 0.4-0.8 0.6-1.5 0.6s-1.2-0.2-1.5-0.6c-0.3-0.4-0.4-0.8-0.4-1.2V10h-1.8c-0.2 0-0.3 0.1-0.3 0.3v3.4c0 0.2 0.1 0.3 0.3 0.3h16.3c0.2 0 0.3-0.1 0.3-0.3V10.3zM17.3 21.3c0.3 0.1 0.6 0.3 0.9 0.6 0.3 0.2 0.4 0.6 0.4 1.1 0 0.7-0.3 1.2-0.8 1.6 -0.5 0.4-1.2 0.6-2.1 0.6 -0.6 0-1.1-0.1-1.7-0.3 -0.1-0.1-0.1-0.1-0.1-0.2l0.1-1.1c0 0 0-0.1 0.1-0.1h0.1c0.5 0.2 1.1 0.3 1.5 0.3 0.3 0 0.5-0.1 0.7-0.2 0.2-0.1 0.3-0.3 0.3-0.5 0-0.2-0.1-0.4-0.3-0.6 -0.2-0.1-0.6-0.2-1.2-0.3 -0.1 0-0.1-0.1-0.1-0.2v-1.1c0-0.1 0.1-0.1 0.1-0.2 0.6 0 0.9-0.1 1-0.3 0.1-0.1 0.2-0.3 0.2-0.4 0-0.1 0-0.2-0.1-0.3 -0.1-0.1-0.3-0.1-0.7-0.1 -0.4 0-0.8 0.1-1.2 0.3 -0.1 0-0.1 0-0.2 0 0 0-0.1 0-0.1-0.1l-0.1-1.1c0 0 0-0.1 0.1-0.2 0.6-0.2 1.2-0.4 1.9-0.4 0.7 0 1.2 0.1 1.7 0.4 0.4 0.3 0.6 0.7 0.6 1.1C18.4 20.4 18 20.9 17.3 21.3M22.6 18.2c0.1 0 0.2 0.1 0.2 0.2v6.5c0 0.1-0.1 0.1-0.2 0.1h-1.4c-0.1 0-0.1 0-0.1-0.1v-4.6l-0.9 0.3c0 0-0.1 0-0.1 0 0 0 0 0-0.1 0 0 0-0.1-0.1-0.1-0.1l-0.2-1.1c0-0.1 0-0.1 0.1-0.2l2-1c0 0 0 0 0.1 0H22.6z"/></svg>'; break;
		case 'check' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 16 16" enable-background="new 0 0 16 16"><path d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8S12.5 0 8 0zM8 15c-3.9 0-7-3.1-7-7 0-3.9 3.1-7 7-7 3.9 0 7 3.1 7 7C15 11.9 11.9 15 8 15zM11.5 4.8c-0.3-0.2-0.8-0.1-1 0.2L7.2 10.2 5.6 8.7C5.3 8.4 4.9 8.4 4.6 8.7 4.3 9 4.4 9.5 4.6 9.7l2.2 2.1 0 0 0.1 0.1 0.1 0 0.1 0 0.1 0 0.2 0 0.1 0 0.2-0.1 0 0 0.1-0.1 0.1-0.1 0 0 3.8-5.9C12 5.5 11.9 5 11.5 4.8z"/></svg>'; break;
		case 'contact' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path d="M18.5 0.1C8.3 0.1 0.1 8.3 0.1 18.5c0 10.1 8.2 18.4 18.4 18.4 0.6 0 1.1-0.5 1.1-1.1 0-0.6-0.5-1.1-1.1-1.1 -8.9 0-16.1-7.2-16.1-16.1S9.6 2.4 18.5 2.4c8.9 0 16.1 7.2 16.1 16.1 0 3.7-2 7.4-4.8 8.9 -1 0.6-2.1 0.8-3.3 0.9 0.7-0.4 1.3-1 1.8-1.7 0.1-0.1 0.2-0.3 0.3-0.4 0.4-0.9 0.4-1.9 0.6-2.8 0.3-1.2-5.2-3.5-5.7-2 -0.2 0.6-0.4 2.3-0.8 2.8 -0.3 0.4-1.1 0.2-1.5-0.2 -1.3-1.1-2.7-2.6-3.9-3.9 0 0-0.1-0.1-0.1-0.1 0 0-0.1-0.1-0.1-0.1v0c-1.2-1.2-2.8-2.6-3.9-3.9 -0.4-0.5-0.6-1.2-0.2-1.5 0.5-0.3 2.2-0.6 2.8-0.8 1.5-0.5-0.8-6-2-5.7 -0.9 0.2-1.9 0.3-2.8 0.6 -0.2 0.1-0.3 0.2-0.4 0.3 -3.1 2-3.6 6.8-0.5 10.4 1.2 1.4 2.4 2.7 3.6 4l0 0c0 0 0.1 0.1 0.1 0.1 0 0 0.1 0.1 0.1 0.1l0 0c1.3 1.3 2.8 3.1 5.4 4.8 5.3 3.5 9.3 2.5 11.7 1.2 4.1-2.3 6-7.1 6-10.9C36.8 8.3 28.6 0.1 18.5 0.1"/></svg>'; break;
		case 'donate' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 18 18" enable-background="new 0 0 18 18"><path d="M11.5 12.5c-0.4 0.5-1.1 0.8-1.9 0.9v1.3H8.5v-1.3c-1.4-0.1-2.3-1-2.6-2.4l1.6-0.4c0.2 0.9 0.7 1.4 1.5 1.4 0.4 0 0.7-0.1 0.9-0.3 0.2-0.2 0.3-0.4 0.3-0.7 0-0.3-0.1-0.5-0.3-0.7C9.7 10.1 9.3 9.9 8.7 9.6 8.1 9.4 7.6 9.2 7.3 9 7 8.8 6.7 8.6 6.5 8.2c-0.2-0.4-0.3-0.8-0.3-1.3 0-0.6 0.2-1.2 0.6-1.7C7.1 4.8 7.7 4.5 8.5 4.4V3.4h1.1v1c1.2 0.1 2 0.8 2.3 2l-1.5 0.6c-0.3-0.8-0.7-1.2-1.3-1.2 -0.3 0-0.5 0.1-0.7 0.3 -0.2 0.2-0.3 0.4-0.3 0.7 0 0.3 0.1 0.5 0.3 0.6 0.2 0.1 0.6 0.3 1.1 0.5 0.6 0.2 1.1 0.4 1.5 0.7 0.4 0.2 0.6 0.5 0.9 0.9 0.2 0.4 0.3 0.8 0.3 1.3C12.1 11.4 11.9 12 11.5 12.5M9 0c-5 0-9 4-9 9s4 9 9 9c5 0 9-4 9-9S14 0 9 0"/></svg>'; break;
		case 'employ' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 18 18" enable-background="new 0 0 18 18"><path d="M9 0c1.2 0 2.4 0.2 3.5 0.7s2.1 1.1 2.9 1.9c0.8 0.8 1.5 1.8 1.9 2.9C17.8 6.6 18 7.8 18 9c0 0.8-0.1 1.6-0.3 2.4 -0.2 0.8-0.5 1.5-0.9 2.2 -0.4 0.7-0.9 1.3-1.4 1.8s-1.2 1-1.8 1.4c-0.7 0.4-1.4 0.7-2.2 0.9C10.6 17.9 9.8 18 9 18s-1.6-0.1-2.4-0.3c-0.8-0.2-1.5-0.5-2.1-0.9 -0.7-0.4-1.3-0.9-1.8-1.4s-1-1.2-1.4-1.8c-0.4-0.7-0.7-1.4-0.9-2.2C0.1 10.6 0 9.8 0 9c0-0.8 0.1-1.6 0.3-2.4C0.5 5.8 0.8 5.1 1.2 4.5c0.4-0.7 0.9-1.3 1.4-1.8 0.5-0.5 1.2-1 1.8-1.4 0.7-0.4 1.4-0.7 2.2-0.9C7.4 0.1 8.2 0 9 0M4.8 10.6c0-0.2 0.1-0.4 0.2-0.6C5.1 9.8 5.2 9.7 5.4 9.6L6.8 9C6.9 8.9 7 8.8 7 8.7 6.9 8.5 6.8 8.3 6.7 8 6.6 7.7 6.6 7.4 6.6 7.1c0-0.2 0-0.4 0.1-0.6 0-0.2 0.1-0.4 0.2-0.5 -0.2-0.2-0.5-0.2-0.7-0.2 -0.4 0-0.8 0.2-1 0.5S4.6 7 4.6 7.5c0 0.3 0.1 0.6 0.2 0.9C5 8.6 5.1 8.9 5.4 9L3.4 9.9c-0.1 0.1-0.2 0.2-0.2 0.4v1.6c0 0.1 0 0.2 0.1 0.3 0.1 0.1 0.1 0.1 0.2 0.1h1.3V10.6zM12.5 10.6c0-0.2-0.1-0.4-0.3-0.4l-1.7-0.8 -0.7-0.3c0.2-0.1 0.3-0.2 0.4-0.4s0.2-0.3 0.3-0.5c0.1-0.1 0.1-0.3 0.2-0.5S10.8 7.3 10.8 7.1c0-0.1 0-0.2 0-0.3 0-0.1 0-0.2-0.1-0.3 -0.1-0.5-0.3-0.8-0.6-1.1C9.8 5.1 9.4 5 9 5c-0.4 0-0.8 0.1-1.1 0.4 -0.3 0.3-0.5 0.6-0.6 1.1 -0.1 0.2-0.1 0.4-0.1 0.6 0 0.4 0.1 0.7 0.2 1C7.6 8.5 7.8 8.8 8.1 9L7.5 9.3l-1.8 0.8c-0.2 0.1-0.3 0.2-0.3 0.5v1.7 0.3c0 0.1 0 0.2 0.1 0.3 0.1 0.1 0.2 0.1 0.3 0.1h6.3c0.1 0 0.2 0 0.3-0.1 0.1-0.1 0.1-0.2 0.1-0.3V12.2 10.6zM14.8 10.3c0-0.2-0.1-0.3-0.2-0.4l-2-0.9c0.2-0.1 0.4-0.3 0.5-0.6 0.1-0.3 0.2-0.6 0.2-0.9 0-0.5-0.1-0.9-0.4-1.2 -0.3-0.3-0.6-0.5-1-0.5 -0.1 0-0.3 0-0.4 0.1s-0.2 0.1-0.4 0.2c0.1 0.4 0.2 0.7 0.2 1.1 0 0.6-0.2 1.1-0.5 1.6 0.1 0.1 0.1 0.1 0.2 0.2 0.1 0 0.1 0.1 0.2 0.1l1.3 0.6c0.2 0.1 0.3 0.2 0.4 0.4 0.1 0.2 0.2 0.4 0.2 0.6v1.7h1.4c0.1 0 0.2 0 0.2-0.1 0.1-0.1 0.1-0.2 0.1-0.3V10.3z"/></svg>'; break;
		case 'facebook'			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path d="M82.2 21.1H72.1c-7.9 0-9.4 3.8-9.4 9.2v12.1h18.8l-2.5 19H62.8v48.7H43.1V61.5H26.8v-19h16.4v-14c0-16.2 9.9-25.1 24.5-25.1 6.9 0 12.9 0.5 14.6 0.8V21.1z"/></svg>'; break;
		case 'facebooksquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="facebooksquare" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M79.5 97H67.7V59.6h12.5L82 45.9H67.7v-8.8c0-4.1 1.7-6.9 7.6-6.9l8.1-0.1V17.5c-2-0.2-5.9-0.6-11-0.6 -10.9 0-18.4 6.6-18.4 18.8v10.2H40.2v13.8h13.8V97H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7v58.9C97.1 89.1 89.2 97 79.5 97z"/></svg>'; break;
		case 'flickr' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="flickr" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.6 20.2v59.5c0 9.8-8 17.8-17.8 17.8H20.3c-9.8 0-17.8-8-17.8-17.8V20.2c0-9.8 8-17.8 17.8-17.8h59.5C89.6 2.3 97.6 10.3 97.6 20.2zM32.5 36.8c-7.2 0-13.1 5.9-13.1 13.1S25.3 63 32.5 63s13.1-5.9 13.1-13.1S39.8 36.8 32.5 36.8zM67.5 36.8c-7.2 0-13.1 5.9-13.1 13.1S60.2 63 67.5 63s13.1-5.9 13.1-13.1S74.7 36.8 67.5 36.8z"/></svg>'; break;
		case 'forms' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 27.3 36.7" enable-background="new 0 0 27.317 36.72"><path d="M15 16.6l3.7-3.7c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0l-3.1 3.1 -1.2-1.2c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2l1.8 1.8c0.2 0.2 0.4 0.2 0.6 0.2C14.7 16.8 14.9 16.7 15 16.6M15.3 17.1v0.6h-5v-5h5v0.6l1.1-1.1v0c0-0.3-0.2-0.6-0.6-0.6H9.8c-0.3 0-0.6 0.3-0.6 0.6v6.1c0 0.3 0.2 0.6 0.6 0.6h6.1c0.3 0 0.6-0.2 0.6-0.6v-2.2l-1 1C15.4 17 15.4 17 15.3 17.1M10.4 22.7h4.9v4.9h-4.9V22.7zM9.1 22.1v6.1c0 0.4 0.3 0.6 0.6 0.6h6.1c0.4 0 0.6-0.3 0.6-0.6v-6.1c0-0.3-0.3-0.6-0.6-0.6H9.7C9.4 21.4 9.1 21.7 9.1 22.1M5.6 7.6h16.1V5.9H5.6V7.6zM24.9 29.1h-5.6v5.2l-0.1 0.1H2.4V2.4h22.5V29.1zM27.3 29.8V1.2c0-0.7-0.5-1.2-1.2-1.2H1.2c-0.7 0-1.2 0.5-1.2 1.2v34.3c0 0.7 0.5 1.2 1.2 1.2h18.5c0.3 0 0.6-0.1 0.8-0.3l6.4-5.8C27.2 30.4 27.3 30.1 27.3 29.8"/></svg>'; break;
		case 'gallery' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="gallery" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M80 20h9.8c1.4 0 2.7 0.5 3.7 1.5 1 1 1.5 2.2 1.5 3.7v64.6c0 1.4-0.5 2.7-1.5 3.7 -1 1-2.2 1.5-3.7 1.5H25.2c-1.4 0-2.7-0.5-3.7-1.5 -1-1-1.5-2.2-1.5-3.7V80h-9.8c-1.4 0-2.7-0.5-3.7-1.5 -1-1-1.5-2.2-1.5-3.7V10.2c0-1.4 0.5-2.7 1.5-3.7 1-1 2.2-1.5 3.7-1.5h64.6c1.4 0 2.7 0.5 3.7 1.5 1 1 1.5 2.2 1.5 3.7V20zM15 70h55V15H15V70zM50 50c0.1-0.3 0.2-0.8 0.3-1.4 0.1-0.6 0.4-1.8 0.9-3.5 0.5-1.7 1-3.4 1.5-5s1.2-3.3 2.2-5.2 1.8-3.6 2.8-5c0.9-1.4 2.1-2.5 3.3-3.5s2.6-1.4 4-1.4v40H20V35c1.9 0 3.5 0.5 4.8 1.5s2.4 2.3 3 3.8 1.1 2.9 1.5 4.4 0.6 2.7 0.6 3.8l0 1.5c0-0.1 0.1-0.3 0.1-0.6 0.1-0.2 0.2-0.7 0.4-1.4 0.2-0.7 0.5-1.3 0.8-2 0.3-0.6 0.7-1.3 1.3-2.1 0.5-0.8 1.1-1.4 1.8-2s1.5-1 2.5-1.4c1-0.4 2-0.6 3.2-0.6 1.6 0 3 0.3 4.2 1 1.2 0.7 2.2 1.5 2.9 2.5 0.7 1 1.3 2 1.7 3 0.5 1 0.8 1.8 1 2.5L50 50zM37.8 32.8c1.5-1.5 2.2-3.2 2.2-5.3 0-2.1-0.7-3.8-2.2-5.3S34.6 20 32.5 20s-3.8 0.7-5.3 2.2c-1.5 1.5-2.2 3.2-2.2 5.3 0 2.1 0.7 3.8 2.2 5.3 1.5 1.5 3.2 2.2 5.3 2.2S36.3 34.3 37.8 32.8zM85 85V30h-5v44.8c0 1.4-0.5 2.7-1.5 3.7 -1 1-2.2 1.5-3.7 1.5H30v5H85z"/></svg>'; break;
		case 'googleplus' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="googleplus" viewBox="0 0 512 512" enable-background="new 0 0 512 512"><path d="M310 366.3c0 15.3-4.5 30.4-12.1 43.4 -25.9 43.9-79.9 59.5-127.8 59.5 -37.7 0-84.1-9.8-105-44.9 -6-9.8-9.3-21.3-9.3-32.9 0-28.4 17.6-52 40.9-66.5 29.4-18.3 67.5-22.9 101.5-25.1 -8.8-11.6-15.8-21.8-15.8-36.9 0-8 2.3-14.3 5.3-21.3 -5.8 0.5-11.3 1-17.1 1 -49 0-88.1-35.7-88.1-85.6 0-27.6 13.1-54.7 33.9-72.8 27.1-23.4 65.5-32.6 100.4-32.6h105l-34.7 22.1h-32.9c23.4 19.8 37.7 41.9 37.7 73.6 0 65-59.5 72.3-59.5 104.2C232.4 284.5 310 295.5 310 366.3zM274.4 387.7c0-33.9-33.6-54.5-58-72.1 -4-0.5-8-0.5-12.1-0.5 -40.9 0-101.7 13.1-101.7 64.8 0 49 53 66.5 93.7 66.5C233.4 446.4 274.4 430.9 274.4 387.7zM231.9 212.1c10.3-11 13.3-25.1 13.3-39.9 0-37.2-21.8-100.2-67-100.2 -14.1 0-28.6 7-37.2 18.1 -9 11.3-11.8 26.1-11.8 40.2 0 37.7 21.3 96.9 66.5 96.9C208.3 227.2 223.1 221.2 231.9 212.1zM453.2 226.5v27.1h-53.5v55h-26.4v-55h-53.2v-27.1h53.2V172h26.4v54.5H453.2z"/></svg>'; break;
		case 'instagram' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="instagram" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.1 84.9c0 6.6-5.5 12.1-12.1 12.1H15C8.3 97 2.9 91.5 2.9 84.9V14.8C2.9 8.1 8.3 2.7 15 2.7h70.1c6.6 0 12.1 5.5 12.1 12.1V84.9zM86.5 42.6h-8.3c0.8 2.5 1.2 5.3 1.2 8C79.4 66.3 66.3 79 50.1 79c-16.1 0-29.3-12.7-29.3-28.4 0-2.8 0.4-5.5 1.2-8h-8.7v39.8c0 2.1 1.7 3.7 3.7 3.7h65.6c2.1 0 3.7-1.7 3.7-3.7V42.6zM50.1 31.3c-10.4 0-18.9 8.2-18.9 18.4S39.6 68 50.1 68c10.5 0 19-8.2 19-18.4S60.6 31.3 50.1 31.3zM86.5 17.4c0-2.3-1.9-4.2-4.2-4.2H71.5c-2.3 0-4.2 1.9-4.2 4.2v10.1c0 2.3 1.9 4.2 4.2 4.2h10.7c2.3 0 4.2-1.9 4.2-4.2V17.4z"/></svg>'; break;
		case 'linkedin' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="linkedin" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M14.2 25.9H14c-6.8 0-11.2-4.7-11.2-10.5 0-6 4.5-10.5 11.4-10.5 6.9 0 11.2 4.5 11.3 10.5C25.6 21.2 21.2 25.9 14.2 25.9zM24.3 95H4V34.2h20.3V95zM97.1 95H77V62.5c0-8.2-2.9-13.8-10.3-13.8 -5.6 0-8.9 3.7-10.4 7.4 -0.5 1.4-0.7 3.1-0.7 5V95H35.5c0.2-55.1 0-60.8 0-60.8h20.2V43h-0.1c2.6-4.2 7.4-10.3 18.4-10.3 13.3 0 23.3 8.7 23.3 27.4V95z"/></svg>'; break;
		case 'linkedinsquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="linkedinsquare" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.1 79.3c0 9.8-7.9 17.7-17.7 17.7H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7V79.3zM24.6 18.5c-4.8 0-8 3.2-8 7.4 0 4.1 3.1 7.4 7.9 7.4h0.1c5 0 8-3.3 8-7.4C32.4 21.7 29.4 18.5 24.6 18.5zM31.6 81.6V39H17.4v42.6H31.6zM82.6 81.6V57.2c0-13.1-7-19.2-16.3-19.2 -7.6 0-11 4.2-12.8 7.2h0.1V39H39.4c0 0 0.2 4 0 42.6h14.2V57.8c0-1.2 0.1-2.5 0.4-3.4 1-2.5 3.4-5.2 7.3-5.2 5.1 0 7.1 3.9 7.1 9.6v22.8H82.6z"/></svg>'; break;
		case 'lunch' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path d="M29.5 13.4l-4.7 4.7 0 0c-1.6 1.5-3.8 0.4-3.8 0.4l-0.6 0.6 7.1 7.1 -2.1 2.1 -7.1-7.1 -0.3 0.3 0 0 -7 7c0 0-1.5 0.2-1.5-1.5l7.3-7.3 -0.8-0.8 -1.9 1.9c-5.7-3.6-6.5-10.2-6.5-10.2L9.6 8.5l9.2 9.2 0.6-0.6 0 0c-0.6-1.4-1.2-2.3 0.3-3.9l0 0 4.7-4.7 0.8 0.8 -4.2 5 0.9 0.9 4.8-4.6 0.7 0.7 -4.6 4.8 1.1 1.1 4.8-4.3L29.5 13.4zM34.1 18.5c0-8.6-7-15.6-15.6-15.6 -8.6 0-15.6 7-15.6 15.6 0 8.6 7 15.6 15.6 15.6C27.1 34.1 34.1 27.1 34.1 18.5M35.2 18.5c0 9.2-7.5 16.8-16.8 16.8 -9.2 0-16.8-7.5-16.8-16.8S9.2 1.7 18.5 1.7C27.7 1.7 35.2 9.2 35.2 18.5M36.8 18.5c0-10.1-8.2-18.4-18.4-18.4C8.4 0.1 0.1 8.3 0.1 18.5s8.2 18.4 18.4 18.4C28.6 36.8 36.8 28.6 36.8 18.5"/></svg>'; break;
		case 'news' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" viewBox="0 0 36.9 36.9" enable-background="new 0 0 36.94 36.94"><path d="M9.3 31.7c0 0.3 0.3 0.6 0.6 0.6h9.2c0.3 0 0.6-0.3 0.6-0.6 0-0.3-0.3-0.6-0.6-0.6H9.9C9.5 31.1 9.3 31.4 9.3 31.7M9.3 28.2c0 0.3 0.3 0.6 0.6 0.6h9.2c0.3 0 0.6-0.3 0.6-0.6 0-0.3-0.3-0.6-0.6-0.6H9.9C9.5 27.7 9.3 27.9 9.3 28.2M9.3 24.8c0 0.3 0.3 0.6 0.6 0.6h9.2c0.3 0 0.6-0.3 0.6-0.6 0-0.3-0.3-0.6-0.6-0.6H9.9C9.5 24.2 9.3 24.5 9.3 24.8M17.3 12.7h-5.7V7h5.7V12.7zM19.6 13.9V5.9c0-0.6-0.5-1.1-1.1-1.1h-8c-0.6 0-1.1 0.5-1.1 1.1v8c0 0.6 0.5 1.1 1.2 1.1h8C19.1 15 19.6 14.5 19.6 13.9M32.2 7.6c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 8.2 32.2 7.9 32.2 7.6M32.2 11c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 11.6 32.2 11.3 32.2 11M32.2 14.5c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6s0.3 0.6 0.6 0.6h9.2C32 15 32.2 14.8 32.2 14.5M32.2 17.9c0-0.3-0.3-0.6-0.6-0.6h-21.8c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h21.8C32 18.5 32.2 18.2 32.2 17.9M32.2 21.3c0-0.3-0.3-0.6-0.6-0.6h-21.8c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h21.8C32 21.9 32.2 21.7 32.2 21.3M32.2 24.8c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 25.4 32.2 25.1 32.2 24.8M32.2 28.2c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 28.8 32.2 28.5 32.2 28.2M32.2 31.7c0-0.3-0.3-0.6-0.6-0.6h-9.2c-0.3 0-0.6 0.3-0.6 0.6 0 0.3 0.3 0.6 0.6 0.6h9.2C32 32.2 32.2 32 32.2 31.7M34.5 32.2c0 1.3-1 2.3-2.3 2.3H4.7c-1.3 0-2.3-1-2.3-2.3V9.3c0-0.6 0.5-1.1 1.1-1.1h1.1v22.9c0 0.6 0.5 1.1 1.1 1.1 0.6 0 1.2-0.5 1.2-1.1V3.6c0-0.6 0.5-1.1 1.1-1.1h25.2c0.6 0 1.1 0.5 1.1 1.1V32.2zM36.8 32.2V3.6c0-1.9-1.5-3.4-3.4-3.4H8.1c-1.9 0-3.4 1.5-3.4 3.4v2.3H3.6c-1.9 0-3.4 1.5-3.4 3.4v22.9c0 2.5 2.1 4.6 4.6 4.6h27.5C34.8 36.8 36.8 34.8 36.8 32.2"/></svg>'; break;
		case 'pinterest' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="pinterest" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M50 97c-4.7 0-9.1-0.7-13.4-2 1.8-2.8 3.8-6.4 4.8-10.1 0 0 0.6-2.1 3.3-13 1.6 3.1 6.4 5.9 11.5 5.9 15.2 0 25.5-13.8 25.5-32.4 0-13.9-11.8-27-29.9-27 -22.3 0-33.6 16.1-33.6 29.5 0 8.1 3.1 15.3 9.6 18 1 0.4 2 0 2.3-1.2 0.2-0.8 0.7-2.9 1-3.7 0.3-1.2 0.2-1.6-0.7-2.6 -1.9-2.3-3.1-5.2-3.1-9.3 0-11.9 8.9-22.6 23.2-22.6 12.6 0 19.6 7.7 19.6 18.1 0 13.6-6 25-15 25 -4.9 0-8.6-4.1-7.4-9.1 1.4-6 4.2-12.4 4.2-16.7 0-3.9-2.1-7.1-6.4-7.1 -5 0-9.1 5.2-9.1 12.2 0 0 0 4.5 1.5 7.5 -5.2 21.9-6.1 25.7-6.1 25.7C31 85.7 31 89.7 31.1 93 14.5 85.7 2.9 69.2 2.9 49.8 2.9 23.8 24 2.7 50 2.7c26 0 47.1 21.1 47.1 47.1S76 97 50 97z"/></svg>'; break;
		case 'pinterestsquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="pinterestsquare" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.1 20.4v58.9c0 9.8-7.9 17.7-17.7 17.7H35c2-2.9 5.3-7.9 6.6-12.9 0 0 0.6-2.1 3.3-12.8 1.7 3.1 6.4 5.8 11.4 5.8 15 0 25.2-13.7 25.2-32 0-13.8-11.7-26.7-29.5-26.7 -22.2 0-33.3 15.9-33.3 29.2 0 8 3.1 15.1 9.6 17.8 1 0.4 2 0 2.3-1.2 0.2-0.8 0.7-2.9 0.9-3.7 0.3-1.2 0.2-1.6-0.7-2.6 -1.8-2.3-3.1-5.1-3.1-9.2 0-11.8 8.8-22.3 23-22.3C63.1 26.4 70 34 70 44.2c0 13.4-6 24.8-14.8 24.8 -4.9 0-8.5-4.1-7.4-9 1.4-5.9 4.1-12.3 4.1-16.5 0-3.8-2-7-6.3-7 -5 0-9 5.2-9 12 0 0 0 4.4 1.5 7.4 -5.1 21.6-6 25.4-6 25.4C30.9 87 31.4 93.6 31.8 97H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9C89.2 2.7 97.1 10.6 97.1 20.4z"/></svg>'; break;
		case 'research' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="research" viewBox="0 0 23.3 23.3"><rect x="0" y="9.5" width="4.1" height="12.1"/><path d="M23.3 20.7l-4.9-4.9 -0.6 0.4 -1-0.9c1.5-2.1 1.3-5.1-0.6-7 -0.1-0.1-0.3-0.2-0.4-0.3V0.2h-4.1v6.5c-0.6 0.1-1.2 0.3-1.7 0.5V5.3H5.8v16.3h4.1v-4.6c0.6 0.3 1.1 0.5 1.7 0.5v4.1h4.1v-4.8l0.6 0.6 -0.4 0.7 4.9 4.9c0 0 1.1 0 1.7-0.7C23.3 21.6 23.3 20.7 23.3 20.7zM9.4 9.2c1.6-1.6 4.3-1.6 5.9 0 1.6 1.6 1.6 4.3 0 5.9 -1.6 1.6-4.3 1.6-5.9 0C7.8 13.5 7.8 10.8 9.4 9.2z"/></svg>'; break;
		case 'testimonial' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="testimonial" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M17 5.8h66c3 0 5.6 1.1 7.8 3.2 2.2 2.2 3.2 4.7 3.2 7.8v38.5c0 3-1.1 5.6-3.2 7.8 -2.2 2.2-4.7 3.2-7.8 3.2h-5.5L50 93.8V66.3H17c-3 0-5.6-1.1-7.8-3.2C7.1 60.9 6 58.3 6 55.3V16.8c0-3 1.1-5.6 3.2-7.8C11.4 6.9 14 5.8 17 5.8zM77.5 16.8H17v5.5h60.5V16.8zM83 33.3H17v5.5h66V33.3zM66.5 49.8H17v5.5h49.5V49.8z"/></svg>'; break;
		case 'tour' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="tour" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M76 37l18-7.3v49.5L67.2 90.3 33.5 79.1 6 90.1V40.6l27.5-11L57 37.4l9.5 40.2L76 37zM66.5 63.6l6.4-32.7c2.2-1.2 4-2.9 5.3-5 1.3-2.1 2-4.5 2-7.1 0-3.8-1.3-7.1-4-9.7 -2.7-2.7-5.9-4-9.7-4s-7.1 1.3-9.7 4c-2.7 2.7-4 5.9-4 9.7 0 2.6 0.7 4.9 2 7.1 1.3 2.1 3.1 3.8 5.3 5L66.5 63.6zM60.7 13c1.6-1.6 3.6-2.4 5.8-2.4s4.2 0.8 5.8 2.4c1.6 1.6 2.4 3.6 2.4 5.8s-0.8 4.2-2.4 5.8c-1.6 1.6-3.6 2.4-5.8 2.4s-4.2-0.8-5.8-2.4c-1.6-1.6-2.4-3.6-2.4-5.8S59.1 14.6 60.7 13z"/></svg>'; break;
		case 'trees' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="festoftrees" viewBox="0 0 180 31" enable-background="new 0 0 180 30.961"><path d="M15.1 25.5c1.9 0.8 4.5 0 5.6-1.1 -0.5-0.8-1.3 0.1-2.2 0.4 -1.1 0.4-2.1 0.6-3.5 0.4 -0.2 0-0.1 0.1-0.1 0.2C15 25.4 15 25.4 15.1 25.5M6.1 24c0.4 0.8 1.5 1 2.6 0.9 0.6 0.4 1.5 0.5 2.4 0.5 0.1-0.1 0.2-0.3 0.3-0.4 -0.6-0.3-1.3 0.1-2-0.2 0.6-0.3 1.2-0.6 1.6-1.1 -0.1-0.3-0.4-0.4-0.7-0.5 -0.5 1-1.5 1.4-3 1.4C7 24.3 6.8 23.9 6.1 24M12.5 2.7c0-0.4-0.5-0.4-0.7-0.7 0-0.2 0.2-0.5 0.1-0.7 -0.2-0.1-0.4 0.2-0.7 0.2 -0.3-0.2-0.4-0.5-0.8-0.5 -0.2 0.2 0 0.6 0.1 0.8 -0.2 0.2-0.8 0.3-0.7 0.6 0.1 0.3 0.7 0.1 0.8 0.4 0 0.3-0.1 0.9 0.2 0.9 0.3-0.2 0.3-0.7 0.6-0.9C11.8 2.7 12.3 2.9 12.5 2.7M12.7 5.1c-0.4 0.2-0.4 0.9-0.8 1.2 0.1-0.5 0.3-0.9 0.4-1.4C12.5 4.9 12.6 5 12.7 5.1M20.1 11.4c0.1-0.7-0.9-1.1-1.5-1.2 -1.9-0.2-4.4 0-5.1-1.1 0.6 0.2 1.4 0.5 2.1 0.5 0.9 0 2.2-0.6 2.2-1.4 -1.1-0.6-2.9-0.6-3.5-1.7 0.6 0 1-0.4 1.1-0.9 -0.8-0.5-2-1-2.7-1.5 -0.3-0.2-0.4-0.6-0.7-0.6 -0.8-0.2-0.3 0.6-0.2 1 0.2 1-0.5 2-0.9 2.8 0.3 0.2 0.4-0.1 0.7-0.1 -1.1 1.4-2.6 2.5-4.3 3.4 -0.1 0.3-0.4 0.3-0.3 0.7 1.1 0.5 2 0.2 2.8-0.3 1-0.6 2.1-1.6 2.5-2.5 -0.2 0-0.4-0.1-0.7-0.1 -0.4 0.5-0.9 1-1.4 1.5 -0.7 0.6-1.5 1.5-2.4 1.2 0.5-0.7 1.4-1 2-1.5 0.9-0.7 1.8-1.5 2.5-2.3C12.4 7.3 12.4 7.3 12.4 7.3c-0.1 0.1-0.1 0.5 0 0.6 0.3 0 0.3 0 0.6 0 0.1-0.1 0.1-0.3 0.1-0.6 -0.1-0.2-0.5-0.2-0.6-0.2 0 0 0-0.1 0-0.1 0-0.1 0.1-0.2 0.1-0.3 0-0.2-0.3 0.1-0.2-0.2 0.2-0.3 0.4-0.7 0.6-1.1 0.1 0.1 0.3 0.1 0.4 0.2 -0.1 0.3-0.4 0.3-0.5 0.6 0.2 0.1 0.5 0.3 0.7 0.4 -0.1 0.2 0 0.2 0.1 0.4 0.8 0.8 2.2 0.9 3.3 1.4 -0.5 0.5-1.1 0.9-1.8 0.9 -1 0-1.8-1.1-2.7-0.9 0 0.4 0.4 0.3 0.4 0.6 -0.2 0.1-0.4 0.3-0.4 0.6h-0.4c-1.1 1.9-3.3 3.2-5.3 4.5 -0.5 0.3-1.5 0.9-1.3 1.5 0.2 0.6 1.3 0.3 1.7 0.4 -1.1 0.9-2.5 1.5-3 3 1.1 1 2.7 0.3 3.8-0.2 2.7-1.2 4.9-3.2 6.6-5.1 -0.2-0.1-0.5-0.1-0.7-0.2 -1.9 2.2-4.5 4.3-7.5 5.4 -0.4 0.1-1 0.5-1.4 0.1 0.7-1.7 2.7-2.1 3.8-3.5 -0.1 0-0.3 0.1-0.2-0.1 1.8-0.8 3.1-2.1 4.3-3.5 -0.1-0.2-0.5-0.1-0.6-0.2 -1.3 1.3-2.5 2.4-4.1 3.3 -0.6 0.3-1.2 0.8-1.9 0.7 0.8-1.3 2.5-1.8 3.6-2.7 1.2-0.9 2.1-1.9 3-3 0.6 0.4 1.3 0.8 2.2 0.9 0 0 0.1 0 0.1 0 -0.2 0.2-0.1 0.7 0.1 0.8 0.7 0.1 0.7-0.2 0.8-0.7 0 0 0 0 0 0 0 0 0.1 0 0.1 0 1.3 0.1 2.9-0.1 3.3 1 -1.8 1.6-4.7 0.1-5.9-1 -0.3 0.1-0.4 0.3-0.6 0.4 0.9 0.8 2.1 1.8 3.8 1.9C17.9 13 20.1 12.2 20.1 11.4M5.4 20.8L5.4 20.8H5.4C5.4 20.8 5.4 20.8 5.4 20.8M5.4 20.8c0.2 0.1 0.4 0 0.6 0 1.6-0.9 3.7-1.5 5.2-2.5 0.5-0.3 1.1-0.8 1.3-1.3 -1-0.1-1.6 0.9-2.5 1.3 -1.5 0.7-3.1 1.3-4.6 2.1C5.3 20.6 5.3 20.8 5.4 20.8M9.5 20.4c0.7 0.1 1.1-0.5 0.9-1C9.6 18.9 8.9 19.8 9.5 20.4M11.5 14.7c0.7 0 0.9-1.5-0.1-1.2C10.7 13.6 10.8 14.7 11.5 14.7M15.4 14.3c-0.3-0.1-0.4 0.3-0.3 0.4 0.1 0 0.1 0.1 0.3 0.1C15.5 14.7 15.5 14.4 15.4 14.3M21.8 14.6c-1.3-1.2-4.7-0.2-6.1-1.5 -0.1 0-0.1 0-0.1 0.1 0 0-0.1 0.1-0.1 0.1 1.2 1 3.4 1.1 5.3 1.2 -1.7 1.6-4.7 1.9-7.5 1.2 0.3 0.5 0.9 0.7 1.5 0.7C17.5 16.8 20.6 16.1 21.8 14.6M26.6 28.9c-0.4-0.5-1-0.7-1.5-0.9 -0.6-0.3-1.1-0.5-1.4-1 -0.4-0.7-0.2-1.3-0.1-2 0-0.4-0.1-0.7-0.2-1 -0.1-1 0-2.1-0.1-3.2 0.9-0.6 0.4-2.3-1-1.9 0 0 0 0 0 0 -0.1-1.2-0.9-1.9-2.3-2 -1.8 0-4.2 0.3-5.9-0.1 0.3 0.6 1.2 0.5 2.2 0.6 1.5 0.2 3.3 0.1 4.8 0.1 0.2 0.3 0.4 0.6 0.5 1.1 -1.6 0.8-4 0.3-5.5-0.3 -0.7-0.3-1.1-0.9-1.7-0.9 1.5 1.5 5.4 2.8 7.9 1.7 0 0 0 0 0 0 -0.5 0.5-0.3 1.4 0.1 1.9 -0.8 1.1-1.9 1.8-3.6 1.9 -0.2-0.1-0.1-0.4-0.4-0.4 -0.4 0.2-0.3 0.5-0.7 0.6 -0.9 0.4-2.2-0.2-2.8-0.6 -0.4-0.3-1-1-0.3-1.2 0.2 0.1 0 0.5 0.1 0.6 0.2 0 0.2-0.3 0.4-0.3 -0.4-0.5 0.1-1.5-0.4-2 -0.2-0.2-0.7-0.2-0.9-0.2 0 0-0.1 0-0.1 0 0 0 0 0 0 0 0.1-0.2 0.4-0.8 0.1-1 -0.2 0.4-0.5 0.8-0.7 1.2 -0.2 0.2-0.2 0.7-0.2 1 -0.2 0.3-0.7 0.3-0.6 0.9 0.6 0.3 0.7-0.3 0.9-0.3 0.1 0.6-0.7 0.7-1.2 0.9 0 0 0 0 0 0 0-0.2 0.2-0.5-0.1-0.5 -0.4-0.1-0.5 0.5-0.9 0.6 0 0 0 0 0 0 -0.4 0.1-0.8-0.3-1.2-0.4 0 0 0 0 0 0 1.6-1.4 3.1-3.1 4-5.2 -0.2 0-0.4-0.2-0.7-0.1 -1 2-2.4 3.6-4.1 5 0 0 0 0 0 0 -0.3-0.1-0.2-0.5-0.6-0.6 -0.7 0.4-1.9 0.1-2.7-0.1 0 0 0 0 0 0 -0.2 0-0.4 0-0.6 0 -1-0.2-1.7-0.6-1.9-1.7 0.2-0.4 0.4-0.4 0.4-0.7 0.3-1.7-2.3-1.7-1.9 0 0.1 0.3 0.4 0.3 0.5 0.7 0.1 0.4-0.2 1.7-0.3 2.5 -0.1 0.5-0.4 0.8-0.4 1.2 -0.1 0.5 0.2 1 0.2 1.4 0 0.8-0.5 1.7-0.9 2.4C0.7 27.5 0.1 28.2 0 28.8c0.4 0 0.9-0.4 1.2-0.7 1-0.9 1.7-2.3 2.2-3.6 1 0.4 1.4 1.5 1.3 2.9 0 0.6-0.4 1.4 0.1 1.8 0.5-0.6 0.5-1.6 0.6-2.4 0-0.4 0.1-1 0.1-1.4 -0.1-1-1.3-1.3-1.5-2 -0.2-0.6 0.2-1.4 0.2-1.9 0.9 0.7 3.1 0.4 4.1-0.1 0.1 0.2 0.4 0.1 0.6 0.2 0 0 0 0 0 0 -0.1 0.4-0.5 0.5-0.7 0.6 -0.7 0.4-1.4 0.9-2.4 0.9 -0.4-0.2-0.5-0.8-0.5-1.2 -0.3-0.1-0.6 0.1-0.7 0.2 0.3 2.5 3.9 0.8 4.9 0 0 0 0 0 0 0 0.7 0.7 1.9 1.1 3.4 0.9 -0.6 0.8-1 2-1.5 2.9 -0.2 0.3-0.6 0.5-0.6 0.9 0.3 0.1 0.6-0.2 0.8-0.1 -0.2 0.6-0.4 1.4-0.7 2.1 -0.2 0.7-0.8 1.4-0.4 2 1.1-1.1 1.8-2.6 2.5-4.1h1c0.8 1.6-0.7 2.9-0.9 4.1 0.6 0.2 0.9-0.6 1.3-1.2 0.6-0.9 1.2-2.2 0.6-3.3 0.3-0.2 0.5-0.6 0.4-0.9 0 0 0 0 0 0 -0.1 0-0.1-0.1-0.1-0.1 0 0 0 0.1-0.1 0.1 -0.3-0.3-0.4-1.3-0.1-1.7 1 0.8 2.6 0 3.3-0.6 0.9 0.1 2.5 0.4 3.5-0.1 -0.5 0.7 0.1 1.7 0 2.5 0 0.5-0.4 1-0.6 1.6 -0.1 0.4-0.1 0.8-0.1 1.2 -0.1 1 0.1 2 0.8 2.5 0.5-0.6 0.2-1.8 0.2-2.8 0.1-0.6 0.2-1.2 0.4-1.5C22.7 28.3 24.5 29.1 26.6 28.9M19.5 21.5c0.5 0.1 1.2 0.1 1.5 0.1 1.2-0.3 0.7-1.8-0.4-1.8 0 0.4 0.4 0.4 0.4 0.9 -0.3 0.6-1.3 0.5-1.8 0.4 -1-0.2-2.5-0.7-3.3-1.4 -0.7-0.6-0.9-1.7-1.8-1.5C15.1 19.7 17.4 21 19.5 21.5M15.2 20.5c0 0-0.1 0.1-0.1 0.1 0.7 1.1 2.1 1.6 3.8 1.8 0.2 0.1 0.3 0.2 0.4 0.2 0.1-0.1 0.3-0.1 0.5-0.1 -1-0.9-2.8-0.6-3.8-1.5C15.9 20.7 15.6 20.3 15.2 20.5M18.2 18.3c0.2 0.3 0.7 0.2 0.9-0.1C19.3 17.4 17.9 17.4 18.2 18.3M12 20.7c0.2 0 0.3-0.1 0.4-0.1 0.1-0.6-0.7-0.6-0.6 0C11.9 20.6 12 20.7 12 20.7M30.1 8.7h4.6V6.1h-7.8v18.1h3.2V15.7h3.3v-2.6h-3.3V8.7zM36.5 24.2h8.2v-2.6H39.8V15.7h3.3v-2.6H39.8V8.7h4.6V6.1h-7.8V24.2zM50.5 12.1c-0.7-0.9-0.9-1.4-0.9-2.2 0-0.8 0.6-1.4 1.5-1.4 0.8 0 1.4 0.7 1.4 2v0.7h3.2V9.9c0-2.4-1.9-4-4.7-4 -2.8 0-4.7 1.6-4.7 4 0 2.5 0.7 3.1 2.4 5.1l2.7 2.8c0.7 0.8 1.1 1.5 1.1 2.5 0 1.1-0.6 1.7-1.4 1.7 -0.8 0-1.4-0.5-1.4-1.7v-1.7h-3.3v1.9c0 2.6 2.1 4.1 4.7 4.1 2.6 0 4.8-1.4 4.8-4.1 0-2.1-0.8-3.1-2.1-4.6L50.5 12.1zM63.6 8.7h3.3V6.1h-9.9v2.6h3.3v15.6h3.2V8.7zM68.9 24.2h3.2V6.1h-3.2V24.2zM81.4 24.2l4.2-18.1h-3.4L79.8 19.5h-0.1L77.5 6.1h-3.5l4 18.1H81.4zM91.1 17.4h-2.1l1-6.5h0.1L91.1 17.4zM92.3 24.2h3.2L91.8 6.1h-3.2l-3.7 18.1h3.1l0.6-4.2h3.1L92.3 24.2zM97.4 24.2h7.5v-2.6h-4.2V6.1h-3.2V24.2zM123.2 2.1c0 2.4-2.8 9.7-5.2 11.9 2-8.3 3.5-12.8 4.7-12.8C123.1 1.1 123.2 1.5 123.2 2.1M116.7 20.2c0.5 1.1 0.7 2.2 0.7 3.2 0 1.7-0.6 3-1.2 3 -0.3 0-0.4-0.3-0.4-0.9C115.8 24.9 115.9 24.2 116.7 20.2M112.2 9.6c0 1.7-0.4 4-1 5.8 -1.2-0.7-1.7-2.3-1.7-3.8 0-2.3 0.9-4.4 1.8-4.4C112 7.3 112.2 8.3 112.2 9.6M110.9 16.3c-0.4 1.2-0.9 2-1.4 2 -0.1 0-0.2 0-0.2 0 -0.9 0-1.2-1-1.2-2.4 0-0.8 0.1-1.6 0.3-2.4C108.7 14.8 109.5 15.9 110.9 16.3M124.3 3.1c0-1.4-0.6-2-1-2.2 -0.1-0.4-0.6-0.8-1.2-0.8 -3.5 0-4.9 6.4-6.5 13.6 0 0.2-0.1 0.4-0.1 0.5 -0.6 1.1-1.6 1.6-2.5 1.6 0.9-1.7 1.4-3.8 1.4-5.6 0-2.2-0.9-4-2.9-4 -1.6 0-2.7 1.2-3.2 2.9 -0.6-0.1-1.1 0.5-1.3 1 -0.7 1.4-1.2 3.3-1.2 5.2 0 2.4 0.9 4.3 2.9 4.3 1.5 0 2.8-1.3 3.9-3.1 1.1 0 2-0.5 2.7-1 -0.6 3-1.1 5.7-1.1 7.8 0 2.3 0.6 3.8 2.1 3.8 1.9 0 2.5-1.6 2.5-3.3 0-1.9-0.7-3.9-1.7-4.3 3.2-0.6 5.6-1.9 6.9-5 0.1-0.1 0.1-0.3 0.1-0.4 0-0.2-0.1-0.3-0.2-0.3 -0.1 0-0.3 0.1-0.4 0.4 -1.3 2.8-3.6 3.6-6.5 4 0.2-1.3 0.5-2.4 0.7-3.4C120.3 14.7 124.3 9.3 124.3 3.1M133.2 8.7h3.3V6.1h-9.9v2.6h3.3v15.6h3.2V8.7zM145.3 11.3c0 2.6-0.6 2.9-2.7 2.9h-1V8.7h2.1C145 8.7 145.3 9.8 145.3 11.3M149.1 24.2l-3.4-7.7c1.6-0.8 2.7-2.5 2.7-5.2 0-2.9-1.5-5.2-4.6-5.2h-5.4v18.1h3.2v-7.3h1l3.1 7.3H149.1zM150.7 24.2h8.2v-2.6h-4.9V15.7h3.3v-2.6h-3.3V8.7h4.6V6.1h-7.8V24.2zM160.7 24.2h8.2v-2.6h-4.9V15.7h3.3v-2.6h-3.3V8.7h4.6V6.1h-7.8V24.2zM176.7 11.2h3.2V9.9c0-2.4-1.9-4-4.7-4 -2.8 0-4.7 1.6-4.7 4 0 2.5 0.7 3.1 2.4 5.1l2.7 2.8c0.7 0.8 1.1 1.5 1.1 2.5 0 1.1-0.6 1.7-1.4 1.7 -0.8 0-1.4-0.5-1.4-1.7v-1.7h-3.3v1.9c0 2.6 2.1 4.1 4.7 4.1 2.6 0 4.8-1.4 4.8-4.1 0-2.1-0.8-3.1-2.1-4.6l-3.2-3.7c-0.7-0.9-0.9-1.4-0.9-2.2 0-0.8 0.6-1.4 1.4-1.4 0.8 0 1.4 0.7 1.4 2V11.2z"/></svg>'; break;
		case 'tumblr' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="tumblr" viewBox="0 0 512 512" enable-background="new 0 0 512 512"><path d="M398.9 462.5c-8.4 12.6-46.3 26.8-80.4 27.3C217.2 491.5 179 417.9 179 366V214.2h-46.9v-60c70.3-25.4 87.3-89 91.2-125.3 0.3-2.2 2.2-3.3 3.3-3.3 0 0 1.1 0 68.1 0v118.3h92.9v70.3h-93.2v144.5c0 19.5 7.3 46.6 44.6 45.8 12.3-0.3 28.7-3.9 37.4-8.1L398.9 462.5z"/></svg>'; break;
		case 'twitter' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="twitter" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path d="M101.2 33.6c0.1 1 0.1 2 0.1 3 0 30.5-23.2 65.6-65.6 65.6 -13.1 0-25.2-3.8-35.4-10.4 1.9 0.2 3.6 0.3 5.6 0.3 10.8 0 20.7-3.6 28.6-9.9 -10.1-0.2-18.6-6.9-21.6-16 1.4 0.2 2.9 0.4 4.4 0.4 2.1 0 4.1-0.3 6.1-0.8C12.7 63.7 4.8 54.4 4.8 43.2c0-0.1 0-0.2 0-0.3 3.1 1.7 6.6 2.8 10.4 2.9C9 41.7 4.9 34.6 4.9 26.6c0-4.3 1.1-8.2 3.1-11.6 11.4 14 28.4 23.1 47.6 24.1 -0.4-1.7-0.6-3.5-0.6-5.3 0-12.7 10.3-23.1 23.1-23.1 6.6 0 12.6 2.8 16.9 7.3 5.2-1 10.2-2.9 14.6-5.6 -1.7 5.4-5.4 9.9-10.1 12.7 4.6-0.5 9.1-1.8 13.3-3.6C109.6 26.2 105.7 30.3 101.2 33.6z"/></svg>'; break;
		case 'twittersquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="twittersquare" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.1 79.3c0 9.8-7.9 17.7-17.7 17.7H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7V79.3zM74 34.4c2.7-1.6 4.7-4.2 5.7-7.2 -2.5 1.5-5.3 2.6-8.2 3.1 -2.3-2.5-5.7-4.1-9.4-4.1 -7.1 0-12.9 5.8-12.9 12.9 0 1 0.1 2 0.3 2.9 -10.7-0.6-20.3-5.6-26.6-13.5 -1.1 1.9-1.8 4.2-1.8 6.5 0 4.5 2.1 8.4 5.6 10.7 -2.1-0.1-4.2-0.7-6.1-1.6 0 0 0 0.1 0 0.1 0 6.3 4.7 11.5 10.6 12.6 -1.1 0.3-2 0.5-3.1 0.5 -0.8 0-1.6-0.1-2.4-0.2 1.7 5.1 6.4 8.8 12 9 -4.4 3.4-9.9 5.5-16 5.5 -1 0-2.1-0.1-3.1-0.2 5.7 3.6 12.5 5.8 19.8 5.8C62 77.3 75 57.7 75 40.6c0-0.6 0-1.1-0.1-1.7 2.5-1.8 4.7-4.1 6.4-6.7C79.1 33.3 76.6 34 74 34.4z"/></svg>'; break;
		case 'vimeo' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="vimeo" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.1 79.3c0 9.8-7.9 17.7-17.7 17.7H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7V79.3zM78.5 25.8c-2.5-3.2-7.8-3.3-11.5-2.8 -2.9 0.5-13 4.9-16.4 15.5 6-0.5 9.2 0.4 8.6 7.1 -0.2 2.8-1.7 5.8-3.2 8.8 -1.8 3.4-5.2 10-9.7 5.2 -4-4.3-3.7-12.5-4.6-18 -0.6-3.1-1.1-6.9-2.1-10.1 -0.9-2.7-2.9-6-5.3-6.7 -2.6-0.7-5.9 0.4-7.8 1.5 -6 3.6-10 8.6-15.9 12.8v0.4c2 1 1.4 2.6 2.9 2.8 3.6 0.5 7.1-3.4 9.5 0.7 1.5 2.5 1.9 5.2 2.8 7.8 1.3 3.6 2.2 7.4 3.3 11.5 1.7 6.9 3.8 17.2 9.8 19.8 3 1.3 7.6-0.4 9.9-1.8 6.3-3.7 11.2-9 15.3-14.5C73.8 52.9 79 38.2 79.8 33.9 80.4 31 80.3 28.1 78.5 25.8z"/></svg>'; break;
		case 'vimeosquare' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="vimeosquare" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.1 79.3c0 9.8-7.9 17.7-17.7 17.7H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7V79.3zM78.5 25.8c-2.5-3.2-7.8-3.3-11.5-2.8 -2.9 0.5-13 4.9-16.4 15.5 6-0.5 9.2 0.4 8.6 7.1 -0.2 2.8-1.7 5.8-3.2 8.8 -1.8 3.4-5.2 10-9.7 5.2 -4-4.3-3.7-12.5-4.6-18 -0.6-3.1-1.1-6.9-2.1-10.1 -0.9-2.7-2.9-6-5.3-6.7 -2.6-0.7-5.9 0.4-7.8 1.5 -6 3.6-10 8.6-15.9 12.8v0.4c2 1 1.4 2.6 2.9 2.8 3.6 0.5 7.1-3.4 9.5 0.7 1.5 2.5 1.9 5.2 2.8 7.8 1.3 3.6 2.2 7.4 3.3 11.5 1.7 6.9 3.8 17.2 9.8 19.8 3 1.3 7.6-0.4 9.9-1.8 6.3-3.7 11.2-9 15.3-14.5C73.8 52.9 79 38.2 79.8 33.9 80.4 31 80.3 28.1 78.5 25.8z"/></svg>'; break;
		case 'vine' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="vine" viewBox="0 0 512 512" enable-background="new 0 0 512 512"><path d="M459.4 306.2c-19.5 4.5-39.1 6.4-55.2 6.4 -39.1 82-109.1 152.3-132.5 165.5 -14.8 8.4-28.7 8.9-45.2-0.8C197.7 459.9 88.9 370.6 52.6 89.9h79c19.8 168.5 68.4 255 121.7 319.8 29.6-29.6 58-68.9 80.1-113.3 -52.7-26.8-84.8-85.7-84.8-154.3 0-69.5 39.9-121.9 108.3-121.9 66.4 0 102.7 41.3 102.7 112.4 0 26.5-5.6 56.6-16.2 79.8 0 0-49.1 9.8-67.2-21.8 3.6-12 8.6-32.6 8.6-51.3 0-33.2-12-49.4-30.1-49.4 -19.3 0-32.6 18.1-32.6 53 0 71.2 45.2 111.9 103.8 111.9 10.3 0 22-1.1 33.8-3.9V306.2z"/></svg>'; break;
		case 'youtube' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="youtube" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M89.5 90.4c-1 4.4-4.6 7.6-8.8 8 -10.2 1.2-20.4 1.2-30.7 1.2 -10.2 0-20.5 0-30.7-1.2 -4.3-0.4-7.8-3.6-8.8-8 -1.4-6.2-1.4-13-1.4-19.3 0-6.4 0.1-13.2 1.4-19.3 1-4.4 4.6-7.6 8.9-8.1 10.1-1.1 20.4-1.1 30.6-1.1 10.2 0 20.5 0 30.7 1.1 4.3 0.5 7.8 3.7 8.8 8.1 1.4 6.2 1.4 12.9 1.4 19.3C90.9 77.4 90.9 84.2 89.5 90.4zM32.4 57.3v-5.2H15.2v5.2H21v31.4h5.5V57.3H32.4zM41.4 0.5l-6.7 22v15h-5.5v-15c-0.5-2.7-1.6-6.6-3.4-11.7C24.6 7.4 23.4 4 22.3 0.5h5.9L32 15.1l3.8-14.5H41.4zM47.4 88.7V61.4h-4.9v20.9c-1.1 1.5-2.2 2.3-3.1 2.3 -0.7 0-1-0.4-1.2-1.2 -0.1-0.2-0.1-0.8-0.1-1.9V61.4h-4.9V83c0 1.9 0.2 3.2 0.4 4 0.4 1.4 1.6 2 3.2 2 1.8 0 3.6-1.1 5.6-3.4v3H47.4zM56.2 28.6c0 2.9-0.5 5.1-1.5 6.5 -1.4 1.9-3.3 2.8-5.9 2.8 -2.5 0-4.4-0.9-5.8-2.8 -1-1.4-1.5-3.6-1.5-6.5v-9.7c0-2.9 0.5-5.1 1.5-6.5 1.4-1.9 3.3-2.8 5.8-2.8 2.5 0 4.5 0.9 5.9 2.8 1 1.4 1.5 3.5 1.5 6.5V28.6zM51.2 17.9c0-2.5-0.7-3.8-2.4-3.8 -1.6 0-2.4 1.3-2.4 3.8v11.6c0 2.5 0.8 3.9 2.4 3.9 1.7 0 2.4-1.3 2.4-3.9V17.9zM66.1 69.7c0-2.5-0.1-4.4-0.5-5.5 -0.6-2-2-3.1-3.9-3.1 -1.8 0-3.5 1-5.1 3v-12h-4.9v36.6h4.9v-2.7c1.7 2 3.4 3 5.1 3 1.9 0 3.3-1 3.9-3 0.4-1.2 0.5-3 0.5-5.5V69.7zM61.2 80.9c0 2.5-0.7 3.7-2.2 3.7 -0.8 0-1.7-0.4-2.5-1.2V66.8c0.8-0.8 1.7-1.2 2.5-1.2 1.4 0 2.2 1.3 2.2 3.7V80.9zM74.8 37.6h-5v-3c-2 2.3-3.9 3.4-5.7 3.4 -1.6 0-2.8-0.7-3.3-2 -0.3-0.8-0.4-2.2-0.4-4.1V10h5v20.3c0 1.2 0 1.8 0.1 1.9 0.1 0.8 0.5 1.2 1.2 1.2 1 0 2-0.8 3.1-2.4V10h5V37.6zM84.8 79.3h-5c0 2-0.1 3.1-0.1 3.4 -0.3 1.3-1 2-2.2 2 -1.7 0-2.5-1.3-2.5-3.8V76h9.9v-5.7c0-2.9-0.5-5-1.5-6.4 -1.4-1.9-3.4-2.8-5.9-2.8 -2.5 0-4.5 0.9-5.9 2.8 -1 1.4-1.5 3.5-1.5 6.4v9.6c0 2.9 0.6 5.1 1.6 6.4 1.4 1.9 3.4 2.8 6 2.8 2.6 0 4.6-1 6-2.9 0.6-0.9 1-1.9 1.2-3 0.1-0.5 0.1-1.6 0.1-3.2V79.3zM79.9 71.9h-5v-2.5c0-2.5 0.8-3.8 2.5-3.8 1.7 0 2.5 1.3 2.5 3.8V71.9z"/></svg>'; break;
		case 'youtubesquare'	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="youtubesquare" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M97.1 79.3c0 9.8-7.9 17.7-17.7 17.7H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7V79.3zM82.6 50.7c-0.9-3.6-3.8-6.3-7.3-6.6 -8.3-0.9-16.8-0.9-25.3-0.9 -8.4 0-16.9 0-25.2 0.9 -3.6 0.4-6.5 3-7.3 6.6 -1.2 5.1-1.2 10.7-1.2 16 0 5.2 0 10.8 1.2 16 0.8 3.6 3.7 6.2 7.2 6.6 8.4 0.9 16.9 0.9 25.3 0.9 8.4 0 16.9 0 25.3-0.9 3.5-0.4 6.4-3.1 7.2-6.6 1.2-5.2 1.2-10.7 1.2-16C83.8 61.4 83.8 55.8 82.6 50.7zM35.5 55.3h-4.9v26h-4.5v-26h-4.8V51h14.2V55.3zM42.9 8.5h-4.6l-3.1 12L32 8.5h-4.8c0.9 2.8 2 5.6 2.9 8.5 1.5 4.3 2.4 7.5 2.8 9.7V39h4.5V26.7L42.9 8.5zM47.9 81.3h-4.1v-2.5c-1.6 1.8-3.1 2.8-4.7 2.8 -1.3 0-2.2-0.6-2.6-1.7 -0.2-0.7-0.4-1.7-0.4-3.3V58.7h4.1v16.6c0 0.9 0 1.5 0.1 1.6 0.1 0.6 0.4 0.9 0.9 0.9 0.9 0 1.7-0.6 2.6-1.9V58.7h4.1V81.3zM55.2 23.7c0-2.4-0.4-4.2-1.3-5.3 -1.2-1.5-2.8-2.3-4.8-2.3 -2.1 0-3.7 0.8-4.8 2.3 -0.9 1.2-1.3 2.9-1.3 5.3v8c0 2.4 0.4 4.2 1.3 5.3 1.1 1.5 2.7 2.3 4.8 2.3 2 0 3.6-0.8 4.8-2.3 0.9-1.1 1.3-2.9 1.3-5.3V23.7zM51 32.5c0 2.1-0.7 3.1-2 3.1 -1.4 0-2-1-2-3.1v-9.6c0-2.1 0.6-3.2 2-3.2 1.3 0 2 1.1 2 3.2V32.5zM63.3 74.5c0 2-0.1 3.6-0.4 4.5 -0.5 1.7-1.6 2.6-3.3 2.6 -1.4 0-2.8-0.9-4.2-2.5v2.2h-4.1V51h4.1v9.9c1.3-1.6 2.7-2.5 4.2-2.5 1.7 0 2.8 0.9 3.3 2.6 0.3 0.9 0.4 2.4 0.4 4.5V74.5zM59.3 65.2c0-2-0.6-3.1-1.8-3.1 -0.7 0-1.4 0.3-2 1v13.8c0.7 0.7 1.4 1 2 1 1.2 0 1.8-1 1.8-3V65.2zM70.4 39V16.3h-4.1v17.4c-0.9 1.3-1.8 1.9-2.6 1.9 -0.6 0-0.9-0.3-1-1 -0.1-0.1-0.1-0.6-0.1-1.6V16.3h-4.1v18c0 1.6 0.1 2.6 0.4 3.4 0.4 1.1 1.3 1.7 2.6 1.7 1.5 0 3.1-0.9 4.7-2.8V39H70.4zM78.7 74c0 1.4-0.1 2.2-0.1 2.6 -0.1 0.9-0.4 1.7-0.9 2.5 -1.1 1.7-2.8 2.5-4.9 2.5 -2.1 0-3.8-0.8-5-2.3 -0.9-1.1-1.3-2.9-1.3-5.3V66c0-2.4 0.4-4.1 1.2-5.3 1.2-1.5 2.8-2.3 4.9-2.3 2 0 3.7 0.8 4.8 2.3 0.9 1.2 1.3 2.9 1.3 5.3v4.7h-8.2v4c0 2.1 0.7 3.1 2.1 3.1 1 0 1.6-0.6 1.8-1.6 0-0.2 0.1-1.2 0.1-2.8h4.2V74zM74.6 67.3v-2.1c0-2.1-0.7-3.1-2-3.1 -1.3 0-2 1-2 3.1v2.1H74.6z"/></svg>'; break;

	} // switch

	return $output;

} // babyfold_get_svg()

/**
 * Adds the page title above the calendar
 *
 * @param 	mixed 		$before 		The existing content before the HTML
 * @return 	mixed 						The altered content before the HTML
 */
function thebabyfold_add_calendar_page_title( $before ) {

	$before .= '<h1>Calendar of Events</h1>';

	return $before;

} // thebabyfold_add_calendar_page_title()

add_filter( 'tribe_events_before_html', 'thebabyfold_add_calendar_page_title' );

/**
 * Adds PDF as a filter for the Media Library
 *
 * @param 	array 		$post_mime_types 		The current MIME types
 * @return 	array 								The modified MIME types
 */
function thebabyfold_add_mime_types( $post_mime_types ) {

    $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );

    return $post_mime_types;

} // thebabyfold_add_mime_types

add_filter( 'post_mime_types', 'thebabyfold_add_mime_types' );

/**
 * Add "edit_theme_options" capability to the Editors
 */
function thebabyfold_add_capability() {

	$role = get_role( 'editor' );

	$role->add_cap( 'edit_theme_options' );

} // thebabyfold_add_capability()

add_action( 'admin_init', 'thebabyfold_add_capability');



