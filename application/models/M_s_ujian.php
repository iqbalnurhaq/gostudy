<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_s_ujian extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  function get_data_ujian($kode_mapel, $kode_kelas){
    $sql = "SELECT *, (SELECT COUNT(soal.no_soal) FROM soal WHERE soal.kode_ujian=ujian.kode_ujian) AS jml_soal FROM ujian WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->result();
  }

  function load_detail_ujian($kode_ujian){
    $this->db->where('kode_ujian', $kode_ujian);
    return $this->db->get('ujian')->result();  
  }

  function load_soal($kode_ujian){
    $sql = "SELECT * FROM soal WHERE soal.kode_ujian='$kode_ujian' ORDER BY no_soal";
    return $this->db->query($sql)->result();
  }


  function upload_file_tugas($data){
    $this->db->insert('upload_tugas', $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }
  
  function upload_has_tugas($data){
    return $this->db->insert('has_upload', $data);
  }

  function load_upload_tugas($kode_tugas, $kode_siswa){
    $sql = "SELECT * FROM has_upload JOIN upload_tugas ON has_upload.id_file=upload_tugas.id WHERE has_upload.kode_tugas='$kode_tugas' AND has_upload.kode_siswa='$kode_siswa'";
    return $this->db->query($sql)->result();
  }

   function insert_jbw($data, $kode_ujian){
    $this->db->insert('jwb_siswa', $data);
    return $this->db->insert_id();
   
  }
  
  function insert_detail_hasil($data_desc){
    return $this->db->insert_batch('desc_jwb_siswa', $data_desc);
  }

   function insert_jbw_t($kode_ujian, $kode_siswa, $durasi){
     $data = array('kode_ujian' => $kode_ujian,
     'kode_siswa' => $kode_siswa,
     'pengerjaan' => $durasi);
     $this->db->insert('jwb_siswa', $data);
     return $this->db->insert_id();
     
  }

   function ambilKunci($kode_soal){
    $sql = "SELECT jwb FROM soal WHERE kode_soal='$kode_soal'";
    return $this->db->query($sql)->row_array();
  }

  function ambil_id_jwb_siswa($kode_ujian, $kode_siswa){
    $sql = "SELECT id FROM jwb_siswa WHERE kode_ujian='$kode_ujian' AND kode_siswa='$kode_siswa'";
    return $this->db->query($sql)->row_array();
  }

  function saveJwb($jwbSiswa, $ket, $kode_soal, $id_jwb){
    $sql = "UPDATE desc_jwb_siswa SET jawaban='$jwbSiswa', ket='$ket' WHERE kode_soal='$kode_soal' AND id_jwb_siswa='$id_jwb'";
    return $this->db->query($sql);
  }

  function status($kode_siswa, $kode_ujian){
    $this->db->where('kode_siswa', $kode_siswa);
    $this->db->where('kode_ujian', $kode_ujian);
    return $this->db->update('jwb_siswa', array('status' => 1));
  }

  function input_nilai_ujian($kode_siswa, $kode_ujian, $nilai){
    $data = array('kode_ujian' => $kode_ujian,
     'kode_siswa' => $kode_siswa,
     'nilai_ujian' => $nilai);
     $this->db->insert('nilai_ujian', $data);
  }

  // ----------- Hasil Ujian ------------

  function jml_soal($id){
    $sql = "SELECT COUNT(id_jwb_siswa) AS jumlah_soal FROM desc_jwb_siswa WHERE id_jwb_siswa='$id'";
    return $this->db->query($sql)->row_array()['jumlah_soal'];
  }
  function soal_benar($id){
    $sql = "SELECT COUNT(id_jwb_siswa) AS s_benar FROM desc_jwb_siswa WHERE id_jwb_siswa='$id' AND ket=1";
    return $this->db->query($sql)->row_array()['s_benar'];
  }




}

?>