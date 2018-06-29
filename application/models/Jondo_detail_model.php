<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jondo_detail_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function jondo($unit, $status, $kategori)
    {
        $from_kategori = "";
        $kd_kategori = 0;
        switch ($kategori) {
            case 'SERVER':
                $from_kategori = "t_server";
                $kd_kategori = 1;
                break;

            case 'PC':
                $from_kategori = "t_pc";
                $kd_kategori = 2;
                break;

            case 'LAPTOP':
                $from_kategori = "t_laptop";
                break;
        }

        $sql = "
            SELECT "
            . ($kategori == 'LAPTOP' ? '' : 'c.deskripsi katdesc,') .
               "alamat_ip,
                hostname,
                nup,
                b.deskripsi lokdesc,
                keterangan,
                kode_unit
            FROM $from_kategori a";

        $sql .= "
            LEFT JOIN r_ruang b ON a.lokasi = b.kd_ruang ";

        $sql .= ($kd_kategori > 0) ? "
            LEFT JOIN r_kategori c ON a.kategori = c.kd_kategori AND c.kd_jenis = $kd_kategori" : "";

        $sql .= "
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