<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('os_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('os_view');
	}

	public function get_os()
	{
		$list = $this->os_model->get_all($this->session->kd_unit);

        $data = array();
        foreach($list as $row){
        	$rows = array();
            $rows[] = $row->kode_unit;
        	$rows[] = $row->nm_unit;
            $rows[] = $row->nm_perangkat;
        	$rows[] = $row->a;
        	$rows[] = $row->b;
        	$rows[] = $row->c;
        	$rows[] = $row->d;
        	$rows[] = $row->e;
            $rows[] = $row->f;
        	$rows[] = $row->g;
        	$rows[] = $row->h;
            $id_enc = strtr($this->encrypt->encode("$row->perangkat,$row->nm_perangkat,$row->kode_unit,$row->nm_unit"), array('+' => '.', '=' => '-', '/' => '~'));
        	$rows[] = $id_enc;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function get_os_chart()
	{
		$list = $this->os_model->get_all_chart($this->session->kd_unit);

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
