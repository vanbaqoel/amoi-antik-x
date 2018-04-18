<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah_pass extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        //$this->load->model('ubah_pass_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('ubah_pass_view');
	}

	private function ping($ip)
	{

	}
}
