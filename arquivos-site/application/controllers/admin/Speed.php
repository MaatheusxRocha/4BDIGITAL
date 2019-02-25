<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Speed extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'speed_model', 'log_modification_model','config_model'));
        $this->load->library(array('encrypt', 'simple_encrypt', 'form_validation'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('prices')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if (empty($this->language)) {
            $this->language = 1;
        }
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
        $configs = $this->config_model->get($this->language);
        if (!$configs->num_rows()) {
            $this->session->set_flashdata('errormsg', 'É necessário cadastrar ao menos um item!');
            redirect('admin/config');
        }
        $combo_config[''] = 'Selecione...';
        foreach ($configs->result() as $c) {
            $combo_config[$c->id] = $c->name;
        }
        $data = array(
            'op' => 'save',
            'configs' => $combo_config,
            'speeds' => $this->speed_model->get($this->language)->result(),
        );
        $this->_header();
        $this->load->view('admin/speed/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            $this->index();
            return;
        }

        $name = $this->input->post('name');
        $price_month = money_american($this->input->post('price_month'));
        $data = array(
            'name' => $name,
            'frequency' => money_american($this->input->post('frequency')),
            'price_month' => $price_month,
            'price_hour' => number_format(($price_month / 720), 3),
            'created_at' => date('Y-m-d H:i:s'),
            'config_id' => $this->input->post('config'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        if ($id = $this->speed_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Velocidade cadastrada com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Velocidade', 'speed', $id, "Cadastro da velocidade \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/speed');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/speed');
        }

        $speed = $this->speed_model->get($this->language, $id);
        if (!$speed->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/speed');
        }
        $configs = $this->config_model->get($this->language);
        if (!$configs->num_rows()) {
            $this->session->set_flashdata('errormsg', 'É necessário cadastrar ao menos um item!');
            redirect('admin/config');
        }
        $combo_config[''] = 'Selecione...';
        foreach ($configs->result() as $c) {
            $combo_config[$c->id] = $c->name;
        }
        $data = array(
            'op' => 'update',
            'configs' => $combo_config,
            'speeds' => $this->speed_model->get($this->language)->result(),
            'speed' => $speed->row(),
        );
        $this->_header();
        $this->load->view('admin/speed/crud', $data);
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
            redirect('admin/speed');
        }

        $speed = $this->speed_model->get($this->language, $id);
        if (!$speed->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/speed');
        }
        $speed = $speed->row();

        $name = $this->input->post('name');
        $price_month = money_american($this->input->post('price_month'));
        $data = array(
            'name' => $name,
            'frequency' => money_american($this->input->post('frequency')),
            'price_month' => $price_month,
            'price_hour' => number_format(($price_month / 720), 6),
            'config_id' => $this->input->post('config'),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->speed_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Velocidade', 'speed', $id, "Atualização da velocidade \"$name\"");
            $this->session->set_flashdata('successmsg', 'Velocidade atualizada com sucesso!');
            redirect('admin/speed');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/speed');
        }

        $speed = $this->speed_model->get($this->language, $id);
        if (!$speed->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/speed');
        }
        $speed = $speed->row();

        if ($this->speed_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Velocidade excluída com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Velocidade', 'speed', $id, "Exclusão da velocidade \"$speed->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir a velocidade!');
        }
        redirect('admin/speed');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('frequency', 'Frequência', 'trim|required|max_length[3]');
        $this->form_validation->set_rules('price_month', 'Valor Mensal', 'trim|required');
        $this->form_validation->set_rules('config', 'Item de Configuração', 'strip_tags|trim|required');
        return $this->form_validation->run();
    }

}
