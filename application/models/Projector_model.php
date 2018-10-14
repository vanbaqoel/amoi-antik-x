<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projector_model extends CI_Model {

	var $table = 't_projector';

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
                b.deskripsi resolusidesc,
                a.brightness,
                a.contrast_ratio,
                c.deskripsi aspectdesc,
                d.deskripsi kondesc,
                e.deskripsi lokdesc,
                a.keterangan,
                a.kode_unit
            FROM t_projector a
            LEFT JOIN r_resolusi b ON a.resolusi = b.kd_resolusi
            LEFT JOIN r_aspect_ratio c ON a.aspect_ratio = c.kd_aspect_ratio
            LEFT JOIN r_kondisi d ON a.kondisi = d.kd_kondisi
            LEFT JOIN r_ruang e ON a.lokasi = e.kd_ruang";

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
                e.deskripsi edesc,
                f.deskripsi fdesc
            FROM t_projector a
                LEFT JOIN r_resolusi b ON a.resolusi = b.kd_resolusi
                LEFT JOIN r_aspect_ratio c ON a.aspect_ratio = c.kd_aspect_ratio
                LEFT JOIN r_kondisi d ON a.kondisi = d.kd_kondisi
                LEFT JOIN r_status e ON a.status = e.kd_status
                LEFT JOIN r_ruang f ON a.lokasi = f.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_projector($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_projector($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }

    public function delete_projector($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return $this->db->affected_rows();
    }
}

?>