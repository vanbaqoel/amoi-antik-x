<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os_detail extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('os_detail_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function os_view($status, $id_enc)
	{
		$id_dec = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));
		$param = explode(',', $id_dec);
		$status_desc = "";
		switch ($status) {
			case 'a':
				$status_desc = "$param[0] TERCATAT PADA AMOI-ANTIK";
				break;

			case 'b':
				$status_desc = "$param[0] YANG DIGUNAKAN BEKERJA";
				break;

			case 'c':
				$status_desc = "$param[0] BERSISTEM OPERASI WINDOWS XP";
				break;

			case 'd':
				$status_desc = "$param[0] BERSISTEM OPERASI WINDOWS 7";
				break;

			case 'e':
				$status_desc = "$param[0] BERSISTEM OPERASI WINDOWS 10";
				break;

			case 'f':
				$status_desc = "$param[0] BERSISTEM OPERASI LAINNYA";
				break;

			case 'g':
				$status_desc = "$param[0] BERSISTEM OPERASI GENUINE";
				break;

			case 'h':
				$status_desc = "$param[0] BERSISTEM OPERASI NOT GENUINE";
				break;
		}
		$data = array('status' => $status, 'status_desc' => $status_desc, 'kategori' => $param[0], 'kd_unit' => $param[1], 'nm_unit' => $param[2] );
		$this->load->view('os_detail_view', $data);
	}

	public function os($status, $kategori, $unit)
	{

		$list = $this->os_detail_model->os($unit, $status, $kategori);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->nup;
        	$rows[] = ($kategori == 'LAPTOP' ? $kategori : $row->katdesc);
        	$rows[] = "$row->merek $row->tipe";
        	$rows[] = "$row->osdesc $row->osedesc";
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
