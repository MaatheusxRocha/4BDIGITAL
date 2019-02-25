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
	'id' => '0141515210',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','uf-epico'),
			'caption'	=>	__('Add a title for the widget. Leave it blank to ommit it in the frontend.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'Follow us!', 'uf-epico' ),
		),
	),
	'multiple'	=> false,
);

