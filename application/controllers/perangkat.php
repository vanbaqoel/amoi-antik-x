<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perangkat extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('mperangkat');
        } else {
            redirect(base_url('login'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('vperangkat');
	}

	public function get_pc()
	{
		$list = $this->mperangkat->getPC();

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" onclick="edit_pc('.$row->id.')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" onclick="delete_pc('.$row->id.')"><i class="fa fa-trash"></i></button>
                    </div>';//$row->ID;
        	$rows[] = $row->kategori;
        	$rows[] = $row->merek;
        	$rows[] = $row->tipe;
        	$rows[] = $row->sn;
        	$rows[] = $row->processor;
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

        	$data[] = $rows;
        }

        $output = array(
            "data" => $data,
            );

        //Output to JSON format
        echo json_encode($output);
	}

	public function add_pc()
	{
		$data = array(
			'id' => '',
			'kategori' => $this->input->post('radKategori'),
			'merek' => strtoupper($this->input->post('txtMerek')), 
			'tipe' => strtoupper($this->input->post('txtTipe')), 
			'sn' => $this->input->post('txtSN'), 
			'processor' => strtoupper($this->input->post('txtProcessor')), 
			'storage' => $this->input->post('txtStorage'), 
			'ram' => $this->input->post('txtRAM'), 
			'nic' => $this->input->post('cboNIC'), 
			'optical' => $this->input->post('cboOptical'), 
			'os' => strtoupper($this->input->post('txtOS')), 
			'edisi_os' => strtoupper($this->input->post('txtEdisiOS')), 
			'orisinalitas_os' => strtoupper($this->input->post('txtEdisiOS')), 
			'office' => strtoupper($this->input->post('txtOffice')), 
			'antivirus' => strtoupper($this->input->post('txtAntivirus')), 
			'alamat_ip' => $this->input->post('txtIP'), 
			'hostname' => strtoupper($this->input->post('txtHostname')), 
			'join_domain' => $this->input->post('cboJoin'), 
			'kode_barang' => $this->input->post('txtKdBarang'), 
			'nup' => $this->input->post('txtNUP'), 
			'tahun_perolehan' => $this->input->post('txtPerolehan'), 
			'kondisi' => $this->input->post('cboKondisi'), 
			'nip' => $this->input->post('cboPenggunaan'), 
			'lokasi' => strtoupper($this->input->post('txtLokasi')), 
			'keterangan' => strtoupper($this->input->post('txtKeterangan')), 
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$insert = $this->mperangkat->addPC($data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit_pc($id)
	{
		$data = $this->mperangkat->getPCbyID($id);

		echo json_encode($data);
	}

	public function update_pc($id)
	{
		$data = array(
			'kategori' => $this->input->post('cboKategori'),
			'merek' => strtoupper($this->input->post('txtMerek')), 
			'tipe' => strtoupper($this->input->post('txtTipe')), 
			'sn' => $this->input->post('txtSN'), 
			'processor' => strtoupper($this->input->post('txtProcessor')), 
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

		$this->mperangkat->updatePC(array('id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_pc($id)
	{
		$this->mperangkat->deletePC($id);
		echo json_encode(array("status" => TRUE));
	}
}
