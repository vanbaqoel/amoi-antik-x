<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jondo_detail_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function jondo($unit, $status, $perangkat)
    {
        $from_kategori = "";
        switch ($perangkat) {
            case 1:
                $from_kategori = "t_pc";
                break;

            case 2:
                $from_kategori = "t_laptop";
                break;
        }

        $sql = "
            SELECT
                merek,
                tipe,
                alamat_ip,
                hostname,
                nup,
                b.deskripsi lokdesc,
                keterangan,
                kode_unit
            FROM $from_kategori a
            LEFT JOIN r_ruang b ON a.lokasi = b.kd_ruang
            WHERE kode_unit = '$unit'";

        switch ($status) {
            case 'b':
                $sql .= " AND kondisi != 4 AND status = 1";
                break;

            case 'c':
                $sql .= " AND kondisi != 4 AND status = 1 AND koneksi = 1";
                break;

            case 'd':
                $sql .= " AND kondisi != 4 AND status = 1 AND koneksi = 1 AND join_domain = 1";
                break;

            case 'e':
                $sql .= " AND kondisi != 4 AND status = 1 AND koneksi = 1 AND join_domain = 0";
                break;

            case 'f':
                $sql .= " AND kondisi != 4 AND status = 1 AND os = 1";
                break;

            case 'g':
                $sql .= " AND kondisi != 4 AND status = 1 AND os = 3";
                break;

            case 'h':
                $sql .= " AND kondisi != 4 AND status = 1 AND os = 6";
                break;

            case 'i':
                $sql .= " AND kondisi != 4 AND status = 1 AND os NOT IN(1, 3, 6)";
                break;
        }

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>