<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_g_tugas extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function insert_tugas($data){
    return $this->db->insert('tugas', $data);
  }

  function cek_kode_tugas(){
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('tugas')->num_rows();  
  }

  function get_data_tugas($kode_mapel, $kode_kelas){
    $this->db->where('kode_mapel', $kode_mapel);
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('tugas')->result();
  }

  function load_detail_tugas($kode_tugas){
    $this->db->where('kode_tugas', $kode_tugas);
    return $this->db->get('tugas')->result();  
  }

  function save_deskripsi($desc, $kode_tugas){
    $this->db->where('kode_tugas', $kode_tugas);
    return $this->db->update('tugas', array('deskripsi' => $desc));
  }





}

?>