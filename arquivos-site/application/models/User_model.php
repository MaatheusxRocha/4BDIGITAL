<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'user';

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null, $limit = NULL, $offset = NULL) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        $current_id = $this->session->userdata('user_id');
        if(empty($current_id) || $current_id != 1){
            $this->db->where('id <> 1');
        }
        if (!is_null($limit)) {
            $this->db->limit($limit, !is_null($offset) ? $offset : 0);
        }
        $this->db->order_by('name');
        return $this->db->get($this->table);
    }
    
    public function save($user, $return = NULL) {
        if (is_null($return)) {
            return $this->db->insert($this->table, $user);
        } else {
            if ($this->db->insert($this->table, $user)) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
    }

    public function update($id, $user) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $user);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function get_username($username, $user = NULL) {
        $this->db->where('username', $username);
        if (!is_null($user)) {
            $this->db->where('id <>', $user);
        }
        return $this->db->get($this->table);
    }

    public function get_email($email, $user = NULL) {
        $this->db->where('email', $email);
        if (!is_null($user)) {
            $this->db->where('id <>', $user);
        }
        return $this->db->get($this->table);
    }

    public function get_field($fields) {
        $this->db->where($fields);
        return $this->db->get($this->table);
    }

}
