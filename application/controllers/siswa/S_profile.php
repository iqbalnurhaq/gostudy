<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_profile extends CI_Controller {

    public function __construct()
  	{
        parent::__construct();
        $cek = $this->session->userdata('login');
		if ($cek == 'usr_siswa') {
			true;
		}else{
			redirect('Login');
        }
        
		
		$this->load->helper('create_random_helper');
       
    }


	public function index()
	{
        $kode_siswa = $this->session->userdata('kode_siswa');
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
        $data['profile'] = $this->db->query("SELECT * FROM siswa JOIN users ON siswa.user_code=users.kode_user WHERE siswa.kode_siswa='$kode_siswa'")->result();
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/v_profile');
    }
    
    public function update_profile(){
        $kode_siswa = $this->session->userdata('kode_siswa');
        $user_code = $this->session->userdata('user_code');
        $email = $this->input->post("email");
        $no_tlp = $this->input->post("no_tlp");
        $alamat = $this->input->post("alamat");
        $username = $this->input->post("username");

        $this->db->query("UPDATE siswa SET email='$email', no_tlp='$no_tlp', alamat='$alamat' WHERE kode_siswa='$kode_siswa'");
        $this->db->query("UPDATE users SET username='$username' WHERE kode_user='$user_code'");
        $this->session->set_flashdata('pesan', 'sukses');
        redirect("siswa/S_profile");
    }

    function GantiPass(){
        $kode_siswa = $this->session->userdata('kode_siswa');
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
        $data['profile'] = $this->db->query("SELECT * FROM siswa JOIN users ON siswa.user_code=users.kode_user WHERE siswa.kode_siswa='$kode_siswa'")->result();
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/v_gantiPass');
    }
    function aksi_g_pass(){
        $lama = $this->input->post("lama");
        $baru = $this->input->post("baru");
        $kode_siswa = $this->session->userdata('kode_siswa');
        if ($lama == $baru) {
            $kode_user = $this->db->query("SELECT user_code FROM siswa WHERE kode_siswa='$kode_siswa'")->row_array()['user_code'];
            $this->db->query("UPDATE users SET password='$baru' WHERE kode_user='$kode_user'");
            $this->session->set_flashdata('pesan', 'sukses');
            redirect("siswa/S_profile");
        }else{
            $this->session->set_flashdata('pesan', 'error');
            redirect("siswa/S_profile/GantiPass");
        }
    }
	
	

}
