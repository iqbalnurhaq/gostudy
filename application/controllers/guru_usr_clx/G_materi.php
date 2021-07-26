<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_materi extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		$cek = $this->session->userdata('login');
		if ($cek == 'usr_guru') {
			true;
		}else{
			redirect('Login');
		}
		
		$this->load->library('upload');
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_g_materi');
		// $this->load->model('M_g_materi');
		
  	}

	public function index()
	{
		$kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/materi/v_materi');
	}

	function ambil_data_materi(){
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data_materi = $this->M_g_materi->get_data_materi($kode_mapel, $kode_kelas);
		$output['data_materi'] = $data_materi;
    	echo json_encode($output);
	}
	
	public function tambah_materi(){
		$config['upload_path']          = './file_materi/';
	    $config['allowed_types']        = 'pdf|doc|docx|ppt|xls|xlsx';
    	$config['max_size']             = 50000;
	
		$this->load->library('upload', $config);
	    $this->upload->initialize($config);
	
		if ( ! $this->upload->do_upload('file'))
		{
				$this->session->set_flashdata('pesan',  $this->upload->display_errors());
				redirect('guru_usr_clx/G_materi');
		}else{
				$data = array('upload_data' => $this->upload->data());
				$this->save_materi($data);
				$this->session->set_flashdata('pesan', 'sukses');
				redirect('guru_usr_clx/G_materi');
		}
	}

	function save_materi($upload){
		$data = array(
		  'nama_materi' => $this->input->post('nama_materi'),
		  'nama_file' => $upload['upload_data']['file_name'],
		  'size' => $upload['upload_data']['file_size'],
		  'tipe_file' => $upload['upload_data']['file_type'],
		  'kode_mapel' => $this->session->userdata('kode_mapel'),
		  'kode_kelas' => $this->session->userdata('kode_kelas')
		);
		// $id = $this->session->userdata('id');
		$this->M_g_materi->upload_file_materi($data, $this->session->userdata('kode_kelas'), $this->session->userdata('kode_mapel'));
	}

	function hapus_materi(){
		$id = $this->input->post('id');
		$this->db->delete('materi', array('id' => $id));
		$output['msg'] = 'success';
		echo json_encode($output);
	}

	function aksi_download(){
		$this->load->helper('download');
		$nama = $this->uri->segment(4);
    	force_download('file_materi/'.$nama, NULL);
	}



}
