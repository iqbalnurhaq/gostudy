<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_ujian extends CI_Controller {
	private $filename = "import_data_soal";

    public function __construct()
  	{
		parent::__construct();
		$cek = $this->session->userdata('login');
		if ($cek == 'usr_guru') {
			true;
		}else{
			redirect('Login');
		}
        $this->load->helper('create_random_helper');
        $this->load->library('pagination');
		$this->load->model('M_g_ujian');
		$this->load->model('M_s_ujian');
       
    }


	public function index()
	{
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/ujian/v_ujian');
	}

	function ambil_data_ujian(){
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data_ujian = $this->M_g_ujian->get_data_ujian($kode_mapel, $kode_kelas);
		$output['data_ujian'] = $data_ujian;
    	echo json_encode($output);
	}
	
	public function tambah_ujian(){
		date_default_timezone_set("Asia/Jakarta");
		$nama_ujian = $this->input->post("nama_ujian");
		$durasi = $this->input->post("wkt_pengerjaan");

		$tgl_aktif = $this->input->post("tgl_aktif");

		$tgl_akt1 = substr($tgl_aktif, 6, 4);
		$tgl_akt2 = substr($tgl_aktif, 3, 2);
		$tgl_akt3= substr($tgl_aktif, 0, 2);
		$wkt_aktif = substr($tgl_aktif, 11, 9);
		
		$tgl_akh1 = substr($tgl_aktif, 29, 4);
		$tgl_akh2 = substr($tgl_aktif, 26, 2);
		$tgl_akh3= substr($tgl_aktif, 23, 2);
		$wkt_akhir = substr($tgl_aktif, 34, 9);

		// $aktif = substr($tgl_aktif, 0, 10);
		// $akhir = substr($tgl_aktif, 23, 10);
		
		
		$w_aktif = date("Hi", strtotime($wkt_aktif));
		$w_akhir = date("Hi", strtotime($wkt_akhir));
		
		$jam_aktif = substr($w_aktif, 0, 2) * 60;
		$menit_aktif = substr($w_aktif, 2, 2);
		
		$jam_akhir = substr($w_akhir, 0, 2) * 60;
		$menit_akhir = substr($w_akhir, 2, 2);
		
		$fix_jm_aktif = $jam_aktif + $menit_aktif;
		$fix_jm_akhir = $jam_akhir + $menit_akhir;
		

		$fix = $fix_jm_akhir - $fix_jm_aktif;
		
		
		$aktif = $tgl_akt1."-".$tgl_akt2."-".$tgl_akt3;
		$akhir = $tgl_akh1."-".$tgl_akh2."-".$tgl_akh3;
		$diff = abs(strtotime($akhir) - strtotime($aktif));
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		
		


		$r = 0;
		while ($r == 0 ) {
			$kode_ujian = helper_kodeujian();
			$cek_kode_ujian = $this->M_g_ujian->cek_kode_ujian($kode_ujian);
			if ($cek_kode_ujian == 0) {
				$data_ujian = array(
					'kode_ujian' => $kode_ujian,
					'nama_ujian' => $nama_ujian,
					'tgl_aktif' => substr($tgl_aktif, 0, 10),
					'wkt_aktif' => $wkt_aktif,
					'tgl_akhir' => substr($tgl_aktif, 23, 10),
					'wkt_akhir' => $wkt_akhir,
					'durasi' => $durasi,
					'kode_mapel' => $this->session->userdata('kode_mapel'),
					'kode_kelas' => $this->session->userdata('kode_kelas'),
					'status' => 1
				);

				if ($years > 0) {
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian, $this->session->userdata('kode_kelas'), $this->session->userdata('kode_mapel'));
					$r += 1;
					$this->session->set_flashdata('pesan', 'sukses');
					redirect('guru_usr_clx/G_ujian');
				}else if($months > 0){
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian, $this->session->userdata('kode_kelas'), $this->session->userdata('kode_mapel'));
					$r += 1;
					$this->session->set_flashdata('pesan', 'sukses');
					redirect('guru_usr_clx/G_ujian');
				}else if($days > 0){
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian, $this->session->userdata('kode_kelas'), $this->session->userdata('kode_mapel'));
					$r += 1;
					$this->session->set_flashdata('pesan', 'sukses');
					redirect('guru_usr_clx/G_ujian');
				}else if($fix > $durasi){
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian, $this->session->userdata('kode_kelas'), $this->session->userdata('kode_mapel'));
					$r += 1;
					$this->session->set_flashdata('pesan', 'sukses');
					redirect('guru_usr_clx/G_ujian');
				}else{
					$r += 1;
					$this->session->set_flashdata('pesan', 'error');
					redirect('guru_usr_clx/G_ujian');
				}
			}else{
				$r += 0;
			}
		}
		
		


		// $cocok = substr($tgl_aktif, 6, 10).substr($tgl_aktif, 3, 2).substr($tgl_aktif, 0, 2).date("Hi", strtotime($wkt_aktif)) < substr($tgl_akhir, 6, 10).substr($tgl_akhir, 3, 2).substr($tgl_akhir, 0, 2).date("Hi", strtotime($wkt_akhir));
		
		// if ($cocok) {
		// 	$r = 0;
		// 	while ($r == 0 ) {
		// 		$kode_ujian = helper_kodeujian();
		// 		$cek_kode_ujian = $this->M_g_ujian->cek_kode_ujian($kode_ujian);
		// 		if ($cek_kode_ujian == 0) {
		// 			$data_ujian = array(
		// 				'kode_ujian' => $kode_ujian,
		// 				'nama_ujian' => $nama_ujian,
		// 				'tgl_aktif' => $tgl_aktif,
		// 				'wkt_aktif' => $wkt_aktif,
		// 				'tgl_akhir' => $tgl_akhir,
		// 				'wkt_akhir' => $wkt_akhir,
		// 				'kode_mapel' => $this->session->userdata('kode_mapel'),
		// 				'kode_kelas' => $this->session->userdata('kode_kelas'),
		// 				'status' => 1
		// 			);

		// 			$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian, $this->session->userdata('kode_kelas'), $this->session->userdata('kode_mapel'));
		// 			if ($insert_ujian) {
		// 				$r += 1;
		// 				$this->session->set_flashdata('pesan', 'sukses');
		// 				redirect('guru_usr_clx/G_ujian');
		// 			}
		// 		}else{
		// 			$r += 0;
		// 		}
		// 	}
		// }else{
		// 	$this->session->set_flashdata('pesan', 'error');
		// 	redirect('guru_usr_clx/G_ujian');
		// }
	}

	function detail_ujian($offset = 0){

		
		$kode_ujian = $this->uri->segment(4);
		$this->session->set_userdata(array('kode_ujian' => $kode_ujian));
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas'];
		$data['siswa_mengerjakan'] = $this->db->query("SELECT * FROM jwb_siswa WHERE kode_ujian='$kode_ujian'")->num_rows();
		$data['analisis_soal'] = $this->db->query("SELECT * FROM soal WHERE kode_ujian='$kode_ujian' ORDER BY no_soal")->result(); 
		$data['jml_soal'] = $this->db->query("SELECT * FROM soal WHERE kode_ujian='$kode_ujian'")->num_rows(); 
		$data['bank_soal'] = $this->db->query("SELECT * FROM bank_has_ujian WHERE kode_ujian='$kode_ujian'")->num_rows(); 
		$data['data_ujian'] = $this->M_g_ujian->load_detail_ujian($kode_ujian);
		
		$jml_siswa = $this->M_g_ujian->get_jml_siswa($kode_kelas);
		$jml_nilai = $this->M_g_ujian->get_jml_nilai($kode_ujian);
		$progress = number_format(($jml_nilai / $jml_siswa) * 100 , 2);

		$data['progress'] = $progress;
		
		// $data['numRow'] = $this->M_g_ujian->getAllSoal($kode_ujian)->num_rows();
		$this->load->view('guru/header', $data);
        $this->load->view('guru/ujian/v_detail_ujian', $data);

	}
	
	function save_soal(){
		$kode_ujian = $this->session->userdata('kode_ujian');
		$soal = $this->input->post('soal');
		$optA = $this->input->post('optA');
		$optB = $this->input->post('optB');
		$optC = $this->input->post('optC');
		$optD = $this->input->post('optD');
		$optE = $this->input->post('optE');
		$jwb = $this->input->post('jwb');


		$r = 0;

		while ($r == 0 ) {
			$kode_soal = helper_kodesoal();
			$cek_kode_soal = $this->M_g_ujian->cek_kode_soal($kode_soal);
			if ($cek_kode_soal == 0) {
				$no_soal = $this->db->query("SELECT COUNT(no_soal) AS no_soal FROM soal WHERE kode_ujian='$kode_ujian'")->row_array()['no_soal'];
				$data_soal = array(
					'kode_soal' =>$kode_soal,
					'pertanyaan' => $soal,
					'op_a' => $optA,
					'op_b' => $optB,
					'op_c' => $optC,
					'op_d' => $optD,
					'op_e' => $optE,
					'jwb' => $jwb,
					'no_soal' => $no_soal + 1,
					'kode_ujian' => $kode_ujian,
				); 
				$r += 1;
				$insert_soal = $this->M_g_ujian->insert_soal($data_soal);
				redirect('guru_usr_clx/G_ujian/detail_ujian/'.$kode_ujian);
			}else{
				$r += 0;
			}
		}
		
	}

	function load_edit_soal(){
		$kode_soal = $this->input->post("kode_soal");
		$data_soal = $this->M_g_ujian->load_soal($kode_soal);
		$output['data_soal'] = $data_soal;
    	echo json_encode($output);
	}

	function edit_save_soal(){
		$kode_ujian = $this->session->userdata('kode_ujian');
		$soal = $this->input->post('soal');
		$optA = $this->input->post('optA');
		$optB = $this->input->post('optB');
		$optC = $this->input->post('optC');
		$optD = $this->input->post('optD');
		$optE = $this->input->post('optE');
		$jwb = $this->input->post('jwb');
		$kode_soal = $this->input->post('kode_soal');
		
		$data_soal = array(
					'pertanyaan' => $soal,
					'op_a' => $optA,
					'op_b' => $optB,
					'op_c' => $optC,
					'op_d' => $optD,
					'op_e' => $optE,
					'jwb' => $jwb
				); 

		$update = $this->M_g_ujian->update_soal($data_soal, $kode_soal);
		$this->session->set_flashdata('pesan', 'sukses');
		$output['pesan'] = 'sukses';
		echo json_encode($output);	
	}


	public function form(){
		$kode_ujian = $this->session->userdata('kode_ujian');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data = array();
		// Buat variabel $data sebagai array
		if(isset($_POST['preview'])){
		// Jika user menekan tombol Preview pada form
		// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
		$upload = $this->M_g_ujian->upload_file($this->filename);
		if($upload['result'] == "success"){ // Jika proses upload sukses
			// Load plugin PHPExcel nya
			include APPPATH.'PHPExcel/PHPExcel.php';
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
			// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
			$no_soal = $this->db->query("SELECT * FROM soal WHERE kode_ujian='$kode_ujian'")->num_rows();
			$data['sheet'] = $sheet;
			$data['kode_ujian'] = $kode_ujian;
			$data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
			
		}else{ // Jika proses upload gagal
			$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
		}
		}

		$this->load->view('guru/ujian/v_previewExcel', $data);
  	}



  public function import(){
	$kode_ujian = $this->session->userdata('kode_ujian');
    // Load plugin PHPExcel nya
    include APPPATH.'PHPExcel/PHPExcel.php';
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data_soal = array();
    $numrow = 1;
	$no_soal = $this->db->query("SELECT * FROM soal WHERE kode_ujian='$kode_ujian'")->num_rows();
	$no_soal++;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        $i = 0;
        while ($i == 0) {
          $kode_soal = helper_kodesoal();
          $cek_kode_soal = $this->M_g_ujian->cek_kode_soal($kode_soal);
          if ($cek_kode_soal == 0) {
			$nomer = $no_soal++;
			array_push($data_soal, array(
					'kode_soal' =>$kode_soal,
					'pertanyaan' => $row['B'],
					'op_a' => $row['C'],
					'op_b' => $row['D'],
					'op_c' => $row['E'],
					'op_d' => $row['F'],
					'op_e' => $row['G'],
					'jwb' => $row['H'],
					'no_soal' => $nomer,
					'kode_ujian' => $kode_ujian
			));               
            $i += 1;
          }else{
            $i += 0;
          }

        }
        // array_push($data, array(
        //   'nis'=>$row['A'], // Insert data nis dari kolom A di excel
        //   'nama'=>$row['B'], // Insert data nama dari kolom B di excel
        //   'jk'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
        // ));
      }
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    
    $this->M_g_ujian->insert_multiple_soal($data_soal);
    $this->session->set_flashdata('message_name', 'Data Berhasil ditambahkan');
    redirect("guru_usr_clx/G_ujian/detail_ujian/".$kode_ujian); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }


  function _soal(){
		$this->load->helper('download');
		force_download('excel/template_guru.xlsx', NULL);
	}

	function load_hasil_ujian(){
		$kode_ujian = $this->session->userdata('kode_ujian');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$jml_siswa = $this->M_g_ujian->get_jml_siswa($kode_kelas);
		$jml_nilai = $this->M_g_ujian->get_jml_nilai($kode_ujian);
		$progress = number_format(($jml_nilai / $jml_siswa) * 100 , 2);
		$hasil = $this->M_g_ujian->get_hasil_ujian($kode_ujian, $kode_kelas);
		
		$backup = $this->M_g_ujian->cek_backup($kode_ujian);

		$cek_backup = $backup / $jml_siswa;


	
		$data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas'];
		$data['hasil'] = $hasil;
		$data['kode_ujian'] = $kode_ujian;
		$data['progress'] = $progress;
		$data['backup'] = $cek_backup;
		$this->load->view('guru/header', $data);
        $this->load->view('guru/ujian/v_hasil_ujian', $data);
	}

	function diskualifikasi(){
		$kode_siswa = $this->input->post('kode_siswa');
		$kode_ujian = $this->session->userdata('kode_ujian');
		$this->M_s_ujian->input_nilai_ujian($kode_siswa, $kode_ujian, 0);
		$output['pesan'] = "success";
    	echo json_encode($output);
	}

	function reset(){
		$kode_siswa = $this->input->post('kode_siswa');
		$kode_ujian = $this->session->userdata('kode_ujian');
		$this->M_g_ujian->delete_hasil_siswa($kode_siswa, $kode_ujian);
		$this->M_g_ujian->delete_jwb_siswa($kode_siswa, $kode_ujian);
		$output['pesan'] = "success";
    	echo json_encode($output);
	}

	function ambil_nilai(){
		// $kode_ujian = $this->session->userdata('kode_ujian');
		$kode_kelas = $this->session->userdata('kode_kelas');
		// $jml_siswa = $this->M_g_ujian->get_jml_siswa($kode_kelas);
		// $jml_nilai = $this->M_g_ujian->get_jml_nilai($kode_ujian);
		// $progress = ($jml_nilai / $jml_siswa) * 100;
		// if ($progress == 100) {
				
		// }
		$arr = [];
        $nilai = $this->M_g_ujian->get_nilai_backup($kode_kelas);
        foreach ($nilai as $val) {
            $arr[$val->kode_nilai] = $val->nama_nilai;
        }
    	$output['nilai'] = $arr;
    	echo json_encode($output);
		
	}

	function aksi_backup_nilai(){
		$kode_nilai = $this->input->post('kode_nilai');
		$kode_ujian = $this->session->userdata('kode_ujian');
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_guru = $this->session->userdata('kode_guru');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$siswa = $this->M_g_ujian->get_nilai_ujian_siswa($kode_ujian);

		$data = array();
		foreach ($siswa as $val) {
			array_push($data, array(
				'kode_siswa' => $val->kode_siswa,
				'kode_guru' => $kode_guru,
				'kode_nilai' => $kode_nilai,
				'kode_mapel' => $kode_mapel,
				'nilai' => $val->nilai_ujian
			));
		}

		$this->db->insert_batch('nilai_siswa', $data);
		$this->db->query("UPDATE has_nilai SET status=1 WHERE kode_nilai='$kode_nilai' AND kode_kelas='$kode_kelas'");
		$output['pesan'] = 'sukses';
		echo json_encode($output);
	}

	function hapus_soal(){
		$kode_soal = $this->input->post("id");
		$kode_ujian = $this->session->userdata('kode_ujian');
		$this->db->delete('soal', array('kode_soal' => $kode_soal));
		$soal = $this->db->query("SELECT * FROM soal WHERE kode_ujian='$kode_ujian' ORDER BY no_soal")->result();
		$data_soal = array();
		$no_soal = 1;
		foreach ($soal as $val) {
			array_push($data_soal, array(
				'kode_soal' => $val->kode_soal,
				'no_soal' => $no_soal
			));
			$no_soal++;
		}
		$this->db->update_batch('soal', $data_soal, 'kode_soal');
		$output['kode_ujian'] = $kode_ujian;
		$output['pesan'] = 'sukses';
		echo json_encode($output);
	}

	function hapus_ujian(){
		$kode_ujian = $this->input->post("id");
		$this->db->delete('ujian', array('kode_ujian' => $kode_ujian));
		$output['pesan'] = 'sukses';
		echo json_encode($output);
	}

	function upload_bank_soal(){
		$kode_ujian = $this->input->post("id");
		$kode_guru = $this->session->userdata('kode_guru');
		$sql = $this->db->query("SELECT * FROM ujian JOIN mapel JOIN kelas WHERE kode_ujian='$kode_ujian'")->row_array();
		$nama_ujian = $sql['nama_ujian'];
		$nama_kelas = $sql['nama_kelas'];
		$nama_mapel = $sql['nama_mapel'];
		$nama_guru = $this->db->query("SELECT * FROM guru WHERE kode_guru='$kode_guru'")->row_array()['nama_guru'];

		$data_upload = array('nama_ujian' => $nama_ujian,
							'mapel' => $nama_mapel,
							'kelas' => $nama_kelas,
							'guru' => $nama_guru,
							'kode_ujian' => $kode_ujian);
		
		$ins_bank = $this->M_g_ujian->insert_bank_ujian($data_upload); 

		
		$data_soal = array();
		$soal = $this->db->query("SELECT * FROM soal WHERE kode_ujian='$kode_ujian'")->result();
		foreach ($soal as $val) {
			array_push($data_soal, array(
				'pertanyaan' => $val->pertanyaan,
				'op_a' => $val->op_a,
				'op_b' => $val->op_b,
				'op_c' => $val->op_c,
				'op_d' => $val->op_d,
				'op_e' => $val->op_e,
				'jwb' => $val->jwb,
				'kode_bank_ujian' => $ins_bank,
				'no_soal' => $val->no_soal
			));
		}

		$this->db->insert_batch('bank_soal', $data_soal);
		$output['pesan'] = 'sukses';
		echo json_encode($output);
		
	}

	function load_data_backup(){
		$output['pesan'] = 'sukses';
		$output['ujian'] = $this->db->query("SELECT * FROM bank_has_ujian")->result();
		echo json_encode($output);
	}

	function load_data_bank_soal(){
		$id = $this->input->post("id");
		$output['pesan'] = 'sukses';
		$output['soal'] = $this->db->query("SELECT * FROM bank_soal WHERE kode_bank_ujian='$id' ORDER BY no_soal ASC")->result();
		echo json_encode($output);
	}
	 function download_template_soal(){
		$this->load->helper('download');
		force_download('excel/template_soal_kuis.xlsx', NULL);
	}




    
    





}
