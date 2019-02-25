<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'department_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
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
        define('DESK_W', '100');
        define('DESK_H', '100');
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
            'departments' => $this->department_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/department/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            return $this->index();
        }

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'email' => $this->input->post('email'),
            'status' => FALSE,
            'position' => $this->department_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        if ($id = $this->department_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Departamento cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área "Contato - Departamentos"', 'department', $id, "Cadastro do departamento \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/department');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/department');
        }

        $department = $this->department_model->get($this->language, $id);
        if (!$department->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/department');
        }

        $data = array(
            'op' => 'update',
            'departments' => $this->department_model->get($this->language)->result(),
            'department' => $department->row(),
        );
        $this->_header();
        $this->load->view('admin/department/crud', $data);
        $this->_footer();
    }

    public function update() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, verifique as informações!');
            $id = $this->input->post('id');
            return $this->edit($id);
        }

        $id = $this->input->post('id');
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/department');
        }

        $department = $this->department_model->get($this->language, $id);
        if (!$department->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/department');
        }
        $department = $department->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'email' => $this->input->post('email'),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->department_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área "Contato - Departamentos"', 'department', $id, "Atualização do departamento \"$name\"");
            $this->session->set_flashdata('successmsg', 'Departamento atualizado com sucesso!');
            redirect('admin/department');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/department');
        }

        $department = $this->department_model->get($this->language, $id);
        if (!$department->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/department');
        }
        $department = $department->row();

        $data = array(
            'status' => !$department->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->department_model->update($department->id, $data);

        if ($department->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Contato - Departamentos"', 'department', $id, "Desativação do departamento \"$department->name\"");
            $this->session->set_flashdata('successmsg', 'O item foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Contato - Departamentos"', 'department', $id, "Ativação do departamento \"$department->name\"");
            $this->session->set_flashdata('successmsg', 'O item foi ativado com sucesso');
        }
        redirect('admin/department');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/department');
        }

        $department = $this->department_model->get($this->language, $id);
        if (!$department->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/department');
        }
        $department = $department->row();

        if ($this->department_model->delete($id)) {
            @unlink($department->image);
            $this->session->set_flashdata('successmsg', 'Departamentos excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área "Contato - Departamentos"', 'department', $id, "Exclusão do departamento \"$department->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o departamento!');
        }
        redirect('admin/department');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('email', 'Descrição', 'strip_tags|trim|required|max_length[150]');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->department_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->department_model->update($id, $data);
    }

}
