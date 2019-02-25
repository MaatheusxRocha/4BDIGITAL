<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Startup_item extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'startup_item_model', 'log_modification_model'));
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
        define('DESK_W', '150');
        define('DESK_H', '150');
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
            'startup_items' => $this->startup_item_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/startup_item/crud', $data);
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
            'status' => TRUE,
            'position' => $this->startup_item_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'startup_item/';
            $ext = $upload['file_ext'];
            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $this->load->library('wideimage/lib/WideImage');
            $image = WideImage::load($upload['full_path']);
            $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['image'] = $file_name;
            @unlink($upload['full_path']);
        } else {
            $this->session->set_flashdata('errormsg', 'Imagem não enviada ou formato não suportado. Tente novamente!');
            return $this->index();
        }

        if ($id = $this->startup_item_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Item cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área "Startups - Item"', 'startup_item', $id, "Cadastro do item \"$text\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/startup_item');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_item');
        }

        $startup_item = $this->startup_item_model->get($this->language, $id);
        if (!$startup_item->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_item');
        }

        $data = array(
            'op' => 'update',
            'startup_items' => $this->startup_item_model->get($this->language)->result(),
            'startup_item' => $startup_item->row(),
        );
        $this->_header();
        $this->load->view('admin/startup_item/crud', $data);
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
            redirect('admin/startup_item');
        }

        $startup_item = $this->startup_item_model->get($this->language, $id);
        if (!$startup_item->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_item');
        }
        $startup_item = $startup_item->row();

        $text = $this->input->post('text');
        $data = array(
            'text' => $text,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'startup_item/';
            $ext = $upload['file_ext'];
            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $this->load->library('wideimage/lib/WideImage');
            $image = WideImage::load($upload['full_path']);
            $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['image'] = $file_name;
            @unlink($upload['full_path']);
            @unlink($startup_item->image);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem não enviada. A antiga permanece!');
        }

        if ($this->startup_item_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área "Startups - Item"', 'startup_item', $id, "Atualização do item \"$text\"");
            $this->session->set_flashdata('successmsg', 'Item atualizado com sucesso!');
            redirect('admin/startup_item');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/startup_item');
        }

        $startup_item = $this->startup_item_model->get($this->language, $id);
        if (!$startup_item->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/startup_item');
        }
        $startup_item = $startup_item->row();

        $data = array(
            'status' => !$startup_item->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->startup_item_model->update($startup_item->id, $data);

        if ($startup_item->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Startups - Item"', 'startup_item', $id, "Desativação do item \"$startup_item->text\"");
            $this->session->set_flashdata('successmsg', 'O item foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Startups - Item"', 'startup_item', $id, "Ativação do item \"$startup_item->text\"");
            $this->session->set_flashdata('successmsg', 'O item foi ativado com sucesso');
        }
        redirect('admin/startup_item');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/startup_item');
        }

        $startup_item = $this->startup_item_model->get($this->language, $id);
        if (!$startup_item->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/startup_item');
        }
        $startup_item = $startup_item->row();

        if ($this->startup_item_model->delete($id)) {
            @unlink($startup_item->image);
            $this->session->set_flashdata('successmsg', 'Item excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área "Startups - Item"', 'startup_item', $id, "Exclusão do item \"$startup_item->text\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o item!');
        }
        redirect('admin/startup_item');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('text', 'Texto', 'strip_tags|trim|required|max_length[80]');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->startup_item_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->startup_item_model->update($id, $data);
    }

}
