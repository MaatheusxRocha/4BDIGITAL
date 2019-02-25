<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Call extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'call_model', 'log_modification_model', 'department_model'));
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
        $data = $this->_load_calls($page);
        $this->_header();
        $this->load->view('admin/call/list', $data);
        $this->_footer();
    }

    private function _load_calls($page = NULL) {
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
            $start_date = format_date($this->input->post('start_date'));
            $end_date = format_date($this->input->post('end_date'));
        } elseif ($filters && strpos($referer, 'admin/call') !== FALSE) {
            $start_date = $filters['start_date'];
            $end_date = $filters['end_date'];
        } else {
            $start_date = $end_date = NULL;
        }
        $filters = array(
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->session->set_userdata('filters', $filters);

        $calls = $this->call_model->get(NULL, $start_date, $end_date, $limit, $offset);
        if (!$calls->num_rows() && $page) {
            redirect('admin/call');
        }
        $calls = $calls->result();
        $all_calls = $this->call_model->get(NULL, $start_date, $end_date)->num_rows();
        $end = $offset + $limit;

        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url('admin/call'),
            'uri_segment' => 3,
            'total_rows' => $all_calls,
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
            'calls' => $calls,
            'display_start' => $all_calls > 0 ? $offset + 1 : 0,
            'display_end' => $end > $all_calls ? $all_calls : $end,
            'total_rows' => $all_calls,
        );
        return $data;
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }

        $call = $this->call_model->get($id);
        if (!$call->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }
        $call = $call->row();

        $data = array(
            'status' => !$call->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id
        );
        $this->call_model->update($call->id, $data);

        if ($call->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Ligue-me"', 'call', $id, "Desativação do contato de \"$call->name\"");
            $this->session->set_flashdata('successmsg', 'O contato foi marcado como "Não lido" com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Ligue-me"', 'call', $id, "Ativação do contato de \"$call->name\"");
            $this->session->set_flashdata('successmsg', 'O contato foi marcado como "Lido" com sucesso');
        }
        redirect($this->input->server('HTTP_REFERER'));
    }

}
