<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_modification_model extends CI_Model {

    private $table = 'log_modification';

    public function __construct() {
        parent::__construct();
    }

    public function get($limit = NULL, $offset = NULL, $user = NULL, $start = NULL, $end = NULL) {
        $this->db->select('user.name AS user_name');
        $this->db->select('log_modification.*');
        
        if (!is_null($limit)) {
            $this->db->limit($limit, !is_null($offset) ? $offset : 0);
        }
        if (!empty($user)) {
            $this->db->where('log_modification.user_id', $user);
        }
        if (!empty($start)) {
            $this->db->where('DATE(log_modification.date) >=', $start);
        }
        if (!empty($end)) {
            $this->db->where('DATE(log_modification.date) <=', $end);
        }
        $this->db->join('user', 'user.id = user_id');
        $this->db->order_by('date', 'desc');
        return $this->db->get($this->table);
    }

    public function save_log($action, $area, $table, $id_modification = NULL, $observation = NULL){
        $modification = array(
            'user_id' => $this->session->userdata('user_id'),
            'url' => current_url(),
            'date' => date('Y-m-d H:i:s'),
            'action'=> $action,
            'area' => $area,
            'table' => $table,
            'id_modification' => $id_modification,
            'observation' => $observation
        );
        return $this->db->insert($this->table, $modification) ? $this->db->insert_id() : FALSE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function update($id, $modification) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $modification);
    }
    
    public function get_last_modification(){
        $this->db->where('table <>', 'user');
        $this->db->order_by('id desc');
        $this->db->limit(1);
        return $this->db->get($this->table);
    }
    
}
