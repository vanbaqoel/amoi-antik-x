<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server_model extends CI_Model {

	var $table = 't_server';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                a.id,
                a.nup,
                b.deskripsi katdesc,
                a.merek,
                a.tipe,
                a.hostname,
                a.alamat_ip,
                c.deskripsi kondesc,
                d.deskripsi lokdesc,
                a.keterangan
            FROM t_server a
            LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 1
            LEFT JOIN r_kondisi c ON a.kondisi = c.kd_kondisi
            LEFT JOIN r_ruang d ON a.lokasi = d.kd_ruang";
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
                IF(a.orisinalitas_os = 1, 'GENUINE', 'TIDAK GENUINE') AS ori,
                IF(a.join_domain = 1, 'SUDAH', 'BELUM') AS jondo,
                b.deskripsi bdesc,
                c.deskripsi cdesc,
                d.deskripsi ddesc,
                e.deskripsi edesc,
                f.deskripsi fdesc,
                g.deskripsi gdesc,
                h.deskripsi hdesc,
                i.deskripsi idesc
            FROM t_server a
                LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 1
                LEFT JOIN r_os c ON a.os = c.kd_os
                LEFT JOIN r_osedisi d ON a.edisi_os = d.kd_osedisi
                LEFT JOIN r_office e ON a.office = e.kd_office
                LEFT JOIN r_koneksi f ON a.koneksi = f.kd_koneksi
                LEFT JOIN r_kondisi g ON a.kondisi = g.kd_kondisi
                LEFT JOIN r_status h ON a.status = h.kd_status
                LEFT JOIN r_ruang i ON a.lokasi = i.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_server($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_server($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_server($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return ($this->db->affected_rows() > 0);
    }
}

?>