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

	/*public function standar_view($kategori, $nm_kategori, $unit, $nm_unit)
	{
		$status_desc = urldecode($nm_kategori) . " YANG TIDAK MEMENUHI STANDAR";
		$data = array('status_desc' => $status_desc, 'kategori' => $kategori, 'kd_unit' => $unit, 'nm_unit' => $nm_unit );
		$this->load->view('standar_detail_view', $data);
	}*/

	public function standar_view($id_enc)
	{
		$id_dec = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));
		$param = explode(',', $id_dec);
		$status_desc = urldecode($param[1]) . " YANG TIDAK MEMENUHI STANDAR";
		$data = array('status_desc' => $status_desc, 'kategori' => $param[0], 'kd_unit' => $param[2], 'nm_unit' => $param[3] );
		$this->load->view('standar_detail_view', $data);
	}

	public function standar($kategori, $unit)
	{

		$list = $this->standar_detail_model->standar($unit, $kategori);

        $data = array();
        $no = 0;
        switch (urldecode($kategori)) {
        	// PC
            case 1:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->processor;
		        	$rows[] = $row->astd;
		        	$rows[] = "$row->storage GB";
		        	$rows[] = $row->bstd;
		        	$rows[] = "$row->ram GB";
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->nic;
		        	$rows[] = $row->dstd;
		        	$rows[] = $row->optical;
		        	$rows[] = $row->estd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Laptop/Notebook
            case 2:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->processor;
		        	$rows[] = $row->astd;
		        	$rows[] = "$row->storage GB";
		        	$rows[] = $row->bstd;
		        	$rows[] = "$row->ram GB";
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->nic;
		        	$rows[] = $row->dstd;
		        	$rows[] = $row->wifi;
		        	$rows[] = $row->estd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // LCD Projector
            case 3:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->resolusi;
		        	$rows[] = $row->astd;
		        	$rows[] = "$row->brightness LUMEN";
		        	$rows[] = $row->bstd;
		        	$rows[] = "$row->contrast_ratio : 1";
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->aspect_ratio;
		        	$rows[] = $row->dstd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Scanner
            case 4:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = "$row->scan_speed MS/LINE";
		        	$rows[] = $row->astd;
		        	$rows[] = $row->bit_depth;
		        	$rows[] = $row->bstd;
		        	$rows[] = ($row->doc_size == 1) ? "HINGGA F4" : "DI BAWAH F4";
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->interface;
		        	$rows[] = $row->dstd;
        			$rows[] = "$row->sent_speed PPM";
		        	$rows[] = $row->estd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // UPS
            case 5:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = "$row->output KVA";
		        	$rows[] = $row->astd;
		        	$rows[] = "$row->half_load MENIT";
		        	$rows[] = $row->bstd;
		        	$rows[] = "$row->full_load MENIT";
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Printer
            case 6:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->katdesc;
		        	$rows[] = $row->printmethdesc;
		        	$rows[] = $row->astd;
		        	$rows[] = "$row->print_speed PPM";
		        	$rows[] = $row->bstd;
		        	$rows[] = $row->media_size;
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->conmethdesc;
		        	$rows[] = $row->dstd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Komputer Server
            case 7:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->jenis;
		        	$rows[] = $row->astd;
		        	$rows[] = $row->jml_processor;
		        	$rows[] = $row->bstd;
		        	$rows[] = $row->jml_core;
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->storage;
		        	$rows[] = $row->dstd;
		        	$rows[] = $row->ram;
		        	$rows[] = $row->estd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // CCTV
            case 8:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = "$row->frame_rate FPS";
		        	$rows[] = $row->astd;
		        	$rows[] = $row->channel;
		        	$rows[] = $row->bstd;
		        	$rows[] = "$row->harddisk GB";
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Mesin Absensi
            case 9:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->user_cap;
		        	$rows[] = $row->acstd;
		        	$rows[] = $row->record_cap;
		        	$rows[] = $row->bcstd;
		        	$rows[] = $row->recog;
		        	$rows[] = $row->cstd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Mesin Antrian
            case 10:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->counter;
		        	$rows[] = $row->astd;
		        	$rows[] = $row->ticket;
		        	$rows[] = $row->bstd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Facsimile
            case 11:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->astd;
		        	$rows[] = "$row->speed S/P";
		        	$rows[] = $row->bstd;
		        	$rows[] = $row->lokasi;

		        	$data[] = $rows;
		        }
                break;
            // Televisi
            case 12:
                foreach($list as $row){
		        	$rows = array();
		            $no++;
		            $rows[] = $no;
		        	$rows[] = $row->nup;
		        	$rows[] = "$row->merek $row->tipe";
		        	$rows[] = $row->katdesc;
		        	$rows[] = $row->astd;
		        	$rows[] = "$row->ukuran INCH";
		        	$rows[] = $row->lokasi;

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
