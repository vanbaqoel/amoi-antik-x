<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_kondisi_data($unit, $perangkat)
    {
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
                FROM view_all "
            .(($unit != '000') ? "WHERE kode_unit = '$unit'" : "").
            ") e "
            .(($perangkat != 0) ? "WHERE perangkat = $perangkat " : " ");

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_spek_data($unit, $perangkat)
    {
        $sql = "
            SELECT
                SUM(COALESCE(a, 0)) w,
                SUM(COALESCE(b, 0)) x
            FROM (
                SELECT
                    kode_unit,
                    perangkat,
                    SUM(jml_on_spek) a,
                    SUM(jml_dinilai - jml_on_spek) b
                FROM view_hasil_penilaian "
                .(($perangkat != 0) ? "WHERE perangkat = $perangkat " : "").
                "GROUP BY kode_unit
            ) e "
            .(($unit != '000') ? "WHERE kode_unit = '$unit'" : "");

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_jondo_data($unit, $perangkat)
    {
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
                FROM view_all
                WHERE "
                .(($perangkat != 0) ? "perangkat = $perangkat " : "perangkat IN (1, 2, 7)")
                .(($unit != '000') ? " AND kode_unit = '$unit' " : "").
            ") z ";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_os_data($unit, $perangkat)
    {
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
                FROM view_all
                WHERE "
                .(($perangkat != 0) ? "perangkat = $perangkat " : "perangkat IN (1, 2, 7)")
                .(($unit != '000') ? " AND kode_unit = '$unit' " : "").
            ") z ";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>