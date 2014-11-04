<?php
/**
 * @package thebabyfold
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"><?php

		echo sprintf( '<h1 class="entry-title showhide">%1$s</h1><span class="show_hide">+</span>', get_the_title( get_the_ID() ) );

	?></header><!-- .entry-header -->
	<div class="entry-content hidethis"><?php

			the_content();
	
	?></div><!-- .entry-content -->
</article><!-- #post-## -->