<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('server_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('server_view');
	}

	public function get_all()
	{
		$list = $this->server_model->get_all($this->session->kd_unit);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="edit_server('.$row->id.')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="delete_server('.$row->id.')"><i class="fa fa-trash"></i></button>
                      </div>';
        	$rows[] = $row->kategori;
        	$rows[] = $row->merek;
        	$rows[] = $row->tipe;
        	$rows[] = $row->sn;
        	$rows[] = $row->processor;
        	$rows[] = $row->jumlah_processor;
        	$rows[] = $row->jumlah_core;
        	$rows[] = $row->storage;
        	$rows[] = $row->ram;
        	$rows[] = $row->nic;
        	$rows[] = $row->optical;
        	$rows[] = $row->os;
        	$rows[] = $row->edisi_os;
        	$rows[] = $row->orisinalitas_os;
        	$rows[] = $row->office;
        	$rows[] = $row->antivirus;
        	$rows[] = $row->alamat_ip;
        	$rows[] = $row->hostname;
        	$rows[] = $row->join_domain;
        	$rows[] = $row->kode_barang;
        	$rows[] = $row->nup;
        	$rows[] = $row->tahun_perolehan;
        	$rows[] = $row->kondisi;
        	$rows[] = $row->nip;
        	$rows[] = $row->lokasi;
        	$rows[] = $row->keterangan;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function add_server()
	{
		$data = array(
			'id' => '',
			'kategori' => $this->input->post('cboKategori'),
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => strtoupper($this->input->post('txtSN')),
			'processor' => strtoupper($this->input->post('txtProcessor')),
			'jumlah_processor' => $this->input->post('txtJumlahProcessor'),
			'jumlah_core' => $this->input->post('txtJumlahCore'),
			'storage' => $this->input->post('txtStorage'),
			'ram' => $this->input->post('txtRAM'),
			'nic' => $this->input->post('cboNIC'),
			'optical' => $this->input->post('cboOptical'),
			'os' => strtoupper($this->input->post('txtOS')),
			'edisi_os' => strtoupper($this->input->post('txtEdisiOS')),
			'orisinalitas_os' => $this->input->post('cboOrisinalitasOS'),
			'office' => strtoupper($this->input->post('txtOffice')),
			'antivirus' => strtoupper($this->input->post('txtAntivirus')),
			'alamat_ip' => strtoupper($this->input->post('txtAlamatIP')),
			'hostname' => strtoupper($this->input->post('txtHostName')),
			'join_domain' => $this->input->post('cboJoinDomain'),
			'kode_barang' => strtoupper($this->input->post('txtKodeBarang')),
			'nup' => strtoupper($this->input->post('txtNUP')),
			'tahun_perolehan' => strtoupper($this->input->post('txtTahunPerolehan')),
			'kondisi' => $this->input->post('cboKondisi'),
			'nip' => strtoupper($this->input->post('txtNIP')),
			'lokasi' => strtoupper($this->input->post('txtLokasi')),
			'keterangan' => strtoupper($this->input->post('txtKeterangan')),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$insert = $this->server_model->add_server($data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit_server($id)
	{
		$data = $this->server_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_server($id)
	{
		$data = array(
			'kategori' => $this->input->post('cboKategori'),
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => $this->input->post('txtSN'),
			'processor' => strtoupper($this->input->post('txtProcessor')),
			'jumlah_processor' => $this->input->post('txtJumlahProcessor'),
			'jumlah_core' => $this->input->post('txtJumlahCore'),
			'storage' => $this->input->post('txtStorage'),
			'ram' => $this->input->post('txtRAM'),
			'nic' => $this->input->post('cboNIC'),
			'optical' => $this->input->post('cboOptical'),
			'os' => strtoupper($this->input->post('txtOS')),
			'edisi_os' => strtoupper($this->input->post('txtEdisiOS')),
			'orisinalitas_os' => strtoupper($this->input->post('cboOrisinalitasOS')),
			'office' => strtoupper($this->input->post('txtOffice')),
			'antivirus' => strtoupper($this->input->post('txtAntivirus')),
			'alamat_ip' => $this->input->post('txtAlamatIP'),
			'hostname' => strtoupper($this->input->post('txtHostName')),
			'join_domain' => $this->input->post('cboJoinDomain'),
			'kode_barang' => $this->input->post('txtKodeBarang'),
			'nup' => $this->input->post('txtNUP'),
			'tahun_perolehan' => $this->input->post('txtTahunPerolehan'),
			'kondisi' => $this->input->post('cboKondisi'),
			'nip' => $this->input->post('txtNIP'),
			'lokasi' => strtoupper($this->input->post('txtLokasi')),
			'keterangan' => strtoupper($this->input->post('txtKeterangan')),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$this->server_model->update_server(array('id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_server($id)
	{
		$this->mperangkat->delete_server($id);
		echo json_encode(array("status" => TRUE));
	}
}