<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_a_nilai extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function load_data_nilai(){
    $sql = "SELECT * FROM nilai";
    return $this->db->query($sql)->result();
  }

  function cek_kode_nilai($kode_nilai){
    $sql = "SELECT * FROM nilai WHERE kode_nilai='$kode_nilai'";
    return $this->db->query($sql)->num_rows();  
  }

  // ---------------- CRUD ----------------

  function tambah_nilai($data){
    return $this->db->insert('nilai', $data);
  }

  function delete_nilai($kode_nilai){
    return $this->db->delete('nilai', array('kode_nilai' => $kode_nilai));
  }

  function update_nilai($kode_nilai, $nama_nilai){
    $this->db->where('kode_nilai', $kode_nilai);
    return $this->db->update('nilai', array('nama_nilai' => $nama_nilai));
  }

  function slc_siswa(){
    return $this->db->get('siswa');
  }

  function insert_nilai($kode_siswa, $kode_nilai){
    $data = array('kode_siswa' => $kode_siswa,
                  'kode_nilai' => $kode_nilai);
  }

 

}

?>