<?php
/**
 * The homepage template file.
 *
 * @package thebabyfold
 */

get_header();

	?><div id="primary" class="content-area">
		<main id="main" class="site-main" role="main"><?php

			putRevSlider("homepage","homepage");

		?></main><!-- .site-main -->
	</div><!-- .content-area -->
</div><!-- #page -->
	<div class="promo-wrap">
		<div class="promo-boxes"><?php

		$boxes = array( 'promo_box_1', 'promo_box_2', 'promo_box_3' );

		foreach ( $boxes as $box ) {

			if ( '' == get_theme_mod( $box . '_url' ) ) {

				$link = get_bloginfo( 'url' );

			} else {

				$link = get_theme_mod( $box . '_url' );

			}

			?><div class="promo-box" style="background-image:url(<?php echo esc_url( get_theme_mod( $box . '_image' ) ); ?>);">
				<a href="<?php echo esc_url( $link ); ?>"><?php

				$text = get_theme_mod( $box . '_text' );

				if ( ! empty( $text ) ) {

					echo '<span class="promo-box-text">' . esc_html( $text ) . '</span>';

				}

				?></a>
			</div><?php

		} // foreach

		?></div>
	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="social-menu">
			<h2 class="social-headline">Connect with Us</h2><?php

			get_template_part( 'menu', 'social' );

		?></div><!-- .social-menu -->
		<div class="home_footer">
			<div class="headline">We never give up on a child</div>
			<div class="content">The Baby Fold embodies Christian principles to help families and children develop the hope, courage, and love they need to become whole and healthy.</div>
		</div><!-- .home_footer -->
		<div class="site-info"><?php

			printf( __( '<div class="copyright">&copy %1$s <a href="%2$s" title="Login">%3$s</a></a></div>', 'thebabyfold' ), date( 'Y' ), get_admin_url(), get_bloginfo( 'name' ) );
			get_template_part( 'menu', 'footer' );
			printf( __( '<div class="credits">Designed and developed by <a href="%1$s">DCC Marketing</a></div>', 'thebabyfold' ), 'http://dccmarketing.com' );

		?></div><!-- .site-info -->

	</footer><!-- #colophon -->
<?php

wp_footer();

?></body>
</html>