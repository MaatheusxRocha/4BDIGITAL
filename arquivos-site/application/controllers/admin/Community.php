<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Community extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'community_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('community')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }

        define('VIDEO_W', 1280);
        define('VIDEO_H', 720);
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
        $community = $this->community_model->get($this->language);
        if ($community->num_rows()) {
            $data['community'] = $community->row();
        }
        $this->_header();
        $this->load->view('admin/community/crud', $data);
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
            'subtitle' => $this->input->post('subtitle'),
            'video_text' => $this->input->post('video_text'),
            'video' => $this->input->post('video'),
            'blog_text' => $this->input->post('blog_text'),
            'wiki_text' => $this->input->post('wiki_text'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $community = $this->community_model->get($this->language);
        $community_exists = (bool) $community->num_rows();
        if ($community_exists) {
            $community = $community->row();
        }

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        $this->load->library('wideimage/lib/WideImage');

        $base64_image = $this->input->post('video_cover');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'community/';
            $sanitize_title = simple_filename('community_video_cover');

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(VIDEO_W, VIDEO_H, 'outside')->crop('center', 'middle', VIDEO_W, VIDEO_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['video_cover'] = $fileNameDesktop;
            @unlink($upload_name);
            if ($community_exists && $community->video_cover) {
                @unlink($community->video_cover);
            }
        }

        if ($community_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->community_model->update($community->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Comunidade', 'community', NULL, 'Atualização da página "Comunidade"');
                $this->session->set_flashdata('successmsg', 'Comunidade atualizada com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->community_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Comunidade', 'community', NULL, 'Cadastro da página "Comunidade"');
                $this->session->set_flashdata('successmsg', 'Comunidade cadastrada com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/community');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title_one', 'Título Cinza', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('title_two', 'Título Vermelho', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('subtitle', 'Subtítulo', 'strip_tags|trim|required');
        $this->form_validation->set_rules('video_text', 'Texto do Vídeo', 'strip_tags|trim|max_length[70]');
        $this->form_validation->set_rules('video', 'Código do Vídeo', 'strip_tags|trim|max_length[30]');
        $this->form_validation->set_rules('blog_text', 'Texto "Blog"', 'strip_tags|trim|max_length[130]');
        $this->form_validation->set_rules('wiki_text', 'Texto "Wiki"', 'strip_tags|trim|max_length[130]');
        return $this->form_validation->run();
    }

}
