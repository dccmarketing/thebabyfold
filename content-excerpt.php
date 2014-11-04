<?php
/**
 * @package thebabyfold
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"><?php

		echo sprintf( '<h1 class="entry-title"><a href="%1$s" rel="bookmark">%2$s</a></h1>', esc_url( get_permalink() ), get_the_title( get_the_ID() ) );

	?></header><!-- .entry-header -->
	<div class="entry-content"><?php

			the_excerpt();
	
	?></div><!-- .entry-content -->
</article><!-- #post-## -->