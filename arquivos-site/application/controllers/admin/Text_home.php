<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Text_home extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'text_home_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
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
        define('DESK_W', '500');
        define('DESK_H', '282');
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
        $text_home = $this->text_home_model->get($this->language);
        if ($text_home->num_rows()) {
            $data['text_home'] = $text_home->row();
        }
        $this->_header();
        $this->load->view('admin/text_home/crud', $data);
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
            'title_plans' => $this->input->post('title_plans'),
            'title_rules' => $this->input->post('title_rules'),
            'transfer' => $this->input->post('transfer'),
            'text_ticketing' => $this->input->post('text_ticketing'),
            'text_billing' => $this->input->post('text_billing'),
            'title_why_choose' => $this->input->post('title_why_choose'),
            'text_video' => $this->input->post('text_video'),
            'video' => $video,
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $text_home = $this->text_home_model->get($this->language);
        $text_home_exists = (bool) $text_home->num_rows();
        if ($text_home_exists) {
            $text_home = $text_home->row();
        }

        $base64_image = $this->input->post('image');
        $this->load->library('wideimage/lib/WideImage');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_large = IMAGES_PATH . 'home/video/';
            $sanitize_title = simple_filename('video_'.$video);

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $file_name = $pattern_large . archive_filename($pattern_large, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_large = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            $image_large->saveToFile($file_name, 90);

            $data['cover'] = $file_name;

            @unlink($upload_name);
            if($text_home_exists){
                @unlink($text_home->cover);
            }
        }

        if ($text_home_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->text_home_model->update($text_home->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Texto Home', 'text_home', NULL, 'Atualização dos textos da home');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->text_home_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Texto Home', 'text_home', NULL, 'Cadastro dos textos da home');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/text_home');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_html', 'O campo {field} é obrigatório');
        $this->form_validation->set_message('max_length_html', 'O campo {field} aceita no máximo {param} caracteres');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title_plans', 'Titulo Planos', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('title_rules', 'Titulo Simular', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('transfer', 'Transferência', 'strip_tags|trim|required|max_length[10]');
        $this->form_validation->set_rules('text_billing', 'Texto Billing', 'strip_tags|trim|required|max_length[55]');
        $this->form_validation->set_rules('title_why_choose', 'Título "Por que escolher"', 'trim|callback_required_html|callback_max_length_html[100]');
        $this->form_validation->set_rules('text_ticketing', 'Título "Como bilhetamos"', 'trim|callback_required_html');
        $this->form_validation->set_rules('video', 'Vídeo', 'strip_tags|trim|max_length[30]');
        $this->form_validation->set_rules('text_video', 'Vídeo', 'strip_tags|trim|max_length[55]');
        return $this->form_validation->run();
    }


    public function required_html($text) {
        return (bool) trim(strip_tags($text));
    }

    public function max_length_html($text, $size) {
        return strlen(trim(strip_tags($text))) <= $size;
    }

}
