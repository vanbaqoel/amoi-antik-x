<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medsos extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('medsos_model');
	        $this->load->model('reference_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('medsos_view');
	}

	public function get_all()
	{
		$list = $this->medsos_model->get_all($this->session->kd_unit);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
            $platform = '';
            switch ($row->platform) {
            	case 1:
            		$platform = "<i class='fa fa-chrome'></i> - MICROWEB";
            		break;
            	case 2:
            		$platform = "<i class='fa fa-twitter-square' style='color: #1DA1F2'></i> - TWITTER";
            		break;
            	case 3:
            		$platform = "<i class='fa fa-facebook-official' style='color: #3B5998'></i> - FACEBOOK";
            		break;
            	case 4:
            		$platform = "<i class='fa fa-instagram' style='color: #262626'></i> - INSTAGRAM";
            		break;
            	case 5:
            		$platform = "<i class='fa fa-youtube-play' style='color: #ff0000'></i> - YOUTUBE";
            		break;
            }
        	$rows[] = $platform;
        	$rows[] = $row->nm_akun;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Lihat" onclick="view_medsos($row->platform)"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.($this->session->crud_locked ? 'disabled' : '').' onclick="edit_medsos('.$row->platform.')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.($this->session->crud_locked ? 'disabled' : '').' onclick="delete_medsos('.$row->platform.')"><i class="fa fa-trash"></i></button>
                      </div>';

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function ru($save_method = NULL)
	{
		if ($save_method === NULL) {
			show_404();
		}

		$title = ($save_method == 'add') ? 'REKAM' : 'UBAH' ;
		$data = array(
			'title' => $title,
			'save_method' => $save_method
		);

		$this->load->view('medsos_ru_view', $data);
	}

	public function add_medsos()
	{
		$data = array(
			'platform' => $this->input->post('cboPlatform'),
			'nm_akun' => $this->input->post('txtAkun'),
			'kode_unit' => $this->session->kd_unit
		);

		$insert_result = $this->medsos_model->add_medsos($data);

		echo json_encode(array("status" => $insert_result));
	}

	public function edit_medsos($id)
	{
		$data = $this->medsos_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_medsos()
	{
		$data = array(
			'platform' => $this->input->post('cboPlatform'),
			'nm_akun' => $this->input->post('txtAkun'),
			'kode_unit' => $this->session->kd_unit
		);

		$update_result = $this->medsos_model->update_medsos($data);
		echo json_encode(array("status" => $update_result));
	}

	public function delete_medsos($platform)
	{
		$delete_result = $this->medsos_model->delete_medsos($platform);
		echo json_encode(array("status" => $delete_result));
	}
}
