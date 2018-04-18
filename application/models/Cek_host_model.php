<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_host_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all($kode_unit)
    {
        $sql = "
            SELECT alamat_ip, hostname, lokasi FROM t_server WHERE kode_unit = '$kode_unit' AND alamat_ip != ''
            UNION
            SELECT alamat_ip, hostname, lokasi FROM t_pc WHERE kode_unit = '$kode_unit' AND alamat_ip != ''
            UNION
            SELECT alamat_ip, hostname, lokasi FROM t_laptop WHERE kode_unit = '$kode_unit' AND alamat_ip != ''
            ";

        $query = $this->db->query($sql);

        return $query->result();
    }
}

?>