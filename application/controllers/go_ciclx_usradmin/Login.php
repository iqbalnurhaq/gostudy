<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
  	}
	public function index()
	{
        $this->load->view('admin/login');
        
    }
    
    public function aksi_login()
    {
        $user= $this->input->post('user');
        $pass= $this->input->post('pass');
        $cek_akun = $this->db->query("SELECT * FROM usr_admin WHERE username='$user' AND password='$pass'")->num_rows(); 
        if ($cek_akun == 1) {
            $data = array(
                'login' => 'admin',
            );
            $this->session->set_userdata($data);
            redirect('go_ciclx_usradmin/A_guru');
        }else{
            redirect('go_ciclx_usradmin/Login');
        }
    }
}
