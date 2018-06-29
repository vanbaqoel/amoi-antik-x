<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_kondisi_data($unit, $perangkat)
    {
        $where_perangkat = "";
        switch ($perangkat) {
            case 1:
                $where_perangkat = "SERVER";
                break;
            case 2:
                $where_perangkat = "PC";
                break;
            case 3:
                $where_perangkat = "LAPTOP";
                break;
        }

        $sql = "
            SELECT
                SUM(COALESCE(a, 0)) w,
                SUM(COALESCE(b, 0)) x,
                SUM(COALESCE(c, 0)) y,
                SUM(COALESCE(d, 0)) z
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    CASE WHEN kondisi = 1 THEN jml END AS a,
                    CASE WHEN kondisi = 2 THEN jml END AS b,
                    CASE WHEN kondisi = 3 THEN jml END AS c,
                    CASE WHEN kondisi = 4 THEN jml END AS d
                FROM all_view "
            .(($unit != '000') ? "WHERE kode_unit = '$unit'" : "").
            ") e "
            .(($perangkat != 0) ? "WHERE perangkat = '$where_perangkat' " : " ");

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_spek_data($unit, $perangkat)
    {
        $where_perangkat = "";
        switch ($perangkat) {
            case 1:
                $where_perangkat = "SERVER";
                break;
            case 2:
                $where_perangkat = "PC";
                break;
            case 3:
                $where_perangkat = "LAPTOP";
                break;
        }

        $sql = "
            SELECT
                SUM(COALESCE(a, 0)) w,
                SUM(COALESCE(b, 0)) x
            FROM (
                SELECT
                    kode_unit,
                    'SERVER' perangkat,
                    SUM(CASE WHEN nilai = 5 THEN 1 ELSE 0 END) a,
                    SUM(CASE WHEN nilai < 5 THEN 1 ELSE 0 END) b
                FROM t_server_std
                GROUP BY kode_unit
                UNION
                SELECT
                    kode_unit,
                    'PC' perangkat,
                    SUM(CASE WHEN nilai = 5 THEN 1 ELSE 0 END) a,
                    SUM(CASE WHEN nilai < 5 THEN 1 ELSE 0 END) b
                FROM t_pc_std
                GROUP BY kode_unit
                UNION
                SELECT
                    kode_unit,
                    'LAPTOP' perangkat,
                    SUM(CASE WHEN nilai = 5 THEN 1 ELSE 0 END) a,
                    SUM(CASE WHEN nilai < 5 THEN 1 ELSE 0 END) b
                FROM t_laptop_std
                GROUP BY kode_unit) e WHERE "
            .(($unit != '000') ? "kode_unit = '$unit' AND " : "1 AND ")
            .(($perangkat != 0) ? "perangkat = '$where_perangkat' " : "1 ");

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_jondo_data($unit, $perangkat)
    {
        $where_perangkat = "";
        switch ($perangkat) {
            case 1:
                $where_perangkat = "SERVER";
                break;
            case 2:
                $where_perangkat = "PC";
                break;
            case 3:
                $where_perangkat = "LAPTOP";
                break;
        }

        $sql = "
            SELECT
                SUM(COALESCE(a, 0)) x,
                SUM(COALESCE(b, 0)) y
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    CASE WHEN kondisi != 4 AND status = 1 AND koneksi = 1 AND join_domain = 1 THEN jml END AS a,
                    CASE WHEN kondisi != 4 AND status = 1 AND koneksi = 1 AND join_domain = 0 THEN jml END AS b
                FROM all_view "
            .(($unit != '000') ? "WHERE kode_unit = '$unit'" : "").
            ") z "
            .(($perangkat != 0) ? "WHERE perangkat = '$where_perangkat' " : " ");

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_os_data($unit, $perangkat)
    {
        $where_perangkat = "";
        switch ($perangkat) {
            case 1:
                $where_perangkat = "SERVER";
                break;
            case 2:
                $where_perangkat = "PC";
                break;
            case 3:
                $where_perangkat = "LAPTOP";
                break;
        }

        $sql = "
            SELECT
                SUM(COALESCE(a, 0)) x,
                SUM(COALESCE(b, 0)) y
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    CASE WHEN kondisi != 4 AND status = 1 AND orisinalitas_os = 1 THEN jml END AS a,
                    CASE WHEN kondisi != 4 AND status = 1 AND orisinalitas_os = 0 THEN jml END AS b
                FROM all_view "
            .(($unit != '000') ? "WHERE kode_unit = '$unit'" : "").
            ") z "
            .(($perangkat != 0) ? "WHERE perangkat = '$where_perangkat' " : " ");

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>