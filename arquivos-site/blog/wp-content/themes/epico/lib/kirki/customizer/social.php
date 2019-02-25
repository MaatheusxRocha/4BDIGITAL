<?php

/*
 * Creates the section, settings and the controls for the customizer
 */
function epico_social_customizer( $wp_customize ){

	$fields = array();

	// Create the "social" section
	$wp_customize->add_section( 'social', array(
		'title'    => __( 'Social sharing buttons', 'epico' ),
		'priority' => 3
	) );

}
add_action( 'customize_register', 'epico_social_customizer' );

/*
 * Creates the array of options and controls for the customizer
 */
function epico_social_customizer_settings( $fields ){

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialpages',
		'label'    => __( 'Enable in pages', 'epico' ),
		'help'     => __( 'Control the display of the social buttons in pages.', 'epico' ),
		'section'  => 'social',
		'default'  => 0,
		'priority' => 1,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialposts',
		'label'    => __( 'Enable in posts', 'epico' ),
		'help'     => __( 'Control the display of the social buttons in posts.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 2,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialstickybox',
		'label'    => __( 'Sticky share box', 'epico' ),
		'help'     => __( 'By default the box remains fixed when the page scrolls. You can control this behavior here.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 3,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialclose',
		'label'    => __( 'Close button', 'epico' ),
		'help'     => __( 'A close button to dismiss the social button bar. For this feature to work, you must have installed the theme\'s funcionality plugin.' , 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 4,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialcounter',
		'label'    => __( 'Total number of shares', 'epico' ),
		'help'     => __( 'The total number of shares for all social networks shown.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 5,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialpartialcount',
		'label'    => __( 'Shares per social network', 'epico' ),
		'help'     => __( 'Individual number or shares for each social network.', 'epico' ),
		'section'  => 'social',
		'default'  => 0,
		'priority' => 6,
	);

	$fields[] = array(
		'type'     => 'radio-image',
		'settings' => 'epico_socialstyles',
		'label'    => __( 'Button styles', 'epico' ),
		'section'  => 'social',
		'priority' => 7,
		'default'  => 0,
		'choices'  => array(
			0 => get_template_directory_uri() . '/img/icons/social-colorful.png',
			1 => get_template_directory_uri() . '/img/icons/social-minimal.png',
		),
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialfacebook',
		'label'    => __( 'Facebook button', 'epico' ),
		'help'     => __( 'Hide Facebook button.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 8,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialtwitter',
		'label'    => __( 'Twitter button', 'epico' ),
		'help'     => __( 'Hide Twitter button.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 9,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialgoogle',
		'label'    => __( 'Google+ button', 'epico' ),
		'help'     => __( 'Hide Google Plus button.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 10,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialpinterest',
		'label'    => __( 'Pinterest button', 'epico' ),
		'help'     => __( 'Hide Pinterest button.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 11,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_sociallinkedin',
		'label'    => __( 'LinkedIn button', 'epico' ),
		'help'     => __( 'Hide LinkedIn button.', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 12,
	);

	$fields[] = array(
		'type'     => 'checkbox',
		'settings' => 'epico_socialwhatsapp',
		'label'    => __( 'WhatsApp button (mobile)', 'epico' ),
		'help'     => __( 'Hide WhatsApp button. Notice: this button is available only in mobile devices (Android or iOS)', 'epico' ),
		'section'  => 'social',
		'default'  => 1,
		'priority' => 13,
	);

	return $fields;
}
add_filter( 'kirki/controls', 'epico_social_customizer_settings' );
