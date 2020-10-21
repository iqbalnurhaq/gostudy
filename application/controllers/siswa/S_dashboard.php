<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_dashboard extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		if ($this->session->userdata('kode_kelas')) {
            true;
        }else{
            redirect('Login');
        }
		$this->load->helper('create_random_helper');
       
    }


	public function index()
	{
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/dashboard/v_dashboard');
	}
	
	public function tambah_materi(){
		
	}



}
