<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'recipe_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('startup')) {
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
            'recipes' => $this->recipe_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/recipe/crud', $data);
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
            'status' => TRUE,
            'position' => $this->recipe_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        if ($id = $this->recipe_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Modelo cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área "Modelos de receita"', 'recipe', $id, "Cadastro do modelo \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/recipe');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/recipe');
        }

        $recipe = $this->recipe_model->get($this->language, $id);
        if (!$recipe->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/recipe');
        }

        $data = array(
            'op' => 'update',
            'recipes' => $this->recipe_model->get($this->language)->result(),
            'recipe' => $recipe->row(),
        );
        $this->_header();
        $this->load->view('admin/recipe/crud', $data);
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
            redirect('admin/recipe');
        }

        $recipe = $this->recipe_model->get($this->language, $id);
        if (!$recipe->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/recipe');
        }
        $recipe = $recipe->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->recipe_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área "Modelos de receita"', 'recipe', $id, "Atualização do modelo \"$name\"");
            $this->session->set_flashdata('successmsg', 'Modelo atualizado com sucesso!');
            redirect('admin/recipe');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/recipe');
        }

        $recipe = $this->recipe_model->get($this->language, $id);
        if (!$recipe->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/recipe');
        }
        $recipe = $recipe->row();

        $data = array(
            'status' => !$recipe->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->recipe_model->update($recipe->id, $data);

        if ($recipe->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Modelos de receita"', 'recipe', $id, "Desativação do modelo \"$recipe->name\"");
            $this->session->set_flashdata('successmsg', 'O modelo foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Modelos de receita"', 'recipe', $id, "Ativação do modelo \"$recipe->name\"");
            $this->session->set_flashdata('successmsg', 'O modelo foi ativado com sucesso');
        }
        redirect('admin/recipe');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/recipe');
        }

        $recipe = $this->recipe_model->get($this->language, $id);
        if (!$recipe->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/recipe');
        }
        $recipe = $recipe->row();

        if ($this->recipe_model->delete($id)) {
            @unlink($recipe->image);
            $this->session->set_flashdata('successmsg', 'Modelo excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área "Modelos de receita"', 'recipe', $id, "Exclusão do modelo \"$recipe->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o modelo!');
        }
        redirect('admin/recipe');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[30]');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->recipe_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->recipe_model->update($id, $data);
    }

}
