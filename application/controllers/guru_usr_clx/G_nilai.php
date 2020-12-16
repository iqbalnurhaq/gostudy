<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_nilai extends CI_Controller {
	private $filename = "import_data_nilai";

    public function __construct()
  	{
		parent::__construct();
		$this->load->helper('create_random_helper');
		$this->load->model('M_g_nilai');
		$this->load->model('M_g_siswa');
		$this->load->model('M_g_ujian');
       
    }


	public function index()
	{
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas'];
        $this->load->view('guru/header', $data);
        $this->load->view('guru/nilai/v_nilai');
    }
    
    function data_nilai(){
		$kode_kelas = $this->session->userdata('kode_kelas');
		// $output['data_nilai'] = $this->M_g_nilai->data_siswa($kode_kelas); 
		$output['data_nilai_siswa'] = $this->M_g_nilai->data_nilai_siswa($kode_kelas);
    	echo json_encode($output);
	}
    function nilai_siswa(){
		$kode_siswa = $this->uri->segment(4);
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$kode_guru = $this->session->userdata('kode_guru');
		$kode_nilai = $this->session->userdata('kode_nilai');
		// $output['data_nilai'] = $this->M_g_nilai->data_siswa($kode_kelas); 
		// $output['data_siswa'] = $this->M_g_nilai->data_siswa($kode_kelas);
		$output['nilai_siswa'] = $this->M_g_nilai->nilai_siswa($kode_kelas, $kode_nilai);
    	echo json_encode($output);
	}

	function link_nilai(){
		$kode_nilai = $this->uri->segment(4);
		$this->session->set_userdata(array('kode_nilai' => $kode_nilai));
		$kode_kelas = $this->session->userdata('kode_kelas');
		$jml_siswa = $this->M_g_ujian->get_jml_siswa($kode_kelas); 
		$jml_nilai = $this->db->query("SELECT COUNT(id) AS jml FROM nilai_siswa WHERE kode_nilai='$kode_nilai'")->row_array()['jml'];
		$progress = number_format(($jml_nilai / $jml_siswa) * 100 , 2);

		$data['progress'] = $progress;
		$data['kode_nilai'] = $kode_nilai;
		$data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas'];
		$data['nama_nilai'] = $this->db->query("SELECT nama_nilai FROM nilai WHERE kode_nilai='$kode_nilai'")->row_array()['nama_nilai'];
        $this->load->view('guru/header', $data);
        $this->load->view('guru/nilai/v_link_siswa');
	}

	function input_nilai(){
		$nilai = $this->input->post('nilai');
		$kode_siswa = $this->input->post('kode_siswa');
		$kode_nilai = $this->session->userdata('kode_nilai');
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$kode_guru = $this->session->userdata('kode_guru');
		$cek = $this->M_g_nilai->cek_nilai($kode_siswa, $kode_nilai, $kode_mapel);
		if ($cek) {
			$update = $this->M_g_nilai->update_nilai($nilai, $kode_siswa, $kode_nilai, $kode_guru, $kode_mapel);
			$output['pesan'] = 'success';
			$output['kode_nilai'] = $kode_nilai;
			echo json_encode($output);  
		} else {
			$insert_nilai = $this->M_g_nilai->insert_nilai($nilai, $kode_siswa, $kode_nilai, $kode_guru, $kode_mapel);
			$output['pesan'] = 'success';
			$output['kode_nilai'] = $kode_nilai;
			echo json_encode($output);  
		}
	}

	function open(){
		$kode_nilai = $this->input->post('kode_nilai');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$this->M_g_nilai->open_nilai($kode_nilai, $kode_kelas);
		$output['pesan'] = 'success';
		echo json_encode($output);  
	}

	function clear(){
		$kode_kelas = $this->session->userdata('kode_kelas');
		$kode_nilai = $this->input->post('kode_nilai');
		$this->M_g_nilai->clear_nilai($kode_nilai, $kode_kelas);
		$this->M_g_nilai->delete_nilai($kode_nilai, $kode_kelas);
		$output['pesan'] = 'success';
		echo json_encode($output);  
	}

	public function export(){
		$kode_kelas = $this->session->userdata('kode_kelas');
		// Load plugin PHPExcel nya
		include APPPATH.'PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					->setLastModifiedBy('My Notes Code')
					->setTitle("Data Siswa")
					->setSubject("Siswa")
					->setDescription("Laporan Semua Data Siswa")
					->setKeywords("Data Siswa");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "KODE SISWA"); // Set kolom B1 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "NIS"); // Set kolom C1 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "NAMA"); // Set kolom D1 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "NILAI"); // Set kolom E1 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$siswa = $this->M_g_siswa->get_data_siswa($kode_kelas);
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa as $data){ // Lakukan looping pada variabel siswa
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kode_siswa);
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nis);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama_siswa);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,'');
		
		// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		
		$no++; // Tambah 1 setiap kali looping
		$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function export_nilai_fix(){
		$kode_nilai = $this->uri->segment(4);
		$kode_kelas = $this->session->userdata('kode_kelas');
		// Load plugin PHPExcel nya
		include APPPATH.'PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					->setLastModifiedBy('My Notes Code')
					->setTitle("Data Nilai")
					->setSubject("Nilai")
					->setDescription("Laporan Semua Data Nilai")
					->setKeywords("Data Nilai");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "KODE SISWA"); // Set kolom B1 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "NIS"); // Set kolom C1 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "NAMA"); // Set kolom D1 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "NILAI"); // Set kolom E1 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$siswa = $this->M_g_nilai->get_data_nilai($kode_kelas, $kode_nilai);
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa as $data){ // Lakukan looping pada variabel siswa
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kode_siswa);
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nis);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama_siswa);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nilai);
		
		// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		
		$no++; // Tambah 1 setiap kali looping
		$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Nilai.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function form(){
		$kode_kelas = $this->session->userdata('kode_kelas');
		$kode_nilai = $this->input->post("kode_nilai");
		
		// $data = array();
		// Buat variabel $data sebagai array
		if(isset($_POST['preview'])){
			// Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->M_g_nilai->upload_file($this->filename);
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'PHPExcel/PHPExcel.php';
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet;
				$data['kode_nilai'] = $kode_nilai;
				$data['siswa'] = $this->M_g_siswa->get_data_siswa($kode_kelas);
				$data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas'];
				
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		$this->load->view('guru/nilai/v_previewExcel', $data);
	}

	public function import(){
		$kode_nilai = $this->input->post("kode_nilai");
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$kode_guru = $this->session->userdata('kode_guru');
		// Load plugin PHPExcel nya
		include APPPATH.'PHPExcel/PHPExcel.php';
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				
				array_push($data, array(
				'kode_siswa'=>$row['B'],
				'kode_nilai'=>$kode_nilai,
				'kode_mapel'=>$kode_mapel,
				'kode_guru'=>$kode_guru,
				'nilai' => $row['E'],
				));		
				
			}
			$numrow++; // Tambah 1 setiap kali looping
		}

		$this->M_g_nilai->open_nilai($kode_nilai, $kode_kelas);
		
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->M_g_nilai->insert_multiple($data);
		$this->session->set_flashdata('message_name', 'Data Berhasil ditambahkan');
		redirect("guru_usr_clx/G_nilai"); // Redirect ke halaman awal (ke controller siswa fungsi index)
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
