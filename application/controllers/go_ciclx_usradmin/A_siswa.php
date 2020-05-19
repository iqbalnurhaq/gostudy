<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_siswa extends CI_Controller {
	public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_siswa');
	}
	  
	public function index()
	{
		$i = 0;
		while ($i == 0) {
			$pwdSiswa = helper_createPwd();
			$cekPwd = $this->M_a_siswa->cek_pwd_siswa($pwdSiswa);
			if ($cekPwd == 0) {
				$i += 1;
				$data['password'] = $pwdSiswa;		
				$this->load->view('admin/header');
        		$this->load->view('admin/siswa/v_siswa', $data);
			}else {
				$i += 0;
			}
		}
	}

	function data_siswa(){
		$dataSiswa = $this->M_a_siswa->load_data_siswa();
    	$output['dataSiswa'] = $dataSiswa;
    	echo json_encode($output);
	}

	function data_siswa_ban(){
		$dataSiswa = $this->M_a_siswa->load_data_siswa_banned();
    	$output['dataSiswa'] = $dataSiswa;
    	echo json_encode($output);
	}

	function tambah(){
		$i = 0;
		$r = 0;
		while ($i == 0) {
			$kode_user = helper_kodeUser();
			$cek_kode_user = $this->M_a_siswa->cek_kode_user($kode_user);
			if ($cek_kode_user == 0) {
				$dataUsersiswa = array('kode_user' => $kode_user,
                      'username' => $this->input->post('nis'),
                      'password' => $this->input->post('password'),
                      'lvl_usr' => 'siswa',
                      'akses' => 0);	
				$insert_user_siswa = $this->M_a_siswa->tambah_user_siswa($dataUsersiswa);	
				if ($insert_user_siswa) {
					while ($r == 0 ) {
						$kode_siswa = helper_kodeSiswa();
						$cek_kode_siswa = $this->M_a_siswa->cek_kode_siswa($kode_siswa);
						if ($cek_kode_siswa == 0) {
							$datasiswa = array('kode_siswa' => $kode_siswa,
                            'nis' => $this->input->post('nis'),
							'nama_siswa' => $this->input->post('nama'),
                            'user_code' => $kode_user);
							$insert_siswa = $this->M_a_siswa->tambah_siswa($datasiswa);
							if ($insert_siswa) {
								$r += 1;
								$this->session->set_flashdata('pesan', 'sukses');
								redirect('go_ciclx_usradmin/A_siswa');
							}
						}else{
							$r += 0;
						}
					}
				}
				$i += 1;
			}else{
				$i += 0; 
			}
		}			
	}


	// ----------------- Update Delete -------------------

	function hapus_siswa(){
		$kode_siswa = $this->input->post('id');
		$del = $this->M_a_siswa->delete_siswa($kode_siswa);
		if ($del) {
			$output['msg'] = 'success';
			echo json_encode($output);
		}
	}

	function ban_siswa(){
		$kode_siswa = $this->input->post('id');
		$ban = $this->M_a_siswa->banned_siswa($kode_siswa);
		if ($ban) {
			$output['msg'] = 'success';
			echo json_encode($output);
		}
	}

	function aktifkan_siswa(){
		$kode_siswa = $this->input->post('id');
		$ban = $this->M_a_siswa->aktif_siswa($kode_siswa);
		if ($ban) {
			$output['msg'] = 'success';
			echo json_encode($output);
		}
	}
}
