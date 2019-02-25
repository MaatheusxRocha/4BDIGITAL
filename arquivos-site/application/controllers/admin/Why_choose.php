<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Why_choose extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'why_choose_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('home')) {
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
            'why_chooses' => $this->why_choose_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/why_choose/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            $this->index();
            return;
        }
        
        $title = $this->input->post('title');
        $data = array(
            'title' => $title,
            'description' => $this->input->post('description'),
            'status' => FALSE,
            'position' => $this->why_choose_model->get_max_position($this->language) + 1,
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

        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'why_choose/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

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
            $this->index();
            return;
        }

        if ($id = $this->why_choose_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Item cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área "Por que a Brascloud"', 'why_choose', $id, "Cadastro do item \"$title\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/why_choose');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/why_choose');
        }
        
        $why_choose = $this->why_choose_model->get($this->language, $id);
        if (!$why_choose->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/why_choose');
        }
        
        $data = array(
            'op' => 'update',
            'why_chooses' => $this->why_choose_model->get($this->language)->result(),
            'why_choose' => $why_choose->row(),
        );
        $this->_header();
        $this->load->view('admin/why_choose/crud', $data);
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
            redirect('admin/why_choose');
        }
        
        $why_choose = $this->why_choose_model->get($this->language, $id);
        if (!$why_choose->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/why_choose');
        }
        $why_choose = $why_choose->row();

        $title = $this->input->post('title');
        $data = array(
            'title' => $title,
            'description' => $this->input->post('description'),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        
        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));

        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'why_choose/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['image'] = $file_name;

            @unlink($upload['full_path']);
            @unlink($why_choose->image);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem não enviada. A antiga permanece!');
        }

        if ($this->why_choose_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área "Por que a Brascloud"', 'why_choose', $id, "Atualização do item \"$title\"");
            $this->session->set_flashdata('successmsg', 'Item atualizado com sucesso!');
            redirect('admin/why_choose');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/why_choose');
        }
        
        $why_choose = $this->why_choose_model->get($this->language, $id);
        if (!$why_choose->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/why_choose');
        }
        $why_choose = $why_choose->row();
        
        $data = array(
            'status' => !$why_choose->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->why_choose_model->update($why_choose->id, $data);
        
        if ($why_choose->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Por que a Brascloud"', 'why_choose', $id, "Desativação do item \"$why_choose->title\"");
            $this->session->set_flashdata('successmsg', 'O item foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Por que a Brascloud"', 'why_choose', $id, "Ativação do item \"$why_choose->title\"");
            $this->session->set_flashdata('successmsg', 'O item foi ativado com sucesso');
        }
        redirect('admin/why_choose');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/why_choose');
        }
        
        $why_choose = $this->why_choose_model->get($this->language, $id);
        if (!$why_choose->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/why_choose');
        }
        $why_choose = $why_choose->row();
        
        if ($this->why_choose_model->delete($id)) {
            @unlink($why_choose->image);
            $this->session->set_flashdata('successmsg', 'Item excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área "Por que a Brascloud"', 'why_choose', $id, "Exclusão do item \"$why_choose->title\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o item!');
        }
        redirect('admin/why_choose');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('title', 'Título', 'strip_tags|trim|required|max_length[45]');
        $this->form_validation->set_rules('description', 'Descrição', 'strip_tags|trim|required|max_length[100]');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->why_choose_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->why_choose_model->update($id, $data);
    }

}
