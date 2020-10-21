<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_kelas extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_kelas');
  	}

	public function index()
	{
        $this->load->view('admin/header');
        $this->load->view('admin/kelas/v_kelas');
        
        
    }
    
    function data_kelas(){
        $arr = [];
        $datakelas = $this->M_a_kelas->load_data_kelas();
        foreach ($datakelas as $val) {
            $arr[$val->kode_kelas] = $val->nama_kelas;
        }
    	$output['datakelas'] = $arr;
    	echo json_encode($output);
    }

    function load_data_kelas(){
        $sql = "SELECT * FROM kelas";
        $output['datakelas'] = $this->db->query($sql)->result();
    	echo json_encode($output);
    }

    function tmb_kelas(){
		$r = 0;
        while ($r == 0 ) {
            $kode_kelas = helper_kodekelas();
            $cek_kode_kelas = $this->M_a_kelas->cek_kode_kelas($kode_kelas);
            if ($cek_kode_kelas == 0) {
                $datakelas = array('kode_kelas' => $kode_kelas,
                'nama_kelas' => $this->input->post('nama_kelas'));

                $insert_kelas = $this->M_a_kelas->tambah_kelas($datakelas);
                if ($insert_kelas) {
                    $r += 1;
                    $output['status'] = 'success';
    	            echo json_encode($output);
                }
            }else{
                $r += 0;
            }
        }
				
		
		
    }

    function hapus_kelas(){
		$kode_kelas = $this->input->post('id');
		$del = $this->M_a_kelas->delete_kelas($kode_kelas);
		if ($del) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }
    
    function edit_kelas(){
        $kode_kelas = $this->input->post('kode_kelas');
        $nama_kelas = $this->input->post('nama_kelas');
        $update = $this->M_a_kelas->update_kelas($kode_kelas, $nama_kelas);
		if ($update) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }

    function nextAksi(){
        $this->load->view('admin/header');
        $this->load->view('admin/kelas/v_nextAksi');
    }


    // -------------------- Next aksi  ---------------------

    function load_data_mapel(){
        $kode_kelas = $this->input->get('kode_kelas'); 
        $output['data_mapel'] = $this->M_a_kelas->slc_mapel($kode_kelas);
    	echo json_encode($output);
    }

    function load_data_siswa(){
        $kode_kelas = $this->input->get('kode_kelas'); 
        $output['data_siswa'] = $this->M_a_kelas->slc_siswa($kode_kelas);
    	echo json_encode($output);
    }

    function load_data_nilai(){
        $kode_kelas = $this->input->get('kode_kelas'); 
        $output['data_nilai'] = $this->M_a_kelas->slc_nilai($kode_kelas);
    	echo json_encode($output);
    }

    function data_mapel_aktif(){
        $arr = [];
        $kode_kelas = $this->input->get('kode_kelas'); 
        $data_mapel = $this->M_a_kelas->slc_mapel_aktif($kode_kelas);
        foreach ($data_mapel as $val) {
            $arr[$val->kode_mapel] = $val->kode_mapel;
        }
        
        $output['data_mapel'] = $this->M_a_kelas->slc_data_mapel_aktif($arr, $kode_kelas);
    	echo json_encode($output);
    }

    function data_siswa_aktif(){
        $kode_kelas = $this->input->get('kode_kelas');
        $output['data_siswa'] = $this->M_a_kelas->slc_siswa_aktif($kode_kelas);
    	echo json_encode($output); 
    }

    function data_nilai_aktif(){
        $kode_kelas = $this->input->get('kode_kelas'); 
        $output['data_nilai'] = $this->M_a_kelas->slc_nilai_aktif($kode_kelas);
    	echo json_encode($output);
    }

    // -------------------- Aksi cek ---

    function tambah_mapel_aktif(){
        $kode_mapel = $this->input->post('kode_mapel');
        $kode_kelas = $this->input->post('kode_kelas');
        if ($kode_mapel) {
            foreach ($kode_mapel as $val) {
                $this->M_a_kelas->tmb_mapel_aktif($val, $kode_kelas);
            }
        }
        $this->session->set_flashdata('pesan', 'sukses');
        $output['msg'] = 'success';
		echo json_encode($output);
    }

    function tambah_siswa_aktif(){
        $kode_siswa = $this->input->post('kode_siswa');
        $kode_kelas = $this->input->post('kode_kelas');
        if ($kode_siswa) {
            foreach ($kode_siswa as $val) {
                $this->M_a_kelas->tmb_siswa_aktif($val, $kode_kelas);
            }
        }
        $this->session->set_flashdata('pesan', 'sukses');
        $output['msg'] = 'success';
		echo json_encode($output);
    }

    function tambah_nilai_aktif(){
        $kode_nilai = $this->input->post('kode_nilai');
        $kode_kelas = $this->input->post('kode_kelas');
        if ($kode_nilai) {
            foreach ($kode_nilai as $val) {
                $this->M_a_kelas->tmb_nilai_aktif($val, $kode_kelas);
            }
        }
        $this->session->set_flashdata('pesan', 'sukses');
        $output['msg'] = 'success';
		echo json_encode($output);
    }

    // ------------------ Aksi Tambah Guru In Mapel ------------------

    function guru_in_mapel(){
        $arr = [];
        $kode_mapel = $this->input->get('kode_mapel');
        $kode_kelas = $this->input->get('kode_kelas');
        $dataGuru = $this->M_a_kelas->load_data_guru_in_mapel($kode_mapel);
        $dataGuru_p = $this->M_a_kelas->load_data_guru_in_mapel_p($kode_mapel, $kode_kelas);
        foreach ($dataGuru as $val) {
            foreach ($dataGuru_p as $val_p) {
                if ($val->kode_guru == $val_p->kode_guru) {
                    
                }else{
                    $arr[$val->kode_guru] = $val->nama_guru . ' (' . $val->nip . ')';
                }
            }
        }
        $output['dataGuru'] = $arr;
    	echo json_encode($output);
    }

    function insert_guru_in_mapel(){
        $kode_guru = $this->input->post('kode_guru');
        $kode_mapel = $this->input->post('kode_mapel');
        $kode_kelas = $this->input->post('kode_kelas');
        $nama_guru = $this->db->query("SELECT nama_guru FROM guru WHERE kode_guru='$kode_guru'")->row_array()['nama_guru'];
        $update_data = $this->M_a_kelas->update_data_kelas_guru_in_mapel($kode_guru, $nama_guru, $kode_mapel, $kode_kelas);
        if($update_data){
            $this->session->set_flashdata('pesan', 'sukses');
            $output['msg'] = 'success';
            echo json_encode($output);
        } 
    }


    // --------- function  haspus in nextAksi --------

    function hapus_mapel(){
        $kode_kelas = $this->input->post('kode_kelas');
        $kode_mapel = $this->input->post('kode_mapel');
		$del = $this->M_a_kelas->delete_mapel_in_kelas($kode_kelas, $kode_mapel);
		if ($del) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }
}
