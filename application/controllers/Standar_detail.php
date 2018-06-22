<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standar_detail extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('standar_detail_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function standar_view($kategori, $unit, $nm_unit)
	{
		$status_desc = "$kategori YANG TIDAK MEMENUHI STANDAR";
		$data = array('status_desc' => $status_desc, 'kategori' => $kategori, 'kd_unit' => $unit, 'nm_unit' => $nm_unit );
		$this->load->view('standar_detail_view', $data);
	}

	public function standar($kategori, $unit)
	{

		$list = $this->standar_detail_model->standar($unit, $kategori);

        $data = array();
        $no = 0;
        switch ($kategori) {
            case 'SERVER':
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->ktg;
		        	$rows[] = $row->nup;
		        	$rows[] = $row->merek;
		        	$rows[] = $row->tipe;
		        	$rows[] = $row->sn;
		        	$rows[] = $row->jenis;
		        	$rows[] = $row->jstd;
		        	$rows[] = $row->jml_processor;
		        	$rows[] = $row->pstd;
		        	$rows[] = $row->jml_core;
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->storage;
		        	$rows[] = $row->sstd;
		        	$rows[] = $row->ram;
		        	$rows[] = $row->rstd;
		        	$rows[] = $row->lokasi;
		        	$rows[] = $row->kode_unit;

		        	$data[] = $rows;
		        }
                break;

            case 'PC':
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->kategori;
		        	$rows[] = $row->nup;
		        	$rows[] = $row->merek;
		        	$rows[] = $row->tipe;
		        	$rows[] = $row->sn;
		        	$rows[] = $row->processor;
		        	$rows[] = $row->pstd;
		        	$rows[] = $row->storage;
		        	$rows[] = $row->sstd;
		        	$rows[] = $row->ram;
		        	$rows[] = $row->rstd;
		        	$rows[] = $row->nic;
		        	$rows[] = $row->nstd;
		        	$rows[] = $row->optical;
		        	$rows[] = $row->ostd;
		        	$rows[] = $row->lokasi;
		        	$rows[] = $row->kode_unit;

		        	$data[] = $rows;
		        }
                break;

            case 'LAPTOP':
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->ktg;
		        	$rows[] = $row->nup;
		        	$rows[] = $row->merek;
		        	$rows[] = $row->tipe;
		        	$rows[] = $row->sn;
		        	$rows[] = $row->processor;
		        	$rows[] = $row->pstd;
		        	$rows[] = $row->storage;
		        	$rows[] = $row->sstd;
		        	$rows[] = $row->ram;
		        	$rows[] = $row->rstd;
		        	$rows[] = $row->nic;
		        	$rows[] = $row->nstd;
		        	$rows[] = $row->wifi;
		        	$rows[] = $row->wstd;
		        	$rows[] = $row->lokasi;
		        	$rows[] = $row->kode_unit;

		        	$data[] = $rows;
		        }
                break;
        }


        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}
}
