<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_contact_model extends CI_Model {

    private $table = 'partner_contact';

    public function __construct() {
        parent::__construct();
    }

    public function count_inactive() {
        $this->db->select('COUNT(*) as count');
        $this->db->where('status', FALSE);
        return $this->db->get($this->table)->row()->count;
    }

    public function get($id = NULL, $start_date = NULL, $end_date = NULL, $limit = NULL, $offset = NULL) {
        $this->db->select('partner_contact.*');
        $this->db->select('city.name AS city_name');
        $this->db->select('state.uf AS state_uf');

        $this->db->join('city', 'city.id = partner_contact.city_id', 'left');
        $this->db->join('state', 'state.id = city.state_id', 'left');

        if ($id) {
            $this->db->where('partner_contact.id', $id);
        }
        if ($start_date) {
            $this->db->where('DATE(partner_contact.created_at) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(partner_contact.created_at) <=', $end_date);
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
