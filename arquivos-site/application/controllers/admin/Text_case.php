<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Text_case extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'text_case_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('cases')) {
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
        $text_case = $this->text_case_model->get($this->language);
        if ($text_case->num_rows()) {
            $data['text_case'] = $text_case->row();
        }
        $this->_header();
        $this->load->view('admin/text_case/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        $data = array(
            'title_one' => $this->input->post('title_one'),
            'title_two' => $this->input->post('title_two'),
            'subtitle' => $this->input->post('subtitle'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $text_case = $this->text_case_model->get($this->language);
        $text_case_exists = (bool) $text_case->num_rows();
        if ($text_case_exists) {
            $text_case = $text_case->row();
        }
        
        if ($text_case_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->text_case_model->update($text_case->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Texto Case', 'text_case', NULL, 'Atualização dos textos do case');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->text_case_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Texto Case', 'text_case', NULL, 'Cadastro dos textos do case');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/text_case');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title_one', 'Titulo 1', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('title_two', 'Titulo 2', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('subtitle', 'subtitle', 'strip_tags|trim|required|max_length[150]');
        return $this->form_validation->run();
    }
    
}
