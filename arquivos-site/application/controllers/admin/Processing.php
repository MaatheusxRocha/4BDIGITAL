<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'processing_model','config_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('prices')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
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
        $data = array();
        $configs = $this->config_model->get($this->language);
        if (!$configs->num_rows()) {
            $this->session->set_flashdata('errormsg', 'É necessário cadastrar ao menos um item!');
            redirect('admin/config');
        }
        $combo_config[''] = 'Selecione...';
        foreach ($configs->result() as $c) {
            $combo_config[$c->id] = $c->name;
        }
        $data['configs'] = $combo_config;
        $processing = $this->processing_model->get($this->language);
        if ($processing->num_rows()) {
            $data['processing'] = $processing->row();
        }
        $this->_header();
        $this->load->view('admin/processing/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        $data = array(
            'name' => $this->input->post('name'),
            'scale_min' => $this->input->post('scale_min'),
            'scale_max' => $this->input->post('scale_max'),
            'scale' => $this->input->post('scale'),
            'config_id' => $this->input->post('config'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $processing = $this->processing_model->get($this->language);
        $processing_exists = (bool) $processing->num_rows();
        if ($processing_exists) {
            $processing = $processing->row();
        }

        if ($processing_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->processing_model->update($processing->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Processamento', 'processing', NULL, 'Atualização do processamento');
                $this->session->set_flashdata('successmsg', 'Processamento atualizado com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->processing_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Processamento', 'processing', NULL, 'Cadastro do processamento');
                $this->session->set_flashdata('successmsg', 'Processamento cadastrado com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/processing');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('name', 'Titulo', 'strip_tags|trim|required|max_length[30]');
        $this->form_validation->set_rules('scale_min', 'Valor minímo', 'strip_tags|trim|required|numeric');
        $this->form_validation->set_rules('scale_max', 'Valor máximo', 'strip_tags|trim|required|numeric');
        $this->form_validation->set_rules('scale', 'Escala', 'strip_tags|trim|required|numeric');
        $this->form_validation->set_rules('config', 'Item de Configuração', 'strip_tags|trim|required');
        return $this->form_validation->run();
    }

}
