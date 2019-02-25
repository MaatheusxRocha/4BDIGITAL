<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'contact_us_model', 'log_modification_model', 'department_model'));
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
        $data = $this->_load_contact_uss($page);
        $this->_header();
        $this->load->view('admin/contact_us/list', $data);
        $this->_footer();
    }

    private function _load_contact_uss($page = NULL) {
        $limit = 20;
        if (!empty($page) && is_numeric($page)) {
            $offset = ($page - 1) * $limit;
        } else {
            $page = null;
            $offset = 0;
        }

        $method = $this->input->method(TRUE);
        $filters = $this->session->userdata('filters');
        $referer = $this->input->server('HTTP_REFERER');
        if ($method === 'POST') {
            $department_id = $this->input->post('department_id');
            if (!is_numeric($department_id)) {
                $department_id = NULL;
            }
            $start_date = format_date($this->input->post('start_date'));
            $end_date = format_date($this->input->post('end_date'));
        } elseif ($filters && strpos($referer, 'admin/contact_us') !== FALSE) {
            $department_id = $filters['department_id'];
            $start_date = $filters['start_date'];
            $end_date = $filters['end_date'];
        } else {
            $department_id = $start_date = $end_date = NULL;
        }
        $filters = array(
            'department_id' => $department_id,
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->session->set_userdata('filters', $filters);

        $contact_uss = $this->contact_us_model->get(NULL, $department_id, $start_date, $end_date, $limit, $offset);
        if (!$contact_uss->num_rows() && $page) {
            redirect('admin/contact_us');
        }
        $contact_uss = $contact_uss->result();
        $all_contact_uss = $this->contact_us_model->get(NULL, $department_id, $start_date, $end_date)->num_rows();
        $end = $offset + $limit;

        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url('admin/contact_us'),
            'uri_segment' => 3,
            'total_rows' => $all_contact_uss,
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
            'department_combo' => $this->_get_department_combo(),
            'department_id' => $department_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'limit' => $limit,
            'page' => $page,
            'contact_uss' => $contact_uss,
            'display_start' => $all_contact_uss > 0 ? $offset + 1 : 0,
            'display_end' => $end > $all_contact_uss ? $all_contact_uss : $end,
            'total_rows' => $all_contact_uss,
        );
        return $data;
    }

    private function _get_department_combo() {
        $departments = $this->department_model->get()->result();
        $department_combo[''] = 'Selecione...';
        foreach ($departments as $u) {
            $department_combo[$u->id] = $u->name;
        }
        return $department_combo;
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }

        $contact = $this->contact_us_model->get($id);
        if (!$contact->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }
        $contact = $contact->row();

        $data = array(
            'status' => !$contact->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id
        );
        $this->contact_us_model->update($contact->id, $data);

        if ($contact->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Fale Conosco"', 'contact_us', $id, "Desativação do contato de \"$contact->name\"");
            $this->session->set_flashdata('successmsg', 'O contato foi marcado como "Não lido" com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Fale Conosco"', 'contact_us', $id, "Ativação do contato de \"$contact->name\"");
            $this->session->set_flashdata('successmsg', 'O contato foi marcado como "Lido" com sucesso');
        }
        redirect($this->input->server('HTTP_REFERER'));
    }

}
