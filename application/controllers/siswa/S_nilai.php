<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_nilai extends CI_Controller {

    public function __construct()
  	{
        parent::__construct();
        $cek = $this->session->userdata('login');
		if ($cek == 'usr_siswa') {
			true;
		}else{
			redirect('Login');
		}
		$this->load->library('upload');
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		// $this->load->model('M_s_nilai');
		// $this->load->model('M_g_nilai');
  	}

	public function index()
	{	
		
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_siswa = $this->session->userdata('kode_siswa');
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
        // $data_nilai = $this->db->query("SELECT * FROM nilai LEFT JOIN nilai_siswa ON nilai_siswa.kode_nilai=nilai.kode_nilai AND nilai_siswa.kode_siswa='$kode_siswa' AND nilai_siswa.kode_mapel='$kode_mapel'")->result();
        
        $data['nilai'] = $this->db->query("SELECT *, (SELECT nama_nilai FROM nilai WHERE kode_nilai=has_nilai.kode_nilai) AS nama_nilai FROM has_nilai LEFT JOIN nilai_siswa ON has_nilai.kode_nilai=nilai_siswa.kode_nilai AND nilai_siswa.kode_siswa='$kode_siswa' WHERE has_nilai.kode_kelas='$kode_kelas'")->result();
        // print_r($data_nilai);
        // exit();
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/nilai/v_nilai');
    }
    

	



}
