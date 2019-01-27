<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medsos_model extends CI_Model {

	var $table = 'r_medsos';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($unit)
    {
        $sql = "
            SELECT
                platform,
                nm_akun,
                kode_unit
            FROM r_medsos a";

        if ($unit != '000') {
            $sql .= " WHERE a.kode_unit = '$unit'";
        }

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_by_id($id)
    {
        $sql = "
            SELECT *
            FROM r_medsos
            WHERE platform = $id AND kode_unit = '".$this->session->kd_unit."'";

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function add_medsos($data)
    {
        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() > 0);
    }

    public function update_medsos($data)
    {
        $where = array(
            "platform" => $data["platform"],
            "kode_unit" => $this->session->kd_unit
        );
        $this->db->update($this->table, $data, $where);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_medsos($platform)
    {
        $where = array(
            "platform" => $platform,
            "kode_unit" => $this->session->kd_unit
        );
        $this->db->delete($this->table, $where);

        return ($this->db->affected_rows() > 0);
    }
}

?>