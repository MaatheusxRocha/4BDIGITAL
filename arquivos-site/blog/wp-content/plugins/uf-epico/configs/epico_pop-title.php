<?php
/**
*
* fieldconfig for uf-epico/Title
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Title','uf-epico'),
	'id' => '134108214',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title text','uf-epico'),
			'caption'	=>	__('Add a title for the widget. Leave it blank to ommit it in the frontend.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'Popular posts', 'uf-epico' ),
		),
		'icon'	=>	array(
			'label'		=> 	__('Icon','uf-epico'),
			'caption'	=>	__('You can add an icon next to the main title. <strong><a target=\'_blank\' href=\'http://minha.uberfacil.com/epico/icones\'>This page</a></strong> will show all the  available options. <br /><br />Just choose an icon and click on it to copy it\'s ID to the clipboard. Next, paste it here.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'fa fa-star',
		),
	),
	'multiple'	=> false,
);

