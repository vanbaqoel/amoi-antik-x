<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

	var $table = 't_absensi';

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
                a.user_cap,
                a.record_cap,
                b.deskripsi recogdesc,
                c.deskripsi lokdesc,
                d.deskripsi kondesc,
                a.keterangan,
                a.kode_unit
            FROM t_absensi a
            LEFT JOIN r_recog b ON a.recog = b.kd_recog
            LEFT JOIN r_ruang c ON a.lokasi = c.kd_ruang
            LEFT JOIN r_kondisi d ON a.kondisi = d.kd_kondisi";

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
                d.deskripsi ddesc,
                e.deskripsi edesc
            FROM t_absensi a
                LEFT JOIN r_recog b ON a.recog = b.kd_recog
                LEFT JOIN r_kondisi c ON a.kondisi = c.kd_kondisi
                LEFT JOIN r_status d ON a.status = d.kd_status
                LEFT JOIN r_ruang e ON a.lokasi = e.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_absensi($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_absensi($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }

    public function delete_absensi($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return $this->db->affected_rows();
    }
}

?>