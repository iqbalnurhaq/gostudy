<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_materi extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		// $this->load->model('M_g_materi');
  	}

	public function index()
	{
		$kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/materi/v_materi');
	}
	
	public function tambah_materi(){
		$config['upload_path']          = './file_materi/';
	    $config['allowed_types']        = 'pdf|doc|docx|ppt';
    	$config['max_size']             = 50000;
	
		$this->load->library('upload', $config);
	    $this->upload->initialize($config);
	
		if ( ! $this->upload->do_upload('file_materi'))
		{
				$this->session->set_flashdata('message',  $this->upload->display_errors());
				redirect('guru_usr_clx/G_materi');
		}else{
				$data = array('upload_data' => $this->upload->data());
				$this->save_materi($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Materi berhasil ditambahkan</div>');
				redirect('guru_usr_clx/G_materi');
		}
	}

	function save_materi($upload){
		$data = array(
		  'nama_materi' => $this->input->post('namaMateri'),
		  'nama_file' => $upload['upload_data']['file_name'],
		  'ukuran_file' => $upload['upload_data']['file_size'],
		  'tipe_file' => $upload['upload_data']['file_type'],
		  'kode_mapel' => $this->session->userdata('kode_mapel'),
		  'kode_kls' => $this->input->post('idKls')
		);
		$id = $this->session->userdata('id');
		$this->M_g_materi->uploadFileMateri($data);
	  }



}
