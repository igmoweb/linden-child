<?php
/**
 * The template for displaying all single posts.
 *
 * @package Linden Lite
 */

get_header();

while ( have_posts() ) : the_post(); ?>

	<div class="content-wrap">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">
				<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
			</main><!-- #main -->

		</div><!-- #primary -->
	</div><!-- .content-wrap -->

	<nav class="navigation post-navigation clear" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'linden-lite' ); ?></h2>
		<?php

		//show link to previous post with preview on hover
		$linden_lite_prev_post = get_previous_post();
		if ( !empty( $linden_lite_prev_post )) {	?>

			<div class="nav-previous">

				<a href="<?php the_permalink($linden_lite_prev_post); ?>"><span class="tooltip tooltip-left"><span class="tooltip-item"> <?php echo get_the_title($linden_lite_prev_post); ?></span><span class="tooltip-content"><span class="tooltip-text"><?php echo get_the_post_thumbnail($linden_lite_prev_post, 'linden-lite-post-feed-thumb'); ?></span></span></span></a>

			</div><?php
		}

		//show link to next post with preview on hover
		$linden_lite_next_post = get_next_post();
		if( !empty( $linden_lite_next_post )) { ?>

			<div class="nav-next">

				<a href="<?php the_permalink($linden_lite_next_post); ?>"><span class="tooltip tooltip-right"><span class="tooltip-item"> <?php echo get_the_title($linden_lite_next_post); ?></span><span class="tooltip-content"><span class="tooltip-text"><?php echo get_the_post_thumbnail($linden_lite_next_post, 'linden-lite-post-feed-thumb'); ?></span></span></span></a>

			</div>
			<?php

		}
		?>
	</nav>
<?php

endwhile; // end of the loop.

get_footer();

?>
