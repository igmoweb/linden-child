<?php
/**
 * @package Linden Lite
 */
$vimeo_url = get_post_meta( get_the_ID(), '_vimeo_link', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header"><?php

		the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="header-meta"><?php

			linden_lite_entry_category_or_types();
			echo ' ';
			linden_lite_posted_on();
			echo ' ';
			linden_lite_posted_by();
			echo ' ';

			?>
		</div><!-- .header-meta -->

		<div class="entry-featured">
			<?php if ( ! empty( $vimeo_url ) ): ?>
				<?php echo wp_oembed_get( $vimeo_url ); ?>
			<?php elseif ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail( 'linden-lite-post-thumb' ); ?>
			<?php endif; ?>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content"><?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'linden-lite' ),
			'after'  => '</div>',
		) ); ?>

	</div><!-- .entry-content --><?php

	linden_lite_entry_tags();
	?>

</article><!-- #post-## -->
