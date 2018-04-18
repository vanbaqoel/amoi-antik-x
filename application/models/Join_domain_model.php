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
                (COALESCE(SUM(x.b), 0) + COALESCE(SUM(x.c), 0)) a,
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
                    CASE WHEN kondisi != 'RUSAK BERAT' THEN jml END AS b,
                    CASE WHEN kondisi = 'RUSAK BERAT' THEN jml END AS c,
                    CASE WHEN join_domain = 'SUDAH' THEN jml END AS d,
                    CASE WHEN join_domain = 'BELUM' THEN jml END AS e,
                    CASE WHEN os = 'WINDOWS XP' THEN jml END AS f,
                    CASE WHEN os = 'WINDOWS 7' THEN jml END AS g,
                    CASE WHEN os = 'WINDOWS 10' THEN jml END AS h,
                    CASE WHEN os NOT IN('WINDOWS XP', 'WINDOWS 7', 'WINDOWS 10') THEN jml END AS i
                FROM all_view) x JOIN r_unit y ON x.kode_unit = y.kd_unit
            ".(($unit != '000') ? "WHERE kode_unit = '$unit'" : "")."
            GROUP BY x.kode_unit, x.perangkat
            ORDER BY y.no_urut ASC, x.perangkat DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_all_chart($unit)
    {
        $sql = "
            SELECT
                x.kode_unit,
                y.nm_unit,
                x.perangkat,
                (COALESCE(SUM(x.b), 0) + COALESCE(SUM(x.c), 0)) a,
                COALESCE(SUM(x.b), 0) b,
                COALESCE(SUM(x.c), 0) c,
                COALESCE(SUM(x.d), 0) d,
                COALESCE(SUM(x.e), 0) e
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    CASE WHEN kondisi != 'RUSAK BERAT' THEN jml END AS b,
                    CASE WHEN kondisi = 'RUSAK BERAT' THEN jml END AS c,
                    CASE WHEN join_domain = 'SUDAH' AND kondisi != 'RUSAK BERAT' THEN jml END AS d,
                    CASE WHEN join_domain = 'BELUM' AND kondisi != 'RUSAK BERAT' THEN jml END AS e
                FROM all_view) x JOIN r_unit y ON x.kode_unit = y.kd_unit "
            .(($unit != '000') ? "WHERE kode_unit = '$unit'" : "").
            "GROUP BY x.perangkat
            ORDER BY x.perangkat DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>