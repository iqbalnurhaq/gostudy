<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilih_mapel extends CI_Controller {

    public function __construct()
  	{
        parent::__construct();
          $cek = $this->session->userdata('login');
		if ($cek == 'usr_siswa') {
			true;
		}else{
			redirect('Login');
        }
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		// $this->load->model('M_g_materi');
  	}

	public function index()
	{
        $kode_siswa = $this->session->userdata('kode_siswa');
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['data_mapel'] = $this->db->query("SELECT * FROM has_kelas JOIN mapel ON has_kelas.kode_mapel=mapel.kode_mapel WHERE has_kelas.kode_kelas='$kode_kelas'")->result();
        $this->load->view('siswa/v_pilih_mapel', $data);
    }
    
    public function masuk_mapel(){
        $kode_mapel = $this->input->post('kode_mapel');
        $this->session->set_userdata('kode_mapel', $kode_mapel);
        redirect('siswa/S_dashboard');
    }
    
	



}
