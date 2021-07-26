<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_profile extends CI_Controller {

    public function __construct()
  	{
        parent::__construct();
        $cek = $this->session->userdata('login');
		if ($cek == 'usr_guru') {
			true;
		}else{
			redirect('Login');
        }
        
		
		$this->load->helper('create_random_helper');
       
    }


	public function index()
	{
        $kode_guru = $this->session->userdata('kode_guru');
        $kode_mapel = $this->session->userdata('kode_mapel');
         $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $data['profile'] = $this->db->query("SELECT * FROM guru JOIN users ON guru.user_code=users.kode_user WHERE guru.kode_guru='$kode_guru'")->result();
        $this->load->view('guru/header', $data);
        $this->load->view('guru/v_profile');
    }
    
    public function update_profile(){
        $kode_guru = $this->session->userdata('kode_guru');
        $user_code = $this->session->userdata('user_code');
        $email = $this->input->post("email");
        $no_tlp = $this->input->post("no_tlp");
        $alamat = $this->input->post("alamat");
        $username = $this->input->post("username");

        $this->db->query("UPDATE guru SET email='$email', no_tlp='$no_tlp', alamat='$alamat' WHERE kode_guru='$kode_guru'");
        $this->db->query("UPDATE users SET username='$username' WHERE kode_user='$user_code'");
        $this->session->set_flashdata('pesan', 'sukses');
        redirect("guru_usr_clx/G_profile");
    }

    function GantiPass(){
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $kode_guru = $this->session->userdata('kode_guru');
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['profile'] = $this->db->query("SELECT * FROM guru JOIN users ON guru.user_code=users.kode_user WHERE guru.kode_guru='$kode_guru'")->result();
        $this->load->view('guru/header', $data);
        $this->load->view('guru/v_gantiPass');
    }
    function aksi_g_pass(){
        $lama = $this->input->post("lama");
        $baru = $this->input->post("baru");
        $kode_guru = $this->session->userdata('kode_guru');
        if ($lama == $baru) {
            $kode_user = $this->db->query("SELECT user_code FROM guru WHERE kode_guru='$kode_guru'")->row_array()['user_code'];
            $this->db->query("UPDATE users SET password='$baru' WHERE kode_user='$kode_user'");
            $this->session->set_flashdata('pesan', 'sukses');
            redirect("guru_usr_clx/G_profile/GantiPass");
        }else{
            $this->session->set_flashdata('pesan', 'error');
            redirect("guru_usr_clx/G_profile/GantiPass");
        }
    }
	
	

}
