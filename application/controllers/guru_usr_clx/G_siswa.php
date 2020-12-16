<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_siswa extends CI_Controller {

    public function __construct()
  	{
        parent::__construct();
        $this->load->model('M_g_siswa');
		if ($this->session->userdata('kode_kelas')) {
            true;
        }else{
            redirect('Login');
        }
		$this->load->helper('create_random_helper');
       
    }


	public function index()
	{
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/siswa/v_siswa');
	}
	
	public function ambil_data_siswa(){
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data_siswa = $this->M_g_siswa->get_data_siswa($kode_kelas);
        $output['data_siswa'] = $data_siswa;
        echo json_encode($output);  
    }
    
    function aksi_profile(){
        $kode_siswa = $this->uri->segment(4);
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $data['siswa'] = $this->db->query("SELECT * FROM siswa WHERE kode_siswa='$kode_siswa'")->result();
        $this->load->view('guru/header', $data);
        $this->load->view('guru/siswa/v_profile');
        
    }



}
