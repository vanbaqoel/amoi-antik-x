<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('riwayat_model');
	        $this->load->model('reference_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
	}

	public function show($kode, $id)
	{
		$id_decode = $this->encrypt->decode(strtr($id, array('.' => '+', '-' => '=', '~' => '/')));
		$desc = $this->riwayat_model->get_perangkat($kode);
		$data = array('kode' => $kode, 'desc' => strtoupper($desc), 'id' => $id_decode);
		$this->load->view('riwayat_view', $data);
	}

	public function get_all($kode, $id)
	{
		$list = $this->riwayat_model->get_all($kode, $id);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->id;
        	$rows[] = $row->rekanan;
        	$rows[] = $row->tgl_mulai;
        	$rows[] = $row->tgl_selesai;
        	$rows[] = $row->uraian;

        	$id_enc = strtr($this->encrypt->encode($row->id), array('+' => '.', '=' => '-', '/' => '~'));

        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Lihat" onclick="view_riwayat('."'$id_enc'".')"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.($this->session->crud_locked ? 'disabled' : '').' onclick="edit_riwayat('."'$id_enc'".')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.($this->session->crud_locked ? 'disabled' : '').' onclick="delete_riwayat('."'$id_enc'".')"><i class="fa fa-trash"></i></button>
                      </div>';

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function fill_ref()
	{
		$ref = array();

		$ref['r_resolusi'] = $this->reference_model->get_resolusi();
		$ref['r_aspect_ratio'] = $this->reference_model->get_aspect_ratio();
		$ref['r_kondisi'] = $this->reference_model->get_kondisi();
		$ref['r_status'] = $this->reference_model->get_status();
		$ref['r_ruang'] = $this->reference_model->get_ruang();

		return $ref;
	}

	public function ru($save_method = NULL)
	{
		if ($save_method === NULL) {
			show_404();
		}

		$title = ($save_method == 'add') ? 'REKAM' : 'UBAH' ;
		$data = array(
			'title' => $title,
			'ref' => $this->fill_ref(),
			'save_method' => $save_method
		);

		$this->load->view('riwayat_ru_view', $data);
	}

	public function add_riwayat()
	{
		$data = array(
			'id' => '',
			'kd_perangkat' => strtoupper($this->input->post('txtKdPerangkat')),
			'id_perangkat' => strtoupper($this->input->post('txtIDPerangkat')),
			'rekanan' => strtoupper($this->input->post('txtRekanan')),
			'tgl_mulai' => $this->input->post('cboTglMulai'),
			'tgl_selesai' => $this->input->post('txtTglSelesai'),
			'uraian' => strtoupper($this->input->post('txtUraian')),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$insert_result = $this->riwayat_model->add_riwayat($data);

		echo json_encode(array("status" => $insert_result));
	}

	public function edit_riwayat($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$data = $this->riwayat_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_riwayat($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$data = array(
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => $this->input->post('txtSN'),
			'resolusi' => $this->input->post('cboResolusi'),
			'brightness' => $this->input->post('txtBrightness'),
			'contrast_ratio' => $this->input->post('txtContrastRatio'),
			'aspect_ratio' => $this->input->post('cboAspectRatio'),
			'kode_barang' => $this->input->post('txtKodeBarang'),
			'nup' => $this->input->post('txtNUP'),
			'tahun_perolehan' => $this->input->post('txtTahunPerolehan'),
			'kondisi' => $this->input->post('cboKondisi'),
			'status' => $this->input->post('cboStatus'),
			'lokasi' => $this->input->post('cboLokasi'),
			'keterangan' => strtoupper($this->input->post('txtKeterangan')),
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$update_result = $this->riwayat_model->update_riwayat(array('id' => $id), $data);
		echo json_encode(array("status" => $update_result));
	}

	public function delete_riwayat($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$delete_result = $this->riwayat_model->delete_riwayat($id);
		echo json_encode(array("status" => $delete_result));
	}
}
