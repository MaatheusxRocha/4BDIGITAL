<?php
/**
*
* fieldconfig for uf-epico/Image
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Image','uf-epico'),
	'id' => '1523167',
	'master' => 'img_src',
	'fields' => array(
		'img_src'	=>	array(
			'label'		=> 	__('Image upload','uf-epico'),
			'caption'	=>	__('Upload an image file.','uf-epico'),
			'type'		=>	'image',
			'default'	=> 	'',
		),
		'img_url'	=>	array(
			'label'		=> 	__('Image link','uf-epico'),
			'caption'	=>	__('Insert the destination URL.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'http://',
		),
		'img_alt'	=>	array(
			'label'		=> 	__('Image alt text','uf-epico'),
			'caption'	=>	__('Insert the image Alt text.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'img_title'	=>	array(
			'label'		=> 	__('Widget title','uf-epico'),
			'caption'	=>	__('Insert a title above the image.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'target'	=>	array(
			'label'		=> 	__('Link target','uf-epico'),
			'caption'	=>	__('Choose one of the actions for image\'s link when is clicked.','uf-epico'),
			'type'		=>	'radio',
			'default'	=> 	__( '*0||Open in new window,1||Open in the same window', 'uf-epico' ),
		),
	),
	'scripts'	=> array(
		'image-modal.js',
	),
	'multiple'	=> false,
);

