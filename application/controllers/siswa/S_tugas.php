<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_tugas extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		$this->load->library('upload');
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_s_tugas');
        // $this->load->model('M_s_tugas');
        
  	}

	public function index()	
	{	
		
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/tugas/v_tugas');
    }
    
    function ambil_data_tugas(){
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data_tugas = $this->M_s_tugas->get_data_tugas($kode_mapel, $kode_kelas);
		$output['data_tugas'] = $data_tugas;
    	echo json_encode($output);
	}

	function detail_tugas(){
		$kode_tugas = $this->uri->segment(4);
		$this->session->set_userdata(array('kode_tugas' => $kode_tugas));
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_siswa = $this->session->userdata('kode_siswa');
		
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
		$data['data_tugas'] = $this->M_s_tugas->load_detail_tugas($kode_tugas);
		$data['data_upload'] = $this->M_s_tugas->load_upload_tugas($kode_tugas, $kode_siswa);
		// $c = $this->db->query("SELECT rev FROM has_upload WHERE kode_siswa='$kode_siswa' AND kode_tugas='$kode_tugas'")->row_array()['rev'];
		// if ($c == 1) {
		// 	$data['data_class'] = "table-success";
		// }else{
		// 	$data['data_class'] = "table-danger";
		// }
		$this->load->view('siswa/header', $data);
        $this->load->view('siswa/tugas/v_detailTugas', $data);
	}


	public function upload_tugas(){
		$config['upload_path']          = './file_upload_tugas/';
	    $config['allowed_types']        = 'pdf|doc|docx|ppt|xls|xlsx';
    	$config['max_size']             = 50000;
	
		$this->load->library('upload', $config);
	    $this->upload->initialize($config);
	
		if ( ! $this->upload->do_upload('file'))
		{
				$this->session->set_flashdata('pesan',  $this->upload->display_errors());
				redirect('siswa/S_tugas/detail_tugas/'. $this->session->userdata('kode_tugas'));
		}else{
				$data = array('upload_data' => $this->upload->data());
				$this->save_materi($data);
				$this->session->set_flashdata('pesan', 'sukses');
				redirect('siswa/S_tugas/detail_tugas/'. $this->session->userdata('kode_tugas'));
		}
	}

	function save_materi($upload){
		date_default_timezone_set("Asia/Jakarta");

		$kode_siswa = $this->session->userdata('kode_siswa');
		$kode_tugas = $this->session->userdata('kode_tugas');


		$tgl_ak = $this->db->query("SELECT tgl_akhir FROM tugas WHERE kode_tugas='$kode_tugas'")->row_array()['tgl_akhir'];
		$wkt_ak = $this->db->query("SELECT wkt_akhir FROM tugas WHERE kode_tugas='$kode_tugas'")->row_array()['wkt_akhir'];

		$tgl_akh1 = substr($tgl_ak, 6, 4);
		$tgl_akh2 = substr($tgl_ak, 3, 2);
		$tgl_akh3= substr($tgl_ak, 0, 2);

		$tgl_akhir = $tgl_akh1.$tgl_akh2.$tgl_akh3;

		$tgl_skr = date('Y').date('m').date('d');

		
		// $diff = abs(strtotime($akhir) - strtotime($skr));
		// $years = floor($diff / (365*60*60*24));
		// $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		// $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		// echo $diff;
		// echo "<br>";
		// echo $years;
		// echo "<br>";
		// echo $months;
		// echo "<br>";
		// echo $days;
		// echo "<br>";
		$w_akhir = date("Hi", strtotime($wkt_ak));
		$w_skr = date("Gi");

		$tgl_durasi = $tgl_akhir - $tgl_skr;
		
		$data_upload = array(	  
		  'nama_file' => $upload['upload_data']['file_name'],
		);

		$id_file = $this->M_s_tugas->upload_file_tugas($data_upload);

		if ($tgl_durasi > 0) {
			$status = 1;	
		}else if($tgl_durasi == 0){
			if ($w_akhir >= $w_skr) {
				$status = 1;
			}else{
				$status = 0;
			}
		}else{
			$status = 0;
		}
		
		$rev = $this->db->query("SELECT COUNT(id) AS revisi  FROM has_upload WHERE kode_siswa='$kode_siswa' AND kode_tugas='$kode_tugas'")->row_array()['revisi'];

		$data_has = array(
			'id_file' => $id_file,
			'rev' => $rev + 1,
			'status' => $status,
			'kode_siswa' => $kode_siswa,
			'kode_tugas' => $kode_tugas
		);

		$this->M_s_tugas->upload_has_tugas($data_has);
	}



	function ambil_detail_tugas(){

	}

	



}
