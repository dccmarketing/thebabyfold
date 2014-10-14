<?php if ( has_nav_menu( 'bottom_header' ) ) {
					
	$menu['theme_location'] 	= 'bottom_header';
	$menu['container'] 			= 'div';
	$menu['container_id'] 		= 'menu-bottom_header';
	$menu['container_class'] 	= 'menu nav-bottom_header';
	$menu['menu_id'] 			= 'menu-bottom_header-items';
	$menu['menu_class']			= 'menu-items';
	$menu['depth']				= 1;
	$menu['fallback_cb']		= '';

	wp_nav_menu( $menu );

} ?>