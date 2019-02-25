<?php
/**
*
* fieldconfig for uf-epico/Articles
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Articles','uf-epico'),
	'id' => '12139311',
	'master' => 'article',
	'fields' => array(
		'article'	=>	array(
			'label'		=> 	__('Article selection','uf-epico'),
			'caption'	=>	__('Select an article to inclide in the list. You can add more articles clicking <strong>Add new</strong>, below','uf-epico'),
			'type'		=>	'posttypeselector',
			'default'	=> 	'',
		),
	),
	'multiple'	=> true,
);

