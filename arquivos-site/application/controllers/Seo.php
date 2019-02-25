<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('case_model'));
        $this->load->helper(array('help'));
    }

    function sitemap() {
        $this->load->language('internationalization', 'portuguese-br');

        $url_static[] = site_url($this->lang->line('url_about'));
        $url_static[] = site_url($this->lang->line('url_contact'));
        $url_static[] = site_url($this->lang->line('url_prices'));
        $url_static[] = site_url($this->lang->line('url_prices_table'));
        $url_static[] = site_url($this->lang->line('url_partners'));
        $url_static[] = site_url($this->lang->line('url_startup'));
        $url_static[] = site_url($this->lang->line('url_why_create'));
        $url_static[] = site_url($this->lang->line('url_community'));
        $url_static[] = site_url($this->lang->line('url_cases'));
        $url_static[] = site_url($this->lang->line('url_terms'));
        $url_static[] = site_url($this->lang->line('url_services'));
        $url_static[] = site_url($this->lang->line('url_architects'));
        $url_static[] = site_url($this->lang->line('url_faq'));

        $cases = $this->case_model->get_site(1)->result();
        $url_dinamic = array();
        foreach ($cases as $c) {
            $url_dinamic[] = site_url($this->lang->line('url_case_details') . '/' . $c->id . '/' . simple_url($c->name));
        }

        $data['urls_static'] = $url_static;
        $data['urls_dinamic'] = $url_dinamic;
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("site/sitemap", $data);
    }

}
