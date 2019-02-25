<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'performance_model', 'log_modification_model'));
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
            'performances' => $this->performance_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/performance/crud', $data);
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
            'price' => money_american($this->input->post('price')),
            'status' => TRUE,
            'position' => $this->performance_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        
        if ($id = $this->performance_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Item cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Performance', 'performance', $id, "Cadastro do item \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/performance');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/performance');
        }
        
        $performance = $this->performance_model->get($this->language, $id);
        if (!$performance->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/performance');
        }
        
        $data = array(
            'op' => 'update',
            'performances' => $this->performance_model->get($this->language)->result(),
            'performance' => $performance->row(),
        );
        $this->_header();
        $this->load->view('admin/performance/crud', $data);
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
            redirect('admin/performance');
        }
        
        $performance = $this->performance_model->get($this->language, $id);
        if (!$performance->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/performance');
        }
        $performance = $performance->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'price' => money_american($this->input->post('price')),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->performance_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Performance', 'performance', $id, "Atualização do item \"$name\"");
            $this->session->set_flashdata('successmsg', 'Item atualizado com sucesso!');
            redirect('admin/performance');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/performance');
        }
        
        $performance = $this->performance_model->get($this->language, $id);
        if (!$performance->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/performance');
        }
        $performance = $performance->row();
        
        $data = array(
            'status' => !$performance->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->performance_model->update($performance->id, $data);
        
        if ($performance->status) {
            $this->log_modification_model->save_log('desativação', 'Área Performance', 'performance', $id, "Desativação do item \"$performance->name\"");
            $this->session->set_flashdata('successmsg', 'O item foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Performance', 'performance', $id, "Ativação do item \"$performance->name\"");
            $this->session->set_flashdata('successmsg', 'O item foi ativado com sucesso');
        }
        redirect('admin/performance');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/performance');
        }
        
        $performance = $this->performance_model->get($this->language, $id);
        if (!$performance->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/performance');
        }
        $performance = $performance->row();
        
        if ($this->performance_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Item excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Performance', 'performance', $id, "Exclusão do item \"$performance->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o item!');
        }
        redirect('admin/performance');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('price', 'Preço', 'trim|required');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->performance_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->performance_model->update($id, $data);
    }

}
