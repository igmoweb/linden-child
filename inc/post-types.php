<?php
/**
 * @version:
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'add_meta_boxes', 'linden_lite_child_portfolio_meta_boxes' );
add_action( 'save_post', 'linden_lite_child_save_portfolio_meta_box' );
add_action( 'init', 'linden_lite_child_register_clients' );
add_action( 'admin_enqueue_scripts', 'linden_child_enqueue_cliente_admin_styles' );

add_filter( 'manage_cliente_posts_custom_column', 'linden_child_cliente_image_column', 10, 2 );
add_filter( 'manage_cliente_posts_columns', 'linden_child_edit_cliente_columns', 10, 2 );
add_filter( 'register_post_type_args', 'linden_lite_child_jp_portfolio_slug', 10, 2 );
add_filter( 'register_taxonomy_args', 'linden_lite_child_jp_portfolio_slug', 10, 2 );


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

function linden_child_cliente_image_column( $column, $post_id ) {
	switch ( $column ) {
		case 'thumbnail':
			echo get_the_post_thumbnail( $post_id, 'thumbnail' );
			break;
	}
}

function linden_child_edit_cliente_columns( $columns ) {
	$columns = array_slice( $columns, 0, 1, true ) + array( 'thumbnail' => '' ) + array_slice( $columns, 1, NULL, true );
	return $columns;
}

function linden_child_enqueue_cliente_admin_styles( $hook ) {
	$screen = get_current_screen();

	if ( 'edit.php' == $hook && 'cliente' == $screen->post_type && current_theme_supports( 'post-thumbnails' ) ) {
		wp_add_inline_style( 'wp-admin', '.column-thumbnail > img { max-width:50px !important; max-height:50px !important; } .manage-column.column-thumbnail { width: 50px; } @media screen and (max-width: 360px) { .column-thumbnail{ display:none; } }' );
	}
}
