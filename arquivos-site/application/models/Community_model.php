<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Community_model extends CI_Model {

    private $table = 'community';

    public function __construct() {
        parent::__construct();
    }

    public function get($language) {
        $this->db->where('language_id', $language);
        return $this->db->get($this->table);
    }

    public function save($data, $return = NULL) {
        if ($return) {
            return $this->db->insert($this->table, $data) ? $this->db->insert_id() : FALSE;
        } else {
            return $this->db->insert($this->table, $data);
        }
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
}
