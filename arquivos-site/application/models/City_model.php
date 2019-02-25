<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model {

    private $table = 'city';

    public function __construct() {
        parent::__construct();
    }

    public function get($id = NULL, $state_id = NULL) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($state_id)) {
            $this->db->where('state_id', $state_id);
        }
        $this->db->order_by('name');
        return $this->db->get($this->table);
    }

    public function get_details($id = NULL, $state_id = NULL) {
        $this->db->select('city.*, state.name as state');
        $this->db->join('state','state_id = state.id');
        if (!is_null($id)) {
            $this->db->where('city.id', $id);
        }
        if (!is_null($state_id)) {
            $this->db->where('state_id', $state_id);
        }
        return $this->db->get($this->table);
    }
}
