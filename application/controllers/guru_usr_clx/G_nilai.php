<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_nilai extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		$this->load->helper('create_random_helper');
		$this->load->model('M_g_nilai');
       
    }


	public function index()
	{
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas'];
        $data['siswa'] = $this->M_g_nilai->data_siswa($kode_kelas); 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/nilai/v_nilai');
    }
    
    function data_nilai(){
        // $kode_siswa 
    }

	// function ambil_data_tugas(){
	// 	$kode_mapel = $this->session->userdata('kode_mapel');
	// 	$kode_kelas = $this->session->userdata('kode_kelas');
	// 	$data_tugas = $this->M_g_tugas->get_data_tugas($kode_mapel, $kode_kelas);
	// 	$output['data_tugas'] = $data_tugas;
    // 	echo json_encode($output);
	// }
	
	// public function tambah_tugas(){
	// 	date_default_timezone_set("Asia/Jakarta");
	// 	$nama_tugas = $this->input->post("nama_tugas");
	// 	$tgl_aktif = $this->input->post("tgl_aktif");
	// 	$wkt_aktif = $this->input->post("wkt_aktif");
	// 	$tgl_akhir = $this->input->post("tgl_akhir");
	// 	$wkt_akhir = $this->input->post("wkt_akhir");

	// 	$wkt_skr = date("Ymd").date("Hi", strtotime(date("H:i")));
	// 	$wkt_akt = substr($tgl_aktif, 6, 10).substr($tgl_aktif, 3, 2).substr($tgl_aktif, 0, 2).date("Hi", strtotime($wkt_aktif));


	// 	$cocok = substr($tgl_aktif, 6, 10).substr($tgl_aktif, 3, 2).substr($tgl_aktif, 0, 2).date("Hi", strtotime($wkt_aktif)) < substr($tgl_akhir, 6, 10).substr($tgl_akhir, 3, 2).substr($tgl_akhir, 0, 2).date("Hi", strtotime($wkt_akhir));
		
	// 	if ($cocok) {
	// 		$r = 0;
	// 		while ($r == 0 ) {
	// 			$kode_tugas = helper_kodeTugas();
	// 			$cek_kode_tugas = $this->M_g_tugas->cek_kode_tugas($kode_tugas);
	// 			if ($cek_kode_tugas == 0) {
	// 				$data_tugas = array(
	// 					'kode_tugas' => $kode_tugas,
	// 					'nama_tugas' => $nama_tugas,
	// 					'tgl_aktif' => $tgl_aktif,
	// 					'wkt_aktif' => $wkt_aktif,
	// 					'tgl_akhir' => $tgl_akhir,
	// 					'wkt_akhir' => $wkt_akhir,
	// 					'kode_mapel' => $this->session->userdata('kode_mapel'),
	// 					'kode_kelas' => $this->session->userdata('kode_kelas'),
	// 					'status' => 1
	// 				);

	// 				$insert_tugas = $this->M_g_tugas->insert_tugas($data_tugas);
	// 				if ($insert_tugas) {
	// 					$r += 1;
	// 					$this->session->set_flashdata('pesan', 'sukses');
	// 					redirect('guru_usr_clx/G_tugas');
	// 				}
	// 			}else{
	// 				$r += 0;
	// 			}
	// 		}
	// 	}else{
	// 		$this->session->set_flashdata('pesan', 'error');
	// 		redirect('guru_usr_clx/G_tugas');
	// 	}
	// }

	// function detail_tugas(){
	// 	$kode_tugas = $this->uri->segment(4);
	// 	$this->session->set_userdata(array('kode_tugas' => $kode_tugas));
	// 	$kode_kelas = $this->session->userdata('kode_kelas');
    //     $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
	// 	$data['data_tugas'] = $this->M_g_tugas->load_detail_tugas($kode_tugas);
	// 	$this->load->view('guru/header', $data);
    //     $this->load->view('guru/tugas/v_detail_tugas', $data);

	// }

	// function save_desc(){
	// 	$kode_tugas = $this->session->userdata('kode_tugas');
	// 	$desc = $this->input->post('desc');
	// 	$save = $this->M_g_tugas->save_deskripsi($desc, $kode_tugas);
	// 	$output['pesan'] = 'sukses';
    // 	echo json_encode($output);
	// }



}
