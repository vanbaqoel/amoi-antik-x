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
	        $this->load->model('dashboard_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('dashboard_view');
	}

	public function get_kondisi_chart($perangkat)
	{
		$list = $this->dashboard_model->get_kondisi_data($this->session->kd_unit, $perangkat);

        $data = array();
        foreach($list as $row){
        	$rows = array();
        	$rows[] = $row->w;
        	$rows[] = $row->x;
        	$rows[] = $row->y;
        	$rows[] = $row->z;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function get_spek_chart($perangkat)
	{
		$list = $this->dashboard_model->get_spek_data($this->session->kd_unit, $perangkat);

        $data = array();
        foreach($list as $row){
        	$rows = array();
        	$rows[] = $row->w;
        	$rows[] = $row->x;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function get_jondo_chart($perangkat)
	{
		$list = $this->dashboard_model->get_jondo_data($this->session->kd_unit, $perangkat);

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

	public function get_os_chart($perangkat)
	{
		$list = $this->dashboard_model->get_os_data($this->session->kd_unit, $perangkat);

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
