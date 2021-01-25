<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_kelas extends CI_Controller {
    private $filename = "import_data_siswa_kelas";

    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_kelas');
		$this->load->model('M_a_siswa');
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



    // ===== siswa excel ===
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
		$this->load->view('admin/kelas/v_previewExcel', $data);
    }
    
    public function import(){
        $kode_kelas = $this->input->post('kode_kelas');
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
                    'kode_kelas' => $kode_kelas,
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
		redirect("go_ciclx_usradmin/A_kelas/nextAksi"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  	}
}
