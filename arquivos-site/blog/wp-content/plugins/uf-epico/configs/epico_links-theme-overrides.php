<?php
/**
*
* fieldgroups for uf-epico/epico_pages
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Theme overrides','uf-epico'),
	'id' => '11588127',
	'master' => 'target',
	'fields' => array(
		'widget_id'	=>	array(
			'label'		=> 	__('Unique identifier','uf-epico'),
			'caption'	=>	__('Enter an unique identifier for the widget. Use only regular alphabet letters and don\'t use special symbols','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'target'	=>	array(
			'label'		=> 	__('Link target','uf-epico'),
			'caption'	=>	__('<br>Choose one of the actions for the post link when clicked.','uf-epico'),
			'type'		=>	'radio',
			'default'	=> 	__( '0||Open in new window,*1||Open in the same window', 'uf-epico' ),
		),
		'link_bold'	=>	array(
			'label'		=> 	__('Font weight','uf-epico'),
			'caption'	=>	__('<br>Select a font weight for the text','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||Normal,2||Bold', 'uf-epico' ),
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
		'text_color'	=>	array(
			'label'		=> 	__('Text color','uf-epico'),
			'caption'	=>	__('Select a color for the text of the link.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'icon_color'	=>	array(
			'label'		=> 	__('Icon color','uf-epico'),
			'caption'	=>	__('Select a color for the icon.','uf-epico'),
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

