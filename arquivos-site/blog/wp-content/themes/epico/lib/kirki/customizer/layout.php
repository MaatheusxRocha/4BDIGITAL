<?php

/*
 * Cria o painel `Design e Layout`, com os respectivos campos.
 */

function epico_layout_customizer( $wp_customize ){

	$fields = array();

	$wp_customize->add_section( 'layout', array(
		'title'    => __( 'Design and layout', 'epico' ),
		'priority' => 2
	) );

}
add_action( 'customize_register', 'epico_layout_customizer' );

function epico_layout_customizer_settings( $fields ){

	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'epico_color_palettes',
		'label'       => __( 'Color palettes', 'epico' ),
		'help'        => __( 'Customize your site colors with one of these color palletes. Make it the way you want!', 'epico' ),
		'section'     => 'layout',
		'priority'    => 1,
		'default'     => 0,
		'choices'     => array(
			0 => get_template_directory_uri() . '/img/icons/pallete01.png',
			1 => get_template_directory_uri() . '/img/icons/pallete02.png',
			2 => get_template_directory_uri() . '/img/icons/pallete03.png',
			3 => get_template_directory_uri() . '/img/icons/pallete04.png',
			4 => get_template_directory_uri() . '/img/icons/pallete05.png',
			5 => get_template_directory_uri() . '/img/icons/pallete06.png',
			6 => get_template_directory_uri() . '/img/icons/pallete07.png',
			7 => get_template_directory_uri() . '/img/icons/pallete08.png',
			8 => get_template_directory_uri() . '/img/icons/pallete09.png',
		),
	);

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'epico_color_override_option',
		'label'       => __( 'Override style main color', 'epico' ),
		'help'        => __( 'Check this if you want to override the pallete accent color and define a new custom color.', 'epico' ),
		'section'     => 'layout',
		'default'     => 0,
		'priority'    => 2,
	);

	$fields[] = array(
		'type'        => 'color',
		'settings'    => 'epico_color_override',
		'label'       => __( 'Main color', 'epico' ),
		'description' => __( 'Choose a value to automatically override the pallete\'s main color.', 'epico' ),
		'help'        => __( 'Here you can specify a custom color for the main elements of the template, overriding the chosen pallete. The neutral tones will remain the same.', 'epico' ),
		'section'     => 'layout',
		'default'     => '#81D742',
		'priority'    => 3,
	);

	$fields[] = array(
		'type'        => 'color',
		'setting'     => 'epico_landing_bkg_color',
		'description' => __( 'Landing background color', 'epico' ),
		'section'     => 'layout',
		'default'     => '#FFFFFF',
		'priority'    => 5,
	);

	$fields[] = array(
		'type'        => 'image',
		'setting'     => 'epico_landing_bkg_img',
		'description' => __( 'Landing background image', 'epico' ),
		'section'     => 'layout',
		'default'     => null,
		'priority'    => 7,  // prioridades 4 e 5 ocupadas pela imagem de cor de fundo padrao - epico.php - funcao `epico_customizer_remove`
	);

	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'epico_sidebar_layout',
		'label'       => __( 'Site layout', 'epico' ),
		'help'        => __( 'Choose a layout for your content: sidebar on the left or sidebar on the right.', 'epico' ),
		'section'     => 'layout',
		'priority'    => 8,
		'default'     => 1,
		'choices'     => array(
			0 => get_template_directory_uri() . '/img/icons/sidebar-left.png',
			1 => get_template_directory_uri() . '/img/icons/sidebar-right.png',
		),
	);

	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'epico_typography',
		'label'       => __( 'Header font', 'epico' ),
		'help'        => __( 'Choose one typographic style to use with the site headers.', 'epico' ),
		'section'     => 'layout',
		'priority'    => 9,
		'default'     => 1,
		'choices'     => array(
			0 => get_template_directory_uri() . '/img/icons/header-default-font.png',
			1 => get_template_directory_uri() . '/img/icons/header-alt-font-1.png',
			2 => get_template_directory_uri() . '/img/icons/header-alt-font-2.png',
		),
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'epico_compact_loop',
		'label'       => __( 'Compact listing of posts', 'epico' ),
		'help'        => __( 'This will enable a more compact display of posts in various listings: archives, blogs, categories, tags and taxonomies', 'epico' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 10,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'epico_reading_time',
		'label'       => __( 'Estimated reading time of posts', 'epico' ),
		'help'        => __( 'A small notice with the estimated reading time of the post will appear right above the post\'s text. After activating this, you must resave your old posts to calculate the reading time for them.', 'epico' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 11,
	);

	$fields[] = array(
		'type'        => 'select2-multiple',
		'settings'    => 'epico_reading_time_exclude',
		'label'       => __( 'Ignore reading time in pages', 'epico' ),
		'description' => __( 'If you want to remove the reading time from certain pages, select them below.', 'epico' ),
		'help'        => __( 'The reading time does not make sense in some page types. Pages with contact forms or with video only will not benefit for this information. To correct this behavior, this option will remove the reading time only from the pages you select in the text field. This setting works only for pages, not posts.', 'epico' ),
		'section'     => 'layout',
		'default'     => null,
		'priority'    => 12,
		'choices'     => Kirki_Helper::get_posts( array( 'post_type' => 'page', 'orderby' => 'modified', 'posts_per_page' => -1 ) ),
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'epico_zenmode',
		'label'       => __( 'Zen mode (focused reading)', 'epico' ),
		'help'        => __( 'This will add a small icon for the Zen mode (or focused reading mode), right above the post or page title. The Zen mode will allow the site visitor to temporally remove all layout distractions from the site\'s interface, like sidebars, widgets and background colors or images.', 'epico' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 13,
	);

	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'epico_zenmode_text',
		'label'       => __( 'Zen mode button text', 'epico' ),
		'help'        => __( 'Specify the text that will show when the mouse is hovering over the Zen mode icon.', 'epico' ),
		'section'     => 'layout',
		'default'     => __( 'Focused reading', 'epico' ),
		'priority'    => 14,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'epico_author_box_switch',
		'label'       => __( 'Author box', 'epico' ),
		'description' => __( 'Enable or disable the author box below posts.', 'epico' ),
		'help'        => __( 'Uncheck to remove the author box feature from articles, located at the end of the post content. Pages are automatically ignored by default.', 'epico' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 15,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'epico_related_posts_switch',
		'label'       => __( 'Related posts', 'epico' ),
		'description' => __( 'Enable or disable the automatic related posts feature.', 'epico' ),
		'help'        => __( 'Uncheck to remove the related posts feature from articles. Pages are automatically ignored by default.', 'epico' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 16,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'epico_post_nav_switch',
		'label'       => __( 'Post navigation', 'epico' ),
		'description' => __( 'Enable or disable the automatic post navigation feature.', 'epico' ),
		'help'        => __( 'Uncheck to remove the navigation posts feature from articles, before the comment form. Pages are automatically ignored by default.', 'epico' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 17,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'epico_mobile_columns_switch',
		'label'       => __( 'Sidebar columns in mobile', 'epico' ),
		'description' => __( 'Enable or disable the multiple column sidebar on mobile.', 'epico' ),
		'help'        => __( 'Uncheck to let the sidebar widgets span across the entire sidebar in resolutions below 1020 pixels wide. The default behavior is a sidebar with two columns in tablets and smartphones.', 'epico' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 18,
	);

	return $fields;
}
add_filter( 'kirki/controls', 'epico_layout_customizer_settings' );
