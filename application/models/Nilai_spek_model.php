<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_spek_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function nilai_server($unit)
    {
        $sql = "
            REPLACE INTO t_server_std (id, kategori, jumlah_processor, jumlah_core, storage, ram, kode_unit, nilai)
            SELECT a.*, (kategori + jumlah_processor + jumlah_core + storage + ram) nilai
            FROM (
                SELECT
                    id,
                    IF(kategori IN (SELECT jenis_server FROM r_std_spesifikasi), 1, 0) kategori,
                    IF(jumlah_processor < 1, 0, 1) jumlah_processor,
                    IF(jumlah_core < 8, 0, 1) jumlah_core,
                    IF(storage < 300, 0, 1) storage,
                    IF(ram < 8, 0, 1) ram,
                    kode_unit
                FROM t_server
                WHERE kondisi != 'RUSAK BERAT'" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_pc($unit)
    {
        $sql = "
            REPLACE INTO t_pc_std (id, processor, storage, ram, nic, optical, kode_unit, nilai)
            SELECT a.*, (processor + storage + ram + nic + optical) nilai
            FROM (
                SELECT
                    id,
                    IF(processor IN (SELECT processor FROM r_std_spesifikasi), 1, 0) processor,
                    IF(storage < 500, 0, 1) storage,
                    IF(ram < 2, 0, 1) ram,
                    IF(nic IN (SELECT nic FROM r_std_spesifikasi), 1, 0) nic,
                    IF(optical IN (SELECT optical FROM r_std_spesifikasi), 1, 0) optical,
                    kode_unit
                FROM t_pc
                WHERE kategori != 'SPAN' AND kondisi != 'RUSAK BERAT'" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_laptop($unit)
    {
        $sql = "
            REPLACE INTO t_laptop_std (id, processor, storage, ram, nic, wifi, kode_unit, nilai)
            SELECT a.*, (processor + storage + ram + nic + wifi) nilai
            FROM (
                SELECT
                    id,
                    IF(processor IN (SELECT processor FROM r_std_spesifikasi), 1, 0) processor,
                    IF(storage < 250, 0, 1) storage,
                    IF(ram < 2, 0, 1) ram,
                    IF(nic IN (SELECT nic FROM r_std_spesifikasi), 1, 0) nic,
                    IF(wifi IN (SELECT wifi FROM r_std_spesifikasi), 1, 0) wifi,
                    kode_unit
                FROM t_laptop
                WHERE kondisi != 'RUSAK BERAT'" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function get_all($kode_unit)
    {
        $sql = "
            SELECT
                (SELECT COUNT(*) FROM t_server_std WHERE nilai = 5" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") server_std,
                (SELECT COUNT(*) FROM t_pc_std WHERE nilai = 5" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") pc_std,
                (SELECT COUNT(*) FROM t_laptop_std WHERE nilai = 5" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") laptop_std
            FROM DUAL
            ";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>