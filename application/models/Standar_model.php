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
                kode_unit,
                nm_unit,
                perangkat,
                a,
                b,
                (b - a) c,
                d,
                (d - a) e
            FROM (
                SELECT
                    x.*,
                    (CASE
                        WHEN x.perangkat = 'SERVER' THEN (SELECT jml_server FROM std_jumlah_view WHERE kode_unit = x.kode_unit)
                        WHEN x.perangkat = 'PC' THEN (SELECT jml_pc FROM std_jumlah_view WHERE kode_unit = x.kode_unit)
                        WHEN x.perangkat = 'LAPTOP' THEN (SELECT jml_laptop FROM std_jumlah_view WHERE kode_unit = x.kode_unit)
                    END) a
                FROM (
                    SELECT
                        n.kode_unit,
                        'SERVER' perangkat,
                        COUNT(m.id) b,
                        SUM(CASE WHEN m.nilai = 5 THEN 1 ELSE 0 END) d
                    FROM t_server_std m RIGHT JOIN t_server n on m.id = n.id
                    GROUP BY n.kode_unit
                    UNION
                    SELECT
                        p.kode_unit,
                        'PC' perangkat,
                        COUNT(o.id) b,
                        SUM(CASE WHEN o.nilai = 5 THEN 1 ELSE 0 END) d
                    FROM t_pc_std o RIGHT JOIN t_pc p on o.id = p.id
                    GROUP BY p.kode_unit
                    UNION
                    SELECT
                        r.kode_unit,
                        'LAPTOP' perangkat,
                        COUNT(q.id) b,
                        SUM(CASE WHEN q.nilai = 5 THEN 1 ELSE 0 END) d
                    FROM t_laptop_std q RIGHT JOIN t_laptop r on q.id = r.id
                    GROUP BY r.kode_unit
                ) x
            ) y LEFT JOIN r_unit z ON y.kode_unit = z.kd_unit"
            .(($unit != '000') ? " WHERE kode_unit = '$unit'" : "").
            " ORDER BY z.no_urut ASC, y.perangkat DESC";

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