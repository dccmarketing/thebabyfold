<?php
/**
 * Template Name: Newsletter Page
 *
 * Description: The newsletters page
 *
 * @package thebabyfold
 */

$page_title = get_the_title();

get_header(); ?>

	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main"><?php

				while ( have_posts() ) : the_post();

					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {

						comments_template();

					}

				endwhile; // end of the loop.

				?><div class="wrap-reports"><?php

				$newsletters = get_field( 'newsletters' );

				foreach ( $newsletters as $newsletter ) {

					?><div class="newsletter">
						<a href="<?php echo $newsletter['file']; ?>" target="_blank"><?php echo $newsletter['date']  ?></a>
					</div><?php

				} // foreach

				?></div><!-- .reports -->
			</main><!-- #main -->
		</div><!-- #primary --><?php

get_sidebar( 'left' );

	?></div><!-- .wrap --><?php

get_footer();
?>