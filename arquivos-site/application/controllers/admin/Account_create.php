<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_create extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'account_create_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('why_create')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }

        define('DESK_W', 920);
        define('DESK_H', 115);

        define('MOB_W', 240);
        define('MOB_H', 150);
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
        $data = array();
        $account_create = $this->account_create_model->get($this->language);
        if ($account_create->num_rows()) {
            $data['account_create'] = $account_create->row();
        }
        $this->_header();
        $this->load->view('admin/account_create/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            return $this->index();
        }

        $data = array(
            'title_one' => $this->input->post('title_one'),
            'title_two' => $this->input->post('title_two'),
            'title_left' => $this->input->post('title_left'),
            'description' => $this->input->post('description'),
            'on_demand_left' => $this->input->post('on_demand_left'),
            'on_demand_right' => $this->input->post('on_demand_right'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $account_create = $this->account_create_model->get($this->language);
        $account_create_exists = (bool) $account_create->num_rows();
        if ($account_create_exists) {
            $account_create = $account_create->row();
        }

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        $this->load->library('wideimage/lib/WideImage');

        if ($this->upload->do_upload('on_demand_image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'account_create/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);
            $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['on_demand_image'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($account_create_exists) {
                @unlink($account_create->on_demand_image);
            }
        } elseif (!$account_create_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem "On-Demand" não enviada');
            return $this->index();
        }

        if ($this->upload->do_upload('on_demand_image_mobile')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'account_create/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);
            $image_desktop = $image->resize(MOB_W, MOB_H, 'outside')->crop('center', 'middle', MOB_W, MOB_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['on_demand_image_mobile'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($account_create_exists) {
                @unlink($account_create->on_demand_image_mobile);
            }
        } elseif (!$account_create_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem "On-Demand" mobile não enviada');
            return $this->index();
        }

        if ($account_create_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->account_create_model->update($account_create->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Configurações', 'account_create', NULL, 'Atualização das configurações');
                $this->session->set_flashdata('successmsg', 'Configurações atualizadas com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->account_create_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Configurações', 'account_create', NULL, 'Cadastro das configurações');
                $this->session->set_flashdata('successmsg', 'Configurações cadastradas com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/account_create');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_html', 'O campo {field} é obrigatório');
        $this->form_validation->set_message('max_length_html', 'O campo {field} aceita no máximo {param} caracteres');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title_one', 'Título Cinza', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('title_two', 'Título Vermelho', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('title_left', 'Título Amarelo', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('description', 'Descrição', 'trim|callback_required_html');
        $this->form_validation->set_rules('on_demand_left', 'Título On-Demand', 'strip_tags|trim|required|max_length[30]');
        $this->form_validation->set_rules('on_demand_right', 'Descrição On-Demand', 'trim|callback_required_html');
        return $this->form_validation->run();
    }

    public function required_html($text) {
        return (bool) trim(strip_tags($text));
    }

}
