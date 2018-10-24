<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os_detail_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function os($unit, $status, $perangkat)
    {
        $from_kategori = "";
        switch ($perangkat) {
            case 1:
                $from_kategori = "t_pc";
                break;

            case 2:
                $from_kategori = "t_laptop";
                break;

            case 7:
                $from_kategori = "t_server";
                break;
        }

        $sql = "
            SELECT
                merek,
                tipe,
                edisi_os,
                os,
                nup,
                b.deskripsi lokdesc,
                d.deskripsi osdesc,
                e.deskripsi osedesc,
                keterangan,
                kode_unit
            FROM $from_kategori a
            LEFT JOIN r_ruang b ON a.lokasi = b.kd_ruang
            LEFT JOIN r_os d ON a.os = d.kd_os
            LEFT JOIN r_osedisi e ON a.os = e.kd_osedisi
            WHERE kode_unit = '$unit'";

        switch ($status) {
            case 'b':
                $sql .= " AND kondisi != 4 AND status = 1";
                break;

            case 'c':
                $sql .= " AND kondisi != 4 AND status = 1 AND os = 1";
                break;

            case 'd':
                $sql .= " AND kondisi != 4 AND status = 1 AND os = 3";
                break;

            case 'e':
                $sql .= " AND kondisi != 4 AND status = 1 AND os = 6";
                break;

            case 'f':
                $sql .= " AND kondisi != 4 AND status = 1 AND os NOT IN(1, 3, 6)";
                break;

            case 'g':
                $sql .= " AND kondisi != 4 AND status = 1 AND orisinalitas_os = 1";
                break;

            case 'h':
                $sql .= " AND kondisi != 4 AND status = 1 AND orisinalitas_os = 0";
                break;
        }

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>