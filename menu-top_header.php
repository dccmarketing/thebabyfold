<div class="menu-top-header" id="menu_top_header"><?php

	if ( has_nav_menu( 'top_header' ) ) {

		$menu['theme_location'] 	= 'top_header';
		$menu['container'] 			= 'div';
		$menu['container_id'] 		= 'menu-top_header';
		$menu['container_class'] 	= 'menu nav-top_header';
		$menu['menu_id'] 			= 'menu-top_header-items';
		$menu['menu_class']			= 'menu-items';
		$menu['depth']				= 1;
		$menu['fallback_cb']		= '';

		wp_nav_menu( $menu );

	}

?></div><!-- .menu-top-header -->