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
	'id' => '13141114711',
	'master' => 'override',
	'fields' => array(
		'target'	=>	array(
			'label'		=> 	__('Link target','uf-epico'),
			'caption'	=>	__('Choose one of the actions for the link when clicked.','uf-epico'),
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
			'caption'	=>	__('Enable this to allow the default theme colors to be overriden. Then you can define custom values using the options below.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '0||On,*1||Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'bkg_color'	=>	array(
			'label'		=> 	__('Background color','uf-epico'),
			'caption'	=>	__('Select a background color for the widget.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#00B2C2',
		),
		'text_color'	=>	array(
			'label'		=> 	__('Main text color','uf-epico'),
			'caption'	=>	__('Select a color for the widget main text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'icon_color'	=>	array(
			'label'		=> 	__('Title icon color','uf-epico'),
			'caption'	=>	__('Select a color for the icon in the title.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'title_bkg_color'	=>	array(
			'label'		=> 	__('Titles\'s background color','uf-epico'),
			'caption'	=>	__('Select a background color for the title.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#009DAB',
		),
		'title_color'	=>	array(
			'label'		=> 	__('Title\'s text color','uf-epico'),
			'caption'	=>	__('Select a color for the title\'s text','uf-epico'),
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

