<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_a_mapel extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function load_data_mapel(){
    $sql = "SELECT * FROM mapel";
    return $this->db->query($sql)->result();
  }

  function cek_kode_mapel($kode_mapel){
    $sql = "SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'";
    return $this->db->query($sql)->num_rows();  
  }

  // ---------------- CRUD ----------------

  function tambah_mapel($data){
    return $this->db->insert('mapel', $data);
  }

  function delete_mapel($kode_mapel){
    return $this->db->delete('mapel', array('kode_mapel' => $kode_mapel));
  }

  function update_mapel($kode_mapel, $nama_mapel){
    $this->db->where('kode_mapel', $kode_mapel);
    return $this->db->update('mapel', array('nama_mapel' => $nama_mapel));
  }

 

}

?>