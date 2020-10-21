<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_ujian extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
        $this->load->helper('create_random_helper');
        $this->load->library('pagination');
		$this->load->model('M_g_ujian');
       
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
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian);
					$r += 1;
					$this->session->set_flashdata('pesan', 'sukses');
					redirect('guru_usr_clx/G_ujian');
				}else if($months > 0){
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian);
					$r += 1;
					$this->session->set_flashdata('pesan', 'sukses');
					redirect('guru_usr_clx/G_ujian');
				}else if($days > 0){
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian);
					$r += 1;
					$this->session->set_flashdata('pesan', 'sukses');
					redirect('guru_usr_clx/G_ujian');
				}else if($fix > $durasi){
					$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian);
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

		// 			$insert_ujian = $this->M_g_ujian->insert_ujian($data_ujian);
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
		$data['analisis_soal'] = $this->db->query("SELECT * FROM ujian_has_soal WHERE kode_ujian='$kode_ujian'")->result(); 
        $data['data_ujian'] = $this->M_g_ujian->load_detail_ujian($kode_ujian);
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
				$data_soal = array(
					'kode_soal' =>$kode_soal,
					'pertanyaan' => $soal,
					'op_a' => $optA,
					'op_b' => $optB,
					'op_c' => $optC,
					'op_d' => $optD,
					'op_e' => $optE,
					'jwb' => $jwb
				); 
				$insert_soal = $this->M_g_ujian->insert_soal($data_soal);
				if ($insert_soal) {
					$no_soal = $this->db->query("SELECT COUNT(no_soal) AS no_soal FROM ujian_has_soal WHERE kode_ujian='$kode_ujian'")->row_array()['no_soal'];
					$data_has_soal = array(
						'no_soal' => $no_soal + 1,
						'kode_ujian' => $kode_ujian,
						'kode_soal' => $kode_soal
					);
					$insert_has_soal = $this->M_g_ujian->insert_has_soal($data_has_soal);
					$r += 1;
					redirect('guru_usr_clx/G_ujian/detail_ujian/'.$kode_ujian);
				}
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
		$data = array();
		// Buat variabel $data sebagai array
		if(isset($_POST['preview'])){
		// Jika user menekan tombol Preview pada form
		// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
		$upload = $this->M_a_guru->upload_file($this->filename);
		if($upload['result'] == "success"){ // Jika proses upload sukses
			// Load plugin PHPExcel nya
			include APPPATH.'PHPExcel/PHPExcel.php';
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
			// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
			$data['sheet'] = $sheet;
		}else{ // Jika proses upload gagal
			$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
		}
		}
		$this->load->view('admin/guru/v_previewExcel', $data);
  	}



  public function import(){
    // Load plugin PHPExcel nya
    include APPPATH.'PHPExcel/PHPExcel.php';
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $dataUsers = array();
    $data = array();
    $numrow = 1;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        $i = 0;
        while ($i == 0) {
          $kode_user = helper_kodeUser();
          $cek_kode_user = $this->M_a_guru->cek_kode_user($kode_user);
          if ($cek_kode_user == 0) {
            $pwdGuru = helper_createPwd();
            $cekPwd = $this->M_a_guru->cek_pwd_guru($pwdGuru);
            if ($cekPwd == 0) {
              array_push($dataUsers, array(
                'kode_user'=>$kode_user,
                'username'=>$kode_user, // Insert data nis dari kolom A di excel
                'password'=>$pwdGuru, // Insert data nama dari kolom B di excel
                'lvl_usr'=>'guru', // Insert data jenis kelamin dari kolom C di excel
                'akses'=>1,
              ));
              $kode_guru = helper_kodeGuru();
              $cek_kode_guru = $this->M_a_guru->cek_kode_guru($kode_guru);
              if ($cek_kode_guru == 0) {
                array_push($data, array(
				  'kode_guru'=>$kode_guru,
				  'nip' => $row['A'],
                  'nama_guru'=>$row['B'],
                  'jk'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
                  'user_code' => $kode_user,
                ));
                $i += 1;
              }else
                $i += 0;
            }else{
              $i += 0;         
            }
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
    $this->M_a_guru->insert_multiple_user($dataUsers);
    $this->M_a_guru->insert_multiple($data);
    $this->session->set_flashdata('message_name', 'Data Berhasil ditambahkan');
    redirect("go_ciclx_usradmin/A_guru"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }


  function download_template(){
		$this->load->helper('download');
		force_download('excel/template_guru.xlsx', NULL);
	}


    
    





}
