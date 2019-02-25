<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends CI_Model {

    private $table = 'permission';
    private $table_user_permission = 'user_has_permission';

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null, $limit = NULL, $offset = NULL) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($limit)) {
            $this->db->limit($limit, !is_null($offset) ? $offset : 0);
        }
//        $this->db->order_by('name');
        return $this->db->get($this->table);
    }

    public function save($permission, $return = NULL) {
        if (is_null($return)) {
            return $this->db->insert($this->table_user_permission, $permission);
        } else {
            if ($this->db->insert($this->table_user_permission, $permission)) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
    }

    public function get_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get($this->table_user_permission);
    }

    public function get_permission_user($method) {
        if ($this->session->userdata('user_id') == 1) {
            return TRUE;
        }
        $this->db->where('method', $method);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->join('user_has_permission', 'permission.id = user_has_permission.permission_id');
        return $this->db->get($this->table)->num_rows() ? TRUE : FALSE;
    }
    
    public function get_all_permissions($user_id){
        $this->db->where('user_id',$user_id);
        return $this->db->get($this->table_user_permission);
    }

    public function delete_permissions($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->table_user_permission);
    }

}
