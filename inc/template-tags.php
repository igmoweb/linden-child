<?php
/**
 * @version:
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'linden_child_footer_content', 'linden_child_footer_content' );

add_filter( 'body_class', 'linden_lite_child_body_class' );
add_filter( 'get_the_archive_title', 'linden_child_archive_title' );

function linden_child_archive_title( $title ) {
	if ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}

function linden_child_footer_content() {
	?>
	<h2><?php bloginfo( 'name' ); ?></h2>

	<p><?php echo get_bloginfo( 'description', 'display' ); ?></p>
	<p><?php echo get_option( 'admin_email' ); ?></p>
	<p><a href="tel:<?php echo esc_attr( get_option( 'phone_number' ) ); ?>"><?php echo get_option( 'phone_number' ); ?></a></p>
	<?php
}

function linden_lite_child_body_class( $class ) {
	if ( is_single() && get_post_type() === 'jetpack-portfolio' ) {
		$types = wp_get_object_terms( get_the_ID(), 'jetpack-portfolio-type' );
		if ( ! empty( $types ) ) {
			$class[] = 'has-terms';
		}
	}

	return $class;
}
