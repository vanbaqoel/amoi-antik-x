<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os_model extends CI_Model {

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
                COALESCE(SUM(x.jml), 0) a,
                COALESCE(SUM(x.b), 0) b,
                COALESCE(SUM(x.c), 0) c,
                COALESCE(SUM(x.d), 0) d,
                COALESCE(SUM(x.e), 0) e,
                COALESCE(SUM(x.f), 0) f,
                COALESCE(SUM(x.g), 0) g,
                COALESCE(SUM(x.h), 0) h
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    jml,
                    CASE WHEN kondisi != 4 AND status = 1 THEN jml END AS b,
                    CASE WHEN kondisi != 4 AND status = 1 AND os = 1 THEN jml END AS c,
                    CASE WHEN kondisi != 4 AND status = 1 AND os = 3 THEN jml END AS d,
                    CASE WHEN kondisi != 4 AND status = 1 AND os = 6 THEN jml END AS e,
                    CASE WHEN kondisi != 4 AND status = 1 AND os NOT IN(1, 3, 6) THEN jml END AS f,
                    CASE WHEN kondisi != 4 AND status = 1 AND orisinalitas_os = 1 THEN jml END AS g,
                    CASE WHEN kondisi != 4 AND status = 1 AND orisinalitas_os = 0 THEN jml END AS h
                FROM all_view) x
                JOIN r_unit y ON x.kode_unit = y.kd_unit
            ".(($unit != '000') ? "WHERE kode_unit = '$unit'" : "")."
            GROUP BY x.kode_unit, x.perangkat
            ORDER BY y.no_urut ASC, x.perangkat DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>