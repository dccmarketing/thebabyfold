<?php
/**
 * @package thebabyfold
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"><?php

		the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );

		if ( 'post' == get_post_type() ) :

			?><div class="entry-meta"><?php

				thebabyfold_posted_on();

			?></div><!-- .entry-meta --><?php

		endif;

	?></header><!-- .entry-header -->

	<div class="entry-content"><?php

			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'thebabyfold' ), 
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
	
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'thebabyfold' ),
				'after'  => '</div>',
			) );

	?></div><!-- .entry-content -->

	<footer class="entry-footer"><?php

		thebabyfold_entry_footer();

	?></footer><!-- .entry-footer -->
</article><!-- #post-## -->