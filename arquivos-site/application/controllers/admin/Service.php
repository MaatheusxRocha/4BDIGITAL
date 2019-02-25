<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'service_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('services')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }
        define('DESK_W', '1180');
        define('DESK_H', '236');
        define('MOB_W', '800');
        define('MOB_H', '400');
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
        $service = $this->service_model->get($this->language);
        if ($service->num_rows()) {
            $data['service'] = $service->row();
        }
        $this->_header();
        $this->load->view('admin/service/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        $video = $this->input->post('video');
        $data = array(
            'title_one' => $this->input->post('title_one'),
            'title_two' => $this->input->post('title_two'),
            'subtitle' => $this->input->post('subtitle'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $service = $this->service_model->get($this->language);
        $service_exists = (bool) $service->num_rows();
        if ($service_exists) {
            $service = $service->row();
        }
        
        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));

        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'service/large/';
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
        } else if(!$service_exists){
            $this->session->set_flashdata('errormsg', 'Imagem não enviada ou formato não suportado. Tente novamente!');
            $this->index();
            return;
        }
        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('image_mobile')) {
            $upload = $this->upload->data();
            $pattern_mobile = IMAGES_PATH . 'service/mobile/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_mobile . archive_filename($pattern_mobile, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(MOB_W, MOB_H, 'outside')->crop('center', 'middle', MOB_W, MOB_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['image_mobile'] = $file_name;

            @unlink($upload['full_path']);
        } else if(!$service_exists){
            $this->session->set_flashdata('errormsg', 'Imagem mobile não enviada ou formato não suportado. Tente novamente!');
            $this->index();
            return;
        }
        
        if ($service_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->service_model->update($service->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Serviços', 'service', NULL, 'Atualização dos textos do serviço');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->service_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Serviços', 'service', NULL, 'Cadastro dos textos do serviço');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/service');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title_one', 'Titulo 1', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('title_two', 'Titulo 2', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('subtitle', 'subtitle', 'trim|required');
        return $this->form_validation->run();
    }
    
}
