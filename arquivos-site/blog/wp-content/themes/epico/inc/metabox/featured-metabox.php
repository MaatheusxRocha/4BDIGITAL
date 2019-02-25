<?php

/**
 * Define uma meta box personalizada na area de edicao de artigos.
 *
 * @package	    Epico
 * @subpackage  Featured metabox
 * @version     1.0.0
 * @since       1.0.0
 *
 */

add_action( 'add_meta_boxes', 'epico_img_featured_metabox' );

function epico_img_featured_metabox() {

	$screens = array(
		'post',
		'page',
	);

	foreach ( $screens as $screen ) {
		add_meta_box(
			'epico-featured-metabox',
			__( 'Featured image in content' , 'epico' ),
			'epico_render_metabox',
			$screen,
			'side',
			'core'
		);
	}
}

/**
 * Renderiza o conteudo a ser apresentado na meta box.
 *
 */
function epico_render_metabox() {
	require_once get_template_directory() . '/inc/metabox/featured-metabox-display.php';
}


add_action( 'init', 'epico_setup_metabox_helper' );
/**
 * Importa e instancia o meta box helper.
 *
 */
function epico_setup_metabox_helper() {

	require_once get_template_directory() . '/inc/metabox/class-featured-metabox-helper.php';

	$helper = new Uberstart_Metabox_Helper();

}