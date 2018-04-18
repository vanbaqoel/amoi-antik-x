<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jondo_detail_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function jondo($unit, $status, $kategori)
    {
        $from_kategori = "";
        switch ($kategori) {
            case 'SERVER':
                $from_kategori = "t_server";
                break;

            case 'PC':
                $from_kategori = "t_pc";
                break;

            case 'LAPTOP':
                $from_kategori = "t_laptop";
                break;
        }

        $sql = "
            SELECT "
            . ($kategori == 'LAPTOP' ? '' : 'kategori,') .
               "alamat_ip,
                hostname,
                nup,
                lokasi,
                keterangan,
                kode_unit
            FROM $from_kategori
            WHERE kode_unit = '$unit'";

        switch ($status) {
            case 'b':
                $sql .= " AND kondisi != 'RUSAK BERAT'";
                break;

            case 'c':
                $sql .= " AND kondisi = 'RUSAK BERAT'";
                break;

            case 'd':
                $sql .= " AND join_domain = 'SUDAH'";
                break;

            case 'e':
                $sql .= " AND join_domain = 'BELUM'";
                break;

            case 'f':
                $sql .= " AND os = 'WINDOWS XP'";
                break;

            case 'g':
                $sql .= " AND os = 'WINDOWS 7'";
                break;

            case 'h':
                $sql .= " AND os = 'WINDOWS 10'";
                break;

            case 'i':
                $sql .= " AND os NOT IN('WINDOWS XP', 'WINDOWS 7', 'WINDOWS 10')";
                break;
        }

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>