<?php

/*
 * Cria o painel `Sua marca`, com os respectivos campos.
 */

function epico_branding_customizer( $wp_customize ){

	$fields = array();

	$wp_customize->add_section( 'branding', array(
		'title'    => __( 'Branding', 'epico' ),
		'priority' => 1
	) );

}
add_action( 'customize_register', 'epico_branding_customizer' );

function epico_branding_customizer_settings( $fields ){


	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'epico_site_name',
		'label'       => __( 'Site title', 'epico' ),
		'description' => __( 'How you would like to call your blog?', 'epico' ),
		'help'        => __( 'Choose the site title for the header of your site.', 'epico' ),
		'section'     => 'branding',
		'default'     => get_bloginfo( 'name', 'epico' ),
		'priority'    => 1,
	);


	$fields[] = array(
		'type'        => 'image',
		'settings'    => 'epico_logo_upload',
		'label'       => __( 'Logo', 'epico' ),
		'description' => __( 'Add a logo image instead of a title. Tip: to keep your site performance optimzed, upload a small image file (400 pixels maximum). Edit your image in an <a target="_blank" href="http://pixlr.com/editor/">online image editor</a> if necessary', 'epico' ),
		'help'        => __( 'You can use a custom logo instead of just a site title. Click the upload button to send the logo image from your computer. An image with a white or transparent background is preferred.', 'epico' ),

		'section'     => 'branding',
		'default'     => null,
		'priority'    => 2,
	);

	$fields[] = array(
		'type'        => 'slider',
		'settings'    => 'epico_logo_width',
		'label'       => __( 'Logo image width', 'epico' ),
		'section'     => 'branding',
		'description' => __( 'After the upload, you can fine tune the image width to perfect it in your layout.', 'epico' ),
		'default'     => 280,
		'priority'    => 3,
		'choices'     => array(
			'min'     => 120,
			'max'     => 400,
			'step'    => 2,
		),
	);


	return $fields;
}
add_filter( 'kirki/controls', 'epico_branding_customizer_settings' );
