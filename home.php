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
	<div class="promo_wrap">
		<div class="promo_boxes"><?php

		$boxes = array( 'promo_box_1', 'promo_box_2', 'promo_box_3' );

		foreach ( $boxes as $box ) {

			?><div class="promo_box">
				<img src="<?php echo get_field( $box, '203' ); ?>" />
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

			do_action( 'site_info' );

		?></div><!-- .site-info -->

	</footer><!-- #colophon -->
<?php 

wp_footer();

?></body>
</html>