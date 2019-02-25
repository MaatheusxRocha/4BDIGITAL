<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us_model extends CI_Model {

    private $table = 'contact_us';

    public function __construct() {
        parent::__construct();
    }

    public function count_inactive() {
        $this->db->select('COUNT(*) as count');
        $this->db->where('status', FALSE);
        return $this->db->get($this->table)->row()->count;
    }

    public function get($id = NULL, $department_id = NULL, $start_date = NULL, $end_date = NULL, $limit = NULL, $offset = NULL) {
        $this->db->select('contact_us.*');
        $this->db->select('city.name AS city_name');
        $this->db->select('state.uf AS state_uf');
        $this->db->select('department.name AS department_name');

        $this->db->join('city', 'city.id = contact_us.city_id', 'left');
        $this->db->join('state', 'state.id = city.state_id', 'left');
        $this->db->join('department', 'department.id = contact_us.department_id');

        if ($id) {
            $this->db->where('contact_us.id', $id);
        }
        if ($department_id) {
            $this->db->where('contact_us.department_id', $department_id);
        }
        if ($start_date) {
            $this->db->where('DATE(contact_us.created_at) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(contact_us.created_at) <=', $end_date);
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
