<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laptop extends CI_Controller {

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->loggedin)
        {
	        /* Load database model */
	        $this->load->model('laptop_model');
	        $this->load->model('reference_model');
        } else {
            redirect(base_url('autentikasi'), 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('laptop_view');
	}

	public function get_all()
	{
		$list = $this->laptop_model->get_all($this->session->kd_unit);

        $data = array();
        $no = 0;
        foreach($list as $row){
        	$rows = array();
            $no++;
            $rows[] = $no;
        	$rows[] = $row->id;
        	$rows[] = $row->nup;
        	$rows[] = "$row->merek $row->tipe";
        	$rows[] = $row->hostname;
        	$rows[] = $row->alamat_ip;
        	$rows[] = $row->kondesc;
        	$rows[] = $row->lokdesc;
        	$rows[] = $row->keterangan;

        	if ($this->session->kd_unit == '000'){
        		$rows[] = $row->kode_unit;
        	}

        	$id_enc = strtr($this->encrypt->encode($row->id), array('+' => '.', '=' => '-', '/' => '~'));

        	$rows[] = '<div class="btn-group">
                      <button type="button" class="btn btn-sm btn-default" title="Lihat" onclick="view_laptop('."'$id_enc'".')"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Ubah" '.($this->session->crud_locked ? 'disabled' : '').' onclick="edit_laptop('."'$id_enc'".')"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-sm btn-default" title="Hapus" '.($this->session->crud_locked ? 'disabled' : '').' onclick="delete_laptop('."'$id_enc'".')"><i class="fa fa-trash"></i></button>
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

		$ref['r_processor'] = $this->reference_model->get_processor();
		$ref['r_nic'] = $this->reference_model->get_nic();
		$ref['r_wifi'] = $this->reference_model->get_wifi();
		$ref['r_optical'] = $this->reference_model->get_optical();
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

		$this->load->view('laptop_ru_view', $data);
	}

	public function add_laptop()
	{
		$data = array(
			'id' => '',
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => strtoupper($this->input->post('txtSN')),
			'processor' => $this->input->post('cboProcessor'),
			'storage' => $this->input->post('txtStorage'),
			'ram' => $this->input->post('txtRAM'),
			'nic' => $this->input->post('cboNIC'),
			'wifi' => $this->input->post('cboWifi'),
			'optical' => $this->input->post('cboOptical'),
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

		$insert_result = $this->laptop_model->add_laptop($data);

		echo json_encode(array("status" => $insert_result));
	}

	public function edit_laptop($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$data = $this->laptop_model->get_by_id($id);

		echo json_encode($data);
	}

	public function update_laptop($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$data = array(
			'merek' => strtoupper($this->input->post('txtMerek')),
			'tipe' => strtoupper($this->input->post('txtTipe')),
			'sn' => $this->input->post('txtSN'),
			'processor' => $this->input->post('cboProcessor'),
			'storage' => $this->input->post('txtStorage'),
			'ram' => $this->input->post('txtRAM'),
			'nic' => $this->input->post('cboNIC'),
			'wifi' => $this->input->post('cboWifi'),
			'optical' => $this->input->post('cboOptical'),
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
			'modified_by' => $this->session->username,
			'kode_unit' => $this->session->kd_unit
		);

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$update_result = $this->laptop_model->update_laptop(array('id' => $id), $data);
		echo json_encode(array("status" => $update_result));
	}

	public function delete_laptop($id_enc = NULL)
	{
		if ($id_enc === NULL) {
			show_404();
		}

		$id = $this->encrypt->decode(strtr($id_enc, array('.' => '+', '-' => '=', '~' => '/')));

		$delete_result = $this->laptop_model->delete_laptop($id);
		echo json_encode(array("status" => $delete_result));
	}
}
