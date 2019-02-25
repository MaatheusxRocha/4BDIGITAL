<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_page extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'partner_page_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('partners')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }

        define('TOP_W', 1920);
        define('TOP_H', 284);

        define('DESK_W', 650);
        define('DESK_H', 236);

        define('MOB_W', 580);
        define('MOB_H', 370);

        define('COMMERCIAL_W', 830);
        define('COMMERCIAL_H', 275);

        define('COMMERCIAL_MOB_W', 580);
        define('COMMERCIAL_MOB_H', 270);

        define('EASY_W', 1180);
        define('EASY_H', 165);

        define('EASY_MOB_W', 578);
        define('EASY_MOB_H', 708);
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
        $partner_page = $this->partner_page_model->get($this->language);
        if ($partner_page->num_rows()) {
            $data['partner_page'] = $partner_page->row();
        }
        $this->_header();
        $this->load->view('admin/partner_page/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            return $this->index();
        }

        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'commercial_description_one' => $this->input->post('commercial_description_one'),
            'commercial_description_two' => $this->input->post('commercial_description_two'),
            'advantage_title' => $this->input->post('advantage_title'),
            'easy_title' => $this->input->post('easy_title'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $partner_page = $this->partner_page_model->get($this->language);
        $partner_page_exists = (bool) $partner_page->num_rows();
        if ($partner_page_exists) {
            $partner_page = $partner_page->row();
        }

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        $this->load->library('wideimage/lib/WideImage');

        $base64_image = $this->input->post('image_top');
        if ($base64_image) {
            $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_image = str_replace(' ', '+', $base64_image);
            $pattern_desktop = IMAGES_PATH . 'partner_page/';
            $sanitize_title = simple_filename('image_top');

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image));

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_desktop = $image->resize(TOP_W, TOP_H, 'outside')->crop('center', 'middle', TOP_W, TOP_H);
            $image_desktop->saveToFile($fileNameDesktop, 90);

            $data['image_top'] = $fileNameDesktop;

            @unlink($upload_name);
            if ($partner_page_exists && $partner_page->image_top) {
                @unlink($partner_page->image_top);
            }
        } elseif (!$partner_page_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem do Topo não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'partner_page/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['image'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($partner_page_exists) {
                @unlink($partner_page->image);
            }
        } elseif (!$partner_page_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem Principal não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        if ($this->upload->do_upload('image_mobile')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'partner_page/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(MOB_W, MOB_H, 'outside')->crop('center', 'middle', MOB_W, MOB_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['image_mobile'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($partner_page_exists) {
                @unlink($partner_page->image_mobile);
            }
        } elseif (!$partner_page_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem Mobile não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        if ($this->upload->do_upload('commercial_image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'partner_page/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(COMMERCIAL_W, COMMERCIAL_H, 'outside')->crop('center', 'middle', COMMERCIAL_W, COMMERCIAL_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['commercial_image'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($partner_page_exists) {
                @unlink($partner_page->commercial_image);
            }
        } elseif (!$partner_page_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem Comercial não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        if ($this->upload->do_upload('commercial_image_mobile')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'partner_page/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(COMMERCIAL_MOB_W, COMMERCIAL_MOB_H, 'outside')->crop('center', 'middle', COMMERCIAL_MOB_W, COMMERCIAL_MOB_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['commercial_image_mobile'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($partner_page_exists) {
                @unlink($partner_page->commercial_image_mobile);
            }
        } elseif (!$partner_page_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem Comercial Mobile não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        if ($this->upload->do_upload('easy_image')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'partner_page/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(EASY_W, EASY_H, 'outside')->crop('center', 'middle', EASY_W, EASY_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['easy_image'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($partner_page_exists) {
                @unlink($partner_page->easy_image);
            }
        } elseif (!$partner_page_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem Facilidade não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        if ($this->upload->do_upload('easy_image_mobile')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'partner_page/';
            $ext = $upload['file_ext'];

            $fileNameDesktop = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(EASY_MOB_W, EASY_MOB_H, 'outside')->crop('center', 'middle', EASY_MOB_W, EASY_MOB_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($fileNameDesktop, 90);
            } else {
                $image_desktop->saveToFile($fileNameDesktop);
            }

            $data['easy_image_mobile'] = $fileNameDesktop;

            @unlink($upload['full_path']);
            if ($partner_page_exists) {
                @unlink($partner_page->easy_image_mobile);
            }
        } elseif (!$partner_page_exists) {
            $this->session->set_flashdata('errormsg', 'Imagem Facilidade Mobile não enviada');//'Imagem "On-Demand" não enviada ou formato não suportado!');
            return $this->index();
        }

        if ($partner_page_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->partner_page_model->update($partner_page->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área "Página Parceiros"', 'partner_page', NULL, 'Atualização da Página Parceiros');
                $this->session->set_flashdata('successmsg', 'Página Parceiros atualizada com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->partner_page_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área "Página Parceiros"', 'partner_page', NULL, 'Cadastro da Página Parceiros');
                $this->session->set_flashdata('successmsg', 'Página Parceiros cadastrada com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/partner_page');
    }

    private function _form_validation() {
        $this->form_validation->set_message('required_html', 'O campo {field} é obrigatório');
        $this->form_validation->set_message('max_length_html', 'O campo {field} aceita no máximo {param} caracteres');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title', 'Título', 'trim|callback_required_html|callback_max_length_html[100]');
        $this->form_validation->set_rules('description', 'Descrição', 'trim|callback_required_html');
        $this->form_validation->set_rules('commercial_description_one', 'Comercial Cinza', 'strip_tags|trim|required|max_length[200]');
        $this->form_validation->set_rules('commercial_description_two', 'Comercial Vermelho', 'strip_tags|trim|required|max_length[200]');
        $this->form_validation->set_rules('advantage_title', 'Título Vantagens', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('easy_title', 'Título Facilidade', 'strip_tags|trim|required|max_length[100]');
        return $this->form_validation->run();
    }

    public function required_html($text) {
        return (bool) trim(strip_tags($text));
    }

    public function max_length_html($text, $size) {
        return strlen(trim(strip_tags($text))) <= $size;
    }

}
