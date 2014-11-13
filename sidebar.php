<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thebabyfold
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?><div id="secondary" class="widget-area" role="complementary"><?php

	$blocks = get_field( 'content_blocks' );

	if ( ! empty( $blocks ) ) {

		foreach ( $blocks as $block ) {

			?><div class="block">
				<div class="block-title"><div class="block-icon"><?php echo get_svg( strtolower( $block['icon'] ) ); ?></div><div class="block-title-text"><?php echo $block['title']; ?></div><div class="show_hide">+</div></div><!-- .block-title -->
				<div class="block-content"><?php echo $block['content']; ?></div><!-- .block-title -->

			</div><!-- .block --><?php

		} // foreach

	}

	// dynamic_sidebar( 'sidebar-1' );

?></div><!-- #secondary -->