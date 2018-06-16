<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join_domain_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                x.kode_unit,
                y.nm_unit,
                x.perangkat,
                (COALESCE(SUM(x.f), 0) + COALESCE(SUM(x.g), 0) + COALESCE(SUM(x.h), 0) + COALESCE(SUM(x.i), 0)) a,
                COALESCE(SUM(x.b), 0) b,
                COALESCE(SUM(x.c), 0) c,
                COALESCE(SUM(x.d), 0) d,
                COALESCE(SUM(x.e), 0) e,
                COALESCE(SUM(x.f), 0) f,
                COALESCE(SUM(x.g), 0) g,
                COALESCE(SUM(x.h), 0) h,
                COALESCE(SUM(x.i), 0) i
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    CASE WHEN status = 1 THEN jml END AS b,
                    CASE WHEN status = 1 AND koneksi = 1 THEN jml END AS c,
                    CASE WHEN koneksi = 1 AND join_domain = 1 THEN jml END AS d,
                    CASE WHEN koneksi = 1 AND join_domain = 0 THEN jml END AS e,
                    CASE WHEN os = 1 THEN jml END AS f,
                    CASE WHEN os = 3 THEN jml END AS g,
                    CASE WHEN os = 6 THEN jml END AS h,
                    CASE WHEN os NOT IN(1, 3, 6) THEN jml END AS i
                FROM all_view) x
                JOIN r_unit y ON x.kode_unit = y.kd_unit
            ".(($unit != '000') ? "WHERE kode_unit = '$unit'" : "")."
            GROUP BY x.kode_unit, x.perangkat
            ORDER BY y.no_urut ASC, x.perangkat DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_all_chart($unit, $perangkat)
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
                    CASE WHEN koneksi = 1 AND join_domain = 1 THEN jml END AS a,
                    CASE WHEN koneksi = 1 AND join_domain = 0 THEN jml END AS b
                FROM all_view "
            .(($unit != '000') ? "WHERE kode_unit = '$unit'" : "").
            ") z "
            .(($perangkat != 0) ? "WHERE perangkat = '$where_perangkat' " : " ").
            "GROUP BY kode_unit";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>