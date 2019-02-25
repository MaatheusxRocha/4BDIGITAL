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
	'id' => '0141515210',
	'master' => 'text',
	'fields' => array(
		'text'	=>	array(
			'label'		=> 	__('Notice text','uf-epico'),
			'caption'	=>	__('Add a brief text for the notice (10 words is a good limit)','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'We have an important announcement for you!', 'uf-epico' ),
		),
		'button_text'	=>	array(
			'label'		=> 	__('Button text','uf-epico'),
			'caption'	=>	__('Add some text for the button located right after the main text. Remove the text to ommit the button from the layout.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'Click here', 'uf-epico' ),
		),
		'button_url'	=>	array(
			'label'		=> 	__('Button link','uf-epico'),
			'caption'	=>	__('Add a link for the button, including the <strong>http://</strong> part.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'http://',
		),
		'target'	=>	array(
			'label'		=> 	__('Link target','uf-epico'),
			'caption'	=>	__('Choose an action for the button when is clicked.','uf-epico'),
			'type'		=>	'radio',
			'default'	=> 	__( '*0||Open in new window,1||Open in the same window','uf-epico'),
		),
	),
	'multiple'	=> false,
);

