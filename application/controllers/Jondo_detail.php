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

	public function jondo_view($status, $kategori, $unit, $nm_unit)
	{
		$status_desc = "";
		switch ($status) {
			case 'a':
				$status_desc = "$kategori TERCATAT PADA SIMAK BMN/SIPAT";
				break;

			case 'b':
				$status_desc = "$kategori YANG BISA DIGUNAKAN BEKERJA";
				break;

			case 'c':
				$status_desc = "$kategori YANG TIDAK BISA DIGUNAKAN BEKERJA";
				break;

			case 'd':
				$status_desc = "$kategori SUDAH JOIN DOMAIN";
				break;

			case 'e':
				$status_desc = "$kategori BELUM JOIN DOMAIN";
				break;

			case 'f':
				$status_desc = "$kategori BERSISTEM OPERASI WINDOWS XP";
				break;

			case 'g':
				$status_desc = "$kategori BERSISTEM OPERASI WINDOWS 7";
				break;

			case 'h':
				$status_desc = "$kategori BERSISTEM OPERASI WINDOWS 10";
				break;

			case 'i':
				$status_desc = "$kategori BERSISTEM OPERASI LAINNYA";
				break;
		}
		$data = array('status' => $status, 'status_desc' => $status_desc, 'kategori' => $kategori, 'kd_unit' => $unit, 'nm_unit' => $nm_unit );
		$this->load->view('jondo_detail_view', $data);
	}

	public function jondo($status, $kategori, $unit)
	{

		$list = $this->jondo_detail_model->jondo($unit, $status, $kategori);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = ($kategori == 'LAPTOP' ? $kategori : $row->kategori);
        	$rows[] = $row->alamat_ip;
        	$rows[] = $row->hostname;
        	$rows[] = $row->nup;
        	$rows[] = $row->lokasi;
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
