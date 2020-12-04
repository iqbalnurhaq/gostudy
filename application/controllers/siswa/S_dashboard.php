<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_dashboard extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		if ($this->session->userdata('kode_kelas')) {
            true;
        }else{
            redirect('Login');
        }
		$this->load->helper('create_random_helper');
       
    }


	public function index()
	{
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');
        $user_code = $this->session->userdata('user_code');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
        $data['beranda'] = $this->db->query("SELECT * FROM beranda WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY id DESC")->result();
        $data['com_one'] = $this->db->query("SELECT * FROM comment_one WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY id DESC")->result();
        $data['com_two'] = $this->db->query("SELECT * FROM comment_two WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY id DESC")->result();
        $data['tugas'] = $this->db->query("SELECT * FROM tugas WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY tgl_dibuat ASC LIMIT 3")->result();
        $data['ujian'] = $this->db->query("SELECT * FROM ujian WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY tgl_dibuat ASC LIMIT 3")->result();
        $data['kode_user'] = $user_code;
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/dashboard/v_dashboard');
	}
	
	public function kirim_beranda(){
		$nama_siswa = $this->session->userdata('nama_siswa');
        $role = $this->session->userdata('role');
        $user_code = $this->session->userdata('user_code');
        $isi = $this->input->post("isi");
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');

        $data = array('nama_user' => $nama_siswa,
                        'role' => $role,
                        'isi' => $isi,
                        'user_code' => $user_code,
                        'kode_mapel' => $kode_mapel,
                        'kode_kelas' => $kode_kelas
                    );
        $this->db->insert('beranda', $data);
        redirect("siswa/S_dashboard");
    }

    public function kirim_balas(){
        $nama_siswa = $this->session->userdata('nama_siswa');
        $role = $this->session->userdata('role');
        $user_code = $this->session->userdata('user_code');
        $isi = $this->input->post("isi");
        $id_beranda = $this->input->post("id_beranda");
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');


        $data = array('nama_user' => $nama_siswa,
                        'role' => $role,
                        'isi' => $isi,
                        'user_code' => $user_code,
                        'id_beranda' => $id_beranda,
                        'kode_mapel' => $kode_mapel,
                        'kode_kelas' => $kode_kelas
                    );
        $this->db->insert('comment_one', $data);
        $output['pesan'] = 'sukses';
		echo json_encode($output);	
    }

    public function kirim_balas_one(){
        $nama_siswa = $this->session->userdata('nama_siswa');
        $role = $this->session->userdata('role');
        $user_code = $this->session->userdata('user_code');
        $isi = $this->input->post("isi");
        $id_com_one = $this->input->post("id_com_one");
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');


        $data = array('nama_user' => $nama_siswa,
                        'role' => $role,
                        'isi' => $isi,
                        'user_code' => $user_code,
                        'id_comment_one' => $id_com_one,
                        'kode_mapel' => $kode_mapel,
                        'kode_kelas' => $kode_kelas
                    );
        $this->db->insert('comment_two', $data);
        $output['pesan'] = 'sukses';
		echo json_encode($output);	
    }

    // =================

    function hapus_pesan(){
        $id = $this->input->post("id");
        $table = $this->input->post("table");
        if ($table == 1) {
            $this->db->where('id', $id);
            $this->db->delete('beranda');
            $output['pesan'] = 'sukses';
            echo json_encode($output);	
        }else if   ($table == 2) {
            $this->db->where('id', $id);
            $this->db->delete('comment_one');
            $output['pesan'] = 'sukses';
            echo json_encode($output);
        }else if ($table == 3) {
            $this->db->where('id', $id);
            $this->db->delete('comment_two');
            $output['pesan'] = 'sukses';
            echo json_encode($output);
        } else {
            $output['pesan'] = 'error';
            echo json_encode($output);
        }

    }



}
