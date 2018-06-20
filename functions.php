<?php
/*This file is part of linden-child, linden-lite child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

add_action( 'after_setup_theme', 'linden_child_theme_setup' );
add_action( 'init', 'linden_child_theme_init' );
add_action( 'wp_enqueue_scripts', 'linden_child_enqueue_child_styles' );
add_action( 'widgets_init', 'linden_lite_child_widgets_init', 100 );
add_action( 'add_meta_boxes', 'linden_lite_child_portfolio_meta_boxes' );
add_action( 'save_post', 'linden_lite_child_save_portfolio_meta_box' );
add_action( 'init', 'linden_lite_child_register_clients' );
add_action( 'customize_register', 'linden_child_customizer_init' );

add_filter( 'register_post_type_args', 'linden_lite_child_jp_portfolio_slug', 10, 2 );
add_filter( 'register_taxonomy_args', 'linden_lite_child_jp_portfolio_slug', 10, 2 );
add_filter( 'body_class', 'linden_lite_child_body_class' );
add_filter( 'get_the_archive_title', 'linden_child_archive_title' );


function linden_child_theme_setup() {
	add_theme_support( 'post-formats', [ 'image' ] );
	register_nav_menus( [
		'social'  => 'Menú Social',
	] );
}

function linden_child_theme_init() {
	add_post_type_support( 'jetpack-portfolio', 'post-formats' );
	register_taxonomy_for_object_type( 'post_format', 'jetpack-portfolio' );
	remove_post_type_support( 'post', 'post-formats' );
}

add_action( 'admin_init', 'linden_lite_child_register_settings' );
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
}



function linden_lite_child_portfolio_meta_boxes() {
	add_meta_box( 'linden-child-vimeo', 'Vimeo link', 'linden_lite_child_render_portfolio_meta_box', 'jetpack-portfolio' );
}

function linden_lite_child_render_portfolio_meta_box( $post ) {
	$vimeo_link = get_post_meta( $post->ID, '_vimeo_link', true );
	?>
	<label for="vimeo-link">Vimeo URL</label>
	<input type="url" name="vimeo-link" id="vimeo-link" class="large-text" value="<?php echo esc_url( $vimeo_link ); ?>" placeholder="https://vimeo.com/1">
	<?php
	wp_nonce_field( 'save-vimeo-link', 'vimeo-link-nonce' );
}

function linden_lite_child_save_portfolio_meta_box( $post_id ) {
	$nonce_name   = isset( $_POST['vimeo-link-nonce'] ) ? $_POST['vimeo-link-nonce'] : '';
	$nonce_action = 'save-vimeo-link';

	// Check if nonce is set.
	if ( empty( $nonce_name ) ) {
		return;
	}

	// Check if nonce is valid.
	if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
		return;
	}

	update_post_meta( $post_id, '_vimeo_link', sanitize_text_field( $_POST['vimeo-link'] ) );
}




function linden_lite_child_jp_portfolio_slug( $args, $name ) {
	if ( 'jetpack-portfolio' === $name ) {
		$args['rewrite']['slug'] = 'trabajos';
	}

	if ( 'jetpack-portfolio-type' === $name ) {
		$args['rewrite']['slug'] = 'tipo-trabajo';
	}

	if ( 'jetpack-portfolio-tag' === $name ) {
		$args['rewrite']['slug'] = 'etiqueta-trabajo';
	}

	return $args;
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


function linden_lite_child_register_clients() {
	register_post_type( 'cliente', [
		'description'         => '',
		'labels'              => [
			'name'               => _x( 'Clientes', 'post type general name', 'linden-child' ),
			'singular_name'      => _x( 'Cliente', 'post type singular name', 'linden-child' ),
			'menu_name'          => _x( 'Clientes', 'admin menu', 'linden-child' ),
			'name_admin_bar'     => _x( 'Cliente', 'add new cliente on admin bar', 'linden-child' ),
			'add_new'            => _x( 'Add New', 'post_type', 'linden-child' ),
			'add_new_item'       => __( 'Add New Cliente', 'linden-child' ),
			'edit_item'          => __( 'Edit Cliente', 'linden-child' ),
			'new_item'           => __( 'New Cliente', 'linden-child' ),
			'view_item'          => __( 'View Cliente', 'linden-child' ),
			'search_items'       => __( 'Search Clientes', 'linden-child' ),
			'not_found'          => __( 'No clientes found.', 'linden-child' ),
			'not_found_in_trash' => __( 'No clientes found in Trash.', 'linden-child' ),
			'parent_item_colon'  => __( 'Parent Cliente:', 'linden-child' ),
			'all_items'          => __( 'All Clientes', 'linden-child' ),
		],
		'public'              => true,
		'hierarchical'        => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-businessman',
		'supports'            => [ 'title', 'thumbnail' ],
		'has_archive'         => true,
		'rewrite'             => [
			'slug'       => 'clientes',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
		'query_var'           => true,
		'can_export'          => true,
	] );
}


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


function linden_child_archive_title( $title ) {
	if ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}
