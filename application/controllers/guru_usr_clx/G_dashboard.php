<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_dashboard extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		if ($this->session->userdata('kode_kelas')) {
            true;
        }else{
            echo 'Salah';
            exit(); 
        }
		$this->load->helper('create_random_helper');
       
    }

   
      


	public function index()
	{
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/dashboard/v_dashboard');
	}
	
	public function tambah_materi(){
		
	}



}
