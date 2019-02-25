<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_model extends CI_Model {

    private $table = 'faq';

    public function __construct() {
        parent::__construct();
    }

    public function get($language_id, $id = NULL) {
        $this->db->select('faq.*');
        $this->db->where('language_id', $language_id);
        if (!is_null($id)) {
            $this->db->where('faq.id', $id);
        }
        $this->db->join('faq_category', 'faq_category_id = faq_category.id');
        $this->db->order_by('faq.position');
        return $this->db->get($this->table);
    }

    public function get_category($category_id, $id = NULL) {
        $this->db->where('faq_category_id', $category_id);
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

    public function get_max_position($category_id) {
        $this->db->where('faq_category_id', $category_id);
        $this->db->select_max('position');
        return $this->db->get($this->table)->row()->position;
    }

    public function get_category_site($category_id, $search = NULL) {
        $this->db->where('faq_category_id', $category_id);
        $this->db->where('status', TRUE);
        if(!empty($search)){
            $this->db->group_start();
            $this->db->like('question', $search);
            $this->db->or_like('answer', $search);
            $this->db->group_end();
        }
        $this->db->order_by('position');
        return $this->db->get($this->table);
    }
    
    public function get_site_search($language_id, $search){
        $this->db->select('faq.*');
        $this->db->where('faq.status', TRUE);
        $this->db->where('faq_category.status', TRUE);
        $this->db->where('faq_category.language_id', $language_id);
        if(!empty($search)){
            $this->db->group_start();
            $this->db->like('question', $search);
            $this->db->or_like('answer', $search);
            $this->db->group_end();
        }
        $this->db->join('faq_category','faq_category_id = faq_category.id');
        $this->db->order_by('position');
        return $this->db->get($this->table);
    }

}
