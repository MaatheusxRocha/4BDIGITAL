<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Text_contact_us extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'text_contact_us_model'));
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

        define('BRASCLOUD_W', 515);
        define('BRASCLOUD_H', 290);

        define('DEMAND_W', 240);
        define('DEMAND_H', 150);

        define('INFRASTRUCTURE_W', 250);
        define('INFRASTRUCTURE_H', 375);

        define('DIFFERENT_W', 515);
        define('DIFFERENT_H', 290);

        define('VIDEO_W', 515);
        define('VIDEO_H', 290);

        define('VPC_LEFT_W', 430);
        define('VPC_LEFT_H', 450);

        define('VPC_RIGHT_W', 420);
        define('VPC_RIGHT_H', 380);
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
        $text_contact_us = $this->text_contact_us_model->get($this->language);
        if ($text_contact_us->num_rows()) {
            $data['text_contact_us'] = $text_contact_us->row();
        }
        $this->_header();
        $this->load->view('admin/text_contact_us/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            return $this->index();
        }

        $data = array(
            'title' => $this->input->post('title'),
            'title_two' => $this->input->post('title_two'),
            'description' => $this->input->post('description'),
            'title_three' => $this->input->post('title_three'),
            'description_two' => $this->input->post('description_two'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $text_contact_us = $this->text_contact_us_model->get($this->language);
        $text_contact_us_exists = (bool) $text_contact_us->num_rows();
        if ($text_contact_us_exists) {
            $text_contact_us = $text_contact_us->row();
        }

        if ($text_contact_us_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->text_contact_us_model->update($text_contact_us->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área "Contatos - Textos"', 'text_contact_us', NULL, 'Atualização da página de contato');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->text_contact_us_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área "Contatos - Textos"', 'text_contact_us', NULL, 'Cadastro da página de contato');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/text_contact_us');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_html', 'O campo {field} é obrigatório');
        $this->form_validation->set_message('max_length_html', 'O campo {field} aceita no máximo {param} caracteres');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title', 'Título', 'trim|callback_required_html|callback_max_length_html[150]');
        $this->form_validation->set_rules('title_two', 'Título "Fale conosco"', 'trim|callback_required_html|callback_max_length_html[50]');
        $this->form_validation->set_rules('description', 'Texto "Fale conosco"', 'trim|callback_required_html');
        $this->form_validation->set_rules('title_three', 'Título "Ligaremos para você"', 'trim|callback_required_html|callback_max_length_html[50]');
        $this->form_validation->set_rules('description_two', 'Texto "Ligaremos para você"', 'trim|callback_required_html');
        return $this->form_validation->run();
    }

    public function required_html($text) {
        return (bool) trim(strip_tags($text));
    }

    public function max_length_html($text, $size) {
        return strlen(trim(strip_tags($text))) <= $size;
    }

}
