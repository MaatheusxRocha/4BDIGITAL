<?php

/*
 * Creates the section, settings and the controls for the customizer
 */
function epico_advanced_customizer( $wp_customize ){

	$fields = array();

	// Create the "advanced" section
	$wp_customize->add_section( 'advanced', array(
		'title'    => __( 'Advanced', 'epico' ),
		'priority' => 8
	) );

}
add_action( 'customize_register', 'epico_advanced_customizer' );

/*
 * Creates the array of options and controls for the customizer
 */
function epico_advanced_customizer_settings( $fields ){

	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'epico_gtm',
		'label'       => __( 'Google Tag Manager', 'epico' ),
		'description' => __( 'If you want to track user behaviour in your website through the free Google Tag Manager, paste your GTM ID in the field below. You can find it in the conteiner list of your <a href="https://www.google.com/tagmanager" target="_blank">Google Tag Manager account</a> (e.g., GTM-AB123CD).</br></br><strong>Note:</strong> If you already use the <a href="https://support.google.com/analytics/answer/2790010?hl=pt-BR" target="_blank">Universal Analytics</a> in your site, you should remove it first before using the Google Tag Manager, in order to avoid conflicts in data tracking.', 'epico' ),
		'help'        => __( 'The Google Tag Manager is a new (and free) tool from Google that allows digital marketing professionals manage their campaigns with more independence from developers, offering powerful tools to track user behaviour in your website.', 'epico' ),
		'section'     => 'advanced',
		'default'     => '',
		'priority'    => 1,
	);

	$fields[] = array(
		'type'        => 'select2-multiple',
		'settings'    => 'epico_page_ids',
		'label'       => __( 'Ignore styles in pages', 'epico' ),
		'description' => __( 'If you want to remove theme styles from certain pages to avoid conflicts with page builder plugins, select below the pages that should be ignored by the Epico theme.', 'epico' ),
		'help'        => __( 'If you use some kind of page builder plugin to create pages, please identify this pages here. This will remove all Epico styles in these pages. This setting works only for pages, not posts.', 'epico' ),
		'section'     => 'advanced',
		'default'     => null,
		'priority'    => 2,
		'choices'     => Kirki_Helper::get_posts( array( 'post_type' => 'page', 'orderby' => 'modified', 'posts_per_page' => -1 ) ),
	);

	return $fields;
}

add_filter( 'kirki/controls', 'epico_advanced_customizer_settings' );
