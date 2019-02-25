<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    private $language;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user', 'log_modification_model'));
        $this->load->library(array('form_validation', 'encrypt', 'simple_encrypt'));
        if (!$this->current_user->user()) {
            redirect('admin/login');
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

    public function index($page = NULL) {
        if (!$this->permission_model->get_permission_user('configuration')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        if (!empty($page) && !is_numeric($page)) {
            $page = NULL;
        }
        $this->session->unset_userdata('user_edit');
        $data = $this->_load_users($page);
        $data['op'] = 'save';
        $data['list'] = TRUE;
        $this->_header();
        $this->load->view('admin/user/crud', $data);
        $this->_footer();
    }

    public function save($page = NULL) {
        if (!$this->permission_model->get_permission_user('configuration')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        
        if (!empty($page) && !is_numeric($page)) {
            $page = NULL;
        }
        
        if (!$this->_form_validation()) {
            $this->session->set_flashdata('errormsg', 'Não foi possível cadastrar, verifique as informações!');
            $this->index($page);
            return;
        }
        
        $name = $this->input->post('name');
        $user = array(
            'name' => $name,
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'status' => TRUE,
            'created_at' => date('Y-m-d H:i:s'),
        );
        
        if ($id = $this->user_model->save($user, TRUE)) {
            $permissions = $this->input->post('permissions');
            if (is_array($permissions)) {
                foreach ($permissions as $p) {
                    $user_permission = array(
                        'user_id' => $id,
                        'permission_id' => $p
                    );
                    $this->permission_model->save($user_permission);
                }
            }
            $this->session->set_flashdata('successmsg', 'Usuário cadastrado com sucesso!');
            $this->log_modification_model->save_log('cadastro', 'Área Usuários', 'user', $id, "Cadastro do usuário \"$name\"");
        } else {
            $this->session->set_flashdata('errormsg', 'Erro ao cadastrar. Tente novamente!');
        }
        redirect('admin/user/' . $page);
    }

    public function edit($id = NULL, $page = NULL) {
        if (!empty($page) && !is_numeric($page)) {
            $page = NULL;
        }
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida!');
            redirect('admin/user/' . $page);
        }
        $this->session->set_userdata('user_edit', $id);
        if (!$this->permission_model->get_permission_user('configuration')) {
            $data = $this->_load_users(NULL, $this->current_user->user()->id);
            $data['list'] = FALSE;
        } else {
            $data = $this->_load_users($page, $id);
            $data['list'] = TRUE;
        }
        $data['op'] = 'update';
        $this->_header();
        $this->load->view('admin/user/crud', $data);
        $this->_footer();
    }

    public function update($page = NULL) {
        if (!empty($page) && !is_numeric($page)) {
            $page = NULL;
        }
        
        if (!$this->_form_validation()) {
            $id = $this->input->post('id');
            $this->session->set_flashdata('errormsg', 'Não foi possível atualizar, verifique as informações!');
            $this->edit($id, $page);
            return;
        }

        $name = $this->input->post('name');
        $user = array(
            'name' => $name,
            'email' => $this->input->post('email'),
            'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $id = $this->input->post('id');
        if ($this->permission_model->get_permission_user('configuration')) {
            $permissions = $this->input->post('permissions');
            $this->permission_model->delete_permissions($id);
            if (is_array($permissions)) {
                foreach ($permissions as $p) {
                    $user_permission = array(
                        'user_id' => $id,
                        'permission_id' => $p
                    );
                    $this->permission_model->save($user_permission);
                }
            }
        }
        $this->user_model->update($id, $user);
        $this->log_modification_model->save_log('atualização', 'Área Usuários', 'user', $id, "Atualização do usuário \"$name\"");
        if (!$this->permission_model->get_permission_user('configuration')) {
            $this->session->set_flashdata('successmsg', 'Cadastro atualizado com sucesso!');
            redirect('admin/user/edit/' . $this->current_user->user()->id);
        } else {
            $this->session->set_flashdata('successmsg', 'Usuário atualizado com sucesso!');
            redirect('admin/user');
        }
    }

    public function delete($id = NULL, $page = NULL) {
        if (!$this->permission_model->get_permission_user('configuration')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        if (!empty($page) && !is_numeric($page)) {
            $page = NULL;
        }
        if (empty($id) || !is_numeric($id) || $id == 1) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/user/' . $page);
        }
        $user = $this->user_model->get($id);
        if (!$user->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/user/' . $page);
        }
        $user = $user->row();
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('infomsg', 'Você não pode excluír seu proprio usuário!');
            redirect('admin/user/' . $page);
        }
        $this->permission_model->delete_permissions($id);
        if ($this->user_model->delete($id)) {
            $this->session->set_flashdata('successmsg', 'Usuário excluído com sucesso!');
            $this->log_modification_model->save_log('exclusão', 'Área Usuários', 'user', $id, "Exclusão do usuário \"$user->name\"");
        } else {
            if ($user->status) {
                $up_user = array(
                    'status' => FALSE,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->user_model->update($id, $up_user);
                $this->session->set_flashdata('infomsg', 'Usuário não pode ser excluído, portanto foi removido as permissões e foi desativado!');
            }
            $this->session->set_flashdata('errormsg', 'Usuário não pode ser excluído, porém não possui mais nenhuma permissão!');
            $this->log_modification_model->save_log('desativação', 'Área Usuários', 'user', $id, "O usuário \"$user->name\" não pôde ser excluído, então foi desativado e teve as permissões removidas");
        }
        redirect('admin/user/' . $page);
    }

    public function toggle($id = NULL, $page = NULL) {
        if (!$this->permission_model->get_permission_user('configuration')) {
            $this->session->set_flashdata('errormsg', 'Acesso negado!');
            redirect('admin');
        }
        if (!empty($page) && !is_numeric($page)) {
            $page = NULL;
        }
        if (empty($id) || !is_numeric($id) || $id == 1) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/user/' . $page);
        }
        $user = $this->user_model->get($id);
        if (!$user->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ação não permitida.');
            redirect('admin/user/' . $page);
        }
        $user = $user->row();
        if ($user->id == $this->current_user->user()->id) {
            $this->session->set_flashdata('infomsg', 'Você não pode desativar seu próprio usuário!');
            redirect('admin/user/' . $page);
        }
        $up_user = array(
            'status' => !$user->status,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->user_model->update($user->id, $up_user);
        if ($user->status) {
            $this->log_modification_model->save_log('desativação', 'Área Usuários', 'user', $id, "Usuário \"$user->name\" desativado");
            $this->session->set_flashdata('successmsg', 'O usuário foi desativado com sucesso');
        } else {
            $this->log_modification_model->save_log('ativação', 'Área Usuários', 'user', $id, "Usuário \"$user->name\" ativado");
            $this->session->set_flashdata('successmsg', 'O usuário foi ativado com sucesso');
        }
        redirect('admin/user/' . $page);
    }

    private function _load_users($page = NULL, $id = NULL) {
        if ($id) {
            $user = $this->user_model->get($id);
            if (!$user->num_rows()) {
                $this->session->set_flashdata('errormsg', 'Ação não permitida!');
                redirect('admin/user/' . $page);
            }
        }

        $limit = 10;
        if (!empty($page) && is_numeric($page)) {
            $offset = ($page - 1) * $limit;
        } else {
            $page = null;
            $offset = 0;
        }
        $users = $this->user_model->get(NULL, $limit, $offset);
        if (!$users->num_rows() && $page) {
            if ($id) {
                redirect('admin/user/edit/' . $id);
            } else {
                redirect('admin/user');
            }
        }
        $users = $users->result();
        $all_users = $this->user_model->get()->num_rows();
        $end = $offset + $limit;

        $this->load->library('pagination');
        $config = array(
            'base_url' => $id ? site_url('admin/user/edit/' . $id) : site_url('admin/user/'),
            'uri_segment' => $id ? 5 : 3,
            'total_rows' => $all_users,
            'next_link' => '&raquo;',
            'prev_link' => '&laquo;',
            'use_page_numbers' => TRUE,
            'cur_tag_open' => '<li class="active"><a href="#">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'first_link' => 'Inicio',
            'last_link' => 'Fim',
            'num_links' => 4,
            'per_page' => $limit,
        );
        $this->pagination->initialize($config);

        $data = array(
            'limit' => $limit,
            'page' => $page,
            'users' => $users,
            'permissions' => $this->permission_model->get()->result(),
            'display_start' => $all_users > 0 ? $offset + 1 : 0,
            'display_end' => $end > $all_users ? $all_users : $end,
            'total_rows' => $all_users,
        );
        if ($id) {
            $data['user'] = $user->row();
            $user_permissions = $this->permission_model->get_all_permissions($id)->result();
            $permissions = array();
            foreach ($user_permissions as $p) {
                $permissions[] = $p->permission_id;
            }
            $data['user_permissions'] = $permissions;
        }
        return $data;
    }

    private function _form_validation() {
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_message('required', 'O campo {field} é obrigatório');
        $this->form_validation->set_message('max_length', 'O campo {field} aceita no máximo {param} caracteres');
        $this->form_validation->set_message('min_length', 'O campo {field} deve conter no mínimo {param} caracteres');
        $this->form_validation->set_message('valid_email', 'O campo {field} precisa conter um email válido');
        $this->form_validation->set_message('matches', 'O campo {field} e {param} devem ser iguais');
        $this->form_validation->set_message('email_check', 'Email já cadastrado');
        $this->form_validation->set_message('integer', 'O campo {field} requer um inteiro');

        $this->form_validation->set_rules('id', 'ID', 'strip_tags|trim|integer');
        $this->form_validation->set_rules('name', 'Name', 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('email', 'E-mail', 'strip_tags|trim|required|max_length[100]|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|max_length[50]|min_length[5]|matches[re_password]');
        $this->form_validation->set_rules('re_password', 'Confirmação senha', 'trim|required|max_length[50]|min_length[5]');
        return $this->form_validation->run();
    }

    public function email_check($email) {
        $id = $this->session->userdata('user_edit');
        $user = $this->user_model->get_email($email, !empty($id) ? $id : NULL);
        return !$user->num_rows();
    }

}
