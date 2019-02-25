<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Startup_slider extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'startup_slider_model', 'log_modification_model'));
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
            'startup_sliders' => $this->startup_slider_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/startup_slider/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            return $this->index();
        }

        $text = $this->input->post('text');
        $data = array(
            'text' => $text,
            'button' => $this->input->post('button'),
            'link' => $this->input->post('link'),
            'status' => FALSE,
            'position' => $this->startup_slider_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        if ($id = $this->startup_slider_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Slider cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área "Startup - Sliders"', 'startup_slider', $id, "Cadastro do slider \"$text\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/startup_slider');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_slider');
        }

        $startup_slider = $this->startup_slider_model->get($this->language, $id);
        if (!$startup_slider->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_slider');
        }

        $data = array(
            'op' => 'update',
            'startup_sliders' => $this->startup_slider_model->get($this->language)->result(),
            'startup_slider' => $startup_slider->row(),
        );
        $this->_header();
        $this->load->view('admin/startup_slider/crud', $data);
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
            redirect('admin/startup_slider');
        }

        $startup_slider = $this->startup_slider_model->get($this->language, $id);
        if (!$startup_slider->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_slider');
        }
        $startup_slider = $startup_slider->row();

        $text = $this->input->post('text');
        $data = array(
            'text' => $text,
            'button' => $this->input->post('button'),
            'link' => $this->input->post('link'),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->startup_slider_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área "Startup - Slider"', 'startup_slider', $id, "Atualização do slider \"$text\"");
            $this->session->set_flashdata('successmsg', 'Slider atualizado com sucesso!');
            redirect('admin/startup_slider');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/startup_slider');
        }

        $startup_slider = $this->startup_slider_model->get($this->language, $id);
        if (!$startup_slider->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/startup_slider');
        }
        $startup_slider = $startup_slider->row();

        $data = array(
            'status' => !$startup_slider->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->startup_slider_model->update($startup_slider->id, $data);

        if ($startup_slider->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Startup - Slider"', 'startup_slider', $id, "Desativação do slider \"$startup_slider->text\"");
            $this->session->set_flashdata('successmsg', 'O slider foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Startup - Slider"', 'startup_slider', $id, "Ativação do slider \"$startup_slider->text\"");
            $this->session->set_flashdata('successmsg', 'O slider foi ativado com sucesso');
        }
        redirect('admin/startup_slider');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/startup_slider');
        }

        $startup_slider = $this->startup_slider_model->get($this->language, $id);
        if (!$startup_slider->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_slider');
        }
        $startup_slider = $startup_slider->row();

        if ($this->startup_slider_model->delete($id)) {
            @unlink($startup_slider->image);
            $this->session->set_flashdata('successmsg', 'Slider excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área "Startup - Slider"', 'startup_slider', $id, "Exclusão do slider \"$startup_slider->text\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o slider!');
        }
        redirect('admin/startup_slider');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_html', 'O campo {field} é obrigatório');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('text', 'Texto', 'trim|callback_required_html');
        $this->form_validation->set_rules('button', 'Botão', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('link', 'Link', 'strip_tags|trim|required|valid_url');
        return $this->form_validation->run();
    }

    public function required_html($text) {
        return (bool) trim(strip_tags($text));
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->startup_slider_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->startup_slider_model->update($id, $data);
    }

}
