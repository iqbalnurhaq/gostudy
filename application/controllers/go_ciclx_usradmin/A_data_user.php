<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_data_user extends CI_Controller {
	private $filename = "import_data_siswa";
	public function __construct()
  	{
		parent::__construct();
		$cek = $this->session->userdata('login');
		if ($cek == 'admin') {
			true;
		}else{
			redirect('go_ciclx_usradmin/Login');
		}
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_siswa');
	}
	  
	public function index()
	{
		$this->load->view('admin/header');
        $this->load->view('admin/v_data_usr');
	}

}
