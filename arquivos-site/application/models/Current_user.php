<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Current_user extends CI_Model {

    private static $user;

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function user() {
        if (!isset(self::$user)) {
            if (!$user_id = $this->session->userdata('user_id')) {
                return FALSE;
            }
            if (!$u = $this->user_model->get($user_id)->row()) {
                return FALSE;
            }
            self::$user = $u;
        }
        return self::$user;
    }

    public function set_user($user) {
        self::$user = $user;
    }

    public function login($login, $password) {
        $this->db->where('email', $login);
//        $this->db->where('password', $password);
        $users = $this->db->get('user', 1);
        if ($users->num_rows() > 0) {
            $user = $users->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
            return FALSE;
        } else {
            return FALSE;
        }
    }

    public function __unset($user) {
        self::$user = NULL;
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

}
