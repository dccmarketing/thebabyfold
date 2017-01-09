<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thebabyfold
 */

?><div id="secondary" class="widget-area" role="complementary"><?php

	$blocks = get_field( 'content_blocks' );

	if ( ! empty( $blocks ) ) {

		foreach ( $blocks as $block ) {

			$class = '';
			$style = '';

			if ( ! $block['collapsible'] ) {

				$class = 'open';
				$style = 'style="display:block;"';

			}

			?><div class="block <?php echo $class; ?>">
				<div class="block-title"><div class="block-icon"><?php echo babyfold_get_svg( strtolower( $block['icon'] ) ); ?></div><div class="block-title-text"><?php echo $block['title']; ?></div><?php

					if ( $block['collapsible'] ) {

						?><div class="show_hide">+</div><?php

					}

				?></div><!-- .block-title -->
				<div class="block-content" <?php echo $style; ?>><?php echo $block['content']; ?></div><!-- .block-title -->
			</div><!-- .block --><?php

		} // foreach

	}

?></div><!-- #secondary -->