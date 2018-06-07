<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reference_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_jenis()
    {
        $query = $this->db->get('r_jenis');

        return $query->result_array();
    }

    public function get_kategori($jenis)
    {
        $query = $this->db->get_where('r_kategori', array('kd_jenis' => $jenis));

        return $query->result_array();
    }

    public function get_kondisi()
    {
        $query = $this->db->get('r_kondisi');

        return $query->result_array();
    }

    public function get_koneksi()
    {
        $query = $this->db->get('r_koneksi');

        return $query->result_array();
    }

    public function get_nic()
    {
        $query = $this->db->get('r_nic');

        return $query->result_array();
    }

    public function get_office()
    {
        $query = $this->db->get('r_office');

        return $query->result_array();
    }

    public function get_optical()
    {
        $query = $this->db->get('r_optical');

        return $query->result_array();
    }

    public function get_os()
    {
        $query = $this->db->get('r_os');

        return $query->result_array();
    }

    public function get_osedisi()
    {
        $query = $this->db->get('r_osedisi');

        return $query->result_array();
    }

    public function get_processor()
    {
        $query = $this->db->get('r_processor');

        return $query->result_array();
    }

    public function get_ruang()
    {
        $tipe_unit = array(0);
        if ($this->session->tipe != 1) {
            $tipe_unit[] = 2;
            $tipe_unit[] = $this->session->tipe;
        } else {
            $tipe_unit[] = 1;
        }

        $this->db->where_in('tipe_unit', $tipe_unit);
        $query = $this->db->get('r_ruang');

        return $query->result_array();
    }

    public function get_status()
    {
        $query = $this->db->get('r_status');

        return $query->result_array();
    }

    public function get_unit()
    {
        $query = $this->db->get('r_unit');

        return $query->result_array();
    }

    public function get_wifi()
    {
        $query = $this->db->get('r_wifi');

        return $query->result_array();
    }
}
?>