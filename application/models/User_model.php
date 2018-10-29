<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_login($user, $pass)
    {
        $sql = "SELECT
                    A.USERNAME,
                    A.ROLE,
                    A.KD_UNIT,
                    B.TIPE,
                    A.NAME,
                    A.AVATAR
                FROM USERS A, R_UNIT B
                WHERE
                    A.KD_UNIT = B.KD_UNIT AND
                    A.DELETED = 0 AND
                    a.username = '$user' AND
                    a.password = '".md5($user.$pass."amoipasswordsuffix")."'";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function ubah_pass($user, $pass_lama, $pass_baru)
    {
        $sql = "UPDATE users SET password = '".md5($user.$pass_baru."amoipasswordsuffix")."'
                WHERE
                    username = '$user' AND
                    password = '".md5($user.$pass_lama."amoipasswordsuffix")."'";

        $this->db->query($sql);

        return ($this->db->affected_rows() > 0);
    }
}
?>