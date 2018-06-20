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
				<div class="front-page-video">
					<video autoplay muted loop id="myVideo" poster="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'home_image' ) ) ); ?>">
						<source src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'home_video' ) ) ); ?>" type="video/mp4">
					</video>
				</div>
			</main><!-- #main -->

		</div><!-- #primary -->
		<?php

		if ( get_theme_mod( "linden_lite_sidebar_pos" ) != 'sidebar-none') :
			get_sidebar();
		endif;
		?>
	</div><!-- .content-wrap -->

<?php endwhile; // end of the loop.

get_footer(); ?>
