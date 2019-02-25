<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Startup extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'startup_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
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

        define('DESK_W', 1920);
        define('DESK_H', 284);

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
        $startup = $this->startup_model->get($this->language);
        if ($startup->num_rows()) {
            $data['startup'] = $startup->row();
        }
        $this->_header();
        $this->load->view('admin/startup/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            return $this->index();
        }

        $data = array(
            'title' => $this->input->post('title'),
            'title_offer' => $this->input->post('title_offer'),
            'code' => $this->input->post('code'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $startup = $this->startup_model->get($this->language);
        $startup_exists = (bool) $startup->num_rows();
        if ($startup_exists) {
            $startup = $startup->row();
        }

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        $this->load->library('wideimage/lib/WideImage');

        $base64_image = $this->input->post('image');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'startup/';
            $sanitize_title = simple_filename('startup');
            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);

            file_put_contents($upload_name, base64_decode($base64_image));
            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['image'] = $fileNameDesktop;
            @unlink($upload_name);
            if ($startup_exists && $startup->image) {
                @unlink($startup->image);
            }
        } elseif (!$startup_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem não enviada!');
            return $this->index();
        }

        $base64_image = $this->input->post('image_mobile');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'startup/';
            $sanitize_title = simple_filename('startup_mobile');
            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);

            file_put_contents($upload_name, base64_decode($base64_image));
            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(MOB_W, MOB_H, 'outside')->crop('center', 'middle', MOB_W, MOB_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['image_mobile'] = $fileNameDesktop;
            @unlink($upload_name);
            if ($startup_exists && $startup->image_mobile) {
                @unlink($startup->image_mobile);
            }
        } elseif (!$startup_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem mobile não enviada!');
            return $this->index();
        }

        if ($startup_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->startup_model->update($startup->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área "Página Startup"', 'startup', NULL, 'Atualização da Página Startup');
                $this->session->set_flashdata('successmsg', 'Página Startup atualizada com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->startup_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área "Página Startup"', 'startup', NULL, 'Cadastro da Página Startup');
                $this->session->set_flashdata('successmsg', 'Página Startup cadastrada com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/startup');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_html', 'O campo {field} é obrigatório');
        $this->form_validation->set_message('max_length_html', 'O campo {field} aceita no máximo {param} caracteres');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title', 'Título', 'trim|callback_required_html');
        $this->form_validation->set_rules('title_offer', 'Título oferta', 'trim|callback_required_html');
        $this->form_validation->set_rules('code', 'Cupom promocional', 'strip_tags|trim|required|integer');
        return $this->form_validation->run();
    }

    public function required_html($text) {
        return (bool) trim(strip_tags($text));
    }

    public function max_length_html($text, $size) {
        return strlen(trim(strip_tags($text))) <= $size;
    }

}
