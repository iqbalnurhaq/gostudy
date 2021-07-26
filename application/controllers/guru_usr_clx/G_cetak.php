<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_cetak extends CI_Controller {

    public function __construct()
  	{
        parent::__construct();
        $cek = $this->session->userdata('login');
		if ($cek == 'usr_guru') {
			true;
		}else{
			redirect('Login');
		}
		if ($this->session->userdata('kode_kelas')) {
            true;
        }else{
            redirect('Login');
        }
		$this->load->helper('create_random_helper');
       
    }


	public function index()
	{
        $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');
        $user_code = $this->session->userdata('user_code');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/cetak/v_kode');
	}
	
	public function kirim_kode(){
        $kode = $this->input->post("kode");
        $cek = $this->db->query("SELECT * FROM kode_cetak WHERE kode='$kode'")->result();
        if ($cek) {
             redirect("guru_usr_clx/G_cetak/cetak_raport");
        }else{
            redirect("guru_usr_clx/G_cetak");
        }
    }

    public function cetak_raport(){
         $kode_mapel = $this->session->userdata('kode_mapel');
        $kode_kelas = $this->session->userdata('kode_kelas');
        $user_code = $this->session->userdata('user_code');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/cetak/v_cetak_nilai');
    }

    public function data_siswa(){
        $siswa  = $this->db->query("SELECT * FROM siswa JOIN kelas ON siswa.kode_kelas=kelas.kode_kelas")->result();
        $output['data_siswa'] = $siswa;
    	echo json_encode($output);
    }

    public function aksi_cetak(){
        $kode_siswa = $this->uri->segment(4);
       
        // Load file koneksi.php

// Load plugin PHPExcel nya
include APPPATH.'PHPExcel/PHPExcel.php';
// Panggil class PHPExcel nya
$excel = new PHPExcel();
// Settingan awal file excel
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
$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA HASIL RAPORT SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3

$siswa = $this->db->query("SELECT * FROM siswa WHERE kode_siswa='$kode_siswa'")->result();

foreach ($siswa as $value) {
    # code...
    
    $excel->setActiveSheetIndex(0)->setCellValue('A2', "NIS : " .$value->nis); // Set kolom A2 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A2:B2'); // Set Merge Cell pada kolom A2 sampai F2
    
    $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 25 untuk kolom A2

    // ========================
    
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Nama Siswa : " .$value->nama_siswa); // Set kolom A2 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A3:B3'); // Set Merge Cell pada kolom A2 sampai F2
    
    $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 25 untuk kolom A2

    // ======================
    
    $excel->setActiveSheetIndex(0)->setCellValue('C2', "Email :" .$value->email); // Set kolom A2 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('C2:E2'); // Set Merge Cell pada kolom A2 sampai F2
    
    $excel->getActiveSheet()->getStyle('C2')->getFont()->setSize(12); // Set font size 25 untuk kolom A2

    // ================================

    $excel->setActiveSheetIndex(0)->setCellValue('C3', "No Tlp : " .$value->no_tlp); // Set kolom A2 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('C3:E3'); // Set Merge Cell pada kolom A2 sampai F2
    
    $excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(12); // Set font size 25 untuk kolom A2



    $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_row);
  
    $excel->getActiveSheet()->getStyle('A2')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B2')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C2')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D2')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E2')->applyFromArray($style_row);

   $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_row);

    
}



    // ========



$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B4', "MATA PELAJARAN"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C4', "KKM"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('D4', "NILAI"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('E4', "KET"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
// Buat query untuk menampilkan semua data siswa
$kode_kelas = $this->db->query("SELECT kode_kelas FROM siswa WHERE kode_siswa='$kode_siswa'")->row_array()['kode_kelas'];
$mapel = $this->db->query("SELECT * FROM mapel JOIN has_kelas ON mapel.kode_mapel=has_kelas.kode_mapel WHERE has_kelas.kode_kelas='$kode_kelas'")->result();
$c_mapel = $this->db->query("SELECT * FROM has_nilai WHERE kode_kelas='$kode_kelas'")->num_rows();

$data_array = array();
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
foreach ($mapel as $value) {
    # code...
    $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
    $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $value->nama_mapel);
    $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $value->kkm);
    $c_nilai = $this->db->query("SELECT * FROM nilai_siswa WHERE kode_siswa='$kode_siswa' AND kode_mapel='$value->kode_mapel'")->num_rows();
    if ($c_mapel == $c_nilai) {
        $sum_nilai = $this->db->query("SELECT SUM(nilai) AS jml FROM nilai_siswa WHERE kode_siswa='$kode_siswa' AND kode_mapel='$value->kode_mapel'")->row_array()['jml'];
        $nilai_fix = number_format($sum_nilai/$c_mapel, 2);
        $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $nilai_fix);
        if ($nilai_fix >= $value->kkm) {
            # code...
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, "LULUS");
            $excel->getActiveSheet()->getStyle('E'.$numrow)->getFont()->setBold(TRUE); // Set bold kolom A1
        }else {
             $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, "TIDAK LULUS");
             $excel->getActiveSheet()->getStyle('E'.$numrow)->getFont()->setBold(TRUE); // Set bold kolom A1
        }
        array_push($data_array, $nilai_fix);
    }else{
        $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, '---');
        $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, '---');
    }
    

    
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);

  
  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

  $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  $excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  $excel->getActiveSheet()->getStyle('E'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
}

$jml_mapel = $this->db->query("SELECT * FROM mapel JOIN has_kelas ON mapel.kode_mapel=has_kelas.kode_mapel WHERE has_kelas.kode_kelas='$kode_kelas'")->num_rows();
$row_jml = 5 + $jml_mapel;

  $excel->setActiveSheetIndex(0)->setCellValue('A'.$row_jml, "Total Nilai Raport : "); // Set kolom A2 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A'.$row_jml.':C'.$row_jml); // Set Merge Cell pada kolom A2 sampai F2
    
    $excel->getActiveSheet()->getStyle('A'.$row_jml)->getFont()->setSize(12); // Set font size 25 untuk kolom A2


    $r_nilai = count($data_array);

    if ($r_nilai == $jml_mapel) {
        $r_fix = array_sum($data_array);
         $excel->setActiveSheetIndex(0)->setCellValue('D'.$row_jml, number_format($r_fix/$jml_mapel, 2)); // Set kolom A2 dengan tulisan "DATA SISWA"
    }else {

        $excel->setActiveSheetIndex(0)->setCellValue('D'.$row_jml, "---"); // Set kolom A2 dengan tulisan "DATA SISWA"
    }

    $excel->getActiveSheet()->mergeCells('D'.$row_jml.':E'.$row_jml); // Set Merge Cell pada kolom A2 sampai F2


    $excel->getActiveSheet()->getStyle('A'.$row_jml)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B'.$row_jml)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$row_jml)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D'.$row_jml)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E'.$row_jml)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D'.$row_jml)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  $excel->getActiveSheet()->getStyle('E'.$row_jml)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  
    // ========


// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(13); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(13); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(13); // Set width kolom D

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Laporan Data Raport Siswa");
$excel->setActiveSheetIndex(0);
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');

    }

    // =================

  



}
