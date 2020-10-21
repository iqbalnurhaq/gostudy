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
        $kode_guru = $this->session->userdata('kode_guru');
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['data_kelas'] = $this->db->query("SELECT * FROM has_kelas JOIN kelas ON has_kelas.kode_kelas=kelas.kode_kelas WHERE has_kelas.kode_guru='$kode_guru' AND has_kelas.kode_mapel='$kode_mapel'")->result();
        $this->load->view('guru/v_pilih_kelas', $data);
    }
    
    public function masuk_kelas(){
        $kode_kelas = $this->input->post('kode_kelas');
        $this->session->set_userdata('kode_kelas', $kode_kelas);
        redirect('guru_usr_clx/G_dashboard');
    }
    
	



}
