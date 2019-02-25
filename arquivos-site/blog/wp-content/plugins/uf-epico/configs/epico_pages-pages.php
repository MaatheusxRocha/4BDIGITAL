<?php
/**
*
* fieldconfig for uf-epico/Pages
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Pages','uf-epico'),
	'id' => '12139311',
	'master' => 'page_id',
	'fields' => array(
		'page_id'	=>	array(
			'label'		=> 	__('Page selection','uf-epico'),
			'caption'	=>	__('Select a page to inclide in the list. You can add more links clicking <strong>Add another</strong>, below.','uf-epico'),
			'type'		=>	'posttypeselector',
			'default'	=> 	'page',
		),
		'page_title'	=>	array(
			'label'		=> 	__('Page title','uf-epico'),
			'caption'	=>	__('Add a text to the page link.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	__( 'My special page', 'uf-epico' ),
		),
		'icon'	=>	array(
			'label'		=> 	__('Page icon','uf-epico'),
			'caption'	=>	__('Select an icon to represent the page. <strong><a target=\'_blank\' href=\'http://minha.uberfacil.com/epico/icones\'>This page</a></strong> will show all the available options. <br /><br />Just choose an icon and click on it to copy it\'s ID to the clipboard. Next, paste it here.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'fa fa-file-o',
		),
	),
	'multiple'	=> true,
);

