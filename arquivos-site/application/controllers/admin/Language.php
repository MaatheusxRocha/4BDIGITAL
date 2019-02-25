<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user','log_modification_model'));
        $this->load->library(array('form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        $this->language = $this->session->userdata('language');
        if (empty($this->language)) {
            $this->language = 1;
        }
        if (!$this->permission_model->get_permission_user('configuration')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
    }

    private function _header() {
        $header['current_language'] = $this->language_model->get($this->language)->row();
        $header['languages'] = $this->language_model->get()->result();
        $header['current_user'] = $this->current_user->user();
        $this->load->view('admin/default/header', $header);
    }

    private function _footer() {
        $this->load->view('admin/default/footer');
    }

    public function index() {
        $data = array(
            'languages' => $this->language_model->get()->result(),
            'op' => 'save'
        );
        $this->_header();
        $this->load->view('admin/language/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        
        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'position' => $this->language_model->get_max_position() + 1,
            'status' => TRUE,
        );

        if ($id = $this->language_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Idioma cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Idiomas', 'language', $id, "Cadastro do idioma \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/language');
    }

    public function edit($id) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/language');
        }
        
        $language = $this->language_model->get($id);
        if (!$language->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/language');
        }
        
        $data = array(
            'languages' => $this->language_model->get()->result(),
            'language' => $language->row(),
            'op' => 'update'
        );
        $this->_header();
        $this->load->view('admin/language/crud', $data);
        $this->_footer();
    }

    public function update() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $id = $this->input->post('id');
            $this->edit($id);
            return;
        }
        
        $id = $this->input->post('id');
        $language = $this->language_model->get($id);
        if (!$language->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/language');
        }
        $language = $language->row();
        
        $name = $this->input->post('name');
        $data = array(
            'name' => $name
        );

        if ($this->language_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Idiomas', 'language', $id, "Atualização do idioma \"$name\"");
            $this->session->set_flashdata('successmsg', 'Idioma atualizado com sucesso!');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar o idioma.');
        }
        redirect('admin/language');
    }

    public function toggle($id) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/language');
        }
        
        $language = $this->language_model->get($id);
        if (!$language->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/language');
        }
        $language = $language->row();
        
        $data = array(
            'status' => $language->status ? FALSE : TRUE,
        );
        $this->language_model->update($language->id, $data);
        if ($language->status) {
            $this->log_modification_model->save_log('desativação', 'Área Idiomas', 'language', $id, "Desativação do idioma \"$language->name\"");
            $this->session->set_flashdata('successmsg', 'O idioma foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Idiomas', 'language', $id, "Ativação do idioma \"$language->name\"");
            $this->session->set_flashdata('successmsg', 'O idioma foi ativado com sucesso');
        }
        redirect('admin/language');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|numeric');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[50]');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->language_model->get($id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->language_model->update($id, $data);
    }

}
