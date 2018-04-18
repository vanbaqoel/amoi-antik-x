<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_login($user, $pass)
    {
        $sql = "SELECT
                    USERNAME,
                    ROLE,
                    KD_UNIT,
                    NAME,
                    AVATAR
                FROM USERS
                WHERE
                    DELETED = 0 AND
                    username = '$user' AND
                    password = '".md5($user.$pass."amoipasswordsuffix")."'";

        $query = $this->db->query($sql);

        return $query->result();
    }
}
?>