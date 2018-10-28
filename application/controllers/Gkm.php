<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gkm extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('gkm_model');
			$this->load->library('upload');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('gkm_view');
	}

	public function get_all()
	{
		$list = $this->gkm_model->get_all($this->session->kd_unit);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->id;
        	$rows[] = $row->judul;
        	$rows[] = $row->pelaksanaan;
        	$rows[] = '<a href="./files/gkm/'.$row->file_dok.'.pdf" target="_blank" class="btn btn-sm btn-default" title="Unduh"><i class="fa fa-download"></i></a>';
        	$rows[] = $row->keterangan;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$id_enc = strtr($this->encrypt->encode($row->id), array('+' => '.', '=' => '-', '/' => '~'));

        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="edit_gkm('."'$id_enc'".')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="delete_gkm('."'$id_enc'".')"><i class="fa fa-trash"></i></button>
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

		$this->load->view('gkm_ru_view', $data);
	}

	public function add_gkm()
	{
		$config['upload_path'] = './files/gkm/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 7168;
        $new_name = $this->session->kd_unit.time();
		$config['file_name'] = $new_name;

        $this->upload->initialize($config);

		$data = array(
			'id' => '',
			'judul' => $this->input->post('txtJudul'),
			'pelaksanaan' => $this->input->post('txtTanggal'),
			'file_dok' => $new_name,
			'keterangan' => $this->input->post('txtKeterangan'),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		if (!$this->upload->do_upload('txtFile')){
			echo json_encode(array("status" => FALSE));
		} else {
			$insert_result = $this->gkm_model->add_gkm($data);
			echo json_encode(array("status" => $insert_result));
		}
	}

	public function edit_gkm($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$data = $this->gkm_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_gkm($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$config['upload_path'] = './files/gkm/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 7168;
        $new_name = $this->session->kd_unit.time();
		$config['file_name'] = $new_name;

        $this->upload->initialize($config);

		$data = array(
			'judul' => $this->input->post('txtJudul'),
			'pelaksanaan' => $this->input->post('txtTanggal'),
			'file_dok' => $new_name,
			'keterangan' => $this->input->post('txtKeterangan'),
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		if (!empty($_FILES['txtFile']['name'])){
			if (!$this->upload->do_upload('txtFile')){
				echo json_encode(array("status" => FALSE));
			} else {
				$update_result = $this->gkm_model->update_gkm(array('id' => $id), $data);
				echo json_encode(array("status" => $update_result));
			}
		} else {
			unset($data['file_dok']);
			$update_result = $this->gkm_model->update_gkm(array('id' => $id), $data);
			echo json_encode(array("status" => $update_result));
		}
	}

	public function delete_gkm($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$delete_result = $this->gkm_model->delete_gkm($id);
		echo json_encode(array("status" => $delete_result));
	}
}
