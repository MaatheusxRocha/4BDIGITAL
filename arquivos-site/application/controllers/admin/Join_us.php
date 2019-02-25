<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Join_us extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'join_us_model', 'log_modification_model', 'department_model'));
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
        $data = $this->_load_join_uss($page);
        $this->_header();
        $this->load->view('admin/join_us/list', $data);
        $this->_footer();
    }

    private function _load_join_uss($page = NULL) {
        $limit = 20;
        if (!empty($page) && is_numeric($page)) {
            $offset = ($page - 1) * $limit;
        } else {
            $page = null;
            $offset = 0;
        }

        $method = $this->input->method(TRUE);
        $filters = $this->session->userdata('join_us_filter');
        $referer = $this->input->server('HTTP_REFERER');
        if ($method === 'POST') {
            $start_date = format_date($this->input->post('start_date'));
            $end_date = format_date($this->input->post('end_date'));
        } elseif ($filters && strpos($referer, 'admin/join_us') !== FALSE) {
            $start_date = $filters['start_date'];
            $end_date = $filters['end_date'];
        } else {
            $start_date = $end_date = NULL;
        }
        $filters = array(
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->session->set_userdata('join_us_filter', $filters);

        $join_uss = $this->join_us_model->get(NULL, $start_date, $end_date, $limit, $offset);
        if (!$join_uss->num_rows() && $page) {
            redirect('admin/join_us');
        }
        $join_uss = $join_uss->result();
        $all_join_uss = $this->join_us_model->get(NULL, $start_date, $end_date)->num_rows();
        $end = $offset + $limit;

        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url('admin/join_us'),
            'uri_segment' => 3,
            'total_rows' => $all_join_uss,
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
            'join_uss' => $join_uss,
            'display_start' => $all_join_uss > 0 ? $offset + 1 : 0,
            'display_end' => $end > $all_join_uss ? $all_join_uss : $end,
            'total_rows' => $all_join_uss,
        );
        return $data;
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }

        $join_us = $this->join_us_model->get($id);
        if (!$join_us->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect($this->input->server('HTTP_REFERER'));
        }
        $join_us = $join_us->row();

        $data = array(
            'status' => !$join_us->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id
        );
        $this->join_us_model->update($join_us->id, $data);

        if ($join_us->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Trabalhe Conosco"', 'join_us', $id, "Desativação do currículo de \"$join_us->name\"");
            $this->session->set_flashdata('successmsg', 'O currículo foi marcado como "Não visto" com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Trabalhe Conosco"', 'join_us', $id, "Ativação do currículo de \"$join_us->name\"");
            $this->session->set_flashdata('successmsg', 'O currículo foi marcado como "Visto" com sucesso');
        }
        redirect($this->input->server('HTTP_REFERER'));
    }

}
