<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Messaging extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'messaging_model', 'log_modification_model'));
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
        define('DESK_W', '170');
        define('DESK_H', '170');
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
            'messagings' => $this->messaging_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/messaging/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            return $this->index();
        }

        $title = $this->input->post('title');
        $data = array(
            'title' => $title,
            'description' => $this->input->post('description'),
            'link' => $this->input->post('link'),
            'start_date' => format_date($this->input->post('start_date')),
            'end_date' => format_date($this->input->post('end_date')),
            'status' => FALSE,
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
            $pattern_desktop = IMAGES_PATH . 'messaging/';
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

        if ($id = $this->messaging_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Mensagem cadastrada com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Mensageria', 'messaging', $id, "Cadastro da mensagem \"$title\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/messaging');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/messaging');
        }

        $messaging = $this->messaging_model->get($this->language, $id);
        if (!$messaging->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/messaging');
        }

        $data = array(
            'op' => 'update',
            'messagings' => $this->messaging_model->get($this->language)->result(),
            'messaging' => $messaging->row(),
        );
        $this->_header();
        $this->load->view('admin/messaging/crud', $data);
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
            redirect('admin/messaging');
        }

        $messaging = $this->messaging_model->get($this->language, $id);
        if (!$messaging->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/messaging');
        }
        $messaging = $messaging->row();

        $title = $this->input->post('title');
        $data = array(
            'title' => $title,
            'description' => $this->input->post('description'),
            'link' => $this->input->post('link'),
            'start_date' => format_date($this->input->post('start_date')),
            'end_date' => format_date($this->input->post('end_date')),
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
            $pattern_desktop = IMAGES_PATH . 'messaging/';
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
            @unlink($messaging->image);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem não enviada. A antiga permanece!');
        }

        if ($this->messaging_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Mensageria', 'messaging', $id, "Atualização da mensagem \"$title\"");
            $this->session->set_flashdata('successmsg', 'Mensagem atualizada com sucesso!');
            redirect('admin/messaging');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/messaging');
        }

        $messaging = $this->messaging_model->get($this->language, $id);
        if (!$messaging->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/messaging');
        }
        $messaging = $messaging->row();

        $data = array(
            'status' => !$messaging->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->messaging_model->update($messaging->id, $data);

        if ($messaging->status) {
            $this->log_modification_model->save_log('desativação', 'Área Mensageria', 'messaging', $id, "Desativação da mensagem \"$messaging->title\"");
            $this->session->set_flashdata('successmsg', 'A mensagem foi desativada com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Mensageria', 'messaging', $id, "Ativação da mensagem \"$messaging->title\"");
            $this->session->set_flashdata('successmsg', 'A mensagem foi ativada com sucesso');
        }
        redirect('admin/messaging');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/messaging');
        }

        $messaging = $this->messaging_model->get($this->language, $id);
        if (!$messaging->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/messaging');
        }
        $messaging = $messaging->row();

        if ($this->messaging_model->delete($id)) {
            @unlink($messaging->image);
            $this->session->set_flashdata('successmsg', 'Mensagem excluída com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Mensageria', 'messaging', $id, "Exclusão da mensagem \"$messaging->title\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir a mensagem!');
        }
        redirect('admin/messaging');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_start_date', 'O campo {field} é obrigatório quando há uma data final');
        $this->form_validation->set_message('required_end_date', 'O campo {field} é obrigatório quando há uma data inicial');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('title', 'Título', 'strip_tags|trim|required|max_length[150]');
        $this->form_validation->set_rules('link', 'Link', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('description', 'Descrição', 'strip_tags|trim|required');
        $this->form_validation->set_rules('start_date', 'Data inicial', 'strip_tags|trim|exact_length[10]|callback_required_start_date');
        $this->form_validation->set_rules('end_date', 'Data final', 'strip_tags|trim|exact_length[10]|callback_required_end_date');
        return $this->form_validation->run();
    }

    public function required_start_date($start_date) {
        return $this->input->post('end_date') ? (bool) $start_date : TRUE;
    }

    public function required_end_date($end_date) {
        return $this->input->post('start_date') ? (bool) $end_date : TRUE;
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->messaging_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->messaging_model->update($id, $data);
    }

}
