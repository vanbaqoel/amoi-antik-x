<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_spek_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function nilai_pc($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_pc_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_pc_std');
        }

        $sql = "
            REPLACE INTO t_pc_std (id, processor, storage, ram, nic, optical, kode_unit, nilai)
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
            $this->db->delete('t_laptop_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_laptop_std');
        }

        $sql = "
            REPLACE INTO t_laptop_std (id, processor, storage, ram, nic, wifi, kode_unit, nilai)
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

    public function nilai_projector($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_projector_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_projector_std');
        }

        $sql = "
            REPLACE INTO t_projector_std (id, resolusi, brightness, contrast_ratio, aspect_ratio, kode_unit, nilai)
            SELECT a.*, (resolusi + brightness + contrast_ratio + aspect_ratio) nilai
            FROM (
                SELECT
                    id,
                    IF(resolusi >= 3, 1, 0) resolusi,
                    IF(brightness >= 2200, 1, 0) brightness,
                    IF(contrast_ratio >= 2000, 1, 0) contrast_ratio,
                    IF(aspect_ratio > 0, 1, 0) aspect_ratio,
                    kode_unit
                FROM t_projector
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_scanner($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_scanner_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_scanner_std');
        }

        $sql = "
            REPLACE INTO t_scanner_std (id, scan_speed, bit_depth, doc_size, interface, sent_speed, kode_unit, nilai)
            SELECT a.*, (scan_speed + bit_depth + doc_size + interface + sent_speed) nilai
            FROM (
                SELECT
                    id,
                    IF(scan_speed <= 6.4, 1, 0) scan_speed,
                    IF(bit_depth >= 24, 1, 0) bit_depth,
                    doc_size,
                    IF(interface >= 2, 1, 0) interface,
                    IF(sent_speed >= 25, 1, 0) sent_speed,
                    kode_unit
                FROM t_scanner
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_ups($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_ups_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_ups_std');
        }

        $sql = "
            REPLACE INTO t_ups_std (id, output, half_load, full_load, kode_unit, nilai)
            SELECT a.*, (output + half_load + full_load) nilai
            FROM (
                SELECT
                    id,
                    IF(output >= 10, 1, 0) output,
                    IF(half_load >= 20, 1, 0) half_load,
                    IF(full_load >= 15, 1, 0) full_load,
                    kode_unit
                FROM t_ups
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_printer($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_printer_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_printer_std');
        }

        $sql = "
            REPLACE INTO t_printer_std (id, print_method, print_speed, media_size, koneksi, kode_unit, nilai)
            SELECT a.*, (print_method + print_speed + media_size + koneksi) nilai
            FROM (
                SELECT
                    id,
                    IF(print_method >= 2, 1, 0) print_method,
                    /*IF(kategori = 1, IF(print_speed >= 35, 1, 0), IF(print_speed >= 15, 1, 0))*/ 1 print_speed,
                    IF(media_size = 'MIN. A4', 1, 0) media_size,
                    IF(koneksi > 0, 1, 0) koneksi,
                    kode_unit
                FROM t_printer
                WHERE kategori != 3 AND kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_server($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_server_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_server_std');
        }

        $sql = "
            REPLACE INTO t_server_std (id, kategori, jumlah_processor, jumlah_core, storage, ram, kode_unit, nilai)
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

    public function nilai_cctv($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_cctv_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_cctv_std');
        }

        $sql = "
            REPLACE INTO t_cctv_std (id, frame_rate, channel, harddisk, kode_unit, nilai)
            SELECT a.*, (frame_rate + channel + harddisk) nilai
            FROM (
                SELECT
                    id,
                    IF(frame_rate >= 19, 1, 0) frame_rate,
                    IF(channel >= 24, 1, 0) channel,
                    IF(harddisk >= 2000, 1, 0) harddisk,
                    kode_unit
                FROM t_cctv
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_absensi($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_absensi_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_absensi_std');
        }

        $sql = "
            REPLACE INTO t_absensi_std (id, user_cap, record_cap, recog, kode_unit, nilai)
            SELECT a.*, (user_cap + record_cap + recog) nilai
            FROM (
                SELECT
                    id,
                    IF(user_cap >= 1000, 1, 0) user_cap,
                    IF(record_cap >= 30000, 1, 0) record_cap,
                    IF(recog < 1, 0, 1) recog,
                    kode_unit
                FROM t_absensi
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_antrian($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_antrian_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_antrian_std');
        }

        $sql = "
            REPLACE INTO t_antrian_std (id, counter, ticket, kode_unit, nilai)
            SELECT a.*, (counter + ticket) nilai
            FROM (
                SELECT
                    id,
                    IF(counter >= 4, 1, 0) counter,
                    IF(ticket >= 2, 1, 0) ticket,
                    kode_unit
                FROM t_antrian
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_fax($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_fax_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_fax_std');
        }

        $sql = "
            REPLACE INTO t_fax_std (id, speed, kode_unit, nilai)
            SELECT a.*, (speed) nilai
            FROM (
                SELECT
                    id,
                    IF(speed >= 20, 1, 0) speed,
                    kode_unit
                FROM t_fax
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function nilai_tv($unit)
    {
        if ($unit != '000') {
            $this->db->delete('t_tv_std', array('kode_unit' => $unit));
        } else {
            $this->db->truncate('t_tv_std');
        }

        $sql = "
            REPLACE INTO t_tv_std (id, kategori, kode_unit, nilai)
            SELECT a.*, (kategori) nilai
            FROM (
                SELECT
                    id,
                    IF(kategori > 1, 1, 0) kategori,
                    kode_unit
                FROM t_tv
                WHERE kondisi != 4 AND status = 1" . (($unit != '000') ? " AND kode_unit = '$unit'" : "") . "
            ) a";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function get_all($kode_unit)
    {
        $sql = "
            SELECT
                (SELECT COUNT(*) FROM t_pc_std WHERE nilai = 5" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") pc_std,
                (SELECT COUNT(*) FROM t_laptop_std WHERE nilai = 5" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") laptop_std,
                (SELECT COUNT(*) FROM t_projector_std WHERE nilai = 4" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") projector_std,
                (SELECT COUNT(*) FROM t_scanner_std WHERE nilai = 5" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") scanner_std,
                (SELECT COUNT(*) FROM t_ups_std WHERE nilai = 3" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") ups_std,
                (SELECT COUNT(*) FROM t_printer_std WHERE nilai = 4" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") printer_std,
                (SELECT COUNT(*) FROM t_server_std WHERE nilai = 5" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") server_std,
                (SELECT COUNT(*) FROM t_cctv_std WHERE nilai = 3" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") cctv_std,
                (SELECT COUNT(*) FROM t_absensi_std WHERE nilai = 3" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") absensi_std,
                (SELECT COUNT(*) FROM t_antrian_std WHERE nilai = 2" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") antrian_std,
                (SELECT COUNT(*) FROM t_fax_std WHERE nilai = 1" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") fax_std,
                (SELECT COUNT(*) FROM t_tv_std WHERE nilai = 1" . (($kode_unit != '000') ? " AND kode_unit = '$kode_unit'" : "") . ") tv_std
            FROM DUAL
            ";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>