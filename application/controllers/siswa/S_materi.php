<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_materi extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		$cek = $this->session->userdata('login');
		if ($cek == 'usr_siswa') {
			true;
		}else{
			redirect('Login');
		}

		$kode_kelas = $this->session->userdata('kode_kelas');
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_siswa = $this->session->userdata('kode_siswa');
		$this->db->query("DELETE FROM has_notif WHERE kode_siswa='$kode_siswa' AND kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' AND kode_notif=1");
		$this->load->library('upload');
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_s_materi');
		// $this->load->model('M_g_materi');
  	}

	public function index()
	{	
		
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/materi/v_materi');
	}

	function ambil_data_materi(){
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data_materi = $this->M_s_materi->get_data_materi($kode_mapel, $kode_kelas);
		$output['data_materi'] = $data_materi;
    	echo json_encode($output);
	}
	


	function aksi_download(){
		$this->load->helper('download');
		$nama = $this->uri->segment(4);
    	force_download('file_materi/'.$nama, NULL);
	}



}
