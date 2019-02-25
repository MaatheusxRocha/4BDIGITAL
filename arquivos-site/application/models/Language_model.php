<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {

    private $table = 'language';

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null, $limit = NULL, $offset = NULL) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if(!is_null($limit)){
            $this->db->limit($limit,!is_null($offset) ? $offset : 0);
        }
        $this->db->order_by('position');
        return $this->db->get($this->table);
    }

    public function save($language, $return = NULL) {
        if(is_null($return)){
            return $this->db->insert($this->table, $language);
        }else{
            $this->db->insert($this->table, $language);
            return $this->db->insert_id();
        }
    }
    
    public function update($id, $language){
        $this->db->where('id',$id);
        return $this->db->update($this->table, $language);
    }
    
    public function get_max_position() {
        $this->db->select_max('position');
        return $this->db->get($this->table)->row()->position;
    }
    
    public function get_visible(){
        $this->db->where('status', TRUE);
        $this->db->order_by('position');
        return $this->db->get($this->table);
    }
    
}