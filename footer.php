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
	<footer id="colophon" class="site-footer" role="contentinfo"><?php 

		//echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'footer-bg' ) ); 

		?><div class="social-menu">
			<h2 class="social-headline">Connect with Us</h2><?php

			get_template_part( 'menu', 'social' );

		?></div><!-- .social-menu -->
		<div class="footer-wrap">
			<div class="site-info"><?php

				do_action( 'site_info' );

			?></div><!-- .site-info -->		
		</div><!-- .footer-wrap -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>