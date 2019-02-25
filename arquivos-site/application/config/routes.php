<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = 'admin/home';
$route['admin/log_modification/(:num)'] = 'admin/log_modification/index/$1';
$route['admin/contact_us/(:num)'] = 'admin/contact_us/index/$1';
$route['admin/call/(:num)'] = 'admin/call/index/$1';
$route['admin/join_us/(:num)'] = 'admin/join_us/index/$1';
$route['admin/partner_contact/(:num)'] = 'admin/partner_contact/index/$1';

//site
$route['precos'] = 'home/prices';
$route['tabela-precos'] = 'home/pricing';
$route['modelo-proposta'] = 'home/proposal';
$route['cadastro-startup'] = 'home/startup_signup';
$route['enviar-startup'] = 'home/startup_submit';
$route['cadastro-parceiro'] = 'home/partner_signup';
$route['enviar-parceiro'] = 'home/partner_submit';
$route['get_cities/(:num)'] = 'home/get_cities/$1';
$route['parceiros'] = 'home/partners';
$route['startup'] = 'home/startup';
$route['contato'] = 'home/contact';
$route['enviar-contato'] = 'home/contact_submit';
$route['ligue-me'] = 'home/call_submit';
$route['por-que-criar-conta'] = 'home/why_create';
$route['comunidade'] = 'home/community';
$route['cases'] = 'home/cases';
$route['detalhes-case/(.+)'] = 'home/case_details/$1';
$route['a-brascloud'] = 'home/about';
$route['enviar-trabalhe-conosco'] = 'home/send_join_us';
$route['termos-legais'] = 'home/terms';
$route['servicos'] = 'home/services';
$route['arquitetos'] = 'home/architects';
$route['tenho-duvidas'] = 'home/faq';
//english
$route['prices'] = 'home/prices';
$route['prices-table'] = 'home/pricing';
$route['proposal-template'] = 'home/proposal';
$route['register-startup'] = 'home/startup_signup';
$route['send-startup'] = 'home/startup_submit';
$route['register-partner'] = 'home/partner_signup';
$route['send-partner'] = 'home/partner_submit';
$route['get_cities/(:num)'] = 'home/get_cities/$1';
$route['partners'] = 'home/partners';
//$route['startup'] = 'home/startup';
$route['contact'] = 'home/contact';
$route['send-contact'] = 'home/contact_submit';
$route['call-me'] = 'home/call_submit';
$route['why-create-an-account'] = 'home/why_create';
$route['community'] = 'home/community';
//$route['cases'] = 'home/cases';
$route['case-details/(.+)'] = 'home/case_details/$1';
$route['about-brascloud'] = 'home/about';
$route['send-join-us'] = 'home/send_join_us';
$route['legal-terms'] = 'home/terms';
$route['services'] = 'home/services';
$route['arquitects'] = 'home/architects';
$route['have-question'] = 'home/faq';
//spanish
$route['precios'] = 'home/prices';
$route['tabla-precios'] = 'home/pricing';
$route['modelo-propuesta'] = 'home/proposal';
$route['registro-startup'] = 'home/startup_signup';
//$route['enviar-startup'] = 'home/startup_submit';
$route['registro-socio'] = 'home/partner_signup';
$route['enviar-socio'] = 'home/partner_submit';
$route['get_cities/(:num)'] = 'home/get_cities/$1';
$route['socios'] = 'home/partners';
//$route['startup'] = 'home/startup';
$route['contacto'] = 'home/contact';
$route['enviar-contacto'] = 'home/contact_submit';
$route['llamame'] = 'home/call_submit';
$route['por-que-crear-cuenta'] = 'home/why_create';
$route['comunidad'] = 'home/community';
$route['casos'] = 'home/cases';
$route['detalles-caso/(.+)'] = 'home/case_details/$1';
$route['la-brascloud'] = 'home/about';
$route['enviar-trabaja-conosotros'] = 'home/send_join_us';
$route['terminos-legales'] = 'home/terms';
$route['servicios'] = 'home/services';
$route['arquitectos'] = 'home/architects';
$route['tengo-dudas'] = 'home/faq';


//seo
$route['seo/sitemap\.xml'] = "seo/sitemap";
$route['sitemap\.xml'] = "seo/sitemap";
