<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'banner_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('home')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if (empty($this->language)) {
            $this->language = 1;
        }
        define('DESK_W', '1920');
        define('DESK_H', '580');
        define('MOB_W', '640');
        define('MOB_H', '440');
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
            'banners' => $this->banner_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/banner/crud', $data);
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
            'button' => $this->input->post('button'),
            'link' => $this->input->post('link'),
            'status' => FALSE,
            'position' => $this->banner_model->get_max_position($this->language) + 1,
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
            $pattern_desktop = IMAGES_PATH . 'banner/large/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);
            if ($ext == '.gif') {
                rename(UPLOAD_PATH . $upload['file_name'], $file_name);
            } else {
                $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
                if ($ext == '.jpg' || $ext == '.jpeg') {
                    $image_desktop->saveToFile($file_name, 90);
                } else {
                    $image_desktop->saveToFile($file_name);
                }
            }

            $data['image'] = $file_name;

            @unlink($upload['full_path']);
        } else {
            $this->session->set_flashdata('errormsg', 'Imagem não enviada ou formato não suportado. Tente novamente!');
            $this->index();
            return;
        }
        if ($this->upload->do_upload('image_mobile')) {
            $upload_mobile = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'banner/mobile/';
            $ext = $upload_mobile['file_ext'];

            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload_mobile['raw_name']);

            $image = WideImage::load($upload_mobile['full_path']);
            if ($ext == '.gif') {
                rename(UPLOAD_PATH . $upload_mobile['file_name'], $file_name);
            } else {
                $image_desktop = $image->resize(MOB_W, MOB_H, 'outside')->crop('center', 'middle', MOB_W, MOB_H);
                if ($ext == '.jpg' || $ext == '.jpeg') {
                    $image_desktop->saveToFile($file_name, 90);
                } else {
                    $image_desktop->saveToFile($file_name);
                }
            }

            $data['image_mobile'] = $file_name;

            @unlink($upload_mobile['full_path']);
            if (isset($upload)) {
                @unlink($upload['full_path']);
            }
        } else {
            $this->session->set_flashdata('errormsg', 'Imagem não enviada ou formato não suportado. Tente novamente!');
            $this->index();
            return;
        }

        if ($id = $this->banner_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Banner cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Banners', 'banner', $id, "Cadastro do banner \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/banner');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/banner');
        }

        $banner = $this->banner_model->get($this->language, $id);
        if (!$banner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/banner');
        }

        $data = array(
            'op' => 'update',
            'banners' => $this->banner_model->get($this->language)->result(),
            'banner' => $banner->row(),
        );
        $this->_header();
        $this->load->view('admin/banner/crud', $data);
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
            redirect('admin/banner');
        }

        $banner = $this->banner_model->get($this->language, $id);
        if (!$banner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/banner');
        }
        $banner = $banner->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'button' => $this->input->post('button'),
            'link' => $this->input->post('link'),
            'status' => FALSE,
            'position' => $this->banner_model->get_max_position($this->language) + 1,
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
            $pattern_desktop = IMAGES_PATH . 'banner/large/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);
            if ($ext == '.gif') {
                rename(UPLOAD_PATH . $upload['file_name'], $file_name);
            } else {
                $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
                if ($ext == '.jpg' || $ext == '.jpeg') {
                    $image_desktop->saveToFile($file_name, 90);
                } else {
                    $image_desktop->saveToFile($file_name);
                }
            }

            $data['image'] = $file_name;

            @unlink($upload['full_path']);
            @unlink($banner->image);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem não enviada ou formato não suportado. A antiga permanece!');
        }
        if ($this->upload->do_upload('image_mobile')) {
            $upload_mobile = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'banner/mobile/';
            $ext = $upload_mobile['file_ext'];

            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload_mobile['raw_name']);

            $image = WideImage::load($upload_mobile['full_path']);
            if ($ext == '.gif') {
                rename(UPLOAD_PATH . $upload_mobile['file_name'], $file_name);
            } else {
                $image_desktop = $image->resize(MOB_W, MOB_H, 'outside')->crop('center', 'middle', MOB_W, MOB_H);
                if ($ext == '.jpg' || $ext == '.jpeg') {
                    $image_desktop->saveToFile($file_name, 90);
                } else {
                    $image_desktop->saveToFile($file_name);
                }
            }

            $data['image_mobile'] = $file_name;

            @unlink($upload_mobile['full_path']);
            @unlink($banner->image_mobile);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem mobile não enviada ou formato não suportado. A antiga permanece!');
        }

        if ($this->banner_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Banners', 'banner', $id, "Atualização do banner \"$name\"");
            $this->session->set_flashdata('successmsg', 'Banner atualizado com sucesso!');
            redirect('admin/banner');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/banner');
        }

        $banner = $this->banner_model->get($this->language, $id);
        if (!$banner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/banner');
        }
        $banner = $banner->row();

        $data = array(
            'status' => !$banner->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->banner_model->update($banner->id, $data);

        if ($banner->status) {
            $this->log_modification_model->save_log('desativação', 'Área Banners', 'banner', $id, "Desativação do banner \"$banner->name\"");
            $this->session->set_flashdata('successmsg', 'O banner foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Banners', 'banner', $id, "Ativação do banner \"$banner->name\"");
            $this->session->set_flashdata('successmsg', 'O banner foi ativado com sucesso');
        }
        redirect('admin/banner');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/banner');
        }

        $banner = $this->banner_model->get($this->language, $id);
        if (!$banner->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/banner');
        }
        $banner = $banner->row();

        if ($this->banner_model->delete($id)) {
            @unlink($banner->image);
            @unlink($banner->image_mobile);
            $this->session->set_flashdata('successmsg', 'Banner excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Banners', 'banner', $id, "Exclusão do banner \"$banner->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o banner!');
        }
        redirect('admin/banner');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[30]');
        $this->form_validation->set_rules('button', 'Texto Botão', 'strip_tags|trim|max_length[40]');
        $this->form_validation->set_rules('image', 'Imagem', 'strip_tags|trim');
        $this->form_validation->set_rules('image_mobile', 'Imagem Mobile', 'strip_tags|trim');
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
        if (!$this->banner_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->banner_model->update($id, $data);
    }

}
