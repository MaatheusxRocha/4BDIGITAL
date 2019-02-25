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
	'id' => '1410100146',
	'master' => 'override',
	'fields' => array(
		'target'	=>	array(
			'label'		=> 	__('Link target','uf-epico'),
			'caption'	=>	__('Choose one of the actions for social network button when clicked.','uf-epico'),
			'type'		=>	'radio',
			'default'	=> 	__( '*0||Open in new window,1||Open in the same window', 'uf-epico' ),
		),
		'widget_id'	=>	array(
			'label'		=> 	__('Unique identifier','uf-epico'),
			'caption'	=>	__('Enter an unique identifier for the widget. Use only regular alphabet letters and don\'t use special symbols.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'override'	=>	array(
			'label'		=> 	__('Override theme colors','uf-epico'),
			'caption'	=>	__('<br><br>Enable this to allow the default theme colors to be overriden. Then you can define custom values using the options below.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||On,*2||Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'text_color'	=>	array(
			'label'		=> 	__('Text color','uf-epico'),
			'caption'	=>	__('Select a color for the text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#333333',
		),
		'icon_color'	=>	array(
			'label'		=> 	__('Icon color','uf-epico'),
			'caption'	=>	__('Select the icon\'s color.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'icon_bkg_color'	=>	array(
			'label'		=> 	__('Icon background color','uf-epico'),
			'caption'	=>	__('Select the icon\'s background color.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#00B2C2',
		),
		'bkg_color'	=>	array(
			'label'		=> 	__('Widget background color','uf-epico'),
			'caption'	=>	__('Select the widget\'s background color.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
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

