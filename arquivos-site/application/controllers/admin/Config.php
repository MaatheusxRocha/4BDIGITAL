<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'config_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
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
        $data = array(
            'op' => 'save',
            'configs' => $this->config_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/config/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            $this->index();
            return;
        }
        
        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'abbreviation' => $this->input->post('abbreviation'),
            'status' => TRUE,
            'position' => $this->config_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        
        if ($id = $this->config_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Item cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Itens de configuração', 'config', $id, "Cadastro do item \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/config');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/config');
        }
        
        $config = $this->config_model->get($this->language, $id);
        if (!$config->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/config');
        }
        
        $data = array(
            'op' => 'update',
            'configs' => $this->config_model->get($this->language)->result(),
            'config' => $config->row(),
        );
        $this->_header();
        $this->load->view('admin/config/crud', $data);
        $this->_footer();
    }

    public function update() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, verifique as informações!');
            $id = $this->input->post('id');
            $this->edit($id);
            return;
        }
        
        $id = $this->input->post('id');
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/config');
        }
        
        $config = $this->config_model->get($this->language, $id);
        if (!$config->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/config');
        }
        $config = $config->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'abbreviation' => $this->input->post('abbreviation'),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->config_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Itens de configuração', 'config', $id, "Atualização do item \"$name\"");
            $this->session->set_flashdata('successmsg', 'Item atualizado com sucesso!');
            redirect('admin/config');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/config');
        }
        
        $config = $this->config_model->get($this->language, $id);
        if (!$config->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/config');
        }
        $config = $config->row();
        
        $data = array(
            'status' => !$config->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->config_model->update($config->id, $data);
        
        if ($config->status) {
            $this->log_modification_model->save_log('desativação', 'Área Itens de configuração', 'config', $id, "Desativação do item \"$config->name\"");
            $this->session->set_flashdata('successmsg', 'O item foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Itens de configuração', 'config', $id, "Ativação do item \"$config->name\"");
            $this->session->set_flashdata('successmsg', 'O item foi ativado com sucesso');
        }
        redirect('admin/config');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/config');
        }
        
        $config = $this->config_model->get($this->language, $id);
        if (!$config->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/config');
        }
        $config = $config->row();
        
        if ($this->config_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Item excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Itens de configuração', 'config', $id, "Exclusão do item \"$config->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o item!');
        }
        redirect('admin/config');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[20]');
        $this->form_validation->set_rules('abbreviation', 'Abreviação', 'strip_tags|trim|required|max_length[10]');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->config_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->config_model->update($id, $data);
    }

}
