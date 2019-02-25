<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model', 'configuration_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
        }
        if (!$this->permission_model->get_permission_user('configuration')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        $this->language = $this->session->userdata('language');
        if(empty($this->language)){
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
        $data = array();
        $configuration = $this->configuration_model->get($this->language);
        if ($configuration->num_rows()) {
            $data['configuration'] = $configuration->row();
        }
        $this->_header();
        $this->load->view('admin/configuration/crud', $data);
        $this->_footer();
    }

    public function save() {
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index();
            return;
        }

        $data = array(
            'name' => $this->input->post('name'),
            'cep' => $this->input->post('cep'),
            'address' => $this->input->post('address'),
            'district' => $this->input->post('district'),
            'city' => $this->input->post('city'),
            'uf' => $this->input->post('uf'),
            'phone' => $this->input->post('phone'),
            'contacts' => $this->input->post('contacts'),
            'email' => $this->input->post('email'),
            'twitter' => $this->input->post('twitter'),
            'facebook' => $this->input->post('facebook'),
            'youtube' => $this->input->post('youtube'),
            'instagram' => $this->input->post('instagram'),
            'linkedin' => $this->input->post('linkedin'),
            'google_plus' => $this->input->post('google_plus'),
            'link_maps' => $this->input->post('link_maps'),
            'link_entry' => $this->input->post('link_entry'),
            'link_blog' => $this->input->post('link_blog'),
            'link_new_account' => $this->input->post('link_new_account'),
            'link_wiki' => $this->input->post('link_wiki'),
            'link_portal' => $this->input->post('link_portal'),
            'attendance' => $this->input->post('attendance'),
            'cnpj' => $this->input->post('cnpj'),
            'user_id' => $this->current_user->user()->id,
            'language_id' => $this->language
        );

        $configuration = $this->configuration_model->get($this->language);
        $configuration_exists = (bool) $configuration->num_rows();
        if ($configuration_exists) {
            $configuration = $configuration->row();
        }

        if ($configuration_exists) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($this->configuration_model->update($configuration->id, $data)) {
                $this->log_modification_model->save_log('atualização', 'Área Configurações', 'configuration', NULL, 'Atualização das configurações');
                $this->session->set_flashdata('successmsg', 'Configurações atualizadas com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao atualizar. Tente novamente!');
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->configuration_model->save($data)) {
                $this->log_modification_model->save_log('cadastro', 'Área Configurações', 'configuration', NULL, 'Cadastro das configurações');
                $this->session->set_flashdata('successmsg', 'Configurações cadastradas com sucesso!');
            } else {
                $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
            }
        }
        redirect('admin/configuration');
    }

    private function _form_validation() {
        $this->form_validation->set_message('valid_cnpj', 'O cnpj informado não é válido');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('name', 'Nome', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('email', 'E-mail', 'strip_tags|trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telefone', 'strip_tags|trim|required|max_length[14]|min_length[13]');
        $this->form_validation->set_rules('contacts', 'Contatos', 'strip_tags|trim');
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'strip_tags|trim|exact_length[18]|callback_valid_cnpj');
        $this->form_validation->set_rules('cep', 'CEP', 'strip_tags|trim|required|max_length[10]');
        $this->form_validation->set_rules('address', 'Endereço', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('district', 'Bairro', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('city', 'Cidade', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('uf', 'Estado', 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('twitter', 'Snapchat', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('facebook', 'Facebook', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('youtube', 'YouTube', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('instagram', 'Instagram', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('linkedin', 'Linkedin', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('google_plus', 'Google+', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('link_maps', 'Link Google Maps', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('link_entry', 'Link "Entrar"', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('link_blog', 'Link Blog', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('link_new_account', 'Link "Crie uma Conta"', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('link_wiki', 'Link Wiki', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('link_portal', 'Link Portal', 'strip_tags|trim|valid_url');
        $this->form_validation->set_rules('attendance', 'Horário de atendimento', 'trim|max_length[200]');
        $this->form_validation->set_rules('privacy', 'Política de Privacidade', 'trim');
        return $this->form_validation->run();
    }

    public function valid_cnpj($cnpj) {
        return !$cnpj || validate_cnpj($cnpj);
    }

}
