<?php
/**
*
* fieldconfig for uf-epico/Configuration
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Configuration','uf-epico'),
	'id' => '51120110',
	'master' => 'sticky',
	'fields' => array(
		'sticky'	=>	array(
			'label'		=> 	__('Sticky box','uf-epico'),
			'caption'	=>	__('Do you want to fix the box at the top of the site?','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||Yes,*2||No', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'close'	=>	array(
			'label'		=> 	__('Close button','uf-epico'),
			'caption'	=>	__('Do you want a close button in the corner? The notice will reapear after page load. If you want do dismiss it permanently, activate the option bellow.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||Yes,2||No', 'uf-epico' ),
			'inline'	=> 	true,
		),
		'cookie'	=>	array(
			'label'		=> 	__('Dismiss after close','uf-epico'),
			'caption'	=>	__('This will add an action to the close button that will dismiss the box even after the page reload. After seven days, the box can appear again for the visitor.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '1||Yes,*2||No', 'uf-epico' ),
			'inline'	=> 	true,
		),
	),
	'styles'	=> array(
		'toggles.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
	),
	'multiple'	=> false,
);

