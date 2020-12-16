<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_profile extends CI_Controller {

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
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['guru'] = $this->db->query("SELECT * FROM guru JOIN users ON guru.user_code=users.kode_user WHERE guru.kode_guru='$kode_guru'")->result();
        $data['data_kelas'] = $this->db->query("SELECT * FROM has_kelas JOIN kelas ON has_kelas.kode_kelas=kelas.kode_kelas WHERE has_kelas.kode_guru='$kode_guru' AND has_kelas.kode_mapel='$kode_mapel'")->result();
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/v_profile', $data);
    }
    
    public function update_profile(){
        $kode_guru = $this->session->userdata('kode_guru');
        $email = $this->input->post('email');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
       
        $this->session->set_userdata('kode_kelas', $kode_kelas);
        redirect('guru_usr_clx/G_dashboard');
    }
    
	



}
