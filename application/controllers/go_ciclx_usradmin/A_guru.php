<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_guru extends CI_Controller {
	public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_guru');
  	}

	public function index()
	{
		$arr = [];
		$i = 0;
		while ($i == 0) {
			$pwdGuru = helper_createPwd();
			$cekPwd = $this->M_a_guru->cek_pwd_guru($pwdGuru);
			if ($cekPwd == 0) {
				$i += 1;
				$data['password'] = $pwdGuru;
				$sql = "SELECT * FROM mapel";
				$dataGuru = $this->db->query($sql)->result();
				
				$data['mapel'] = $dataGuru;
				$this->load->view('admin/header');
        		$this->load->view('admin/guru/v_guru', $data);
			}else {
				$i += 0;
			}
		}
        
	}

	public function firstRead(){
		
	}

	function tambah(){
		$i = 0;
		$r = 0;
		while ($i == 0) {
			$kode_user = helper_kodeUser();
			$cek_kode_user = $this->M_a_guru->cek_kode_user($kode_user);
			if ($cek_kode_user == 0) {
				$dataUserGuru = array('kode_user' => $kode_user,
                      'username' => $this->input->post('nip'),
                      'password' => $this->input->post('password'),
                      'lvl_usr' => 'guru',
                      'akses' => 0);	
				$insert_user_guru = $this->M_a_guru->tambah_user_guru($dataUserGuru);	
				if ($insert_user_guru) {
					while ($r == 0 ) {
						$kode_guru = helper_kodeGuru();
						$cek_kode_guru = $this->M_a_guru->cek_kode_guru($kode_guru);
						if ($cek_kode_guru == 0) {
							$dataGuru = array('kode_guru' => $kode_guru,
                            'nip' => $this->input->post('nip'),
							'nama_guru' => $this->input->post('nama'),
                            'user_code' => $kode_user);
							$insert_guru = $this->M_a_guru->tambah_guru($dataGuru);
							if ($insert_guru) {
								$r += 1;
								$this->session->set_flashdata('pesan', 'sukses');
								redirect('go_ciclx_usradmin/A_guru');
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

	function data_guru(){
		$dataGuru = $this->M_a_guru->load_data_guru();
    	$output['dataGuru'] = $dataGuru;
    	echo json_encode($output);
	}

	function data_guru_ban(){
		$dataGuru = $this->M_a_guru->load_data_guru_banned();
    	$output['dataGuru'] = $dataGuru;
    	echo json_encode($output);
	}

	function hapus_guru(){
		$kode_guru = $this->input->post('id');
		$del = $this->M_a_guru->delete_guru($kode_guru);
		if ($del) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
	}

	function ban_guru(){
		$kode_guru = $this->input->post('id');
		$ban = $this->M_a_guru->banned_guru($kode_guru);
		if ($ban) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
	}

	function aktifkan_guru(){
		$kode_guru = $this->input->post('id');
		$ban = $this->M_a_guru->aktif_guru($kode_guru);
		if ($ban) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
	}


	function tambah_pengampu(){
		$kode_mapel = $this->input->post('kode_mapel');
		$kode_guru = $this->input->post('kode_guru');
        $update = $this->M_a_guru->update_guru_pengampu($kode_mapel, $kode_guru);
        if ($update) {
            $output['msg'] = 'success';
            echo json_encode($output);
        }
    }

}
