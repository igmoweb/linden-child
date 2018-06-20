<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Linden Lite
 */
?>

	</div><!-- #content -->

	<footer class="site-footer" role="contentinfo">

		<h2><?php bloginfo( 'name' ); ?></h2>

		<p><?php echo get_bloginfo( 'description', 'display' ); ?></p>
		<p><?php echo get_option( 'admin_email' ); ?></p>
		<p><a href="tel:<?php echo esc_attr( get_option( 'phone_number' ) ); ?>"><?php echo get_option( 'phone_number' ); ?></a></p>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav id="social-navigation" class="social-navigation" role="navigation">
				<?php
				// Social links navigation menu.
				wp_nav_menu( array(
					'theme_location' => 'social',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
