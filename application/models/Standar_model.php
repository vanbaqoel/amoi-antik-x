<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standar_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $this->db->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION';");
        $sql = "
            SELECT
                z.kode_unit,
                aa.nm_unit,
                ab.kd_perangkat,
                ab.deskripsi nm_perangkat,
                z.jml_standar,
                z.jml_dinilai,
                (z.jml_dinilai - z.jml_standar) selisih_jml,
                z.jml_on_spek,
                (z.jml_on_spek - z.jml_standar) selisih_on_spek
            FROM (
                SELECT
                    y.kode_unit,
                    y.perangkat,
                    y.jml_dinilai,
                    y.jml_on_spek,
                    (CASE
                        WHEN y.perangkat = 1 THEN (SELECT jml_pc FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 2 THEN (SELECT jml_laptop FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 3 THEN (SELECT jml_projector FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 4 THEN (SELECT jml_scanner FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 5 THEN (SELECT jml_ups FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 6 THEN (SELECT jml_printer FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 7 THEN (SELECT jml_server FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 8 THEN (SELECT jml_cctv FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 9 THEN (SELECT jml_absensi FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 10 THEN (SELECT jml_antrian FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 11 THEN (SELECT jml_fax FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                        WHEN y.perangkat = 12 THEN (SELECT jml_tv FROM view_std_jumlah WHERE kd_unit = y.kode_unit)
                    END) jml_standar
                FROM view_hasil_penilaian y
            ) z
            LEFT JOIN r_unit aa ON z.kode_unit = aa.kd_unit
            LEFT JOIN r_perangkat ab ON z.perangkat = ab.kd_perangkat"
            .(($unit != '000') ? " WHERE z.kode_unit = '$unit'" : "").
            " ORDER BY aa.no_urut ASC, z.perangkat ASC";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_all_chart($unit)
    {
        //$this->db->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION';");
        $sql = "
            SELECT
                b.perangkat,
                SUM(b.a) a,
                SUM(b.b) b,
                SUM(b.c) c
            FROM (
                SELECT
                    a.*,
                    (CASE
                        WHEN a.perangkat = 'SERVER' THEN (SELECT jml_server FROM r_std_jumlah WHERE kd_unit = a.kode_unit)
                        WHEN a.perangkat = 'PC' THEN (SELECT jml_pc FROM r_std_jumlah WHERE kd_unit = a.kode_unit)
                        WHEN a.perangkat = 'LAPTOP' THEN (SELECT jml_laptop FROM r_std_jumlah WHERE kd_unit = a.kode_unit)
                    END) c
                FROM (
                    SELECT
                        kode_unit,
                        'SERVER' perangkat,
                        COUNT(*) a,
                        SUM(CASE WHEN nilai = 5 THEN 1 ELSE 0 END) b
                    FROM t_server_std
                    GROUP BY kode_unit
                    UNION
                    SELECT
                        kode_unit,
                        'PC' perangkat,
                        COUNT(*) a,
                        SUM(CASE WHEN nilai = 5 THEN 1 ELSE 0 END) b
                    FROM t_pc_std
                    GROUP BY kode_unit
                    UNION
                    SELECT
                        kode_unit,
                        'LAPTOP' perangkat,
                        COUNT(*) a,
                        SUM(CASE WHEN nilai = 5 THEN 1 ELSE 0 END) b
                    FROM t_laptop_std
                    GROUP BY kode_unit
                ) a
            ) b LEFT JOIN r_unit c ON b.kode_unit = c.kd_unit"
            .(($unit != '000') ? " WHERE kode_unit = '$unit'" : "").
            " GROUP BY b.perangkat
            ORDER BY b.perangkat DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>