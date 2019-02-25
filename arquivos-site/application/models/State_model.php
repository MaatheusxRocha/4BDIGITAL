<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model {

    private $table = 'state';

    public function __construct() {
        parent::__construct();
    }

    public function get($id = NULL) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('name');
        return $this->db->get($this->table);
    }
}
