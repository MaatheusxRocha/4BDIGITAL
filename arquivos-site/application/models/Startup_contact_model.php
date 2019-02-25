<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Startup_contact_model extends CI_Model {

    private $table = 'startup_contact';

    public function __construct() {
        parent::__construct();
    }

    public function count_inactive() {
        $this->db->select('COUNT(*) as count');
        $this->db->where('status', FALSE);
        return $this->db->get($this->table)->row()->count;
    }

    public function get($id = NULL, $start_date = NULL, $end_date = NULL, $limit = NULL, $offset = NULL) {
        $this->db->select('startup_contact.*');
        $this->db->select('city.name AS city_name');
        $this->db->select('state.uf AS state_uf');

        $this->db->join('city', 'city.id = startup_contact.city_id', 'left');
        $this->db->join('state', 'state.id = city.state_id', 'left');

        if ($id) {
            $this->db->where('startup_contact.id', $id);
        }
        if ($start_date) {
            $this->db->where('DATE(startup_contact.created_at) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(startup_contact.created_at) <=', $end_date);
        }
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('created_at', 'desc');
        return $this->db->get($this->table);
    }

    public function save($data, $recipes) {
        if (!$this->db->insert($this->table, $data)) {
            return FALSE;
        }

        if (!$recipes) {
            return TRUE;
        }

        $contact_id = $this->db->insert_id();

        foreach ($recipes as $recipe_id) {
            $data = array(
                'startup_contact_id' => $contact_id,
                'recipe_id' => $recipe_id
            );
            $this->db->insert('startup_contact_recipe', $data);
        }
        return TRUE;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function get_recipes($startup_contact_id) {
        $this->db->select('recipe.*');
        $this->db->join('recipe', 'recipe.id = startup_contact_recipe.recipe_id');
        $this->db->where('startup_contact_id', $startup_contact_id);
        return $this->db->get('startup_contact_recipe');
    }

}
