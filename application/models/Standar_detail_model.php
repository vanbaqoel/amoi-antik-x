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
            // PC
            case 1:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        (SELECT deskripsi FROM r_processor WHERE kd_processor = a.processor) processor,
                        b.processor astd,
                        a.storage,
                        b.storage bstd,
                        a.ram,
                        b.ram cstd,
                        (SELECT deskripsi FROM r_nic WHERE kd_nic = a.nic) nic,
                        b.nic dstd,
                        (SELECT deskripsi FROM r_optical WHERE kd_optical = a.optical) optical,
                        b.optical estd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_pc a, t_pc_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 5";
                break;
            // Laptop/Notebook
            case 2:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        (SELECT deskripsi FROM r_processor WHERE kd_processor = a.processor) processor,
                        b.processor astd,
                        a.storage,
                        b.storage bstd,
                        a.ram,
                        b.ram cstd,
                        (SELECT deskripsi FROM r_nic WHERE kd_nic = a.nic) nic,
                        b.nic dstd,
                        (SELECT deskripsi FROM r_wifi WHERE kd_wifi = a.wifi) wifi,
                        b.wifi estd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_laptop a, t_laptop_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 5";
                break;
            // LCD Projector
            case 3:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        (SELECT deskripsi FROM r_resolusi WHERE kd_resolusi = a.resolusi) resolusi,
                        b.resolusi astd,
                        a.brightness,
                        b.brightness bstd,
                        a.contrast_ratio,
                        b.contrast_ratio cstd,
                        (SELECT deskripsi FROM r_aspect_ratio WHERE kd_aspect_ratio = a.aspect_ratio) aspect_ratio,
                        b.aspect_ratio dstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_projector a, t_projector_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 4";
                break;
            //Scanner
            case 4:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.scan_speed,
                        b.scan_speed astd,
                        a.bit_depth,
                        b.bit_depth bstd,
                        a.doc_size,
                        b.doc_size cstd,
                        (SELECT deskripsi FROM r_usb WHERE kd_usb = a.interface) interface,
                        b.interface dstd,
                        a.sent_speed,
                        b.sent_speed estd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_scanner a, t_scanner_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 5";
                break;
            // UPS
            case 5:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.output,
                        b.output astd,
                        a.half_load,
                        b.half_load bstd,
                        a.full_load,
                        b.full_load cstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_ups a, t_ups_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 3";
                break;
            // Printer
            case 6:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        (SELECT deskripsi FROM r_kategori WHERE kd_jenis = 4 AND kd_kategori = a.kategori) katdesc,
                        (SELECT deskripsi FROM r_print_method WHERE kd_method = a.print_method) printmethdesc,
                        b.print_method astd,
                        a.print_speed,
                        b.print_speed bstd,
                        a.media_size,
                        b.media_size cstd,
                        (SELECT deskripsi FROM r_con_method WHERE kd_con_method = a.koneksi) conmethdesc,
                        b.koneksi dstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_printer a, t_printer_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 4";
                break;
            // Komputer Server
            case 7:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        (SELECT deskripsi FROM r_kategori WHERE kd_jenis = 1 AND kd_kategori = a.kategori) jenis,
                        b.kategori astd,
                        a.jml_processor,
                        b.jumlah_processor bstd,
                        a.jml_core,
                        b.jumlah_core cstd,
                        a.storage,
                        b.storage dstd,
                        a.ram,
                        b.ram estd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_server a, t_server_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 5";
                break;
            // CCTV
            case 8:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.frame_rate,
                        b.frame_rate astd,
                        a.channel,
                        b.channel bstd,
                        a.harddisk,
                        b.harddisk cstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_cctv a, t_cctv_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 3";
                break;
            // Mesin Absensi
            case 9:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.user_cap,
                        b.user_cap acstd,
                        a.record_cap,
                        b.record_cap bcstd,
                        a.recog,
                        b.recog cstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_absensi a, t_absensi_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 3";
                break;
            // Mesin Antrian
            case 10:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.counter,
                        b.counter astd,
                        a.ticket,
                        b.ticket bstd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_antrian a, t_antrian_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 2";
                break;
            // Facsimile
            case 11:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        a.speed,
                        b.speed astd,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_fax a, t_fax_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 1";
                break;
            // Televisi
            case 12:
                $sql = "
                    SELECT
                        a.nup,
                        a.merek,
                        a.tipe,
                        (SELECT deskripsi FROM r_kategori WHERE kd_jenis = 11 AND kd_kategori = a.kategori) katdesc,
                        b.kategori astd,
                        a.ukuran,
                        (SELECT deskripsi FROM r_ruang WHERE kd_ruang = a.lokasi) lokasi
                    FROM t_tv a, t_tv_std b
                    WHERE
                        a.id = b.id AND
                        a.kode_unit = '$unit' AND
                        b.nilai < 1";
                break;


        }

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>