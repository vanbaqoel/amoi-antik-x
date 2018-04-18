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
		$server = $this->nilai_spek_model->nilai_server($kode_unit);
        $pc = $this->nilai_spek_model->nilai_pc($kode_unit);
        $laptop = $this->nilai_spek_model->nilai_laptop($kode_unit);

        $list = $this->nilai_spek_model->get_all($kode_unit);

        $data = array();
        foreach($list as $row){
        	$rows[] = $server + $pc + $laptop;
        	$rows[] = $row->server_std;
        	$rows[] = $row->pc_std;
        	$rows[] = $row->laptop_std;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}
}
