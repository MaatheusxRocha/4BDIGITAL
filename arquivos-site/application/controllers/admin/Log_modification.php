<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Log_modification extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('log_modification')) {
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
        $data = $this->_load_log_modifications($page);
        $this->_header();
        $this->load->view('admin/log_modification/list', $data);
        $this->_footer();
    }

    private function _load_log_modifications($page = NULL) {
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
            $user_id = $this->input->post('user_id');
            if (!is_numeric($user_id)) {
                $user_id = NULL;
            }
            $start_date = format_date($this->input->post('start_date'));
            $end_date = format_date($this->input->post('end_date'));
        } elseif ($filters && strpos($referer, 'admin/log_modification') !== FALSE) {
            $user_id = $filters['user_id'];
            $start_date = $filters['start_date'];
            $end_date = $filters['end_date'];
        } else {
            $user_id = $start_date = $end_date = NULL;
        }
        $filters = array(
            'user_id' => $user_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
        );
        $this->session->set_userdata('filters', $filters);

        $log_modifications = $this->log_modification_model->get($limit, $offset, $user_id, $start_date, $end_date);
        if (!$log_modifications->num_rows() && $page) {
            redirect('admin/log_modification');
        }
        $log_modifications = $log_modifications->result();
        $all_log_modifications = $this->log_modification_model->get(NULL, NULL, $user_id, $start_date, $end_date)->num_rows();
        $end = $offset + $limit;

        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url('admin/log_modification'),
            'uri_segment' => 3,
            'total_rows' => $all_log_modifications,
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
            'user_combo' => $this->_get_user_combo(),
            'user_id' => $user_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'limit' => $limit,
            'page' => $page,
            'log_modifications' => $log_modifications,
            'display_start' => $all_log_modifications > 0 ? $offset + 1 : 0,
            'display_end' => $end > $all_log_modifications ? $all_log_modifications : $end,
            'total_rows' => $all_log_modifications,
        );
        return $data;
    }

    private function _get_user_combo() {
        $users = $this->user_model->get()->result();
        $user_combo[''] = 'Selecione...';
        foreach ($users as $u) {
            $user_combo[$u->id] = $u->name;
        }
        return $user_combo;
    }

}
