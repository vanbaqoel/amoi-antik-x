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
	        $this->load->model('reference_model');
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
        	$rows[] = $row->id;
        	$rows[] = $row->katdesc;
        	$rows[] = $row->merek;
        	$rows[] = $row->tipe;
        	$rows[] = $row->hostname;
        	$rows[] = $row->alamat_ip;
        	$rows[] = $row->lokdesc;
        	$rows[] = $row->keterangan;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$id_enc = strtr($this->encrypt->encode($row->id), array('+' => '.', '=' => '-', '/' => '~'));

        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Lihat" onclick="view_server('."'$id_enc'".')"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="edit_server('."'$id_enc'".')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.(($this->session->kd_unit == '000') ? 'disabled' : '').' onclick="delete_server('."'$id_enc'".')"><i class="fa fa-trash"></i></button>
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

		$ref['r_kategori'] = $this->reference_model->get_kategori(1); // Jenis = 1 (Server)
		// $ref['r_processor'] = $this->reference_model->get_processor();
		// $ref['r_nic'] = $this->reference_model->get_nic();
		// $ref['r_optical'] = $this->reference_model->get_optical();
		$ref['r_os'] = $this->reference_model->get_os();
		$ref['r_osedisi'] = $this->reference_model->get_osedisi();
		$ref['r_office'] = $this->reference_model->get_office();
		$ref['r_koneksi'] = $this->reference_model->get_koneksi();
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

		$this->load->view('server_ru_view', $data);
	}

	public function add_server()
	{
		$data = array(
			'id' => '',
			'kategori' => $this->input->post('cboKategori'),
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => strtoupper($this->input->post('txtSN')),
			'jml_processor' => $this->input->post('txtJmlProcessor'),
			'jml_core' => $this->input->post('txtJmlCore'),
			'storage' => $this->input->post('txtStorage'),
			'ram' => $this->input->post('txtRAM'),
			// 'nic' => $this->input->post('cboNIC'),
			// 'optical' => $this->input->post('cboOptical'),
			'os' => $this->input->post('cboOS'),
			'edisi_os' => $this->input->post('cboEdisiOS'),
			'orisinalitas_os' => $this->input->post('cboOrisinalitasOS'),
			'office' => $this->input->post('cboOffice'),
			'antivirus' => strtoupper($this->input->post('txtAntivirus')),
			'koneksi' => $this->input->post('cboKoneksi'),
			'hostname' => strtoupper($this->input->post('txtHostName')),
			'alamat_ip' => strtoupper($this->input->post('txtAlamatIP')),
			'join_domain' => $this->input->post('cboJoinDomain'),
			'kode_barang' => strtoupper($this->input->post('txtKodeBarang')),
			'nup' => $this->input->post('txtNUP'),
			'tahun_perolehan' => $this->input->post('txtTahunPerolehan'),
			'kondisi' => $this->input->post('cboKondisi'),
			'status' => $this->input->post('cboStatus'),
			'lokasi' => $this->input->post('cboLokasi'),
			'nip' => $this->input->post('txtNIP'),
			'keterangan' => strtoupper($this->input->post('txtKeterangan')),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$insert = $this->server_model->add_server($data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit_server($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$data = $this->server_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_server($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$data = array(
			'kategori' => $this->input->post('cboKategori'),
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => $this->input->post('txtSN'),
			'jml_processor' => $this->input->post('txtJmlProcessor'),
			'jml_core' => $this->input->post('txtJmlCore'),
			'storage' => $this->input->post('txtStorage'),
			'ram' => $this->input->post('txtRAM'),
			// 'nic' => $this->input->post('cboNIC'),
			// 'optical' => $this->input->post('cboOptical'),
			'os' => $this->input->post('cboOS'),
			'edisi_os' => $this->input->post('cboEdisiOS'),
			'orisinalitas_os' => $this->input->post('cboOrisinalitasOS'),
			'office' => $this->input->post('cboOffice'),
			'antivirus' => strtoupper($this->input->post('txtAntivirus')),
			'koneksi' => $this->input->post('cboKoneksi'),
			'hostname' => strtoupper($this->input->post('txtHostName')),
			'alamat_ip' => $this->input->post('txtAlamatIP'),
			'join_domain' => $this->input->post('cboJoinDomain'),
			'kode_barang' => $this->input->post('txtKodeBarang'),
			'nup' => $this->input->post('txtNUP'),
			'tahun_perolehan' => $this->input->post('txtTahunPerolehan'),
			'kondisi' => $this->input->post('cboKondisi'),
			'status' => $this->input->post('cboStatus'),
			'lokasi' => $this->input->post('cboLokasi'),
			'nip' => $this->input->post('txtNIP'),
			'keterangan' => strtoupper($this->input->post('txtKeterangan')),
			'created_by' => $this->session->username,
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$this->server_model->update_server(array('id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_server($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$this->server_model->delete_server($id);
		echo json_encode(array("status" => TRUE));
	}
}
