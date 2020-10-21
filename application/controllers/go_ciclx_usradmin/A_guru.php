<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_guru extends CI_Controller {
	private $filename = "import_data_guru";
	public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_guru');
  	}

	public function index()
	{
		$arr = [];
		$i = 0;
		while ($i == 0) {
			$pwdGuru = helper_createPwd();
			$cekPwd = $this->M_a_guru->cek_pwd_guru($pwdGuru);
			if ($cekPwd == 0) {
				$i += 1;
				$data['password'] = $pwdGuru;
				$sql = "SELECT * FROM mapel";
				$dataGuru = $this->db->query($sql)->result();
				
				$data['mapel'] = $dataGuru;
				$this->load->view('admin/header');
        		$this->load->view('admin/guru/v_guru', $data);
			}else {
				$i += 0;
			}
		}
        
	}

	public function firstRead(){
		
	}

	function tambah(){
		$i = 0;
		$r = 0;
		while ($i == 0) {
			$kode_user = helper_kodeUser();
			$cek_kode_user = $this->M_a_guru->cek_kode_user($kode_user);
			if ($cek_kode_user == 0) {
				$dataUserGuru = array('kode_user' => $kode_user,
                      'username' => $this->input->post('nip'),
                      'password' => $this->input->post('password'),
                      'lvl_usr' => 'guru',
                      'akses' => 1);	
				$insert_user_guru = $this->M_a_guru->tambah_user_guru($dataUserGuru);	
				if ($insert_user_guru) {
					while ($r == 0 ) {
						$kode_guru = helper_kodeGuru();
						$cek_kode_guru = $this->M_a_guru->cek_kode_guru($kode_guru);
						if ($cek_kode_guru == 0) {
							$dataGuru = array('kode_guru' => $kode_guru,
                            'nip' => $this->input->post('nip'),
							'nama_guru' => $this->input->post('nama'),
                            'user_code' => $kode_user);
							$insert_guru = $this->M_a_guru->tambah_guru($dataGuru);
							if ($insert_guru) {
								$r += 1;
								$this->session->set_flashdata('pesan', 'sukses');
								redirect('go_ciclx_usradmin/A_guru');
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

	function data_guru(){
		$dataGuru = $this->M_a_guru->load_data_guru();
    	$output['dataGuru'] = $dataGuru;
    	echo json_encode($output);
	}

	function data_guru_ban(){
		$dataGuru = $this->M_a_guru->load_data_guru_banned();
    	$output['dataGuru'] = $dataGuru;
    	echo json_encode($output);
	}

	function hapus_guru(){
		$kode_guru = $this->input->post('id');
		$del = $this->M_a_guru->delete_guru($kode_guru);
		if ($del) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
	}

	function ban_guru(){
		$kode_guru = $this->input->post('id');
		$ban = $this->M_a_guru->banned_guru($kode_guru);
		if ($ban) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
	}

	function aktifkan_guru(){
		$kode_guru = $this->input->post('id');
		$ban = $this->M_a_guru->aktif_guru($kode_guru);
		if ($ban) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
	}


	function tambah_pengampu(){
		$kode_mapel = $this->input->post('kode_mapel');
		$kode_guru = $this->input->post('kode_guru');
		$update = $this->M_a_guru->update_guru_pengampu($kode_mapel, $kode_guru);
		$update_kelas = $this->M_a_guru->update_has_kelas($kode_mapel, $kode_guru); 
        $output['msg'] = 'success';
    	echo json_encode($output);
        
	}
	

	function load_edit_guru(){
		$kode_guru = $this->input->post('kode_guru');
		$output['data'] = $this->M_a_guru->get_guru_edit($kode_guru);
		echo json_encode($output);	
	}

	function edit_guru(){
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$kode_guru = $this->input->post('kode_guru');
		$data = array('nip' => $nip,
					'nama_guru' => $nama);

		$data_has = array('nama_guru' => $nama);
		$update_guru = $this->M_a_guru->update_guru($data, $kode_guru);
		$update_kelas = $this->M_a_guru->update_has_kelas_nama($data_has, $kode_guru);
		$output['msg'] = 'success';
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
