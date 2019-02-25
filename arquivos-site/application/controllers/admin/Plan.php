<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'plan_model', 'log_modification_model', 'operational_model', 'config_model'));
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
        $operationals = $this->operational_model->get();
        if (!$operationals->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Cadastre ao menos um sistema operacional');
            redirect('admin/operational');
        }
        $data = array(
            'op' => 'save',
            'plans' => $this->plan_model->get($this->language)->result(),
            'operationals' => $operationals->result(),
        );
        $this->_header();
        $this->load->view('admin/plan/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Confira as informações e tente novamente!');
            $this->index();
            return;
        }

        $name = $this->input->post('name');
        $best_seller = $this->input->post('best_seller');
        $data = array(
            'name' => $name,
            'leaf_text' => $this->input->post('leaf_text'),
            'plan_exist_1' => $this->input->post('plan_exist_1'),
            'plan_exist_2' => $this->input->post('plan_exist_2'),
            'best_seller' => $best_seller ? TRUE : FALSE,
            'status' => FALSE,
            'position' => $this->plan_model->get_max_position($this->language) + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        if ($id = $this->plan_model->save($data, TRUE)) {
            $operationals = $this->operational_model->get();
            foreach ($operationals->result() as $so) {
                $price_month = money_american($this->input->post('price_month_' . $so->id));
                $price_month_promotion = money_american($this->input->post('price_month_promotion_' . $so->id));
                $plan_operational = array(
                    'storage' => $this->input->post('storage_' . $so->id),
                    'price_month' => $price_month,
                    'price_month_promotion' => $price_month_promotion,
                    'price_hour' => number_format(($price_month / 720), 6),
                    'price_hour_promotion' => number_format(($price_month_promotion / 720), 6),
                    'created_at' => date('Y-m-d H:i:s'),
                    'user_id' => $this->current_user->user()->id,
                    'plan_id' => $id,
                    'operational_id' => $so->id
                );
                $this->plan_model->save_operational($plan_operational);
            }
            $this->session->set_flashdata('successmsg', 'Plano cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Planos', 'plan', $id, "Cadastro do plano \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/plan');
    }

    public function edit($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }

        $plan = $this->plan_model->get($this->language, $id);
        if (!$plan->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }
        $operationals = $this->operational_model->get()->result();
        foreach ($operationals as $so) {
            $plan_operational = $this->plan_model->get_plan_operational($id, $so->id);
            if ($plan_operational->num_rows()) {
                $so->price_month = $plan_operational->row()->price_month;
                $so->price_hour = $plan_operational->row()->price_hour;
                $so->price_month_promotion = $plan_operational->row()->price_month_promotion;
                $so->price_hour_promotion = $plan_operational->row()->price_hour_promotion;
                $so->storage = $plan_operational->row()->storage;
            } else {
//                $so->price_month = NULL;
//                $so->price_hour = NULL;
                $so->price_month_promotion = NULL;
                $so->price_hour_promotion = NULL;
                $so->storage = NULL;
            }
        }
        $data = array(
            'op' => 'update',
            'plans' => $this->plan_model->get($this->language)->result(),
            'plan' => $plan->row(),
            'operationals' => $operationals
        );
        $this->_header();
        $this->load->view('admin/plan/crud', $data);
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
            redirect('admin/plan');
        }

        $plan = $this->plan_model->get($this->language, $id);
        if (!$plan->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }
        $plan = $plan->row();

        $name = $this->input->post('name');
        $best_seller = $this->input->post('best_seller');
        $data = array(
            'name' => $name,
            'leaf_text' => $this->input->post('leaf_text'),
            'plan_exist_1' => $this->input->post('plan_exist_1'),
            'plan_exist_2' => $this->input->post('plan_exist_2'),
            'best_seller' => $best_seller ? TRUE : FALSE,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );

        if ($this->plan_model->update($id, $data)) {
            $operationals = $this->operational_model->get();
            $this->plan_model->delete_plan($id);
            foreach ($operationals->result() as $so) {
                $price_month = money_american($this->input->post('price_month_' . $so->id));
                $price_month_promotion = money_american($this->input->post('price_month_promotion_' . $so->id));
                $plan_operational = array(
                    'storage' => $this->input->post('storage_' . $so->id),
                    'price_month' => $price_month,
                    'price_month_promotion' => $price_month_promotion,
                    'price_hour' => number_format(($price_month / 720), 6),
                    'price_hour_promotion' => number_format(($price_month_promotion / 720), 6),
                    'created_at' => date('Y-m-d H:i:s'),
                    'user_id' => $this->current_user->user()->id,
                    'plan_id' => $id,
                    'operational_id' => $so->id
                );
                $this->plan_model->save_operational($plan_operational);
            }
            $this->log_modification_model->save_log('atualização', 'Área Planos', 'plan', $id, "Atualização do plano \"$name\"");
            $this->session->set_flashdata('successmsg', 'Plano atualizado com sucesso!');
            redirect('admin/plan');
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit($id);
        }
    }

    public function toggle($id = NULL) {
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/plan');
        }

        $plan = $this->plan_model->get($this->language, $id);
        if (!$plan->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/plan');
        }
        $plan = $plan->row();

        $data = array(
            'status' => !$plan->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->current_user->user()->id,
        );
        $this->plan_model->update($plan->id, $data);

        if ($plan->status) {
            $this->log_modification_model->save_log('desativação', 'Área Planos', 'plan', $id, "Desativação do plano \"$plan->name\"");
            $this->session->set_flashdata('successmsg', 'O plano foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Planos', 'plan', $id, "Ativação do plano \"$plan->name\"");
            $this->session->set_flashdata('successmsg', 'O plano foi ativado com sucesso');
        }
        redirect('admin/plan');
    }

    public function delete($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/plan');
        }

        $plan = $this->plan_model->get($this->language, $id);
        if (!$plan->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }
        $plan = $plan->row();
        $this->plan_model->delete_plan($id);
        $this->plan_model->delete_configs($id);
        if ($this->plan_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Plano excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Planos', 'plan', $id, "Exclusão do plano \"$plan->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir o plano!');
        }
        redirect('admin/plan');
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('leaf_text', 'Texto da Folha', 'strip_tags|trim|max_length[15]');
        $this->form_validation->set_rules('plan_exist_1', 'Plano encontrado (1ª parte)', 'strip_tags|required');
        $this->form_validation->set_rules('plan_exist_2', 'Plano encontrado (2ª parte)', 'strip_tags|required');
        $operationals = $this->operational_model->get();
        foreach ($operationals->result() as $so) {
            $this->form_validation->set_rules('price_month_' . $so->id, 'Valor Mensal - ' . $so->name, 'strip_tags|trim|required');
            $this->form_validation->set_rules('storage_' . $so->id, 'Armazenamento - ' . $so->name, 'strip_tags|trim|is_natural_no_zero');
        }
        return $this->form_validation->run();
    }

    public function update_ordenation() {
        $id = $this->input->post('id');
        $position = $this->input->post('position');
        if (empty($id) || !is_numeric($id) || empty($position) || !is_numeric($position)) {
            echo FALSE;
            return;
        }
        if (!$this->plan_model->get($this->language, $id)->num_rows()) {
            echo FALSE;
            return;
        }
        $data = array(
            'position' => $position,
            'user_id' => $this->current_user->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        echo $this->plan_model->update($id, $data);
    }

    public function config($plan_id = NULL) {
        if (empty($plan_id) || !is_numeric($plan_id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/plan');
        }
        $plan = $this->plan_model->get($this->language, $plan_id);
        if (!$plan->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/plan');
        }
//        $this->session->set_userdata('plan_id', $plan_id);
        $configs = $this->config_model->get($this->language);
        if (!$configs->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Cadastre ao menos um item de configuração');
            redirect('admin/config');
        }
        $combo[''] = 'Selecione...';
        foreach ($configs->result() as $c) {
            $combo[$c->id] = $c->name;
        }
        $data['plan'] = $plan->row();
        $data['configs'] = $combo;
        $data['plan_configs'] = $this->plan_model->get_configs($plan_id)->result();
        $data['op'] = 'save_config';
        $this->_header();
        $this->load->view('admin/plan/config', $data);
        $this->_footer();
    }

    public function save_config() {
        $plan_id = $this->input->post('plan_id');
        $plan = $this->plan_model->get($this->language, $plan_id);
        if (!$plan->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }
        if ($this->_form_validation_config()) {
            $config = array(
                'config_id' => $this->input->post('config'),
                'measure' => $this->input->post('measure'),
                'value' => money_american($this->input->post('value')),
                'plan_id' => $plan_id,
            );
            if ($id = $this->plan_model->save_config($config)) {
                $this->log_modification_model->save_log('cadastro', 'Área Planos', 'plan_config', $id, "Cadastro de configuração no plano \"$plan->name\"");
                $this->session->set_flashdata('successmsg', 'Configuração cadastrada com sucesso');
            } else {
                $this->session->set_flashdata('errormsg', 'Não foi possivel cadastrar a configuração!');
            }
            redirect('admin/plan/config/' . $plan_id);
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possivel cadastrar, confira as informações');
            $this->config($plan_id);
        }
    }

    public function edit_config($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/plan');
        }

        $plan_config = $this->plan_model->get_config($id);
        if (!$plan_config->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }

        $plan = $this->plan_model->get($this->language, $plan_config->row()->plan_id);
        $configs = $this->config_model->get($this->language);
        $combo[''] = 'Selecione...';
        foreach ($configs->result() as $c) {
            $combo[$c->id] = $c->name;
        }
        $data['plan'] = $plan->row();
        $data['op'] = 'update_config';
        $data['configs'] = $combo;
        $data['plan_configs'] = $this->plan_model->get_configs($plan_config->row()->plan_id)->result();
        $data['plan_config'] = $plan_config->row();
        $this->_header();
        $this->load->view('admin/plan/config', $data);
        $this->_footer();
    }

    public function update_config() {
        if (!$this->_form_validation_config()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, verifique as informações!');
            $id = $this->input->post('id');
            $this->edit_config($id);
            return;
        }

        $id = $this->input->post('id');
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }

        $plan_config = $this->plan_model->get_config($id);
        if (!$plan_config->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }
        $plan_config = $plan_config->row();

        $data = array(
            'config_id' => $this->input->post('config'),
            'measure' => $this->input->post('measure'),
            'value' => money_american($this->input->post('value')),
        );

        if ($this->plan_model->update_config($id, $data)) {
            $this->log_modification_model->save_log('atualização', 'Área Planos - Configurações', 'plan_config', $id, "Atualização da configuração \"$plan_config->name\"");
            $this->session->set_flashdata('successmsg', 'Configuração atualizada com sucesso!');
            redirect('admin/plan/config/'.$plan_config->plan_id);
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, tente novamente!');
            $this->edit_config($id);
        }
    }

    public function delete_config($id = NULL) {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/plan');
        }

        $plan_config = $this->plan_model->get_config($id);
        if (!$plan_config->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/plan');
        }
        $plan_config = $plan_config->row();
        if ($this->plan_model->delete_config($id)) {
            $this->session->set_flashdata('successmsg', 'Configuração excluída com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Planos', 'plan_config', $id, "Exclusão da configuração \"$plan_config->name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Não foi possível excluir a configuração!');
        }
        redirect('admin/plan/config/' . $plan_config->plan_id);
    }

    private function _form_validation_config() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('config', 'Item de configuração', 'strip_tags|trim|required');
        $this->form_validation->set_rules('value', 'Valor/Quantidade', 'strip_tags|trim|required');
        $this->form_validation->set_rules('measure', 'Un. Medida', 'strip_tags|trim|required|max_length[5]');
        return $this->form_validation->run();
    }

}
