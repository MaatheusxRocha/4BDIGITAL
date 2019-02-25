<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Storage extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'storage_model'));
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
        $storage = $this->storage_model->get($this->language);
        if ($storage->num_rows()) {
            $data['storage'] = $storage->row();
        }
        $this->_header();
        $this->load->view('admin/storage/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        $price_month = money_american($this->input->post('price_month'));
        $data = array(
            'name' => $this->input->post('name'),
            'scale_min' => $this->input->post('scale_min'),
            'scale_max' => $this->input->post('scale_max'),
            'scale' => $this->input->post('scale'),
            'price_month' => $price_month,
            'price_hour' => number_format(($price_month / 720),6),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $storage = $this->storage_model->get($this->language);
        $storage_exists = (bool) $storage->num_rows();
        if ($storage_exists) {
            $storage = $storage->row();
        }
        
        if ($storage_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->storage_model->update($storage->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Armazenamento', 'storage', NULL, 'Atualização do armazenamento');
                $this->session->set_flashdata('successmsg', 'Armazenamento atualizado com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->storage_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Armazenamento', 'storage', NULL, 'Cadastro do armazenamento');
                $this->session->set_flashdata('successmsg', 'Armazenamento cadastrado com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/storage');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('name', 'Titulo', 'strip_tags|trim|required|max_length[30]');
        $this->form_validation->set_rules('scale_min', 'Valor minímo', 'strip_tags|trim|required|is_natural');
        $this->form_validation->set_rules('scale_max', 'Valor máximo', 'strip_tags|trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('scale', 'Escala', 'strip_tags|trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('price_month', 'Valor Mensal', 'strip_tags|trim|required');
        $this->form_validation->set_rules('price_hour', 'Valor por Hora', 'strip_tags|trim|required');
        return $this->form_validation->run();
    }
    
}
