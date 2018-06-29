<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_spek_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function nilai_server($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_server_std', array('kode_unit' => $unit));
        } else {
            $this->db->delete('t_server_std');
        }

        $sql = "
            INSERT INTO t_server_std (id, kategori, jumlah_processor, jumlah_core, storage, ram, kode_unit, nilai)
            SELECT a.*, (kategori + jumlah_processor + jumlah_core + storage + ram) nilai
            FROM (
                SELECT
                    id,
                    IF(kategori > 1, 1, 0) kategori,
                    IF(jml_processor < 1, 0, 1) jumlah_processor,
                    IF(jml_core < 8, 0, 1) jumlah_core,
                    IF(storage < 300, 0, 1) storage,
                    IF(ram < 8, 0, 1) ram,
                    kode_unit
                FROM t_server
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_pc($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_server_std', array('kode_unit' => $unit));
        } else {
            $this->db->delete('t_server_std');
        }

        $sql = "
            INSERT INTO t_pc_std (id, processor, storage, ram, nic, optical, kode_unit, nilai)
            SELECT a.*, (processor + storage + ram + nic + optical) nilai
            FROM (
                SELECT
                    id,
                    IF(processor IN (SELECT kd_processor FROM r_processor WHERE benchmark >= 3676), 1, 0) processor,
                    IF(storage < 500, 0, 1) storage,
                    IF(ram < 2, 0, 1) ram,
                    IF(nic < 2 OR nic = 9, 0, 1) nic,
                    IF(optical < 4 OR optical = 9, 0, 1) optical,
                    kode_unit
                FROM t_pc
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_laptop($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_server_std', array('kode_unit' => $unit));
        } else {
            $this->db->delete('t_server_std');
        }

        $sql = "
            INSERT INTO t_laptop_std (id, processor, storage, ram, nic, wifi, kode_unit, nilai)
            SELECT a.*, (processor + storage + ram + nic + wifi) nilai
            FROM (
                SELECT
                    id,
                    IF(processor IN (SELECT kd_processor FROM r_processor WHERE benchmark >= 3676), 1, 0) processor,
                    IF(storage < 250, 0, 1) storage,
                    IF(ram < 2, 0, 1) ram,
                    IF(nic < 2 OR nic = 9, 0, 1) nic,
                    IF(wifi < 2 OR wifi = 9, 0, 1) wifi,
                    kode_unit
                FROM t_laptop
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
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