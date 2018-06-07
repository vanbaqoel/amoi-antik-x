<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_model extends CI_Model {

	var $table = 't_pc';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                a.id,
                b.deskripsi katdesc,
                a.merek,
                a.tipe,
                a.hostname,
                a.alamat_ip,
                c.deskripsi lokdesc,
                a.keterangan
            FROM t_pc a
            LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 2
            LEFT JOIN r_ruang c ON a.lokasi = c.kd_ruang";
            /*
        $this->db->select('*', 'r_kategori.deskripsi AS katdesc');
        $this->db->from($this->table);
        $this->db->join('r_kategori', 't_pc.kategori = r_kategori.kd_kategori AND r_kategori.kd_jenis = 2');
        $this->db->join('r_ruang', 't_pc.lokasi = r_ruang.kd_ruang');*/
        if ($unit != '000') {
            $sql .= " WHERE a.kode_unit = $unit";
            // $this->db->where('kode_unit', $unit);
        }

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_by_id($id)
    {
        $sql = "
            SELECT
                a.*,
                IF(a.orisinalitas_os = 1, 'ORIGINAL/GENUINE', 'TIDAK ORIGINAL/GENUINE') AS ori,
                IF(a.join_domain = 1, 'SUDAH', 'BELUM') AS jondo,
                b.deskripsi bdesc,
                c.deskripsi cdesc,
                d.deskripsi ddesc,
                e.deskripsi edesc,
                f.deskripsi fdesc,
                g.deskripsi gdesc,
                h.deskripsi hdesc,
                i.deskripsi idesc,
                j.deskripsi jdesc,
                k.deskripsi kdesc,
                l.deskripsi ldesc
            FROM t_pc a
                LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 2
                LEFT JOIN r_processor c ON a.processor = c.kd_processor
                LEFT JOIN r_nic d ON a.nic = d.kd_nic
                LEFT JOIN r_optical e ON a.optical = e.kd_optical
                LEFT JOIN r_os f ON a.os = f.kd_os
                LEFT JOIN r_osedisi g ON a.edisi_os = g.kd_osedisi
                LEFT JOIN r_office h ON a.office = h.kd_office
                LEFT JOIN r_koneksi i ON a.koneksi = i.kd_koneksi
                LEFT JOIN r_kondisi j ON a.kondisi = j.kd_kondisi
                LEFT JOIN r_status k ON a.status = k.kd_status
                LEFT JOIN r_ruang l ON a.lokasi = l.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_pc($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_pc($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }

    public function delete_pc($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return $this->db->affected_rows();
    }
}

?>