<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_spek extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('nilai_spek_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('nilai_spek_view');
	}

	/*private function ping($ip)
	{
		set_time_limit(0);
		exec("ping -n 1 $ip", $output, $status);
		if ($status == 0) {
			if(count(preg_grep('/Destination host unreachable/i', $output)) == 0){
	            return "Y";
	        } else {
	            return "N";
	        }
		} else {
			return "N";
		}

	}
*/
	public function nilai_all($kode_unit)
	{
        $pc = $this->nilai_spek_model->nilai_pc($kode_unit);
        $laptop = $this->nilai_spek_model->nilai_laptop($kode_unit);
        $projector = $this->nilai_spek_model->nilai_projector($kode_unit);
        $scanner = $this->nilai_spek_model->nilai_scanner($kode_unit);
        $ups = $this->nilai_spek_model->nilai_ups($kode_unit);
        $printer = $this->nilai_spek_model->nilai_printer($kode_unit);
		$server = $this->nilai_spek_model->nilai_server($kode_unit);
        $cctv = $this->nilai_spek_model->nilai_cctv($kode_unit);
        $absensi = $this->nilai_spek_model->nilai_absensi($kode_unit);
        $antrian = $this->nilai_spek_model->nilai_antrian($kode_unit);
        $fax = $this->nilai_spek_model->nilai_fax($kode_unit);
        $tv = $this->nilai_spek_model->nilai_tv($kode_unit);

        $list = $this->nilai_spek_model->get_all($kode_unit);

        $data = array();
        foreach($list as $row){
        	$rows[] = $pc + $laptop + $projector + $scanner + $ups + $printer + $server + $cctv + $absensi + $antrian + $fax + $tv;
        	$rows[] = $row->pc_std;
        	$rows[] = $row->laptop_std;
        	$rows[] = $row->projector_std;
        	$rows[] = $row->scanner_std;
        	$rows[] = $row->ups_std;
        	$rows[] = $row->printer_std;
        	$rows[] = $row->server_std;
        	$rows[] = $row->cctv_std;
        	$rows[] = $row->absensi_std;
        	$rows[] = $row->antrian_std;
        	$rows[] = $row->fax_std;
        	$rows[] = $row->tv_std;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}
}
