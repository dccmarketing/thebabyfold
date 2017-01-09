<?php
/**
 * Template Name: Page with Posts
 *
 * Description: A page with posts at the bottom
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

				endwhile; // page loop.

				$category 	= get_field( 'categories' );
				$cat_posts 	= babyfold_get_category_posts( $category );

				if ( 0 < $cat_posts->found_posts ) {

					echo '<div class="posts_wrap">';

					while ( $cat_posts->have_posts() ) : $cat_posts->the_post();

						if ( 'Volunteer' == $page_title || 'How We Can Help You' == $page_title ) {

							get_template_part( 'content', 'volunteeropps' );

						} else {

							get_template_part( 'content', get_post_format() );

						}

					endwhile; // posts loop

					echo '</div><!-- .posts_wrap -->';

				} // empty check

				wp_reset_postdata();

			?></main><!-- #main -->
		</div><!-- #primary --><?php

get_sidebar();

	?></div><!-- .wrap --><?php

get_footer();
?>