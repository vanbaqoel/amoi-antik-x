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
                        a.kategori jenis,
                        b.kategori jstd,
                        a.jumlah_processor,
                        b.jumlah_processor pstd,
                        a.jumlah_core,
                        b.jumlah_core cstd,
                        a.storage,
                        b.storage sstd,
                        a.ram,
                        b.ram rstd,
                        a.lokasi,
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
                        a.kategori,
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.sn,
                        a.processor,
                        b.processor pstd,
                        a.storage,
                        b.storage sstd,
                        a.ram,
                        b.ram rstd,
                        a.nic,
                        b.nic nstd,
                        a.optical,
                        b.optical ostd,
                        a.lokasi,
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
                        a.processor,
                        b.processor pstd,
                        a.storage,
                        b.storage sstd,
                        a.ram,
                        b.ram rstd,
                        a.nic,
                        b.nic nstd,
                        a.wifi,
                        b.wifi wstd,
                        a.lokasi,
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