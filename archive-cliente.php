<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Linden Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<h1 class="page-title">Clientes</h1>
			</header>
			<?php if ( have_posts() ) : ?>
				<ul class="clientes-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<li>
							<div class="cliente-thumbnail">
								<?php if ( has_post_thumbnail() ): ?>
									<?php the_post_thumbnail( 'thumbnail', array( 'title' => get_the_title() ) ); ?>
								<?php endif; ?>
							</div>
						</li>
					<?php endwhile; ?>
				</ul><!-- .page-header -->
			<?php else : ?>
				<?php get_template_part( 'template-parts/content-none' ); ?>
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<style>

</style>
<?php get_footer(); ?>
