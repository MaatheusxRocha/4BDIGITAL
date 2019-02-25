<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Messaging_model extends CI_Model {

    private $table = 'messaging';

    public function __construct() {
        parent::__construct();
    }

    public function get($language_id, $id = NULL) {
        $this->db->where('language_id', $language_id);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('NOT(start_date), start_date DESC');
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

    public function get_site_permanent($language) {
        $this->db->where('language_id', $language);
        $this->db->where('status', TRUE);
        $this->db->where('start_date is null');
        $this->db->where('end_date is null');
        return $this->db->get($this->table);
    }

    public function get_site_current($language) {
        $this->db->where('language_id', $language);
        $this->db->where('status', TRUE);
        $this->db->where('start_date <=', date('Y-m-d'));
        $this->db->where('end_date >=', date('Y-m-d'));
        $this->db->order_by('created_at', 'desc');
        return $this->db->get($this->table);
    }

}
