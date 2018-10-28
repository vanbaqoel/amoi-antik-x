<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printer_model extends CI_Model {

	var $table = 't_printer';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                a.id,
                a.nup,
                b.deskripsi katdesc,
                a.merek,
                a.tipe,
                c.deskripsi printmethdesc,
                a.print_speed,
                a.media_size,
                d.deskripsi conmethdesc,
                e.deskripsi kondesc,
                f.deskripsi lokdesc,
                a.keterangan,
                a.kode_unit
            FROM t_printer a
            LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 4
            LEFT JOIN r_print_method c ON a.print_method = c.kd_method
            LEFT JOIN r_con_method d ON a.koneksi = d.kd_con_method
            LEFT JOIN r_kondisi e ON a.kondisi = e.kd_kondisi
            LEFT JOIN r_ruang f ON a.lokasi = f.kd_ruang";

        if ($unit != '000') {
            $sql .= " WHERE a.kode_unit = '$unit'";
        }

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_by_id($id)
    {
        $sql = "
            SELECT
                a.*,
                b.deskripsi bdesc,
                c.deskripsi cdesc,
                d.deskripsi ddesc,
                e.deskripsi edesc,
                f.deskripsi fdesc,
                g.deskripsi gdesc
            FROM t_printer a
                LEFT JOIN r_kategori b ON a.kategori = b.kd_kategori AND b.kd_jenis = 4
                LEFT JOIN r_print_method c ON a.print_method = c.kd_method
                LEFT JOIN r_con_method d ON a.koneksi = d.kd_con_method
                LEFT JOIN r_kondisi e ON a.kondisi = e.kd_kondisi
                LEFT JOIN r_status f ON a.status = f.kd_status
                LEFT JOIN r_ruang g ON a.lokasi = g.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_printer($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_printer($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_printer($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return ($this->db->affected_rows() > 0);
    }
}

?>