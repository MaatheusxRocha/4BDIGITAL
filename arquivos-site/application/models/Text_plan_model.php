<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Text_plan_model extends CI_Model {

    private $table = 'text_plan';

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

    public function get_search($language, $search, $column = NULL, $column2 = NULL, $column3 = NULL) {
        $this->db->where('language_id', $language);
        if (!empty($column) || !empty($column2)) {
            $this->db->group_start();
            $this->db->like($column, $search);
            if (!empty($column2)) {
                $this->db->or_like($column2, $search);
            }
            if (!empty($column3)) {
                $this->db->or_like($column3, $search);
            }
            $this->db->group_end();
        }
        return $this->db->get($this->table);
    }

}
