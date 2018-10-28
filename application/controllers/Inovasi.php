<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inovasi extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('inovasi_model');
			$this->load->library('upload');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('inovasi_view');
	}

	public function get_all()
	{
		$list = $this->inovasi_model->get_all($this->session->kd_unit);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->id;
        	$rows[] = $row->judul;
        	$rows[] = $row->deskripsi;
        	$rows[] = ($row->lingkup == 0) ? "INTERNAL" : "EKSTERNAL";
        	$rows[] = $row->penerapan;
        	$rows[] = '<a href="./files/inovasi/'.$row->file_dok.'.pdf" target="_blank" class="btn btn-sm btn-default" title="Unduh"><i class="fa fa-download"></i></a>';
        	$rows[] = $row->keterangan;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$id_enc = strtr($this->encrypt->encode($row->id), array('+' => '.', '=' => '-', '/' => '~'));

        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="edit_inovasi('."'$id_enc'".')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="delete_inovasi('."'$id_enc'".')"><i class="fa fa-trash"></i></button>
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

		$this->load->view('inovasi_ru_view', $data);
	}

	public function add_inovasi()
	{
		$config['upload_path'] = './files/inovasi/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 7168;
        $new_name = $this->session->kd_unit.time();
		$config['file_name'] = $new_name;

        $this->upload->initialize($config);

		$data = array(
			'id' => '',
			'judul' => $this->input->post('txtJudul'),
			'deskripsi' => $this->input->post('txtDeskripsi'),
			'lingkup' => $this->input->post('cboLingkup'),
			'penerapan' => $this->input->post('txtTanggal'),
			'file_dok' => $new_name,
			'keterangan' => $this->input->post('txtKeterangan'),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		if ( !$this->upload->do_upload('txtFile')){
			echo json_encode(array("status" => FALSE));
		} else {
			$insert = $this->inovasi_model->add_inovasi($data);
			if ($insert) {
				echo json_encode(array("status" => TRUE));
			} else {
				echo json_encode(array("status" => FALSE));
			}
		}
	}

	public function edit_inovasi($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$data = $this->inovasi_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_inovasi($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$config['upload_path'] = './files/inovasi/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 7168;
        $new_name = $this->session->kd_unit.time();
		$config['file_name'] = $new_name;

        $this->upload->initialize($config);

		$data = array(
			'judul' => $this->input->post('txtJudul'),
			'deskripsi' => $this->input->post('txtDeskripsi'),
			'lingkup' => $this->input->post('cboLingkup'),
			'penerapan' => $this->input->post('txtTanggal'),
			'file_dok' => $new_name,
			'keterangan' => $this->input->post('txtKeterangan'),
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		if (empty($_FILES['txtFile'])){
			if (!$this->upload->do_upload('txtFile')){
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
				echo json_encode(array("status" => FALSE));
			} else {
				$afrow = $this->inovasi_model->update_inovasi(array('id' => $id), $data);
				if ($afrow != 0) {
					echo json_encode(array("status" => TRUE));
				} else {
					echo json_encode(array("status" => FALSE));
				}
			}
		} else {
			unset($data['file_dok']);
			$afrow = $this->inovasi_model->update_inovasi(array('id' => $id), $data);
			if ($afrow != 0) {
				echo json_encode(array("status" => TRUE));
			} else {
				echo json_encode(array("status" => FALSE));
			}
		}
	}

	public function delete_inovasi($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$this->inovasi_model->delete_inovasi($id);
		echo json_encode(array("status" => TRUE));
	}
}
