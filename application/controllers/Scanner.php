<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scanner extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('scanner_model');
	        $this->load->model('reference_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('scanner_view');
	}

	public function get_all()
	{
		$list = $this->scanner_model->get_all($this->session->kd_unit);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->id;
        	$rows[] = $row->nup;
        	$rows[] = "$row->merek $row->tipe";
        	$rows[] = "$row->scan_speed MS/LINE";
        	$rows[] = "$row->bit_depth BIT";
        	$rows[] = ($row->doc_size == 1) ? "HINGGA F4" : "DI BAWAH F4";
        	$rows[] = $row->usbdesc;
        	$rows[] = "$row->sent_speed PPM";
        	$rows[] = $row->kondesc;
        	$rows[] = $row->lokdesc;
        	$rows[] = $row->keterangan;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$id_enc = strtr($this->encrypt->encode($row->id), array('+' => '.', '=' => '-', '/' => '~'));

        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Lihat" onclick="view_scanner('."'$id_enc'".')"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="edit_scanner('."'$id_enc'".')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="delete_scanner('."'$id_enc'".')"><i class="fa fa-trash"></i></button>
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

		$ref['r_usb'] = $this->reference_model->get_usb();
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

		$this->load->view('scanner_ru_view', $data);
	}

	public function add_scanner()
	{
		$data = array(
			'id' => '',
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => strtoupper($this->input->post('txtSN')),
			'scan_speed' => $this->input->post('txtScanSpeed'),
			'bit_depth' => $this->input->post('txtBitDepth'),
			'doc_size' => $this->input->post('cboDocSize'),
			'interface' => $this->input->post('cboInterface'),
			'sent_speed' => $this->input->post('txtSentSpeed'),
			'kode_barang' => $this->input->post('txtKodeBarang'),
			'nup' => $this->input->post('txtNUP'),
			'tahun_perolehan' => $this->input->post('txtTahunPerolehan'),
			'kondisi' => $this->input->post('cboKondisi'),
			'status' => $this->input->post('cboStatus'),
			'lokasi' => $this->input->post('cboLokasi'),
			'keterangan' => strtoupper($this->input->post('txtKeterangan')),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$insert = $this->scanner_model->add_scanner($data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit_scanner($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$data = $this->scanner_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_scanner($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$data = array(
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => strtoupper($this->input->post('txtSN')),
			'scan_speed' => $this->input->post('txtScanSpeed'),
			'bit_depth' => $this->input->post('txtBitDepth'),
			'doc_size' => $this->input->post('cboDocSize'),
			'interface' => $this->input->post('cboInterface'),
			'sent_speed' => $this->input->post('txtSentSpeed'),
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

		$this->scanner_model->update_scanner(array('id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_scanner($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$this->scanner_model->delete_scanner($id);
		echo json_encode(array("status" => TRUE));
	}
}
