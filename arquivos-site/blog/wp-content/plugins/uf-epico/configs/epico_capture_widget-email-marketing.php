<?php
/**
*
* fieldconfig for uf-epico/Email marketing
*
* @package Uf_Epico
* @author Uberfácil contato@uberfacil.com
* @license GPL-2.0+
* @link http://uberfacil.com
* @copyright 2014-2015 Uberfácil
*/


$group = array(
	'label' => __('Email marketing','uf-epico'),
	'id' => '760175',
	'master' => 'email_service',
	'fields' => array(
		'email_service'	=>	array(
			'label'		=> 	__('Email marketing service','uf-epico'),
			'caption'	=>	__('Choose your email marketing service and fill all required fields.','uf-epico'),
			'type'		=>	'dropdown',
			'default'	=> 	__( '*0||Select an option,1||MailChimp,2||Aweber,3||MadMimi,4||Campaign Monitor,5||e-Goi,6||Get Response,7||Mailee.Me,8||Mail Relay,9||Klick Mail,10||ArpReach,11||ActiveCampaign,12||RD Station,13||Lead Lovers,14||Sendy,15||Benchmark,16||Mail2Easy,17||MyMail,18||TrafficWave,19||InfusionSoft,20||Google Spreadsheets,21||MailPoet', 'uf-epico' ),
		),
		'form_action'	=>	array(
			'label'		=> 	__('HTML Form action','uf-epico'),
			'caption'	=>	__('<br>Insert below your form action. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'list_id'	=>	array(
			'label'		=> 	__('List or campaign ID','uf-epico'),
			'caption'	=>	__('<br>Insert below the unique ID of your list. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'group_id'	=>	array(
			'label'		=> 	__('Group ID','uf-epico'),
			'caption'	=>	__('<br>Insert below the unique ID of your group. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'redirect_url'	=>	array(
			'label'		=> 	__('Redirect URL','uf-epico'),
			'caption'	=>	__('<br>Insert below a custom redirect URL after your form submission.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'redirect_subscribed_url'	=>	array(
			'label'		=> 	__('Already subscribed Redirect URL','uf-epico'),
			'caption'	=>	__('<br>Insert below a custom redirect URL for already subscribed visitors. Leave unfilled if you want the default redirection page. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'webform_id'	=>	array(
			'label'		=> 	__('Unique ID','uf-epico'),
			'caption'	=>	__('<br>Insert below your unique ID. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'client_number'	=>	array(
			'label'		=> 	__('Client identification','uf-epico'),
			'caption'	=>	__('<br>Insert below your client identification. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'email_field'	=>	array(
			'label'		=> 	__('Email field ID','uf-epico'),
			'caption'	=>	__('<br>Insert below your email field ID. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'token'	=>	array(
			'label'		=> 	__('Unique Token','uf-epico'),
			'caption'	=>	__('<br>Insert below your token. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'redirect_confirm_url'	=>	array(
			'label'		=> 	__('Subscription confirmed page','uf-epico'),
			'caption'	=>	__('<br>Insert below a custom redirect URL for subscription confirmation. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'webform_id_alt'	=>	array(
			'label'		=> 	__('Form ID','uf-epico'),
			'caption'	=>	__('<br>Insert below the unique ID of your form. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'tracking_code'	=>	array(
			'label'		=> 	__('Tracking code','uf-epico'),
			'caption'	=>	__('<br>Insert below the tracking code. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'campaign_id'	=>	array(
			'label'		=> 	__('Campaign ID','uf-epico'),
			'caption'	=>	__('<br>Insert below the ID of your campaign. <a href=\'http://minha.uberfacil.com/epico/configurando-o-email-marketing/\' target=\'_blank\'>Where do I get this?</a>.','uf-epico'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'instructions'	=>	array(
			'label'		=> 	__('MyMail Instructions','uf-epico'),
			'caption'	=>	__('<br>Please also configure your MyMail plugin in <strong>Newsletter > Settings</strong> in your WordPress, following <a target="_blank" href="http://minha.uberfacil.com/epico/mymail/">this instructions here</a>.','uf-epico'),
			'type'		=>	'paragraph',
			'default'	=> 	'',
		),
		'optin'	=>	array(
			'label'		=> 	__('Opt-in mode','uf-epico'),
			'caption'	=>	__('<br>Selec an opt-in mode.','uf-epico'),
			'type'		=>	'onoff',
			'default'	=> 	__( '*1||Single Opt-in,*2||Double opt-in', 'uf-epico' ),
			'inline'	=> 	true,
		),
	),
	'multiple'	=> false,
);