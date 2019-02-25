<?php
/**
*
* fieldconfig for uf-epico/Button
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Button','uf-epico'),
	'id' => '51013100',
	'master' => 'button_url',
	'fields' => array(
		'button_url'	=>	array(
			'label'		=> 	__('Button link','uf-epico'),
			'caption'	=>	__('Add a link to a relevant page about the author or the website. ','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'http://',
		),
		'button_txt'	=>	array(
			'label'		=> 	__('Button text','uf-epico'),
			'caption'	=>	__('Insert a short phrase for the button.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	__( 'Read more', 'uf-epico' ),
		),
		'target'	=>	array(
			'label'		=> 	__('Link target','uf-epico'),
			'caption'	=>	__('Choose one of the actions for the button when clicked.','uf-epico'),
			'type'		=>	'radio',
			'default'	=> 	__( '*0||Open in new window,1||Open in the same window', 'uf-epico' ),
		),
	),
	'multiple'	=> false,
);

