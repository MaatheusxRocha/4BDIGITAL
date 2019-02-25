<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Architect extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'architect_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('architect')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }
        define('DESK_W', '1920');
        define('DESK_H', '284');
        define('TOPIC_W', '335');
        define('TOPIC_H', '400');
        define('VIDEO_W', '1280');
        define('VIDEO_H', '720');
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
        $architect = $this->architect_model->get($this->language);
        if ($architect->num_rows()) {
            $data['architect'] = $architect->row();
        }
        $this->_header();
        $this->load->view('admin/architect/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        $title = $this->input->post('title');
        $data = array(
            'title' => $this->input->post('title'),
            'advantage_title' => $this->input->post('advantage_title'),
            'topic_title' => $this->input->post('topic_title'),
            'video_title' => $this->input->post('video_title'),
            'video' => $this->input->post('video'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $architect = $this->architect_model->get($this->language);
        $architect_exists = (bool) $architect->num_rows();
        if ($architect_exists) {
            $architect = $architect->row();
        }
        
        $base64_image = $this->input->post('image');
        $this->load->library('wideimage/lib/WideImage');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_large = IMAGES_PATH . 'architect/top/';
            $sanitize_title = simple_filename($title);

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $file_name = $pattern_large . archive_filename($pattern_large, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_large = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            $image_large->saveToFile($file_name, 90);

            $data['image'] = $file_name;

            @unlink($upload_name);
            if($architect_exists){
                @unlink($architect->image);
            }
        }else if(!$architect_exists){
            $this->session->set_flashdata('errormsg','Imagem de topo não enviada. Tente novamente');
            $this->index();
            return;
        }
        
        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));

        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('topic_image')) {
            $upload = $this->upload->data();
            $pattern_logo = IMAGES_PATH . 'architect/topic/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_logo . archive_filename($pattern_logo, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(TOPIC_W, TOPIC_H, 'outside')->crop('center', 'middle', TOPIC_W, TOPIC_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['topic_image'] = $file_name;

            @unlink($upload['full_path']);
            if($architect_exists){
                @unlink($architect->topic_image);
            }
        } else if(!$architect_exists){
            if(isset($upload_name)){
                @unlink($upload_name);
            }
            $this->session->set_flashdata('errormsg', 'Imagem de tópico não enviada ou formato não suportado. Tente novamente!');
            $this->index();
            return;
        }
        
        $base64_image = $this->input->post('video_cover');
        $this->load->library('wideimage/lib/WideImage');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_large = IMAGES_PATH . 'architect/video/';
            $sanitize_title = simple_filename($title);

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $file_name = $pattern_large . archive_filename($pattern_large, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_large = $image->resize(VIDEO_W, VIDEO_H, 'outside')->crop('center', 'middle', VIDEO_W, VIDEO_H);
            $image_large->saveToFile($file_name, 90);

            $data['video_cover'] = $file_name;

            @unlink($upload_name);
            if($architect_exists){
                @unlink($architect->video_cover);
            }
        }

        if ($architect_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->architect_model->update($architect->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Arquiteto', 'architect', NULL, 'Atualização da página arquiteto');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->architect_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Arquiteto', 'architect', NULL, 'Cadastro da página arquiteto');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/architect');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title', 'Título', 'strip_tags|trim|required|callback_max_length');
        $this->form_validation->set_rules('advantage_title', 'Título Vantagens', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('topic_title', 'Título tópico', 'strip_tags|trim|required|max_length[80]');
        $this->form_validation->set_rules('video', 'Vídeo', 'strip_tags|trim|max_length[30]');
        $this->form_validation->set_rules('video_title', 'Vídeo', 'strip_tags|trim|max_length[100]');
        return $this->form_validation->run();
    }
    
    public function max_length($value){
        $value = trim(strip_tags($value));
        $this->form_validation->set_message('callback_max_length', 'O campo {field} deve conter no máximo 120 caracteres');
        return strlen($value) > 120 ? FALSE : TRUE;
    }
    
}
