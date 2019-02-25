<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Join_us_model extends CI_Model {

    private $table = 'join_us';

    public function __construct() {
        parent::__construct();
    }

    public function count_inactive() {
        $this->db->select('COUNT(*) as count');
        $this->db->where('status', FALSE);
        return $this->db->get($this->table)->row()->count;
    }

    public function get($id = NULL, $start_date = NULL, $end_date = NULL, $limit = NULL, $offset = NULL) {
        if ($id) {
            $this->db->where('id', $id);
        }
        if ($start_date) {
            $this->db->where('DATE(created_at) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(created_at) <=', $end_date);
        }
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table);
    }

    public function save($data, $return = FALSE) {
        if ($this->db->insert($this->table, $data)) {
            return $return ? $this->db->insert_id() : TRUE;
        }
        return FALSE;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

}
