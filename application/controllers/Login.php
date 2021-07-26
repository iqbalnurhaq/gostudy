<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_login');
  	}
	public function index()
	{
        $this->load->view('Login');
        
    }
    
    public function aksi_login()
    {
        $user= $this->input->post('user');
        $pass= $this->input->post('pass');
        $cek_akun = $this->M_login->cek_user($user, $pass); 
        if ($cek_akun == 1) {
            $kode_user = $this->M_login->kode_user($user, $pass)['kode_user'];
            $cek_status = $this->M_login->cek_status($kode_user)['akses']; 
            if ($cek_status == 1) {
                $cek_lvl =  $this->M_login->cek_lvl($kode_user)['lvl_usr'];
                if ($cek_lvl == 'guru') {
                    $ambil_data = $this->M_login->ambil_data_guru($kode_user);
                    $data = array(
                        'kode_guru' => $ambil_data['kode_guru'],
                        'kode_mapel' => $ambil_data['kode_mapel'],
                        'nama_guru' => $ambil_data['nama_guru'],
                        'nip' => $ambil_data['nip'],
                        'user_code' => $ambil_data['user_code'],
                        'role' => 'Guru',
                        'login' => 'usr_guru'
                    );
                    $this->session->set_userdata($data);
                    redirect('guru_usr_clx/pilih_kelas');
                }elseif($cek_lvl == 'siswa'){
                    $ambil_data = $this->M_login->ambil_data_siswa($kode_user);
                    $data = array(
                        'kode_siswa' => $ambil_data['kode_siswa'],
                        'kode_kelas' => $ambil_data['kode_kelas'],
                        'nama_siswa' => $ambil_data['nama_siswa'],
                        'nis' => $ambil_data['nis'],
                        'user_code' => $ambil_data['user_code'],
                        'role' => 'Siswa',
                        'login' => 'usr_siswa'
                    );
                    $this->session->set_userdata($data);
                    redirect('siswa/Pilih_mapel');
                }else{
                    redirect('Login');
                }
            }else if($cek_status == 2){

            }else{
                redirect('Login');
            }
        }else{
            redirect('Login');
        }
    }
}
