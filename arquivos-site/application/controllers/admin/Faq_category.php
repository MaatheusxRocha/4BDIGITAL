<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_category extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'faq_category_model', 'faq_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('faq')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if (empty($this->language)) {
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
            'categories' => $this->faq_category_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/faq_category/crud', $data);
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
            'status' => FALSE,
            'position' => $this->faq_category_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );


        if ($id = $this->faq_category_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Categoria cadastrada com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Categoria Faq', 'faq_category', $id, "Cadastro da categoria \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/faq_category');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }

        $category = $this->faq_category_model->get($this->language, $id);
        if (!$category->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }

        $data = array(
            'op' => 'update',
            'categories' => $this->faq_category_model->get($this->language)->result(),
            'category' => $category->row(),
        );
        $this->_header();
        $this->load->view('admin/faq_category/crud', $data);
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
            redirect('admin/faq_category');
        }

        $category = $this->faq_category_model->get($this->language, $id);
        if (!$category->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }
        $category = $category->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->faq_category_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Categoria Faq', 'faq_category', $id, "Atualização da categoria \"$name\"");
            $this->session->set_flashdata('successmsg', 'Categoria atualizada com sucesso!');
            redirect('admin/faq_category');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/faq_category');
        }

        $category = $this->faq_category_model->get($this->language, $id);
        if (!$category->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/faq_category');
        }
        $category = $category->row();

        $data = array(
            'status' => !$category->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->faq_category_model->update($category->id, $data);

        if ($category->status) {
            $this->log_modification_model->save_log('desativação', 'Área Categoria Faq', 'faq_category', $id, "Desativação da categoria \"$category->name\"");
            $this->session->set_flashdata('successmsg', 'A categoria foi desativada com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Categoria Faq', 'faq_category', $id, "Ativação da categoria \"$category->name\"");
            $this->session->set_flashdata('successmsg', 'A categoria foi ativada com sucesso');
        }
        redirect('admin/faq_category');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/faq_category');
        }

        $category = $this->faq_category_model->get($this->language, $id);
        if (!$category->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }
        $category = $category->row();

        if ($this->faq_category_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Categoria excluída com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Categoria Faq', 'faq_category', $id, "Exclusão da categoria \"$category->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir a categoria!');
        }
        redirect('admin/faq_category');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
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
        if (!$this->faq_category_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->faq_category_model->update($id, $data);
    }

    // controle de faqs
    private function _form_validation_faq() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('question', 'Pergunta', 'trim|required');
        $this->form_validation->set_rules('answer', 'Resposta', 'trim|required');
        return $this->form_validation->run();
    }

    public function faqs($category_id = NULL) {
        if (empty($category_id) || !is_numeric($category_id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida');
            redirect('faq_category');
        }
        $category = $this->faq_category_model->get($this->language, $category_id);
        if (!$category->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida');
            redirect('faq_category');
        }
        $data['category'] = $category->row();
        $data['faqs'] = $this->faq_model->get_category($category_id)->result();
        $data['op'] = 'save_faq';
        $this->session->set_userdata('category_id', $category_id);
        $this->_header();
        $this->load->view('admin/faq_category/faqs', $data);
        $this->_footer();
    }

    public function save_faq() {
        $category_id = $this->input->post('category_id');
        if (empty($category_id) || !is_numeric($category_id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida');
            redirect('admin/faq_category');
        }
        $category = $this->faq_category_model->get($this->language, $category_id);
        if (!$category->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida');
            redirect('admin/faq_category');
        }
        if ($this->_form_validation_faq() === FALSE) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->faqs($category_id);
        } else {
            $position = $this->faq_model->get_max_position($category_id);
            $question = $this->input->post('question');
            $faq = array(
                'question' => $question,
                'answer' => $this->input->post('answer'),
                'status' => TRUE,
                'position' => $position + 1,
                'faq_category_id' => $category_id,
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => $this->current_user->user()->id
            );
            if ($id = $this->faq_model->save($faq, TRUE)) {
                $this->session->set_flashdata('successmsg', 'Pergunta cadastrada com sucesso!');
                $this->log_modification_model->save_log('cadastro', 'Área Perguntas', 'faq', $id, "Cadastro da pergunta " . strip_tags($question));
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
            redirect('admin/faq_category/faqs/' . $category_id);
        }
    }

    public function edit_faq($id) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }

        $faq = $this->faq_model->get($this->language, $id);
        if (!$faq->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }
        $data['faq'] = $faq->row();
        $data['faqs'] = $this->faq_model->get_category($faq->row()->faq_category_id)->result();
        $data['category'] = $this->faq_category_model->get($this->language, $faq->row()->faq_category_id)->row();
        $data['op'] = 'update_faq';
        $this->_header();
        $this->load->view('admin/faq_category/faqs', $data);
        $this->_footer();
    }

    public function update_faq() {
        $faq_id = strip_tags($this->input->post('id'));
        if (empty($faq_id) || !is_numeric($faq_id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }
        $faq = $this->faq_model->get($this->language, $faq_id);
        if (!$faq->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }
        if ($this->_form_validation_faq()) {
            $question = $this->input->post('question');
            $update = array(
                'question' => $question,
                'answer' => $this->input->post('answer'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => $this->current_user->user()->id
            );

            $this->faq_model->update($faq_id, $update);
            $this->session->set_flashdata('successmsg', 'Pergunta atualizada com sucesso!');
            $this->log_modification_model->save_log('atualização', 'Área Perguntas', 'faq', $faq_id, "Atualização da pergunta" . strip_tags($question));
            redirect('admin/faq_category/faqs/' . $faq->row()->faq_category_id);
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->edit_faq($faq_id);
            return;
        }
    }

    public function delete_faq($id) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }

        $faq = $this->faq_model->get($this->language, $id);
        if (!$faq->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/faq_category');
        }

        if ($this->faq_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Pergunta excluída com sucesso!');
            $this->log_modification_model->save_log('atualização', 'Área Perguntas', 'faq', $id, "Exclusão da pergunta " . strip_tags($faq->row()->question));
        } else {
            $this->session->set_flashdata('errormsg', 'Pergunta não pode ser excluída!');
        }
        redirect('admin/faq_category/faqs/' . $faq->row()->faq_category_id);
    }

    public function toggle_faq($id) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/faq_category');
        }
        $faq = $this->faq_model->get($this->language,$id);
        if (!$faq->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/faq_category');
        }
        $up_faq = array(
            'status' => $faq->row()->status ? FALSE : TRUE,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->faq_model->update($faq->row()->id, $up_faq);
        if ($faq->row()->status) {
            $this->log_modification_model->save_log('desativação', 'Área Pergunta', 'faq', $id, "Desativação da pergunta " . strip_tags($faq->row()->question));
            $this->session->set_flashdata('successmsg', 'A pergunta foi desativada com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Pergunta', 'faq', $id, "Ativação da pergunta " . strip_tags($faq->row()->question));
            $this->session->set_flashdata('successmsg', 'A pergunta foi ativada com sucesso');
        }
        redirect("admin/faq_category/faqs/" . $faq->row()->faq_category_id);
    }

    public function update_ordenation_faq() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->faq_model->get($this->language,$id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->faq_model->update($id, $data);
    }

}
