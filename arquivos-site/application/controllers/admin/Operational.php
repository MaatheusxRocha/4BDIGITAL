<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operational extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'operational_model', 'log_modification_model'));
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
        $data = array(
            'op' => 'save',
            'operationals' => $this->operational_model->get()->result(),
        );
        $this->_header();
        $this->load->view('admin/operational/crud', $data);
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
            'price_month' => $price_month,
            'price_hour' => number_format(($price_month / 720), 6),
            'status' => TRUE,
            'position' => $this->operational_model->get_max_position() + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($id = $this->operational_model->save($data, TRUE)) {
            $this->session->set_flashdata('successmsg', 'Sistema operacional cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Sistema Operacional', 'operational', $id, "Cadastro do sistema \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/operational');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/operational');
        }

        $operational = $this->operational_model->get($id);
        if (!$operational->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/operational');
        }

        $data = array(
            'op' => 'update',
            'operationals' => $this->operational_model->get()->result(),
            'operational' => $operational->row(),
        );
        $this->_header();
        $this->load->view('admin/operational/crud', $data);
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
            redirect('admin/operational');
        }

        $operational = $this->operational_model->get($id);
        if (!$operational->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/operational');
        }
        $operational = $operational->row();

        $name = $this->input->post('name');
        $price_month = money_american($this->input->post('price_month'));
        $data = array(
            'name' => $name,
            'price_month' => $price_month,
            'price_hour' => number_format(($price_month / 720), 6),
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->operational_model->update($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Velocidade', 'operational', $id, "Atualização da velocidade \"$name\"");
            $this->session->set_flashdata('successmsg', 'Velocidade atualizada com sucesso!');
            redirect('admin/operational');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/operational');
        }

        $operational = $this->operational_model->get($id);
        if (!$operational->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/operational');
        }
        $operational = $operational->row();

        if ($this->operational_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Sistema operacional excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Sistema Operacional', 'operational', $id, "Exclusão do sistema \"$operational->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o sistema operacional!');
        }
        redirect('admin/operational');
    }
    
    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/operational');
        }

        $operational = $this->operational_model->get($id);
        if (!$operational->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/operational');
        }
        $operational = $operational->row();

        $data = array(
            'status' => !$operational->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->operational_model->update($operational->id, $data);

        if ($operational->status) {
            $this->log_modification_model->save_log('desativação', 'Área Sistema Operacional', 'operational', $id, "Desativação do sistema \"$operational->name\"");
            $this->session->set_flashdata('successmsg', 'O sistema operacional foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Sistema Operacional', 'operational', $id, "Ativação do sistema \"$operational->name\"");
            $this->session->set_flashdata('successmsg', 'O sistema operacional foi ativado com sucesso');
        }
        redirect('admin/operational');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('price_month', 'Valor Mensal', 'trim|required');
        return $this->form_validation->run();
    }
    
    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->operational_model->get($id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->operational_model->update($id, $data);
    }

}
