<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standar_detail_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function standar($unit, $kategori)
    {
        $sql = "";
        switch ($kategori) {
            case 'SERVER':
                $sql = "
                    SELECT
                        'SERVER' ktg,
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.sn,
                        (SELECT deskripsi FROM r_kategori WHERE kd_jenis = 1 AND kd_kategori = a.kategori) jenis,
                        b.kategori jstd,
                        a.jml_processor,
                        b.jumlah_processor pstd,
                        a.jml_core,
                        b.jumlah_core cstd,
                        a.storage,
                        b.storage sstd,
                        a.ram,
                        b.ram rstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi,
                        a.kode_unit
                    FROM t_server a, t_server_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 5";
                break;

            case 'PC':
                $sql = "
                    SELECT
                        (SELECT deskripsi FROM r_kategori WHERE kd_jenis = 2 AND kd_kategori = a.kategori) kategori,
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.sn,
                        (SELECT deskripsi FROM r_processor WHERE kd_processor = a.processor) processor,
                        b.processor pstd,
                        a.storage,
                        b.storage sstd,
                        a.ram,
                        b.ram rstd,
                        (SELECT deskripsi FROM r_nic WHERE kd_nic = a.nic) nic,
                        b.nic nstd,
                        (SELECT deskripsi FROM r_optical WHERE kd_optical = a.optical) optical,
                        b.optical ostd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi,
                        a.kode_unit
                    FROM t_pc a, t_pc_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 5";
                break;

            case 'LAPTOP':
                $sql = "
                    SELECT
                        'LAPTOP' ktg,
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.sn,
                        (SELECT deskripsi FROM r_processor WHERE kd_processor = a.processor) processor,
                        b.processor pstd,
                        a.storage,
                        b.storage sstd,
                        a.ram,
                        b.ram rstd,
                        (SELECT deskripsi FROM r_nic WHERE kd_nic = a.nic) nic,
                        b.nic nstd,
                        (SELECT deskripsi FROM r_wifi WHERE kd_wifi = a.wifi) wifi,
                        b.wifi wstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi,
                        a.kode_unit
                    FROM t_laptop a, t_laptop_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 5";
                break;
        }

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>