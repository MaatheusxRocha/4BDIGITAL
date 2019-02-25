<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Text_faq extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'text_faq_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('faq')) {
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
        $text_faq = $this->text_faq_model->get($this->language);
        if ($text_faq->num_rows()) {
            $data['text_faq'] = $text_faq->row();
        }
        $this->_header();
        $this->load->view('admin/text_faq/crud', $data);
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
            'title_three' => $this->input->post('title_three'),
            'text_contact_us' => $this->input->post('text_contact_us'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $text_faq = $this->text_faq_model->get($this->language);
        $text_faq_exists = (bool) $text_faq->num_rows();
        if ($text_faq_exists) {
            $text_faq = $text_faq->row();
        }
        
        if ($text_faq_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->text_faq_model->update($text_faq->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Texto Faq', 'text_faq', NULL, 'Atualização dos textos do faq');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->text_faq_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Texto Faq', 'text_faq', NULL, 'Cadastro dos textos do faq');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/text_faq');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title_one', 'Titulo Cinza', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('title_two', 'Titulo Vermelho', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('title_three', 'Titulo Laranja', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('text_contact_us', 'Texto "Fale Conosco"', 'trim|required');
        return $this->form_validation->run();
    }
    
}
