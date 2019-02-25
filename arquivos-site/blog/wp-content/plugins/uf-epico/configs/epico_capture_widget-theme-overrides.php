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
	'id' => '121521305',
	'master' => 'override',
	'fields' => array(
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
			'default'	=> 	__( '1||On,*2||Off', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'bkg_color'	=>	array(
			'label'		=> 	__('Widget background color','uf-epico'),
			'caption'	=>	__('Choose a background color for the widget.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'form_bkg_color'	=>	array(
			'label'		=> 	__('Email subscribe form background color','uf-epico'),
			'caption'	=>	__('Choose a background color for the email subscribe form.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#EFF1F1',
		),
		'close_color'	=>	array(
			'label'		=> 	__('Close button color','uf-epico'),
			'caption'	=>	__('Choose a color for the close button, if active.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#00C7C0',
		),
		'title_color'	=>	array(
			'label'		=> 	__('Title color','uf-epico'),
			'caption'	=>	__('Choose a color for the widget title.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#687E87',
		),
		'icon_color'	=>	array(
			'label'		=> 	__('Icon color','uf-epico'),
			'caption'	=>	__('Choose a color for the icon.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#B3C1C7',
		),
		'arrow_color'	=>	array(
			'label'		=> 	__('Arrow color','uf-epico'),
			'caption'	=>	__('Choose a color for the arrow.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#00C7C0',
		),
		'intro_color'	=>	array(
			'label'		=> 	__('Intro text color','uf-epico'),
			'caption'	=>	__('Choose a color for the introductory text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#687E87',
		),
		'notice_color'	=>	array(
			'label'		=> 	__('Anti-spam notice text color','uf-epico'),
			'caption'	=>	__('Choose a color for the anti-spam notice text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#687E87',
		),
		'email_color'	=>	array(
			'label'		=> 	__('Email field background color','uf-epico'),
			'caption'	=>	__('Choose a background color for the email field.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'email_text_color'	=>	array(
			'label'		=> 	__('Email field text color','uf-epico'),
			'caption'	=>	__('Choose a color for the email field\'s text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#687E87',
		),
		'button_color'	=>	array(
			'label'		=> 	__('Submit button background color','uf-epico'),
			'caption'	=>	__('Choose a background color for the submit button.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FF613D',
		),
		'button_color_hover'	=>	array(
			'label'		=> 	__('Submit button background color (hover)','uf-epico'),
			'caption'	=>	__('Choose background color for the submit button\'s hover state.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FF7657',
		),
		'button_color_text'	=>	array(
			'label'		=> 	__('Submit button text color','uf-epico'),
			'caption'	=>	__('Choose a color for the submit button\'s text.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#FFFFFF',
		),
		'border_bottom_color'	=>	array(
			'label'		=> 	__('Widget bottom border color','uf-epico'),
			'caption'	=>	__('Choose a color for the widget bottom border.','uf-epico'),
			'type'		=>	'colorpicker',
			'default'	=> 	'#B3C1C7',
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

