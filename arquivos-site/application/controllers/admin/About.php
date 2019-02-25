<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'about_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
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

        define('BRASCLOUD_W', 690);
        define('BRASCLOUD_H', 435);

        define('DEMAND_W', 331);
        define('DEMAND_H', 172);

        define('INFRASTRUCTURE_W', 495);
        define('INFRASTRUCTURE_H', 743);

        define('DIFFERENT_W', 779);
        define('DIFFERENT_H', 435);

        define('VIDEO_W', 1280);
        define('VIDEO_H', 720);

        define('VPC_LEFT_W', 600);
        define('VPC_LEFT_H', 680);

        define('VPC_RIGHT_W', 620);
        define('VPC_RIGHT_H', 535);
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
        $about = $this->about_model->get($this->language);
        if ($about->num_rows()) {
            $data['about'] = $about->row();
        }
        $this->_header();
        $this->load->view('admin/about/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            return $this->index();
        }

        $data = array(
            'text_brascloud' => $this->input->post('text_brascloud'),
            'text_box_red' => $this->input->post('text_box_red'),
            'title_vision' => $this->input->post('title_vision'),
            'vision' => $this->input->post('vision'),
            'title_mission' => $this->input->post('title_mission'),
            'mission' => $this->input->post('mission'),
            'on_demand_title' => $this->input->post('on_demand_title'),
            'on_demand_text' => $this->input->post('on_demand_text'),
            'believe_title' => $this->input->post('believe_title'),
            'believe_text' => $this->input->post('believe_text'),
            'infrastructure_title' => $this->input->post('infrastructure_title'),
            'infrastructure_text' => $this->input->post('infrastructure_text'),
            'different_title' => $this->input->post('different_title'),
            'different_text' => $this->input->post('different_text'),
            'video_title' => $this->input->post('video_title'),
            'video' => $this->input->post('video'),
            'video_text_one' => $this->input->post('video_text_one'),
            'video_text_two' => $this->input->post('video_text_two'),
            'vpc_title' => $this->input->post('vpc_title'),
            'vpc_text' => $this->input->post('vpc_text'),
            'title_partner' => $this->input->post('title_partner'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $about = $this->about_model->get($this->language);
        $about_exists = (bool) $about->num_rows();
        if ($about_exists) {
            $about = $about->row();
        }

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        $this->load->library('wideimage/lib/WideImage');

        $base64_image = $this->input->post('image_brascloud');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'about/';
            $sanitize_title = simple_filename('image_brascloud');

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(BRASCLOUD_W, BRASCLOUD_H, 'outside')->crop('center', 'middle', BRASCLOUD_W, BRASCLOUD_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['image_brascloud'] = $fileNameDesktop;

            @unlink($upload_name);
            if ($about_exists && $about->image_brascloud) {
                @unlink($about->image_brascloud);
            }
        }

        if ($this->upload->do_upload('on_demand_image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'about/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(DEMAND_W, DEMAND_H, 'outside')->crop('center', 'middle', DEMAND_W, DEMAND_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['on_demand_image'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($about_exists) {
                @unlink($about->on_demand_image);
            }
        } elseif (!$about_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem "On-Demand" não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        $base64_image = $this->input->post('infrastructure_image');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'about/';
            $sanitize_title = simple_filename('infrastructure_image');

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(INFRASTRUCTURE_W, INFRASTRUCTURE_H, 'outside')->crop('center', 'middle', INFRASTRUCTURE_W, INFRASTRUCTURE_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['infrastructure_image'] = $fileNameDesktop;

            @unlink($upload_name);
            if ($about_exists && $about->infrastructure_image) {
                @unlink($about->infrastructure_image);
            }
        } elseif (!$about_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem "Infraestrutura" não enviada ou formato não suportado!');
            return $this->index();
        }

        $base64_image = $this->input->post('different_image');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'about/';
            $sanitize_title = simple_filename('different_image');

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(DIFFERENT_W, DIFFERENT_H, 'outside')->crop('center', 'middle', DIFFERENT_W, DIFFERENT_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['different_image'] = $fileNameDesktop;

            @unlink($upload_name);
            if ($about_exists && $about->different_image) {
                @unlink($about->different_image);
            }
        } elseif (!$about_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem "Infraestrutura" não enviada ou formato não suportado!');
            return $this->index();
        }

        $base64_image = $this->input->post('video_cover');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'about/';
            $sanitize_title = simple_filename('video_cover');

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(VIDEO_W, VIDEO_H, 'outside')->crop('center', 'middle', VIDEO_W, VIDEO_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['video_cover'] = $fileNameDesktop;

            @unlink($upload_name);
            if ($about_exists && $about->video_cover) {
                @unlink($about->video_cover);
            }
        }

        if ($this->upload->do_upload('vpc_image_left')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'about/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(VPC_LEFT_W, VPC_LEFT_H, 'outside')->crop('center', 'middle', VPC_LEFT_W, VPC_LEFT_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['vpc_image_left'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($about_exists && $about->vpc_image_left) {
                @unlink($about->vpc_image_left);
            }
        }

        if ($this->upload->do_upload('vpc_image_right')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'about/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(VPC_RIGHT_W, VPC_RIGHT_H, 'outside')->crop('center', 'middle', VPC_RIGHT_W, VPC_RIGHT_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['vpc_image_right'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($about_exists && $about->vpc_image_right) {
                @unlink($about->vpc_image_right);
            }
        }

        if ($about_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->about_model->update($about->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Configurações', 'about', NULL, 'Atualização das configurações');
                $this->session->set_flashdata('successmsg', 'Configurações atualizadas com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->about_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Configurações', 'about', NULL, 'Cadastro das configurações');
                $this->session->set_flashdata('successmsg', 'Configurações cadastradas com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/about');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_html', 'O campo {field} é obrigatório');
        $this->form_validation->set_message('max_length_html', 'O campo {field} aceita no máximo {param} caracteres');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('text_brascloud', 'Texto "A BRASCLOUD"', 'trim|callback_required_html');
        $this->form_validation->set_rules('text_box_red', 'Texto caixa vermelha', 'trim|callback_required_html');
        $this->form_validation->set_rules('title_vision', 'Título "Nossa Visão"', 'strip_tags|trim|required|max_length[15]');
        $this->form_validation->set_rules('vision', 'Visão', 'strip_tags|trim|required|max_length[200]');
        $this->form_validation->set_rules('title_mission', 'Título "Nossa Missão"', 'strip_tags|trim|required|max_length[15]');
        $this->form_validation->set_rules('mission', 'Missão', 'strip_tags|trim|required|max_length[200]');
        $this->form_validation->set_rules('on_demand_title', 'Título "On-Demand"', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('on_demand_text', 'Texto "On-Demand"', 'strip_tags|trim|required|max_length[140]');
        $this->form_validation->set_rules('believe_title', 'Título "No que acreditamos"', 'strip_tags|trim|required|max_length[30]');
        $this->form_validation->set_rules('believe_text', 'Texto "No que acreditamos"', 'trim|callback_required_html');
        $this->form_validation->set_rules('infrastructure_title', 'Título Infraestrutura', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('infrastructure_text', 'Texto Infraestrutura', 'strip_tags|trim|required');
        $this->form_validation->set_rules('different_title', 'Título "Diferenciais"', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('different_text', 'Texto "diferenciais"', 'trim|required');
        $this->form_validation->set_rules('video_title', 'Título do Vídeo', 'trim|callback_max_length_html[100]');
        $this->form_validation->set_rules('video', 'Código do Vídeo', 'strip_tags|trim|max_length[30]');
        $this->form_validation->set_rules('video_text_one', 'Vídeo - Primeiro texto', 'strip_tags|trim|max_length[100]');
        $this->form_validation->set_rules('video_text_two', 'Vídeo - Segundo texto', 'strip_tags|trim|max_length[100]');
        $this->form_validation->set_rules('vpc_title', 'Título VPC', 'strip_tags|trim|max_length[100]');
        $this->form_validation->set_rules('vpc_text', 'Texto VPC', 'trim');
        $this->form_validation->set_rules('title_partner', 'Título "Parceiros"', 'strip_tags|trim|required|max_length[100]');
        return $this->form_validation->run();
    }

    public function required_html($text) {
        return (bool) trim(strip_tags($text));
    }

    public function max_length_html($text, $size) {
        return strlen(trim(strip_tags($text))) <= $size;
    }

}
