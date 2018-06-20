<?php
/**
 * Template Name: Contact
 */
?>

<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Linden Lite
 */

get_header();

while ( have_posts() ) : the_post(); ?>

	<div class="content-wrap">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>

					<header class="entry-header"><?php

						the_post_thumbnail('medium' );

						the_title( '<h1 class="entry-title">', '</h1>' );

						edit_post_link( esc_html__( 'Edit', 'linden-lite' ), '<div class="header-meta"><span class="edit-link">', '</span></div>' );
						?>
					</header><!-- .entry-header -->

					<div class="entry-content"><?php

						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'linden-lite' ),
							'after'  => '</div>',
						) );
						?>

					</div><!-- .entry-content -->

				</article><!-- #post-## -->
			</main><!-- #main -->

		</div><!-- #primary -->
	</div><!-- .content-wrap -->

<?php endwhile; // end of the loop.

get_footer(); ?>

