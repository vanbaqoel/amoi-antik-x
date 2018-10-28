<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tv_model extends CI_Model {

	var $table = 't_tv';

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
                b.deskripsi katdesc,
                a.ukuran,
                d.deskripsi kondesc,
                c.deskripsi lokdesc,
                a.keterangan,
                a.kode_unit
            FROM t_tv a
            LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 11
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
            FROM t_tv a
                LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 11
                LEFT JOIN r_kondisi c ON a.kondisi = c.kd_kondisi
                LEFT JOIN r_status d ON a.status = d.kd_status
                LEFT JOIN r_ruang e ON a.lokasi = e.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_tv($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_tv($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_tv($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return ($this->db->affected_rows() > 0);
    }
}

?>