<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'case_model', 'log_modification_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('cases')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
            $this->language = 1;
        }
        define('LOGO_W', '540');
        define('LOGO_H', '540');
        define('PERSON_W', '540');
        define('PERSON_H', '540');
        define('ENTERPRISE_W', '1152');
        define('ENTERPRISE_H', '546');
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
            'cases' => $this->case_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/cases/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            $this->index();
            return;
        }
        
        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'description' => $this->input->post('description'),
            'status' => FALSE,
            'position' => $this->case_model->get_max_position($this->language) + 1,
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

        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('image_logo')) {
            $upload = $this->upload->data();
            $pattern_logo = IMAGES_PATH . 'cases/logo/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_logo . archive_filename($pattern_logo, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(LOGO_W, LOGO_H, 'outside')->crop('center', 'middle', LOGO_W, LOGO_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['image_logo'] = $file_name;

            @unlink($upload['full_path']);
        } else {
            //log_message('error', json_encode($this->upload->display_errors()));
            $this->session->set_flashdata('errormsg', 'Imagem de logo não enviada ou formato não suportado. Tente novamente!');
            $this->index();
            return;
        }

        $base64_image_enterprise = $this->input->post('image_enterprise');
        $this->load->library('wideimage/lib/WideImage');
        if ($base64_image_enterprise) {
            $base64_image_enterprise = substr($base64_image_enterprise, strpos($base64_image_enterprise, ',') + 1);
            $base64_image_enterprise = str_replace(' ', '+', $base64_image_enterprise);
            $pattern_enterprise = IMAGES_PATH . 'cases/enterprise/';
            $sanitize_title = simple_filename($name);

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image_enterprise));

            $file_name_enterprise = $pattern_enterprise . archive_filename($pattern_enterprise, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_enterprise = $image->resize(ENTERPRISE_W, ENTERPRISE_H, 'outside')->crop('center', 'middle', ENTERPRISE_W, ENTERPRISE_H);
            $image_enterprise->saveToFile($file_name_enterprise, 90);

            $data['image_enterprise'] = $file_name_enterprise;
            @unlink($upload_name);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem de empresa não enviada ou formato não suportado!');
        }
        
        $base64_image_person = $this->input->post('image_person');
        $this->load->library('wideimage/lib/WideImage');
        if ($base64_image_person) {
            $base64_image_person = substr($base64_image_person, strpos($base64_image_person, ',') + 1);
            $base64_image_person = str_replace(' ', '+', $base64_image_person);
            $pattern_person = IMAGES_PATH . 'cases/person/';
            $sanitize_title = simple_filename($name);

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image_person));

            $file_name_person = $pattern_person . archive_filename($pattern_person, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_person = $image->resize(PERSON_W, PERSON_H, 'outside')->crop('center', 'middle', PERSON_W, PERSON_H);
            $image_person->saveToFile($file_name_person, 90);

            $data['image_person'] = $file_name_person;
            @unlink($upload_name);
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem da pessoa não enviada ou formato não suportado!');
        }
        

        if ($id = $this->case_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Case cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Cases', 'case', $id, "Cadastro do case \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/cases');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/cases');
        }
        
        $case = $this->case_model->get($this->language, $id);
        if (!$case->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/cases');
        }
        
        $data = array(
            'op' => 'update',
            'cases' => $this->case_model->get($this->language)->result(),
            'case' => $case->row(),
        );
        $this->_header();
        $this->load->view('admin/cases/crud', $data);
        $this->_footer();
    }

    public function update() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, verifique as informações!');
            $id = $this->input->post('id');
            $this->edit($id);
            return;
        }
        
        $id = $this->input->post('id');
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/cases');
        }
        
        $case = $this->case_model->get($this->language, $id);
        if (!$case->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/cases');
        }
        $case = $case->row();

        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
            'description' => $this->input->post('description'),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));

        $this->load->library('wideimage/lib/WideImage');
        if ($this->upload->do_upload('image_logo')) {
            $upload = $this->upload->data();
            $pattern_logo = IMAGES_PATH . 'cases/logo/';
            $ext = $upload['file_ext'];

            $file_name = $pattern_logo . archive_filename($pattern_logo, $ext, $upload['raw_name']);

            $image = WideImage::load($upload['full_path']);

            $image_desktop = $image->resize(LOGO_W, LOGO_H, 'outside')->crop('center', 'middle', LOGO_W, LOGO_H);
            if ($ext == '.jpg' || $ext == '.jpeg') {
                $image_desktop->saveToFile($file_name, 90);
            } else {
                $image_desktop->saveToFile($file_name);
            }

            $data['image_logo'] = $file_name;

            @unlink($upload['full_path']);
            @unlink($case->image_logo);
        } else {
            //log_message('error', 'update - '.json_encode($this->upload->display_errors()));
            $this->session->set_flashdata('infomsg', 'Imagem de logo não enviada ou formato não suportado. A antiga permanece!');
        }

        $base64_image_enterprise = $this->input->post('image_enterprise');
        $this->load->library('wideimage/lib/WideImage');
        if ($base64_image_enterprise) {
            $base64_image_enterprise = substr($base64_image_enterprise, strpos($base64_image_enterprise, ',') + 1);
            $base64_image_enterprise = str_replace(' ', '+', $base64_image_enterprise);
            $pattern_enterprise = IMAGES_PATH . 'cases/enterprise/';
            $sanitize_title = simple_filename($name);

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image_enterprise));

            $file_name_enterprise = $pattern_enterprise . archive_filename($pattern_enterprise, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_enterprise = $image->resize(ENTERPRISE_W, ENTERPRISE_H, 'outside')->crop('center', 'middle', ENTERPRISE_W, ENTERPRISE_H);
            $image_enterprise->saveToFile($file_name_enterprise, 90);

            $data['image_enterprise'] = $file_name_enterprise;
            @unlink($upload_name);
            if(!empty($case->image_enterprise)){
                @unlink($case->image_enterprise);
            }
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem de empresa não enviada ou formato não suportado!');
        }
        
        $base64_image_person = $this->input->post('image_person');
        $this->load->library('wideimage/lib/WideImage');
        if ($base64_image_person) {
            $base64_image_person = substr($base64_image_person, strpos($base64_image_person, ',') + 1);
            $base64_image_person = str_replace(' ', '+', $base64_image_person);
            $pattern_person = IMAGES_PATH . 'cases/person/';
            $sanitize_title = simple_filename($name);

            $upload_name = UPLOAD_PATH . archive_filename(UPLOAD_PATH, '.jpg', $sanitize_title);
            file_put_contents($upload_name, base64_decode($base64_image_person));

            $file_name_person = $pattern_person . archive_filename($pattern_person, '.jpg', $sanitize_title);

            $image = WideImage::load($upload_name);
            $image_person = $image->resize(PERSON_W, PERSON_H, 'outside')->crop('center', 'middle', PERSON_W, PERSON_H);
            $image_person->saveToFile($file_name_person, 90);

            $data['image_person'] = $file_name_person;
            @unlink($upload_name);
            if(!empty($case->image_person)){
                @unlink($case->image_person);
            }
        } else {
            $this->session->set_flashdata('infomsg', 'Imagem da pessoa não enviada ou formato não suportado!');
        }

        if ($this->case_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Cases', 'case', $id, "Atualização do case \"$name\"");
            $this->session->set_flashdata('successmsg', 'Case atualizado com sucesso!');
            redirect('admin/cases');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/case');
        }
        
        $case = $this->case_model->get($this->language, $id);
        if (!$case->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/case');
        }
        $case = $case->row();
        
        $data = array(
            'status' => !$case->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->case_model->update($case->id, $data);
        
        if ($case->status) {
            $this->log_modification_model->save_log('desativação', 'Área Cases', 'case', $id, "Desativação do case \"$case->name\"");
            $this->session->set_flashdata('successmsg', 'O case foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Cases', 'case', $id, "Ativação do case \"$case->name\"");
            $this->session->set_flashdata('successmsg', 'O case foi ativado com sucesso');
        }
        redirect('admin/cases');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/cases');
        }
        
        $case = $this->case_model->get($this->language, $id);
        if (!$case->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/cases');
        }
        $case = $case->row();
        
        if ($this->case_model->delete($id)) {
            @unlink($case->image_logo);
            @unlink($case->image_enterprise);
            @unlink($case->image_person);
            $this->session->set_flashdata('successmsg', 'Case excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Cases', 'case', $id, "Exclusão do case \"$case->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o case!');
        }
        redirect('admin/cases');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('description', 'Descrição', 'trim|required');
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->case_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->case_model->update($id, $data);
    }

}
