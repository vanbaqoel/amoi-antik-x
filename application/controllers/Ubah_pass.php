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
	        $this->load->model('user_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('ubah_pass_view');
	}

	public function do_ubah_pass()
	{
		$update_result = $this->user_model->ubah_pass($this->session->username, $this->input->post('txtLama'), $this->input->post('txtBaru'));
		echo json_encode(array("status" => $update_result));
	}

}
