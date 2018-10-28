<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gkm_model extends CI_Model {

	var $table = 't_gkm';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                a.id,
                a.judul,
                a.pelaksanaan,
                a.file_dok,
                a.keterangan,
                a.kode_unit
            FROM t_gkm a";

        if ($unit != '000') {
            $sql .= " WHERE a.kode_unit = '$unit'";
        }

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_by_id($id)
    {
        $sql = "
            SELECT *
            FROM t_gkm
            WHERE id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_gkm($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_gkm($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_gkm($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return ($this->db->affected_rows() > 0);
    }
}

?>