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
                b.*,
                (a - c) d,
                (b - c) e,
                c.nm_unit
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
            " ORDER BY c.no_urut ASC, b.perangkat DESC";

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