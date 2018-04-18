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
			$info = array(
				'username' => $list[0]->USERNAME,
				'role' => $list[0]->ROLE,
				'kd_unit' => $list[0]->KD_UNIT,
				'name' => $list[0]->NAME,
				'avatar' => $list[0]->AVATAR,
				'loggedin' => TRUE
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
