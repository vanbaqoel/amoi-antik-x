<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laptop_model extends CI_Model {

	var $table = 't_laptop';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $this->db->from($this->table);
        if ($unit != '000') {
            $this->db->where('kode_unit', $unit);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->row();
    }

    public function add_laptop($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_laptop($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }

    public function delete_laptop($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return $this->db->affected_rows();
    }
}

?>