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
	'label' => __('Links','uf-epico'),
	'id' => '12139311',
	'master' => 'link_url',
	'fields' => array(
		'link_url'	=>	array(
			'label'		=> 	__('URL','uf-epico'),
			'caption'	=>	__('Insert an URL for your link.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'http://',
		),
		'link_text'	=>	array(
			'label'		=> 	__('Link text','uf-epico'),
			'caption'	=>	__('Add a text to your link.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	__('My special link', 'uf-epico'),
		),
		'icon'	=>	array(
			'label'		=> 	__('Link icon','uf-epico'),
			'caption'	=>	__('Select an icon to represent the link destination. <strong><a target=\'_blank\' href=\'http://uberfacil.com/icones\'>This page</a></strong> will show all the available options. <br /><br />Just choose an icon and click on it to copy it\'s ID to the clipboard. Next, paste it here.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'fa fa-link',
		),
	),
	'multiple'	=> true,
);

