<?php
/**
*
* fieldconfig for uf-epico/Texts
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Texts','uf-epico'),
	'id' => '458101112',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','uf-epico'),
			'caption'	=>	__('Main title for the subscription form. Optimized for 6 words maximum.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'Focus, impact and creativity', 'uf-epico' ),
		),
		'title_tag'	=>	array(
			'label'		=> 	__('Title tag','uf-epico'),
			'caption'	=>	__('Change the header level to best suit your content','uf-epico'),
			'type'		=>	'dropdown',
			'default'	=> 	__('*0||Header level 4,1||Header level 3,2||Paragraph','uf-epico'),
		),
		'intro_p'	=>	array(
			'label'		=> 	__('Intro text','uf-epico'),
			'caption'	=>	__('Add a brief introductory text.','uf-epico'),
			'type'		=>	'textbox',
			'default'	=> 	__( 'Enter your email address below to get <strong>free</strong> blog updates!', 'uf-epico' ),
		),
		'placeholder'	=>	array(
			'label'		=> 	__('Email field text','uf-epico'),
			'caption'	=>	__('Add here the placeholder text that will show up inside the email field.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'Your email', 'uf-epico' ),
		),
		'placeholder_submit'	=>	array(
			'label'		=> 	__('Button text','uf-epico'),
			'caption'	=>	__('Add a text for the submit button.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'Subscribe!', 'uf-epico' ),
		),
	),
	'multiple'	=> false,
);

