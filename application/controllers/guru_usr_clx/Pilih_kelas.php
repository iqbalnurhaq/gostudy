<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilih_kelas extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		// $this->load->model('M_g_materi');
  	}

	public function index()
	{
        $this->load->view('guru/v_pilih_kelas');
    }
    
    public function masuk_kelas(){
        $kode_kelas = $this->input->post('kode_kelas');
        $this->session->set_userdata('kode_kelas', $kode_kelas);
        redirect('guru_usr_clx/G_dashboard');
    }
    
	



}
