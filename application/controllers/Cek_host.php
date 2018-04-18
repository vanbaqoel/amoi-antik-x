<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_host extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('cek_host_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('cek_host_view');
	}

	private function ping($ip)
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

	private function ping_nmap($kode_unit)
	{
		set_time_limit(0);

		$command = 'cmd /c "c:\\Program Files (x86)\\Nmap\\nmap.exe" -sn ';
		switch ($kode_unit) {
			case 'K17':
				$command .= '10.77.26.0/24';
				break;

			case '042':
				$command .= '10.76.42.0/24 10.82.42.0/24';
				break;

			case '079':
				$command .= '10.76.79.0/24 10.82.79.0/24';
				break;

			case '093':
				$command .= '10.76.93.0/24 10.82.93.0/24';
				break;

			case '094':
				$command .= '10.76.94.0/24 10.82.94.0/24';
				break;

			case '117':
				$command .= '10.76.117.0/24 10.82.117.0/24';
				break;

			case '167':
				$command .= '10.76.167.0/24 10.82.167.0/24';
				break;
		}

		exec($command, $output1, $status);

		$ip_lists = array();
		foreach ($output1 as $item) {
			if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $item, $ip_match)) {
			   $ip_lists[] = $ip_match[0];
			}
		}

		return $ip_lists;
	}

	public function cek_all($kode_unit)
	{
		$ip_lists = $this->ping_nmap($kode_unit);
		$list = $this->cek_host_model->get_all($kode_unit);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->alamat_ip;
        	$rows[] = $row->hostname;
        	$rows[] = $row->lokasi;
        	if (in_array($row->alamat_ip, $ip_lists)) {
        		$rows[] = 'Y';
        	} else {
        		$rows[] = 'N';
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
