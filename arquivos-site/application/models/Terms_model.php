<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_model extends CI_Model {

    private $table = 'terms';

    public function __construct() {
        parent::__construct();
    }

    public function get($language_id, $id = NULL) {
        $this->db->where('language_id', $language_id);
        if (!is_null($id)) {
            $this->db->where('id', $id);
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
    
}
