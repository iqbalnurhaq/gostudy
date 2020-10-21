<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_siswa extends CI_Controller {
	private $filename = "import_data_siswa";
	public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_siswa');
	}
	  
	public function index()
	{
		$i = 0;
		while ($i == 0) {
			$pwdSiswa = helper_createPwd();
			$cekPwd = $this->M_a_siswa->cek_pwd_siswa($pwdSiswa);
			if ($cekPwd == 0) {
				$i += 1;
				$data['password'] = $pwdSiswa;		
				$this->load->view('admin/header');
        		$this->load->view('admin/siswa/v_siswa', $data);
			}else {
				$i += 0;
			}
		}
	}

	function data_siswa(){
		$dataSiswa = $this->M_a_siswa->load_data_siswa();
    	$output['dataSiswa'] = $dataSiswa;
    	echo json_encode($output);
	}

	function data_siswa_ban(){
		$dataSiswa = $this->M_a_siswa->load_data_siswa_banned();
    	$output['dataSiswa'] = $dataSiswa;
    	echo json_encode($output);
	}

	function tambah(){
		$i = 0;
		$r = 0;
		while ($i == 0) {
			$kode_user = helper_kodeUser();
			$cek_kode_user = $this->M_a_siswa->cek_kode_user($kode_user);
			if ($cek_kode_user == 0) {
				$dataUsersiswa = array('kode_user' => $kode_user,
                      'username' => $this->input->post('nis'),
                      'password' => $this->input->post('password'),
                      'lvl_usr' => 'siswa',
                      'akses' => 1);	
				$insert_user_siswa = $this->M_a_siswa->tambah_user_siswa($dataUsersiswa);	
				if ($insert_user_siswa) {
					while ($r == 0 ) {
						$kode_siswa = helper_kodeSiswa();
						$cek_kode_siswa = $this->M_a_siswa->cek_kode_siswa($kode_siswa);
						if ($cek_kode_siswa == 0) {
							$datasiswa = array('kode_siswa' => $kode_siswa,
                            'nis' => $this->input->post('nis'),
							'nama_siswa' => $this->input->post('nama'),
                            'user_code' => $kode_user);
							$insert_siswa = $this->M_a_siswa->tambah_siswa($datasiswa);
							if ($insert_siswa) {
								$r += 1;
								$this->session->set_flashdata('pesan', 'sukses');
								redirect('go_ciclx_usradmin/A_siswa');
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


	// ----------------- Update Delete -------------------

	function hapus_siswa(){
		$kode_siswa = $this->input->post('id');
		$del = $this->M_a_siswa->delete_siswa($kode_siswa);
		if ($del) {
			$output['msg'] = 'success';
			echo json_encode($output);
		}
	}

	function ban_siswa(){
		$kode_siswa = $this->input->post('id');
		$ban = $this->M_a_siswa->banned_siswa($kode_siswa);
		if ($ban) {
			$output['msg'] = 'success';
			echo json_encode($output);
		}
	}

	function aktifkan_siswa(){
		$kode_siswa = $this->input->post('id');
		$ban = $this->M_a_siswa->aktif_siswa($kode_siswa);
		if ($ban) {
			$output['msg'] = 'success';
			echo json_encode($output);
		}
	}


	//--------------- Edit siswa --------------
	function load_edit_siswa(){
		$kode_siswa = $this->input->post('kode_siswa');
		$output['data'] = $this->M_a_siswa->get_siswa_edit($kode_siswa);
		echo json_encode($output);	
	}

	function edit_siswa(){
		$nis = $this->input->post('nis');
		$nama = $this->input->post('nama');
		$kode_siswa = $this->input->post('kode_siswa');
		$data = array('nis' => $nis,
					'nama_siswa' => $nama);
		$update_siswa = $this->M_a_siswa->update_siswa($data, $kode_siswa);
		$output['msg'] = 'success';
        echo json_encode($output);
	}


	// --------------------- Excel ------------

	public function form(){
		$data = array();
		// Buat variabel $data sebagai array
		if(isset($_POST['preview'])){
		// Jika user menekan tombol Preview pada form
		// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
		$upload = $this->M_a_siswa->upload_file($this->filename);
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
		$this->load->view('admin/siswa/v_previewExcel', $data);
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
			$cek_kode_user = $this->M_a_siswa->cek_kode_user($kode_user);
			if ($cek_kode_user == 0) {
				$pwdSiswa = helper_createPwd();
				$cekPwd = $this->M_a_siswa->cek_pwd_siswa($pwdSiswa);
				if ($cekPwd == 0) {
				array_push($dataUsers, array(
					'kode_user'=>$kode_user,
					'username'=>$kode_user, // Insert data nis dari kolom A di excel
					'password'=>$pwdSiswa, // Insert data nama dari kolom B di excel
					'lvl_usr'=>'siswa', // Insert data jenis kelamin dari kolom C di excel
					'akses'=>1,
				));
				$kode_siswa = helper_kodeSiswa();
				$cek_kode_siswa = $this->M_a_siswa->cek_kode_siswa($kode_siswa);
				if ($cek_kode_siswa == 0) {
					array_push($data, array(
					'kode_siswa'=>$kode_siswa,
					'nis' => $row['A'],
					'nama_siswa'=>$row['B'],
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
		$this->M_a_siswa->insert_multiple_user($dataUsers);
		$this->M_a_siswa->insert_multiple($data);
		$this->session->set_flashdata('message_name', 'Data Berhasil ditambahkan');
		redirect("go_ciclx_usradmin/A_siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  	}
	  

	function download_template(){
		$this->load->helper('download');
		force_download('excel/template_siswa.xlsx', NULL);
	}

}
