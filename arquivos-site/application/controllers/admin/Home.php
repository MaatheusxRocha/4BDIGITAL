<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'permission_model', 'contact_us_model', 'join_us_model', 'partner_contact_model', 'startup_contact_model', 'call_model'));
        $this->load->library(array('encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }

        $this->language = $this->session->userdata('language');
        if (empty($this->language)) {
            $this->language = 1;
        }
    }

    private function _header() {
        $header['languages'] = $this->language_model->get()->result();
        $header['current_language'] = $this->language_model->get($this->language)->row();
        $header['current_user'] = $this->current_user->user();
        $this->load->view('admin/default/header', $header);
    }

    private function _footer() {
        $this->load->view('admin/default/footer');
    }

    public function index() {
        $data = array(
            'contact_us' => $this->contact_us_model->count_inactive(),
            'join_us' => $this->join_us_model->count_inactive(),
            'partner_contact' => $this->partner_contact_model->count_inactive(),
            'startup_contact' => $this->startup_contact_model->count_inactive(),
            'call' => $this->call_model->count_inactive()
        );
        $this->_header();
        $this->load->view('admin/default/index', $data);
        $this->_footer();
    }

    public function change_language($language_id = NULL) {
        if (empty($language_id) || !is_numeric($language_id)) {
            $this->session->set_userdata('language', 1);
            $this->session->set_flashdata('errormsg', 'Ação não permitida. Idioma definido para português.');
            redirect('admin');
        }
        $language = $this->language_model->get($language_id);
        if (!$language->num_rows()) {
            $this->session->set_userdata('language', 1);
            $this->session->set_flashdata('errormsg', 'Ação não permitida. Idioma definido para português.');
            redirect('admin');
        }
        $this->session->set_userdata('language', $language->row()->id);
        $this->session->set_flashdata('successmsg', 'Idioma alterado com sucesso. Idioma atual: ' . $language->row()->name);
        redirect($this->input->server('HTTP_REFERER'));
    }

}
