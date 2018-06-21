<?php
/**
 * @version:
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'linden_child_customizer_init' );

/**
 * @param WP_Customize_Manager $wp_customize
 */
function linden_child_customizer_init( $wp_customize ) {
	$wp_customize->add_section( 'theme_options', [
		'title'    => 'Opciones del tema',
		'priority' => 130, // Before Additional CSS.
	] );

	/**
	 * Front Page video/image.
	 */
	$wp_customize->add_setting( 'home_video', [
		'default' => '',
	] );

	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'home_video', [
		'label'       => 'Vídeo de portada',
		'section'     => 'theme_options',
		'description' => 'No se recomiendan más de 2Mb de tamaño',
	] ) );

	$wp_customize->add_setting( 'home_image', [
		'default' => '',
	] );

	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'home_image', [
		'label'       => 'Imagen de portada',
		'description' => 'Sólo aparecerá mientras el vídeo se carga',
		'section'     => 'theme_options',
	] ) );
}

