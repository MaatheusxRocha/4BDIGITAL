<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Text_plan extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'text_plan_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('prices')) {
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
        $text_plan = $this->text_plan_model->get($this->language);
        if ($text_plan->num_rows()) {
            $data['text_plan'] = $text_plan->row();
        }
        $this->_header();
        $this->load->view('admin/text_plan/crud', $data);
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
            'title_simulation' => $this->input->post('title_simulation'),
            'title_performance' => $this->input->post('title_performance'),
            'description_performance' => $this->input->post('description_performance'),
            'warning_performance' => $this->input->post('warning_performance'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $text_plan = $this->text_plan_model->get($this->language);
        $text_plan_exists = (bool) $text_plan->num_rows();
        if ($text_plan_exists) {
            $text_plan = $text_plan->row();
        }
        
        if ($text_plan_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->text_plan_model->update($text_plan->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Texto Preços', 'text_plan', NULL, 'Atualização dos textos da area de preços');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->text_plan_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Texto Preços', 'text_plan', NULL, 'Cadastro dos textos da area de preços');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/text_plan');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title', 'Titulo', 'strip_tags|trim|required|max_length[150]');
        $this->form_validation->set_rules('subtitle', 'subtitle', 'strip_tags|trim|required|max_length[150]');
        $this->form_validation->set_rules('title_simulation', 'Titulo Simulação', 'strip_tags|trim|required|max_length[150]');
        $this->form_validation->set_rules('title_performance', 'Titulo Performance', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('description_performance', 'Descrição Performance', 'strip_tags|trim|required|max_length[70]');
        $this->form_validation->set_rules('warning_performance', 'Aviso Performance', 'strip_tags|trim|required|max_length[150]');
        return $this->form_validation->run();
    }
    
}
