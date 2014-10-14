<?php if ( has_nav_menu( 'social' ) ) {
					
	$socialsmenu['theme_location']	= 'social';
	$socialsmenu['container'] 		= 'div';
	$socialsmenu['container_id']    = 'menu-social-media';
	$socialsmenu['container_class'] = 'menu nav-social';
	$socialsmenu['menu_id']         = 'menu-social-media-items';
	$socialsmenu['menu_class']      = 'menu-items';
	$socialsmenu['depth']           = 1;
	$socialsmenu['fallback_cb']     = '';

	wp_nav_menu( $socialsmenu );

} ?>