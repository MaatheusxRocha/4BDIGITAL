<?php
/**
*
* fieldconfig for uf-epico/Customization
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Customization','uf-epico'),
	'id' => '1512313',
	'master' => 'sidebar',
	'fields' => array(
		'sidebar'	=>	array(
			'label'		=> 	__('Span page width','uf-epico'),
			'caption'	=>	__('You can use the widget in the sidebar or spanning the whole width of your layout, if your theme allows.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||Full page width,*2||Sidebar', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'sticky'	=>	array(
			'label'		=> 	__('Fixed on scroll','uf-epico'),
			'caption'	=>	__('<br />(Note: this option is effective only for the widget area after the main sidebar).</br> The widget can stay fixed as you scroll down or scroll normally with the content. To make the fixed option work, activate above the option (<strong>Sidebar</strong>).','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||Fixed postion,*2||Scroll normally', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'innerpages'	=>	array(
			'label'		=> 	__('Short version on inner pages','uf-epico'),
			'caption'	=>	__('<br>You can have a short version of the widget, with just the subscription form, on inner pages of the site – the default version will always be presented on the frontpage.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||Short version,*2||Default version', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'close_btn'	=>	array(
			'label'		=> 	__('Close button','uf-epico'),
			'caption'	=>	__('<br>Would you like a close button in the right top corner of the widget?','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||Add close button,2||Omit close button', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'new_window'	=>	array(
			'label'		=> 	__('Open in new window','uf-epico'),
			'caption'	=>	__('<br>Would you like to open a new window after the visitor clicks the submit button?','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||New window,2||Same window', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'disable_animation'	=>	array(
			'label'		=> 	__('Animations','uf-epico'),
			'caption'	=>	__('<br>You can disable all animations if necessary.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||Animations On,2||Animations Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'bkg_img'	=>	array(
			'label'		=> 	__('Widget background image','uf-epico'),
			'caption'	=>	__('<br>Select a background image for the widget (optional).','uf-epico'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'overlay'	=>	array(
			'label'		=> 	__('Color ovelay effect','uf-epico'),
			'caption'	=>	__('<br>You can add a color overlay effect to the background image. Enable it here.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||On,*2||Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'overlay_color'	=>	array(
			'label'		=> 	__('Ovelay color','uf-epico'),
			'caption'	=>	__('<br>Choose a color for the overlay effect.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#333333',
		),
	),
	'styles'	=> array(
		'toggles.css',

	),
	'scripts'	=> array(
		'toggles.min.js',
		'image-modal.js',
		'colorpicker.js',
	),
	'multiple'	=> false,
);

