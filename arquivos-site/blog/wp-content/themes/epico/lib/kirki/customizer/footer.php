<?php

/*
 * Creates the section, settings and the controls for the customizer
 */
function epico_footer_customizer( $wp_customize ){

	$fields = array();

	// Create the "footer" section
	$wp_customize->add_section( 'footer', array(
		'title'    => __( 'Footer information', 'epico' ),
		'priority' => 4
	) );

}
add_action( 'customize_register', 'epico_footer_customizer' );

/*
 * Creates the array of options and controls for the customizer
 */
function epico_footer_customizer_settings( $fields ){




	$fields[] = array(
		'type'     => 'textarea',
		'settings' => 'epico_footer_txt',
		'label'    => __( 'Add additional information', 'epico' ),
		'help'     => __( 'Add optional credits or other subsidiary information in the site footer. If you need a link in that area, you can use the footer menu, accesible through the WordPress default menu system.', 'epico' ),
		'section'  => 'footer',
		'default'  => __( 'All rights reserved', 'epico' ),
		'priority' => 1,
	);


	$fields[] = array(
		'type'     => 'text',
		'settings' => 'epico_date',
		'label'    => __( 'Site starting date', 'epico' ),
		'help'     => __( 'Enter the starting year of your site, if different from the current year (enter a four digit number . Ex: 2012).', 'epico' ),
		'section'  => 'footer',
		'default'  => null,
		'priority' => 2,
	);


	$fields[] = array(
		'type'     => 'image',
		'settings' => 'epico_logo_image_footer',
		'label'    => __( 'Upload the footer logo image', 'epico' ),
		'help'     => __( '(Optional) A transparent PNG version with a white logo is preferable to maintain contrast against the dark background of the footer.', 'epico' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 3,
	);


	return $fields;
}
add_filter( 'kirki/controls', 'epico_footer_customizer_settings' );
