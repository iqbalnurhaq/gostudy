<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_ujian extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		$cek = $this->session->userdata('login');
		if ($cek == 'usr_siswa') {
			true;
		}else{
			redirect('Login');
		}
		$kode_kelas = $this->session->userdata('kode_kelas');
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_siswa = $this->session->userdata('kode_siswa');
		$this->db->query("DELETE FROM has_notif WHERE kode_siswa='$kode_siswa' AND kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas' AND kode_notif=3");
		$this->load->library('upload');
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_s_ujian');
		// $this->load->model('M_s_tugas');
		date_default_timezone_set("Asia/Jakarta");	
        
  	}

	public function index()	
	{	
		
        $kode_mapel = $this->session->userdata('kode_mapel');
        $data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
		$this->load->view('siswa/header', $data);
        $this->load->view('siswa/ujian/v_ujian');
    }
    
    function ambil_data_ujian(){
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data_tugas = $this->M_s_ujian->get_data_ujian($kode_mapel, $kode_kelas);
		$output['data_ujian'] = $data_tugas;
    	echo json_encode($output);
	}

	function convertToHoursMins($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}

	function durasi(){
		$kode_ujian = $this->session->userdata('kode_ujian');
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_siswa = $this->session->userdata('kode_siswa');
		$waktu_start = $this->db->query("SELECT * FROM jwb_siswa WHERE kode_ujian='$kode_ujian' AND kode_siswa='$kode_siswa'")->row_array()['dibuat'];
		$durasi = $this->db->query("SELECT * FROM jwb_siswa WHERE kode_ujian='$kode_ujian' AND kode_siswa='$kode_siswa'")->row_array()['pengerjaan'];
		$jam = substr($waktu_start, 11, 2) * 60;
		$menit = substr($waktu_start, 14, 2);
		
		$now = date('Hi', strtotime(date("h:i A")));
		$jam_now = substr($now, 0, 2) * 60;
		$menit_now = substr($now, 2, 2);

		$mulai = $jam + $menit;
		$end = $jam + $menit + $durasi;
		$skr = $jam_now + $menit_now;
		$dur = $end - $skr;
		if ($skr > $end) {
			# code...
		}else if($skr < $end){

		}else{
		
		}

		$output['a'] = $dur.':'.'00';
		$output['durasi'] = $this->convertToHoursMins($dur, '%02d:%02d:00');
		echo json_encode($output);
	}

	function kerjakan(){
		date_default_timezone_set("Asia/Jakarta");
		$kode_ujian = $this->uri->segment(4);
		$this->session->set_userdata(array('kode_ujian' => $kode_ujian));
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_siswa = $this->session->userdata('kode_siswa');
		
		$cek_jawaban = $this->db->query("SELECT * FROM jwb_siswa WHERE kode_ujian='$kode_ujian' AND kode_siswa='$kode_siswa'")->num_rows();

		$cek_nilai = $this->db->query("SELECT * FROM nilai_ujian WHERE kode_ujian='$kode_ujian' AND kode_siswa='$kode_siswa'")->num_rows();

		if ($cek_nilai == 1 && $cek_jawaban == 0) {
			$this->load->view('siswa/header_ujian');
			$this->load->view('siswa/ujian/v_diskualifikasi');
		}else{

			if ($cek_jawaban == 1) { 
				
				$cek_status = $this->db->query("SELECT * FROM jwb_siswa WHERE kode_ujian='$kode_ujian' AND kode_siswa='$kode_siswa'")->row_array()['status'];
				if($cek_status == 0){
					
					$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
					$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
					$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);	
					// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
					$this->load->view('siswa/header_ujian', $data);
					$this->load->view('siswa/ujian/v_kerjakan', $data);
				}else{				
					$this->session->set_flashdata('pesan', 'error');
					$this->session->set_flashdata('message', 'Anda telah mengerjakan');
					redirect("siswa/S_ujian");
				}
			}else{


				$tgl = $this->db->query("SELECT * FROM ujian WHERE kode_ujian='$kode_ujian'")->row_array();

				
				$tgl_akhir = $tgl['tgl_akhir'];
				$wkt_akhir = $tgl['wkt_akhir'];
				$durasi = $tgl['durasi'];

			
				
				$tgl_akh1 = substr($tgl_akhir, 6, 4);
				$tgl_akh2 = substr($tgl_akhir, 3, 2);
				$tgl_akh3= substr($tgl_akhir, 0, 2);
				
				$akhir = $tgl_akh1."-".$tgl_akh2."-".$tgl_akh3;
				
				$now = Date('Y-m-d');
				
				$diff = abs(strtotime($akhir) - strtotime($now));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				
				// ========================= Durasi Jam pengerjaan ==================
				
				$p1 = $tgl_akh1.$tgl_akh2.$tgl_akh3;
				$p2 = Date('Ymd');
				
				$p = $p1 - $p2;
				
				// ---- dur. pengerjaan ----
				
				$w_skr = Date('Hi');
				$w_akhir = date('Hi', strtotime($wkt_akhir));


				// $w = $w_akhir - $w2;

				$jam_skr = substr($w_skr, 0, 2);
				$menit_skr = substr($w_skr, 2, 2);
				$dur_skr_fix = ($jam_skr * 60) + $menit_skr;

				
				$jam_akhir = substr($w_akhir, 0, 2);
				$menit_akhir = substr($w_akhir, 2, 2);
				$dur_akhir_fix = ($jam_akhir * 60) + $menit_akhir;

				$dur_fix = $dur_akhir_fix - $dur_skr_fix;


				// ===========================================  Aktif =======================================================
					
				$tgl_aktif = $tgl['tgl_aktif'];
				$wkt_aktif = $tgl['wkt_aktif'];

				$tgl_akt1 = substr($tgl_aktif, 6, 4);
				$tgl_akt2 = substr($tgl_aktif, 3, 2);
				$tgl_akt3= substr($tgl_aktif, 0, 2);

				$aktif = $tgl_akt1."-".$tgl_akt2."-".$tgl_akt3;

				$diff_aktif = abs(strtotime($now) - strtotime($aktif));
				$years_aktif = floor($diff_aktif / (365*60*60*24));
				$months_aktif = floor(($diff_aktif - $years_aktif * 365*60*60*24) / (30*60*60*24));
				$days_aktif = floor(($diff_aktif - $years_aktif * 365*60*60*24 - $months_aktif*30*60*60*24)/ (60*60*24));

				$q1 = $tgl_akt1.$tgl_akt2.$tgl_akt3;

				$q = (int)$p2 - (int)$q1;

				

				$w_aktif = date('Hi', strtotime($wkt_aktif));

				$jam_aktif = substr($w_aktif, 0, 2);
				$menit_aktif = substr($w_aktif, 2, 2);
				$dur_aktif_fix = ($jam_aktif * 60) + $menit_aktif;

				$dur_fix_aktif =  $dur_skr_fix - $dur_aktif_fix;



				// ====================================== end =================================================================
				
				
				$jwb_siswa = array('kode_ujian' => $kode_ujian,
									'kode_siswa' => $kode_siswa,
									'pengerjaan' => $durasi);
				
				



				if ($q >= 0 ) {
					// ============aktif============
					if ($p > 0) {
						if ($years > 0) {

							$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
							if ($data_soal) {
								$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
								
								$data_desc = array();
								foreach ($data_soal as $val) {
								array_push($data_desc, array(
										'kode_soal' => $val->kode_soal,
										'id_jwb_siswa' => $insert_jbw
									));
								}
								$this->M_s_ujian->insert_detail_hasil($data_desc);
								
								$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
								$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
								$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
								
								// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
								$this->load->view('siswa/header_ujian', $data);
								$this->load->view('siswa/ujian/v_kerjakan', $data);
							}else{
								$this->session->set_flashdata('pesan', 'error');
								$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
								redirect('siswa/S_ujian');
							}

						}else if($months > 0){
							
							$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
							if ($data_soal) {
								$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
								
								$data_desc = array();
								foreach ($data_soal as $val) {
								array_push($data_desc, array(
										'kode_soal' => $val->kode_soal,
										'id_jwb_siswa' => $insert_jbw
									));
								}
								$this->M_s_ujian->insert_detail_hasil($data_desc);
								
								
								
								
								$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
								$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
								$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
								
								// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
								$this->load->view('siswa/header_ujian', $data);
								$this->load->view('siswa/ujian/v_kerjakan', $data);
							}else{
								$this->session->set_flashdata('pesan', 'error');
								$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
								redirect('siswa/S_ujian');
							}

						}else if($days > 0){
							$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
							if ($data_soal) {
								$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
								
								$data_desc = array();
								foreach ($data_soal as $val) {
								array_push($data_desc, array(
										'kode_soal' => $val->kode_soal,
										'id_jwb_siswa' => $insert_jbw
									));
								}
								$this->M_s_ujian->insert_detail_hasil($data_desc);
								
								
								
								
								$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
								$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
								$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
								
								// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
								$this->load->view('siswa/header_ujian', $data);
								$this->load->view('siswa/ujian/v_kerjakan', $data);
							}else{
								$this->session->set_flashdata('pesan', 'error');
								$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
								redirect('siswa/S_ujian');
							}
						}else{
							$this->session->set_flashdata('pesan', 'error');
							redirect('siswa/S_ujian');
						}
					} else if($p == 0) {

						if ($dur_fix > $durasi) {
							
							$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
							if ($data_soal) {
								$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
								
								$data_desc = array();
								foreach ($data_soal as $val) {
								array_push($data_desc, array(
										'kode_soal' => $val->kode_soal,
										'id_jwb_siswa' => $insert_jbw
									));
								}
								$this->M_s_ujian->insert_detail_hasil($data_desc);
								
								
								
								
								$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
								$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
								$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
								
								// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
								$this->load->view('siswa/header_ujian', $data);
								$this->load->view('siswa/ujian/v_kerjakan', $data);
							}else{
								$this->session->set_flashdata('pesan', 'error');
								$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
								redirect('siswa/S_ujian');
							}
						}else if($dur_fix < $durasi){
							$dur_t = $dur_fix - 3;
							if ($dur_t > 0) {	

								$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
								if ($data_soal) {
									$insert_jbw = $this->M_s_ujian->insert_jbw_t($kode_ujian, $kode_siswa, $dur_t);
									
									$data_desc = array();
									foreach ($data_soal as $val) {
									array_push($data_desc, array(
											'kode_soal' => $val->kode_soal,
											'id_jwb_siswa' => $insert_jbw
										));
									}
									$this->M_s_ujian->insert_detail_hasil($data_desc);

									$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
									$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
									$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
									
									// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
									$this->load->view('siswa/header_ujian', $data);
									$this->load->view('siswa/ujian/v_kerjakan', $data);
								}else{
									$this->session->set_flashdata('pesan', 'error');
									$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
									redirect('siswa/S_ujian');
								}
								
							}else{
								
								$this->session->set_flashdata('message', 'Maaf anda tidak bisa mengerjakan ujian ini, silahkan cek dokumentasi atau hubungi guru yang bersangkutan');	
								$this->session->set_flashdata('pesan', 'error');
								redirect('siswa/S_ujian');
							}

						}else{
							$this->session->set_flashdata('pesan', 'error');
							$this->session->set_flashdata('message', 'Maaf anda tidak bisa mengerjakan ujian ini, silahkan cek dokumentasi atau hubungi guru yang bersangkutan');
							redirect('siswa/S_ujian');
						}
					}else{
						
						$this->session->set_flashdata('pesan', 'error');
						$this->session->set_flashdata('message', 'Maaf anda tidak bisa mengerjakan ujian ini, silahkan cek dokumentasi atau hubungi guru yang bersangkutan');
						redirect('siswa/S_ujian');
					}

					// ============end============
				}else if($q == 0){
					if ($dur_fix_aktif >= 0) {
						// ==================== Aktif ==============

						if ($p > 0) {
							if ($years > 0) {

								$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
								if ($data_soal) {
									$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
									
									$data_desc = array();
									foreach ($data_soal as $val) {
									array_push($data_desc, array(
											'kode_soal' => $val->kode_soal,
											'id_jwb_siswa' => $insert_jbw
										));
									}
									$this->M_s_ujian->insert_detail_hasil($data_desc);
									
									$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
									$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
									$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
									
									// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
									$this->load->view('siswa/header_ujian', $data);
									$this->load->view('siswa/ujian/v_kerjakan', $data);
								}else{
									$this->session->set_flashdata('pesan', 'error');
									$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
									redirect('siswa/S_ujian');
								}

							}else if($months > 0){
								
								$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
								if ($data_soal) {
									$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
									
									$data_desc = array();
									foreach ($data_soal as $val) {
									array_push($data_desc, array(
											'kode_soal' => $val->kode_soal,
											'id_jwb_siswa' => $insert_jbw
										));
									}
									$this->M_s_ujian->insert_detail_hasil($data_desc);
									
									
									
									
									$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
									$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
									$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
									
									// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
									$this->load->view('siswa/header_ujian', $data);
									$this->load->view('siswa/ujian/v_kerjakan', $data);
								}else{
									$this->session->set_flashdata('pesan', 'error');
									$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
									redirect('siswa/S_ujian');
								}

							}else if($days > 0){
								$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
								if ($data_soal) {
									$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
									
									$data_desc = array();
									foreach ($data_soal as $val) {
									array_push($data_desc, array(
											'kode_soal' => $val->kode_soal,
											'id_jwb_siswa' => $insert_jbw
										));
									}
									$this->M_s_ujian->insert_detail_hasil($data_desc);
									
									
									
									
									$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
									$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
									$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
									
									// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
									$this->load->view('siswa/header_ujian', $data);
									$this->load->view('siswa/ujian/v_kerjakan', $data);
								}else{
									$this->session->set_flashdata('pesan', 'error');
									$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
									redirect('siswa/S_ujian');
								}
							}else{
								
								$this->session->set_flashdata('pesan', 'error');
								$this->session->set_flashdata('message', 'Maaf anda tidak bisa mengerjakan ujian ini, silahkan cek dokumentasi atau hubungi guru yang bersangkutan');	
								redirect('siswa/S_ujian');
							}
						} else if($p == 0) {

							if ($dur_fix > $durasi) {
								
								$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
								if ($data_soal) {
									$insert_jbw = $this->M_s_ujian->insert_jbw($jwb_siswa, $kode_ujian);
									
									$data_desc = array();
									foreach ($data_soal as $val) {
									array_push($data_desc, array(
											'kode_soal' => $val->kode_soal,
											'id_jwb_siswa' => $insert_jbw
										));
									}
									$this->M_s_ujian->insert_detail_hasil($data_desc);
									
									
									
									
									$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
									$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
									$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
									
									// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
									$this->load->view('siswa/header_ujian', $data);
									$this->load->view('siswa/ujian/v_kerjakan', $data);
								}else{
									$this->session->set_flashdata('pesan', 'error');
									$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
									redirect('siswa/S_ujian');
								}
							}else if($dur_fix < $durasi){
								$dur_t = $dur_fix - 3;
								if ($dur_t > 0) {	

									$data_soal = $this->db->query("SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian'")->result();
									if ($data_soal) {
										$insert_jbw = $this->M_s_ujian->insert_jbw_t($kode_ujian, $kode_siswa, $dur_t);
										
										$data_desc = array();
										foreach ($data_soal as $val) {
										array_push($data_desc, array(
												'kode_soal' => $val->kode_soal,
												'id_jwb_siswa' => $insert_jbw
											));
										}
										$this->M_s_ujian->insert_detail_hasil($data_desc);

										$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
										$data['data_ujian'] = $this->M_s_ujian->load_detail_ujian($kode_ujian);
										$data['soal'] = $this->M_s_ujian->load_soal($kode_ujian);
										
										// $data['data_upload'] = $this->M_s_ujian->load_upload_ujian($kode_ujian, $kode_siswa);
										$this->load->view('siswa/header_ujian', $data);
										$this->load->view('siswa/ujian/v_kerjakan', $data);
									}else{
										$this->session->set_flashdata('pesan', 'error');
										$this->session->set_flashdata('message', 'Maaf, Ujian ini belum ada soal, silahkan hubungi guru bersangkutan');
										redirect('siswa/S_ujian');
									}
									
								}else{
									
									$this->session->set_flashdata('message', 'Maaf anda tidak bisa mengerjakan ujian ini, silahkan cek dokumentasi atau hubungi guru yang bersangkutan');	
									$this->session->set_flashdata('pesan', 'error');
									redirect('siswa/S_ujian');
								}

							}else{
								$this->session->set_flashdata('pesan', 'error');
								$this->session->set_flashdata('message', 'Maaf anda tidak bisa mengerjakan ujian ini, silahkan cek dokumentasi atau hubungi guru yang bersangkutan');
								redirect('siswa/S_ujian');
							}
						}else{
							$this->session->set_flashdata('pesan', 'error');
							$this->session->set_flashdata('message', 'Maaf anda tidak bisa mengerjakan ujian ini, silahkan cek dokumentasi atau hubungi guru yang bersangkutan');
							redirect('siswa/S_ujian');
						}

						// ==================== end ==============
					}else{
						$this->session->set_flashdata('pesan', 'error');
						$this->session->set_flashdata('message', 'Maaf, ujian belum aktif');
						redirect('siswa/S_ujian');
					}
				}else{
				
					$this->session->set_flashdata('pesan', 'error');
					$this->session->set_flashdata('message', 'Maaf, ujian belum aktif');
					redirect('siswa/S_ujian');
				}


			}
		
		}
	
			
		
	}


	function kirimJwb(){
		$pilGan = $this->input->post("pilGan");
		$kode_siswa = $this->session->userdata('kode_siswa');
		$kode_ujian = $this->session->userdata('kode_ujian');
		$kode_mapel = $this->session->userdata('kode_mapel');
		$dataPilGan = explode("|" , $pilGan);

		$this->M_s_ujian->status($kode_siswa, $kode_ujian);
		
		foreach ($dataPilGan as $val) {
			$jwbSiswa = substr($val, 10,1);
			$kode_soal = substr($val, 0, 9);
			$kunci = $this->M_s_ujian->ambilKunci($kode_soal);
			$id_jwb = $this->M_s_ujian->ambil_id_jwb_siswa($kode_ujian, $kode_siswa)['id'];
			$cek = $jwbSiswa == $kunci['jwb'];
			if ($cek) {
				$ket = 1;
				$this->M_s_ujian->saveJwb($jwbSiswa, $ket, $kode_soal, $id_jwb);
			}else {
				$ket = 0;
				$this->M_s_ujian->saveJwb($jwbSiswa, $ket, $kode_soal, $id_jwb);
			}
		}

		$id_jwb = $this->M_s_ujian->ambil_id_jwb_siswa($kode_ujian, $kode_siswa)['id'];
		$count_soal = $this->M_s_ujian->jml_soal($id_jwb);
		$s_benar =  $this->M_s_ujian->soal_benar($id_jwb);
		$hasil = $s_benar / $count_soal;
		$nilai = number_format( $hasil * 100 , 2);

		$this->M_s_ujian->input_nilai_ujian($kode_siswa, $kode_ujian, $nilai);

		$output['status'] = 'success';
		$output['kode_ujian'] = $kode_ujian;
    	echo json_encode($output);

	}

	function hasil_ujian(){
		$kode_ujian = $this->uri->segment(4);
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_siswa = $this->session->userdata('kode_siswa');
		$id_jwb = $this->M_s_ujian->ambil_id_jwb_siswa($kode_ujian, $kode_siswa)['id'];
		$cek_nilai = $this->db->query("SELECT * FROM nilai_ujian WHERE kode_ujian='$kode_ujian' AND kode_siswa='$kode_siswa'")->num_rows();
		if ($cek_nilai) {
			if ($id_jwb) {
				$count_soal = $this->M_s_ujian->jml_soal($id_jwb);
				$s_benar =  $this->M_s_ujian->soal_benar($id_jwb);
				$hasil = $s_benar / $count_soal;
				$nilai =  number_format($hasil * 100 , 2);
				$data['nama_mapel'] = $this->db->query("SELECT nama_mapel FROM mapel WHERE kode_mapel='$kode_mapel'")->row_array()['nama_mapel']; 
				$data['jumlah_soal'] = $count_soal; 		
				$data['soal_benar'] = $s_benar; 		
				$data['soal_salah'] = $count_soal - $s_benar; 		
				$data['nilai'] = $nilai; 		
				$this->load->view('siswa/header', $data);
				$this->load->view('siswa/ujian/v_hasil_ujian');
			}else{
				$this->load->view('siswa/header_ujian');
				$this->load->view('siswa/ujian/v_diskualifikasi');
			}
		}else{
			$this->session->set_flashdata('pesan', 'error');
			$this->session->set_flashdata('message', 'Maaf, anda belum mengerjakan ujian ini');
			redirect('siswa/S_ujian');
		}
		
      
	}

	



}
