<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scanner_model extends CI_Model {

	var $table = 't_scanner';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                a.id,
                a.nup,
                a.merek,
                a.tipe,
                a.scan_speed,
                a.bit_depth,
                a.doc_size,
                b.deskripsi usbdesc,
                a.sent_speed,
                c.deskripsi kondesc,
                d.deskripsi lokdesc,
                a.keterangan,
                a.kode_unit
            FROM t_scanner a
            LEFT JOIN r_usb b ON a.interface = b.kd_usb
            LEFT JOIN r_kondisi c ON a.kondisi = c.kd_kondisi
            LEFT JOIN r_ruang d ON a.lokasi = d.kd_ruang";

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
                e.deskripsi edesc
            FROM t_scanner a
                LEFT JOIN r_usb b ON a.interface = b.kd_usb
                LEFT JOIN r_kondisi c ON a.kondisi = c.kd_kondisi
                LEFT JOIN r_status d ON a.status = d.kd_status
                LEFT JOIN r_ruang e ON a.lokasi = e.kd_ruang
            WHERE a.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_scanner($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_scanner($where, $data)
    {
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_scanner($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->table);

        return ($this->db->affected_rows() > 0);
    }
}

?>