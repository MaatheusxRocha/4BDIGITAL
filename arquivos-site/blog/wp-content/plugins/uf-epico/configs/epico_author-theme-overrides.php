<?php
/**
*
* fieldconfig for uf-epico/Theme overrides
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Theme overrides','uf-epico'),
	'id' => '741101015',
	'master' => 'override',
	'fields' => array(
		'widget_id'	=>	array(
			'label'		=> 	__('Unique identifier','uf-epico'),
			'caption'	=>	__('Enter an unique identifier for the widget. Use only regular alphabet letters and don\'t use special symbols.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'stripes'	=>	array(
			'label'		=> 	__('Stripes effect','uf-epico'),
			'caption'	=>	__('<br>Add or remove the stripes effect.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||On,2||Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'override'	=>	array(
			'label'		=> 	__('Override theme colors','uf-epico'),
			'caption'	=>	__('Enable this to allow the default theme colors to be overriden. Then you can define custom values using the options below.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||On,*2||Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'bkg_color'	=>	array(
			'label'		=> 	__('Background color','uf-epico'),
			'caption'	=>	__('Select a background color for the widget.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#00B2C2',
		),
		'button_color'	=>	array(
			'label'		=> 	__('Button\'s background color','uf-epico'),
			'caption'	=>	__('Select a background color for the button.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#F29843',
		),
		'text_color'	=>	array(
			'label'		=> 	__('Main text color','uf-epico'),
			'caption'	=>	__('Select a color for the widget main text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'button_text_color'	=>	array(
			'label'		=> 	__('Button\'s text color','uf-epico'),
			'caption'	=>	__('Select a color for the button\'s text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'button_color_hover'	=>	array(
			'label'		=> 	__('Button\'s background color (hover state).','uf-epico'),
			'caption'	=>	__('Select a background color for the button\'s hover state.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#F29843',
		),
	),
	'styles'	=> array(
		'toggles.css',

	),
	'scripts'	=> array(
		'toggles.min.js',
		'colorpicker.js',
	),
	'multiple'	=> false,
);

