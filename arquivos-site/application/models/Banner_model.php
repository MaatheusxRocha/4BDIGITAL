<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {

    private $table = 'banner';

    public function __construct() {
        parent::__construct();
    }

    public function get($language_id, $id = NULL) {
        $this->db->where('language_id', $language_id);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('position');
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
    
    public function get_max_position($language_id) {
        $this->db->where('language_id', $language_id);
        $this->db->select_max('position');
        return $this->db->get($this->table)->row()->position;
    }
    
    public function get_site($language){
        $this->db->where('language_id', $language);
        $this->db->where('status', TRUE);
        $this->db->order_by('position');
        return $this->db->get($this->table);
    }
}
