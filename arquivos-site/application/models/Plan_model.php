<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_model extends CI_Model {

    private $table = 'plan';
    private $table_operational = 'plan_operational';
    private $table_config = 'plan_config';

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
    
    public function get_plan_operational($plan_id, $operational_id) {
        $this->db->where('plan_id', $plan_id);
        $this->db->where('operational_id', $operational_id);
        return $this->db->get($this->table_operational);
    }
    
    public function get_config($id) {
        $this->db->select('plan_config.*, config.name');
        $this->db->where('plan_config.id', $id);
        $this->db->join('config','config_id = config.id');
        return $this->db->get($this->table_config);
    }
    
    public function get_configs($plan_id) {
        $this->db->select('plan_config.*, config.name');
        $this->db->where('plan_id', $plan_id);
        $this->db->order_by('config.position');
        $this->db->join('config','config_id = config.id');
        return $this->db->get($this->table_config);
    }

    public function save($data, $return = FALSE) {
        if ($this->db->insert($this->table, $data)) {
            return $return ? $this->db->insert_id() : TRUE;
        }
        return FALSE;
    }
    
    public function save_operational($data, $return = FALSE) {
        if ($this->db->insert($this->table_operational, $data)) {
            return $return ? $this->db->insert_id() : TRUE;
        }
        return FALSE;
    }
    
    public function save_config($data, $return = FALSE) {
        if ($this->db->insert($this->table_config, $data)) {
            return $return ? $this->db->insert_id() : TRUE;
        }
        return FALSE;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function update_config($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table_config, $data);
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    public function delete_plan($id) {
        $this->db->where('plan_id', $id);
        return $this->db->delete($this->table_operational);
    }
    public function delete_configs($id) {
        $this->db->where('plan_id', $id);
        return $this->db->delete($this->table_config);
    }
    
    public function delete_config($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_config);
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
    
    public function get_site_operational($language, $operational_id){
        $this->db->select('plan.*, plan_operational.price_month, plan_operational.price_hour, plan_operational.price_month_promotion, plan_operational.price_hour_promotion, plan_operational.storage, operational.name as operational');
        $this->db->where('language_id', $language);
        $this->db->where('operational_id', $operational_id);
        $this->db->where('plan.status', TRUE);
        $this->db->join('plan_operational', 'plan.id = plan_id');
        $this->db->join('operational','operational_id = operational.id');
        $this->db->order_by('plan.position');
        return $this->db->get($this->table);
    }
    
    public function get_plan_custom($language, $os){
        $this->db->select('plan.*');
        $this->db->where('language_id', $language);
        $this->db->where('operational_id', $os);
        $this->db->where('plan.status', TRUE);
        $this->db->join('plan_operational', 'plan.id = plan_id');
        $this->db->join('operational','operational_id = operational.id');
        return $this->db->get($this->table);
    }
    
    public function get_config_item($plan_id, $config_id, $value){
        $this->db->where('plan_id', $plan_id);
        $this->db->where('config_id', $config_id);
        $this->db->where('value', $value);
        return $this->db->get($this->table_config);
    }
    
    public function get_plan_config($plan_id, $config_id){
        $this->db->where('plan_id', $plan_id);
        $this->db->where('config_id', $config_id);
        return $this->db->get($this->table_config);
    }
}
