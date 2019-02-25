<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'partner_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('about')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }
        define('DESK_W', '180');
        define('DESK_H', '120');
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
            'partners' => $this->partner_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/partner/crud', $data);
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
            'link' => $this->input->post('link'),
            'status' => FALSE,
            'position' => $this->partner_model->get_max_position($this->language) + 1,
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
            $pattern_desktop = IMAGES_PATH . 'partner/';
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

        if ($id = $this->partner_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Parceiro cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área "Parceiros de Tecnologia"', 'partner', $id, "Cadastro do parceiro \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/partner');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/partner');
        }

        $partner = $this->partner_model->get($this->language, $id);
        if (!$partner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/partner');
        }

        $data = array(
            'op' => 'update',
            'partners' => $this->partner_model->get($this->language)->result(),
            'partner' => $partner->row(),
        );
        $this->_header();
        $this->load->view('admin/partner/crud', $data);
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
            redirect('admin/partner');
        }

        $partner = $this->partner_model->get($this->language, $id);
        if (!$partner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/partner');
        }
        $partner = $partner->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'link' => $this->input->post('link'),
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
            $pattern_desktop = IMAGES_PATH . 'partner/';
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
            @unlink($partner->image);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem não enviada. A antiga permanece!');
        }

        if ($this->partner_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área "Parceiros de Tecnologia"', 'partner', $id, "Atualização do parceiro \"$name\"");
            $this->session->set_flashdata('successmsg', 'Item atualizado com sucesso!');
            redirect('admin/partner');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/partner');
        }

        $partner = $this->partner_model->get($this->language, $id);
        if (!$partner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/partner');
        }
        $partner = $partner->row();

        $data = array(
            'status' => !$partner->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->partner_model->update($partner->id, $data);

        if ($partner->status) {
            $this->log_modification_model->save_log('desativação', 'Área "Parceiros de Tecnologia"', 'partner', $id, "Desativação do parceiro \"$partner->name\"");
            $this->session->set_flashdata('successmsg', 'O parceiro foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área "Parceiros de Tecnologia"', 'partner', $id, "Ativação do parceiro \"$partner->name\"");
            $this->session->set_flashdata('successmsg', 'O parceiro foi ativado com sucesso');
        }
        redirect('admin/partner');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/partner');
        }

        $partner = $this->partner_model->get($this->language, $id);
        if (!$partner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/partner');
        }
        $partner = $partner->row();

        if ($this->partner_model->delete($id)) {
            @unlink($partner->image);
            $this->session->set_flashdata('successmsg', 'Parceiro excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área "Parceiros de Tecnologia"', 'partner', $id, "Exclusão do parceiro \"$partner->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o parceiro!');
        }
        redirect('admin/partner');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('link', 'Link', 'strip_tags|trim|valid_url');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->partner_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->partner_model->update($id, $data);
    }

}
