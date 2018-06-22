<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standar extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('standar_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('standar_view');
	}

    public function get_all()
    {
        $list = $this->standar_model->get_all($this->session->kd_unit);

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
            $rows[] = '<button type="button" class="btn btn-sm btn-default" title="Lihat" onclick="a('."'$row->perangkat', '$row->kode_unit', '$row->nm_unit'".')"><i class="fa fa-eye"></i></button>';

            $data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
    }

	public function get_all_chart()
	{
		$list = $this->standar_model->get_all_chart($this->session->kd_unit);

        $data = array();
        foreach($list as $row){
        	$rows = array();
        	$rows[] = $row->perangkat;
        	$rows[] = $row->a;
        	$rows[] = $row->b;
        	$rows[] = $row->c;

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}
}
