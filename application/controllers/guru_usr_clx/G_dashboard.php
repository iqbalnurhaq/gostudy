<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_dashboard extends CI_Controller {

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
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $data['beranda'] = $this->db->query("SELECT * FROM beranda WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY id DESC")->result();
        $data['com_one'] = $this->db->query("SELECT * FROM comment_one WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY id DESC")->result();
        $data['com_two'] = $this->db->query("SELECT * FROM comment_two WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY id DESC")->result();
        $data['tugas'] = $this->db->query("SELECT * FROM tugas WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY tgl_dibuat ASC LIMIT 3")->result();
        $data['ujian'] = $this->db->query("SELECT * FROM ujian WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' ORDER BY tgl_dibuat ASC LIMIT 3")->result();
        $data['jml_tugas'] = $this->db->query("SELECT COUNT(kode_tugas) AS jml_tugas FROM tugas WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas'")->row_array()['jml_tugas'];
        $data['jml_materi'] = $this->db->query("SELECT COUNT(id) AS jml_materi FROM materi WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas'")->row_array()['jml_materi'];
        $data['jml_ujian'] = $this->db->query("SELECT COUNT(kode_ujian) AS jml_ujian FROM ujian WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas'")->row_array()['jml_ujian'];
        $data['jml_siswa'] = $this->db->query("SELECT COUNT(kode_siswa) AS jml_siswa FROM siswa WHERE kode_kelas='$kode_kelas'")->row_array()['jml_siswa'];
        $data['kode_user'] = $user_code;
        $this->load->view('guru/header', $data);
        $this->load->view('guru/dashboard/v_dashboard');
	}
	
	public function kirim_beranda(){
		$nama_guru = $this->session->userdata('nama_guru');
        $role = $this->session->userdata('role');
        $user_code = $this->session->userdata('user_code');
        $isi = $this->input->post("isi");
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');

        $data = array('nama_user' => $nama_guru,
                        'role' => $role,
                        'isi' => $isi,
                        'user_code' => $user_code,
                        'kode_mapel' => $kode_mapel,
                        'kode_kelas' => $kode_kelas
                    );
        $this->db->insert('beranda', $data);
        redirect("guru_usr_clx/G_dashboard");
    }

    public function kirim_balas(){
        $nama_guru = $this->session->userdata('nama_guru');
        $role = $this->session->userdata('role');
        $user_code = $this->session->userdata('user_code');
        $isi = $this->input->post("isi");
        $id_beranda = $this->input->post("id_beranda");
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');


        $data = array('nama_user' => $nama_guru,
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
        $nama_guru = $this->session->userdata('nama_guru');
        $role = $this->session->userdata('role');
        $user_code = $this->session->userdata('user_code');
        $isi = $this->input->post("isi");
        $id_com_one = $this->input->post("id_com_one");
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');


        $data = array('nama_user' => $nama_guru,
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
