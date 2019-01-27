<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
        /* Load database model */
        $this->load->model('user_model');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function do_login()
	{
		$data = array('user' => $this->input->post('txtUser'), 'pass' => $this->input->post('txtPass'));
		$list = $this->user_model->get_login($data['user'], $data['pass']);
		if (empty($list)) {
			$data = array('error_message' => 'Nama pengguna atau kata sandi yang Anda masukkan salah!');
			$this->load->view('login_view', $data);
		} else {
			$crud_locked = FALSE;
			if ($list[0]->KD_UNIT == '000') {
	        	$crud_locked = TRUE;
	        } else {
	        	$unit_locked = $this->config->item('masa_penilaian');
	        	$crud_locked = $unit_locked[$list[0]->KD_UNIT];
	        }

			$info = array(
				'username' => $list[0]->USERNAME,
				'role' => $list[0]->ROLE,
				'kd_unit' => $list[0]->KD_UNIT,
				'tipe' => $list[0]->TIPE,
				'name' => $list[0]->NAME,
				'avatar' => $list[0]->AVATAR,
				'loggedin' => TRUE,
				'crud_locked' => $crud_locked
			);

			$this->session->set_userdata($info);
			redirect(base_url('dashboard'), 'refresh');
		}
	}

	public function do_logout() {

		$this->session->set_userdata('loggedin', FALSE);

		/* Hancurkan data session */
		$this->session->sess_destroy();

		redirect(base_url(), 'refresh');
	}
}
