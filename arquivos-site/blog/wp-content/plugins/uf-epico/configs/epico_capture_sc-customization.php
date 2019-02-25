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
	'id' => '01130151',
	'master' => 'disable_animation',
	'fields' => array(
		'new_window'	=>	array(
			'label'		=> 	__('Open in new window','uf-epico'),
			'caption'	=>	__('<br>Would you like to open a new window after the visitor clicks the submit button?','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*0||New window,1||Same window', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'disable_animation'	=>	array(
			'label'		=> 	__('Animations','uf-epico'),
			'caption'	=>	__('You can disable all animations if necessary.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||Animations On,2||Animations Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'bkg_img'	=>	array(
			'label'		=> 	__('Widget background image','uf-epico'),
			'caption'	=>	__('Select a background image for the widget (optional).','uf-epico'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'overlay'	=>	array(
			'label'		=> 	__('Overlay effect','uf-epico'),
			'caption'	=>	__('You can add a color overlay effect to the background image. Enable it here.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||On,*2||Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'overlay_color'	=>	array(
			'label'		=> 	__('Overlay color','uf-epico'),
			'caption'	=>	__('Choose a color for the overlay effect.','uf-epico'),
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

