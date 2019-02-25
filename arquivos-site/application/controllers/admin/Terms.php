<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'terms_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('terms')) {
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

    public function index() {
        $data = array();
        $terms = $this->terms_model->get($this->language);
        if ($terms->num_rows()) {
            $data['terms'] = $terms->row();
        }
        $this->_header();
        $this->load->view('admin/terms/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        $data = array(
            'title' => $this->input->post('title'),
            'subtitle' => $this->input->post('subtitle'),
            'description' => $this->input->post('description'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $terms = $this->terms_model->get($this->language);
        $terms_exists = (bool) $terms->num_rows();
        if ($terms_exists) {
            $terms = $terms->row();
        }
        
        if ($terms_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->terms_model->update($terms->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Termos', 'terms', NULL, 'Atualização dos termos legais');
                $this->session->set_flashdata('successmsg', 'Termos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->terms_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Termos', 'terms', NULL, 'Cadastro dos termos legais');
                $this->session->set_flashdata('successmsg', 'Termos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/terms');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title', 'Título', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('subtitle', 'Subtítulo', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('description', 'Descrição', 'trim|required');
        return $this->form_validation->run();
    }
    
}
