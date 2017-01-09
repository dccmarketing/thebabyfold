<?php
/**
 * Template Name: Reports Page
 *
 * Description: The reports page
 *
 * @package thebabyfold
 */

$page_title = get_the_title();

get_header(); ?>

	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<header class="entry-header"><?php

					the_title( '<h1 class="entry-title">', '</h1>' );

				?></header><!-- .entry-header -->

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content"><?php

						$files = get_field( 'reports' );

						if ( $files ) {

							foreach ( $files as $file ) {

								?><div class="file-wrap">
									<a href="<?php echo $file['report_file']; ?>">
										<img src="<?php echo $file['report_image']; ?>" class="file-cover" />
									</a>
									<p class="file-name"><?php echo $file['report_name']; ?></p>
								</div><?php

							} // foreach

						}

					?></div><!-- .entry-content -->
					<footer class="entry-footer"><?php

						edit_post_link( __( 'Edit', 'thebabyfold' ), '<span class="edit-link">', '</span>' );

					?></footer><!-- .entry-footer -->
				</article><!-- #post-## -->
			</main><!-- #main -->
		</div><!-- #primary --><?php

get_sidebar( 'left' );

	?></div><!-- .wrap --><?php

get_footer();
?>