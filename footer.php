<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package thebabyfold
 */
?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="social-menu">
			<h2 class="social-headline">Connect with Us</h2><?php

			get_template_part( 'menu', 'social' );

		?></div><!-- .social-menu -->
		<div class="footer-wrap">
			<div class="site-info"><?php

				printf( __( '<div class="copyright">&copy %1$s <a href="%2$s" title="Login">%3$s</a></a></div>', 'thebabyfold' ), date( 'Y' ), get_admin_url(), get_bloginfo( 'name' ) );
				get_template_part( 'menu', 'footer' );
				printf( __( '<div class="credits">Designed and developed by <a href="%1$s">DCC Marketing</a></div>', 'thebabyfold' ), 'http://dccmarketing.com' );

			?></div><!-- .site-info -->
		</div><!-- .footer-wrap -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>