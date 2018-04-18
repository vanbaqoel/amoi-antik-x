<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join_domain extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('join_domain_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('jondo_view');
	}

	public function get_jondo()
	{
		$list = $this->join_domain_model->get_all($this->session->kd_unit);

        $data = array();
        foreach($list as $row){
        	$rows = array();
            $rows[] = $row->kode_unit;
        	$rows[] = $row->nm_unit;
        	$rows[] = $row->perangkat;
        	$rows[] = $row->a;
        	$rows[] = $row->b;
        	$rows[] = $row->c;
        	$rows[] = $row->d;
        	$rows[] = $row->e;
        	$rows[] = $row->f;
        	$rows[] = $row->g;
        	$rows[] = $row->h;
        	$rows[] = $row->i;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function get_jondo_chart()
	{
		$list = $this->join_domain_model->get_all_chart($this->session->kd_unit);

        $data = array();
        foreach($list as $row){
        	$rows = array();
        	$rows[] = $row->perangkat;
        	$rows[] = $row->a;
        	$rows[] = $row->b;
        	$rows[] = $row->c;
        	$rows[] = $row->d;
        	$rows[] = $row->e;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}
}
