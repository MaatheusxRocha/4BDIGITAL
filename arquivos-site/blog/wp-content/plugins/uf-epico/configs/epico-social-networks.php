<?php
/**
*
* fieldconfig for uf-epico/Social networks
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Social networks','uf-epico'),
	'id' => '91261146',
	'master' => 'social',
	'fields' => array(
		'social'	=>	array(
			'label'		=> 	__('Social network','uf-epico'),
			'caption'	=>	__('Choose a social network to include in the widget. You can add more links to social networks clicking <strong>Add another</strong>, below.','uf-epico'),
			'type'		=>	'dropdown',
			'default'	=> 	__( '*1||Facebook,2||YouTube,3||Google Plus,4||Twitter,5||LinkedIn,6||Flickr,7||FourSquare,8||Pinterest,9||Instagram,10||Soundcloud,11||Slideshare', 'uf-epico' ),
		),
		'social_link'	=>	array(
			'label'		=> 	__('Profile link','uf-epico'),
			'caption'	=>	__('Add the link to your profile, including the <strong>http://</strong> part','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	__( 'http://www.facebook.com/MyProfile', 'uf-epico' ),
		),
	),
	'multiple'	=> true,
);

