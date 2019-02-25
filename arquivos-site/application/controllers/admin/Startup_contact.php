<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Startup_contact extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'startup_contact_model', 'log_modification_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('contact')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
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

    public function index($page = NULL) {
        $data = $this->_load_startup_contacts($page);
        $this->_header();
        $this->load->view('admin/startup_contact/list', $data);
        $this->_footer();
    }

    private function _load_startup_contacts($page = NULL) {
        $limit = 20;
        if (!empty($page) && is_numeric($page)) {
            $offset = ($page - 1) * $limit;
        } else {
            $page = null;
            $offset = 0;
        }

        $method = $this->input->method(TRUE);
        $filters = $this->session->userdata('startup_contact_filter');
        $referer = $this->input->server('HTTP_REFERER');
        if ($method === 'POST') {
            $start_date = format_date($this->input->post('start_date'));
            $end_date = format_date($this->input->post('end_date'));
        } elseif ($filters && strpos($referer, 'admin/startup_contact') !== FALSE) {
            $start_date = $filters['start_date'];
            $end_date = $filters['end_date'];
        } else {
            $start_date = $end_date = NULL;
        }
        $filters = array(
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->session->set_userdata('startup_contact_filter', $filters);

        $startup_contacts = $this->startup_contact_model->get(NULL, $start_date, $end_date, $limit, $offset);
        if (!$startup_contacts->num_rows() && $page) {
            redirect('admin/startup_contact');
        }
        $startup_contacts = $startup_contacts->result();
        $all_startup_contacts = $this->startup_contact_model->get(NULL, $start_date, $end_date)->num_rows();
        $end = $offset + $limit;

        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url('admin/startup_contact'),
            'uri_segment' => 3,
            'total_rows' => $all_startup_contacts,
            'next_link' => '&raquo;',
            'prev_link' => '&laquo;',
            'use_page_numbers' => TRUE,
            'cur_tag_open' => '<li class="active"><a href="#">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'first_link' => 'Inicio',
            'last_link' => 'Fim',
            'num_links' => 4,
            'per_page' => $limit,
        );
        $this->pagination->initialize($config);

        foreach ($startup_contacts as $startup_contact) {
            $startup_contact->recipes = $this->startup_contact_model->get_recipes($startup_contact->id)->result();
        }

        $data = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'limit' => $limit,
            'page' => $page,
            'startup_contacts' => $startup_contacts,
            'display_start' => $all_startup_contacts > 0 ? $offset + 1 : 0,
            'display_end' => $end > $all_startup_contacts ? $all_startup_contacts : $end,
            'total_rows' => $all_startup_contacts,
        );
        return $data;
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }

        $startup_contact = $this->startup_contact_model->get($id);
        if (!$startup_contact->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }
        $startup_contact = $startup_contact->row();

        $data = array(
            'status' => !$startup_contact->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id
        );
        $this->startup_contact_model->update($startup_contact->id, $data);

        if ($startup_contact->status) {
            $this->log_modification_model->save_log('desativação', 'Área Startups', 'startup_contact', $id, "Desativação da startup \"$startup_contact->name_startup\"");
            $this->session->set_flashdata('successmsg', 'A startup foi marcada como "Não vista" com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Startups', 'startup_contact', $id, "Ativação da startup \"$startup_contact->name_startup\"");
            $this->session->set_flashdata('successmsg', 'A startup foi marcada como "Vista" com sucesso');
        }
        redirect($this->input->server('HTTP_REFERER'));
    }

}
