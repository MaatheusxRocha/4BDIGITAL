<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_contact extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'partner_contact_model', 'log_modification_model', 'department_model'));
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
        $data = $this->_load_partner_contacts($page);
        $this->_header();
        $this->load->view('admin/partner_contact/list', $data);
        $this->_footer();
    }

    private function _load_partner_contacts($page = NULL) {
        $limit = 20;
        if (!empty($page) && is_numeric($page)) {
            $offset = ($page - 1) * $limit;
        } else {
            $page = null;
            $offset = 0;
        }

        $method = $this->input->method(TRUE);
        $filters = $this->session->userdata('partner_contact_filter');
        $referer = $this->input->server('HTTP_REFERER');
        if ($method === 'POST') {
            $start_date = format_date($this->input->post('start_date'));
            $end_date = format_date($this->input->post('end_date'));
        } elseif ($filters && strpos($referer, 'admin/partner_contact') !== FALSE) {
            $start_date = $filters['start_date'];
            $end_date = $filters['end_date'];
        } else {
            $start_date = $end_date = NULL;
        }
        $filters = array(
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->session->set_userdata('partner_contact_filter', $filters);

        $partner_contacts = $this->partner_contact_model->get(NULL, $start_date, $end_date, $limit, $offset);
        if (!$partner_contacts->num_rows() && $page) {
            redirect('admin/partner_contact');
        }
        $partner_contacts = $partner_contacts->result();
        $all_partner_contacts = $this->partner_contact_model->get(NULL, $start_date, $end_date)->num_rows();
        $end = $offset + $limit;

        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url('admin/partner_contact'),
            'uri_segment' => 3,
            'total_rows' => $all_partner_contacts,
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

        $data = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'limit' => $limit,
            'page' => $page,
            'partner_contacts' => $partner_contacts,
            'display_start' => $all_partner_contacts > 0 ? $offset + 1 : 0,
            'display_end' => $end > $all_partner_contacts ? $all_partner_contacts : $end,
            'total_rows' => $all_partner_contacts,
        );
        return $data;
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }

        $partner_contact = $this->partner_contact_model->get($id);
        if (!$partner_contact->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }
        $partner_contact = $partner_contact->row();

        $data = array(
            'status' => !$partner_contact->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id
        );
        $this->partner_contact_model->update($partner_contact->id, $data);

        if ($partner_contact->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Seja um parceiro"', 'partner_contact', $id, "Desativação do parceiro \"$partner_contact->name\"");
            $this->session->set_flashdata('successmsg', 'O parceiro foi marcado como "Não visto" com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Seja um parceiro"', 'partner_contact', $id, "Ativação do parceiro \"$partner_contact->name\"");
            $this->session->set_flashdata('successmsg', 'O parceiro foi marcado como "Visto" com sucesso');
        }
        redirect($this->input->server('HTTP_REFERER'));
    }

}
