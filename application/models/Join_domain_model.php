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
                COALESCE(SUM(x.jml), 0) a,
                COALESCE(SUM(x.b), 0) b,
                COALESCE(SUM(x.c), 0) c,
                COALESCE(SUM(x.d), 0) d,
                COALESCE(SUM(x.e), 0) e
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    jml,
                    CASE WHEN kondisi != 4 AND status = 1 THEN jml END AS b,
                    CASE WHEN kondisi != 4 AND status = 1 AND koneksi = 1 THEN jml END AS c,
                    CASE WHEN kondisi != 4 AND status = 1 AND koneksi = 1 AND join_domain = 1 THEN jml END AS d,
                    CASE WHEN kondisi != 4 AND status = 1 AND koneksi = 1 AND join_domain = 0 THEN jml END AS e
                FROM all_view) x
                JOIN r_unit y ON x.kode_unit = y.kd_unit
                WHERE perangkat != 'SERVER'
            ".(($unit != '000') ? " AND kode_unit = '$unit'" : "")."
            GROUP BY x.kode_unit, x.perangkat
            ORDER BY y.no_urut ASC, x.perangkat DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>