<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_model extends CI_Model {

	var $table = 't_riwayat';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($kode, $id)
    {
        $sql = "
            SELECT
                id,
                kd_perangkat,
                id_perangkat,
                rekanan,
                tgl_mulai,
                tgl_selesai,
                uraian
            FROM t_riwayat
            WHERE kd_perangkat = $kode AND id_perangkat = $id AND deleted = 0";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_perangkat($id)
    {
        $this->db->select('deskripsi');
        $this->db->from('r_perangkat');
        $this->db->where('kd_perangkat', $id);

        return $this->db->get()->row()->deskripsi;
    }

    public function add_riwayat($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_riwayat($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_riwayat($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return ($this->db->affected_rows() > 0);
    }
}

?>