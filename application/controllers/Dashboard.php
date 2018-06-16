<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        // $this->load->model('laptop_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('dashboard_view');
	}

	public function get_jondo_chart($perangkat)
	{
		$this->load->model('join_domain_model');

		$list = $this->join_domain_model->get_all_chart($this->session->kd_unit, $perangkat);

        $data = array();
        foreach($list as $row){
        	$rows = array();
        	$rows[] = $row->x;
        	$rows[] = $row->y;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}
}
