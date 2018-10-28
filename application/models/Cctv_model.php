<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cctv_model extends CI_Model {

	var $table = 't_cctv';

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
                a.frame_rate,
                a.channel,
                a.jml_kamera,
                a.harddisk,
                b.deskripsi kondesc,
                c.deskripsi lokdesc,
                a.keterangan,
                a.kode_unit
            FROM t_cctv a
            LEFT JOIN r_kondisi b ON a.kondisi = b.kd_kondisi
            LEFT JOIN r_ruang c ON a.lokasi = c.kd_ruang";

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
            FROM t_cctv a
                LEFT JOIN r_kondisi b ON a.kondisi = b.kd_kondisi
                LEFT JOIN r_status c ON a.status = c.kd_status
                LEFT JOIN r_ruang d ON a.lokasi = d.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_cctv($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_cctv($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_cctv($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return ($this->db->affected_rows() > 0);
    }
}

?>