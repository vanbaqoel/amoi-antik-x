<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

        /* Load database model */
        $this->load->model('mbooking');

        /* Initialize minifier */
        // $this->ci_minifier->set_domparser(2);
	}

	public function index()
	{
		$this->load->view('free/search');
	}

	public function populate_city()
	{
		$list = $this->mbooking->getCity();
		$dat = array();
		foreach ($list as $row) {
			$rows = array();
			$rows['kd_kota'] = $row->kd_kota;
			$rows['nm_kota'] = $row->nm_kota;
			$rows['kd_provinsi'] = $row->kd_provinsi;
			$rows['nm_provinsi'] = $row->nm_provinsi;

			$dat[] = $rows;
		}

		$output = array("data" => $dat);
        $this->output->set_output(json_encode($output));
	}

	public function search()
	{
		$tgl_berangkat = $this->input->post('dtp-date');
		$tgl = date("Y-m-d", strtotime($tgl_berangkat));
		$kota_asal = $this->input->post('cbo-origin');
		$kota_tujuan = $this->input->post('cbo-dest');
		$jml_penumpang = $this->input->post('txt-passengers');
		 // var_dump($tgl);
		if (empty($this->input->post())) {
			redirect('booking', 'refresh');
		} else {
			$list = $this->mbooking->getJadwal($tgl, $kota_asal, $kota_tujuan, $jml_penumpang);
			$datas = array();
	        foreach($list as $row){
	            $rows = array();
	            $rows[] = $row->kd_tiket; 
				$rows[] = $row->nm_kota_asal; 
				$rows[] = $row->bpoint_asal; 
				$rows[] = $row->nm_kota_tujuan; 
				$rows[] = $row->bpoint_tujuan; 
				$rows[] = $row->via; 
				$rows[] = $row->kelas; 
				$rows[] = $row->pergi; 
				$rows[] = $row->lama_jalan; 
				$rows[] = $row->harga; 
				$rows[] = $row->seat; 
				$rows[] = $row->fasilitas;
				$rows[] = $row->kd_kelas;

	            $datas[] = $rows;
	        }

	        $data = array(
	            "datas" => $datas,
				"tgl_berangkat" => $tgl,
				"kota_asal" => $kota_asal,
				"kota_tujuan" => $kota_tujuan,
				"jml_penumpang" => $jml_penumpang
	        );

	        $this->load->view("free/search-result", $data);
			// $this->output->set_output(json_encode($output));
	    }
	}
}
