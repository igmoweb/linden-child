<?php
/*This file is part of linden-child, linden-lite child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

add_action( 'after_setup_theme', 'linden_child_theme_setup', 20 );
add_action( 'init', 'linden_child_theme_init' );
add_action( 'admin_init', 'linden_lite_child_register_settings' );
add_action( 'wp_enqueue_scripts', 'linden_child_enqueue_child_styles' );
add_action( 'widgets_init', 'linden_lite_child_widgets_init', 100 );

function linden_child_theme_setup() {
	add_theme_support( 'post-formats', [ 'image' ] );
	register_nav_menus( [
		'social'  => 'Menú Social',
	] );
	remove_theme_support( 'custom-background' );
}

function linden_child_theme_init() {
	add_post_type_support( 'jetpack-portfolio', 'post-formats' );
	register_taxonomy_for_object_type( 'post_format', 'jetpack-portfolio' );
	remove_post_type_support( 'post', 'post-formats' );
	add_image_size( 'linden-lite-portfolio-thumb', 1400, 99999 ); // (cropped)
}

function linden_lite_child_register_settings() {
	register_setting( 'general', 'phone_number', 'sanitize_text_field' );
	add_settings_field( 'phone_number', '<label for="phone_number">Teléfono</label>', 'linden_lite_child_render_phone_field', 'general' );
}

function linden_lite_child_render_phone_field() {
	?>
	<input type="text" name="phone_number" value="<?php echo esc_attr( get_option( 'phone_number', '' ) ); ?>">
	<?php
}


function linden_child_enqueue_child_styles() {
	$parent_style = 'parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[ $parent_style ],
		wp_get_theme()->get( 'Version' ) );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );
}



function linden_lite_child_widgets_init() {
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'footer-widget-1' );
}


include_once( 'inc/docs-page.php' );
include_once( 'inc/customizer.php' );
include_once( 'inc/post-types.php' );
include_once( 'inc/template-tags.php' );
