<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('current_user','permission_model','log_modification_model'));
        $this->load->library(array('simple_encrypt', 'encrypt'));
        $this->load->helper(array('help'));
    }

    public function index() {
//        $this->session->set_userdata('user_id',1);
        if ($this->current_user->user()) {
            redirect('admin');
        }

        $this->load->view('admin/login');
    }

    public function submit() {
        $login = trim($this->input->post('login'));
        $password = $this->input->post('password');
        $user = $this->current_user->login($login, $password);
        if ($user) {
            if ($user->status) {
                $this->session->set_userdata('user_id', $user->id);
                $this->current_user->set_user($user);
                $this->session->set_flashdata('infomsg', 'Bem Vindo ' . $this->current_user->user()->name);
                $this->log_modification_model->save_log('login', 'Área Administrativa', 'user', $user->id, "Usuário \"$user->name\" fez login");
                redirect('admin');
            } else {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_flashdata('errormsg', 'Conta desativada');
                $this->session->unset_userdata('user_id', $user->id);
            }
        } else {
            $this->session->set_flashdata('errormsg', 'Usuário ou senha inválidos!');
        }
        redirect('admin/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    public function recover_password() {
        $this->load->view('admin/recover_password');
    }

    public function send_email_recovery() {
        $email = trim(strip_tags($this->input->post('email')));

        $user = $this->user_model->get_email($email);
        if (!$user->num_rows()) {
            $this->session->set_flashdata('infomsg', 'Nenhum cadastro encontrado com este e-mail!');
            redirect('admin/login/recover_password');
        }
        $user = $user->row();

        $this->load->library('email');
        $config['protocol'] = 'mail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $email = $this->simple_encrypt->safe_b64encode($user->email);
        $token = sha1(uniqid() . time());
        $token = str_replace('/', '-', $token);
        $link = site_url("admin/login/recovery/$email/$token");
        log_message('error', 'Link - ' . $link);
        $us = array(
            'token' => $token,
            'time_token' => date('Y-m-d H:i:s')
        );
        $this->user_model->update($user->id, $us);
        $mesage = 'Solicitação de recuperação de senha de acesso a área administrativa do site BRASCLOUD. Caso não tenha solicitado, apenas ignore este e-mail. Caso contrário, clique no link abaixo (ou copie e abra em uma nova aba).';
        $mesage .= "\n\n";
        $mesage.= $link;
        $this->email->initialize($config);
        $from = 'no-reply@brascloud.com.br';
        $this->email->from($from, 'BRASCLOUD - Recuperação de senha');
        $this->email->to($user->email);

        $this->email->subject('BRASCLOUD - Recuperação de senha');

        $this->email->message($mesage);
        if ($this->email->send()) {
            $this->session->set_flashdata('successmsg', 'E-mail para recuperação enviado com sucesso!');
        } else {
            $this->session->set_flashdata('errormsg', 'Houve um erro ao enviar o e-mail. Tente novamente!');
        }
        redirect('admin/login');
    }

    public function recovery($email, $token) {
        $data['email_crypt'] = $email;
        $email = $this->simple_encrypt->safe_b64decode($email);
        $date = date('Y-m-d H:i:s');

        $user = $this->user_model->get_field(array('email' => $email, 'token' => $token));
        if (!$user->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Solicitação inválida! Tente novamente.');
            redirect('admin/login/recover_password');
        }
        $user = $user->row();

        $time_token = new DateTime($user->time_token);
        $time = new DateTime($date);
        $dif = $time->diff($time_token);
        if ($dif->h > 2) {
            $us = array(
                'token' => null,
                'time_token' => null
            );
            $this->user_model->update($user->id, $us);
            $this->session->set_flashdata('errormsg', 'Token de recuperação expirado, por favor realize a operação novamente!');
            redirect('admin/login/recover_password');
        }

        $data['user'] = $user;
        $data['token'] = $token;
        $this->load->view('admin/change_password', $data);
    }

    public function change_password() {
        $this->session->sess_regenerate(true);
        $user_id = trim(strip_tags($this->input->post('id')));
        $email_crypt = $this->input->post('email_crypt');
        $token = $this->input->post('token');
        $email = $this->simple_encrypt->safe_b64decode($email_crypt);

        $user = $this->user_model->get_field(array('email' => $email, 'token' => $token, 'id' => $user_id));
        if (!$user->num_rows()) {
            $this->session->set_flashdata('errormsg', 'Ocorreu um erro durante a solicitação, tente novamente!');
            redirect('admin/login/recover_password');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Senha', 'strip_tags|trim|required|max_length[50]|min_length[5]|matches[re_password]');
        $this->form_validation->set_rules('re_password', 'Confirmação senha', 'strip_tags|trim|required|max_length[50]|min_length[5]');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errormsg', 'Atenção, as senhas devem conter entre 5 e 50 caracteres e devem ser iguais!');
            redirect($this->input->server('HTTP_REFERER'));
        }

        $us = array(
            'password' => crypt($this->input->post('password')),
            'token' => null,
            'time_token' => null,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->user_model->update($user_id, $us);
        $this->session->set_flashdata('successmsg', 'Senha atualizada com sucesso.');
        redirect('admin/login');
    }

}
