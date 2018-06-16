<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laptop_model extends CI_Model {

	var $table = 't_laptop';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('r_ruang', 't_laptop.lokasi = r_ruang.kd_ruang');
        if ($unit != '000') {
            $this->db->where('kode_unit', $unit);
        }

        $query = $this->db->get();

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
                i.deskripsi idesc,
                j.deskripsi jdesc,
                k.deskripsi kdesc,
                l.deskripsi ldesc
            FROM t_laptop a
                LEFT JOIN r_processor b ON a.processor = b.kd_processor
                LEFT JOIN r_nic c ON a.nic = c.kd_nic
                LEFT JOIN r_wifi d ON a.wifi = d.kd_wifi
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