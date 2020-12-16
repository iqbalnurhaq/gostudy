<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_g_ujian extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function insert_ujian($data){
    return $this->db->insert('ujian', $data);
  }

  function cek_kode_ujian(){
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('ujian')->num_rows();  
  }

  function cek_kode_soal($kode_soal){
    $this->db->where('kode_soal', $kode_soal);
    return $this->db->get('soal')->num_rows();  
  }

  function get_data_ujian($kode_mapel, $kode_kelas){
    $this->db->where('kode_mapel', $kode_mapel);
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('ujian')->result();
  }

  function load_detail_ujian($kode_ujian){
    $this->db->where('kode_ujian', $kode_ujian);
    return $this->db->get('ujian')->result();  
  }

  function get_soal_list($limit, $offset, $kode_ujian){
    $this->db->select('*')
         ->from('ujian_has_soal')
         ->join('soal', 'ujian_has_soal.kode_soal = soal.kode_soal');
    $this->db->where('ujian_has_soal.kode_ujian', $kode_ujian);
    $this->db->limit($limit, $offset);
    $query = $this->db->get();
    return $query;
  }

  // function count_soal($kode_ujian){
  //   $this->db->where('kode_ujian', $kode_ujian);
  //   return $this->db->get('ujian_has_soal')->num_rows();  
  // }

  public function getAllSoal($kode_ujian)
    {
      $this->db->select('*')
        ->from('ujian_has_soal')
        ->join('soal', 'ujian_has_soal.kode_soal = soal.kode_soal');
      $this->db->where('ujian_has_soal.kode_ujian', $kode_ujian);
      return $this->db->get();
    }

  function insert_soal($data){
      return $this->db->insert('soal', $data);
  }
  function insert_has_soal($data){
      return $this->db->insert('soal', $data);
  }

  function load_soal($kode_soal){
    $this->db->where('kode_soal', $kode_soal);
    return $this->db->get('soal')->row();  
  }

  function update_soal($data_soal, $kode_soal){
    $this->db->where('kode_soal', $kode_soal);
    $this->db->update('soal', $data_soal);
  }

  function get_hasil_ujian($kode_ujian, $kode_kelas){
    $sql = "SELECT *, siswa.kode_siswa FROM siswa LEFT JOIN nilai_ujian ON siswa.kode_siswa=nilai_ujian.kode_siswa AND nilai_ujian.kode_ujian='$kode_ujian' WHERE siswa.kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->result();
  }

  function get_jml_siswa($kode_kelas){
    $sql = "SELECT * FROM siswa WHERE kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->num_rows();
  }

  function get_jml_nilai($kode_ujian){
    $sql = "SELECT * FROM nilai_ujian WHERE kode_ujian='$kode_ujian'";
    return $this->db->query($sql)->num_rows();
  }
  function cek_backup($kode_ujian){
    $sql = "SELECT * FROM nilai_ujian WHERE kode_ujian='$kode_ujian' AND kode_nilai=null";
    return $this->db->query($sql)->num_rows();
  }

  // ==============
  function delete_hasil_siswa($kode_siswa, $kode_ujian){
    return $this->db->delete('nilai_ujian', array('kode_siswa' => $kode_siswa, 'kode_ujian' => $kode_ujian));
  }
  
  function delete_jwb_siswa($kode_siswa, $kode_ujian){
    return $this->db->delete('jwb_siswa', array('kode_siswa' => $kode_siswa, 'kode_ujian' => $kode_ujian));
  }

  function get_nilai_backup($kode_kelas){
    $sql = "SELECT *, nilai.kode_nilai FROM nilai JOIN has_nilai ON nilai.kode_nilai=has_nilai.kode_nilai WHERE has_nilai.kode_kelas='$kode_kelas' AND status=0";
    return $this->db->query($sql)->result();
  }

  function get_nilai_ujian_siswa($kode_ujian){
    $this->db->where('kode_ujian', $kode_ujian);
    return $this->db->get('nilai_ujian')->result();
  }

  public function upload_file($filename){
    $this->load->library('upload'); // Load librari upload
    $config['upload_path'] = './excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = $filename;
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data

  function insert_multiple_soal($data){
     return $this->db->insert_batch('soal', $data);
  }

  function insert_bank_ujian($data){
    $this->db->insert('bank_has_ujian', $data);
    return $this->db->insert_id();
  }



}

?>