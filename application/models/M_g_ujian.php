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
      return $this->db->insert('ujian_has_soal', $data);
  }

  function load_soal($kode_soal){
    $this->db->where('kode_soal', $kode_soal);
    return $this->db->get('soal')->row();  
  }

  function update_soal($data_soal, $kode_soal){
    $this->db->where('kode_soal', $kode_soal);
    $this->db->update('soal', $data_soal);
  }



}

?>