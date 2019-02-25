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
	'id' => '235452',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','uf-epico'),
			'caption'	=>	__('Add here your name or another relevant text for the title.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	__( 'About the author', 'uf-epico' ),
		),
		'intro_p'	=>	array(
			'label'		=> 	__('Introductory text','uf-epico'),
			'caption'	=>	__('A brief text to introduce the author or the website. This field allows the <strong>strong</strong> and <strong>em</strong> HTML tags.','uf-epico'),
			'type'		=>	'textbox',
			'default'	=> 	__( 'Add here your introductory text. You can apply <strong>negrito</strong> or <em>itálico</em> to the text, if necessary.', 'uf-epico' ),
		),
	),
	'multiple'	=> false,
);

