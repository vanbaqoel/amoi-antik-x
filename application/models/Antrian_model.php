<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian_model extends CI_Model {

	var $table = 't_antrian';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                a.id,
                a.nup,
                a.merek,
                a.tipe,
                a.counter,
                a.ticket,
                c.deskripsi kondesc,
                b.deskripsi lokdesc,
                a.keterangan,
                a.kode_unit
            FROM t_antrian a
            LEFT JOIN r_ruang b ON a.lokasi = b.kd_ruang
            LEFT JOIN r_kondisi c ON a.kondisi = c.kd_kondisi";

        if ($unit != '000') {
            $sql .= " WHERE a.kode_unit = '$unit'";
        }

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_by_id($id)
    {
        $sql = "
            SELECT
                a.*,
                b.deskripsi bdesc,
                c.deskripsi cdesc,
                d.deskripsi ddesc
            FROM t_antrian a
                LEFT JOIN r_kondisi b ON a.kondisi = b.kd_kondisi
                LEFT JOIN r_status c ON a.status = c.kd_status
                LEFT JOIN r_ruang d ON a.lokasi = d.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_antrian($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_antrian($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }

    public function delete_antrian($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return $this->db->affected_rows();
    }
}

?>