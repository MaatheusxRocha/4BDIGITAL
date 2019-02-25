<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'proposal_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('prices')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }
        define('DESK_W', '120');
        define('DESK_H', '120');
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
        $proposal = $this->proposal_model->get($this->language);
        if ($proposal->num_rows()) {
            $data['proposal'] = $proposal->row();
        }
        $this->_header();
        $this->load->view('admin/proposal/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }
        $data = array(
            'title' => $this->input->post('title'),
            'subtitle' => $this->input->post('subtitle'),
            'name' => $this->input->post('name'),
            'job' => $this->input->post('job'),
            'description' => $this->input->post('description'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );
        $proposal = $this->proposal_model->get($this->language);
        $proposal_exists = (bool) $proposal->num_rows();
        if ($proposal_exists) {
            $proposal = $proposal->row();
        }
        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('image_signature')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'signature/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(DESK_W, DESK_H, 'outside')->crop('center', 'middle', DESK_W, DESK_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['image_signature'] = $file_name;

            @unlink($upload['full_path']);
            if ($proposal_exists) {
                @unlink($proposal->image_signature);
            }
        }
        
        if ($proposal_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->proposal_model->update($proposal->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Proposta', 'proposal', NULL, 'Atualização dos textos da proposta');
                $this->session->set_flashdata('successmsg', 'Textos atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->proposal_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Proposta', 'proposal', NULL, 'Cadastro dos textos da proposta');
                $this->session->set_flashdata('successmsg', 'Textos cadastrados com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/proposal');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('title', 'Título', 'strip_tags|trim|required|max_length[30]');
        $this->form_validation->set_rules('subtitle', 'Sub-título', 'trim|required');
        $this->form_validation->set_rules('description', 'Descrição', 'trim|required');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('job', 'Cargo', 'strip_tags|trim|required|max_length[100]');
        return $this->form_validation->run();
    }
    
}
