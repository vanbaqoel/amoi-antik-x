<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jondo_detail extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('jondo_detail_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	// public function jondo_view($status, $kategori, $unit, $nm_unit)
	public function jondo_view($status, $id_enc)
	{
		$id_dec = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));
		$param = explode(',', $id_dec);
		$status_desc = "";
		switch ($status) {
			case 'a':
				$status_desc = "$param[1] TERCATAT PADA AMOI-ANTIK";
				break;

			case 'b':
				$status_desc = "$param[1] YANG DIGUNAKAN BEKERJA";
				break;

			case 'c':
				$status_desc = "$param[1] YANG TERHUBUNG DENGAN JARINGAN KEMENKEU";
				break;

			case 'd':
				$status_desc = "$param[1] SUDAH JOIN DOMAIN";
				break;

			case 'e':
				$status_desc = "$param[1] BELUM JOIN DOMAIN";
				break;
		}
		$data = array('status' => $status, 'status_desc' => $status_desc, 'perangkat' => $param[0], 'kd_unit' => $param[2], 'nm_unit' => $param[3] );
		$this->load->view('jondo_detail_view', $data);
	}

	public function jondo($status, $perangkat, $unit)
	{

		$list = $this->jondo_detail_model->jondo($unit, $status, $perangkat);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->nup;
        	$rows[] = "$row->merek $row->tipe";
        	$rows[] = $row->alamat_ip;
        	$rows[] = $row->hostname;
        	$rows[] = $row->lokdesc;
        	$rows[] = $row->keterangan;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}
}
