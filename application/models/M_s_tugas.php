<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_s_tugas extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  function get_data_tugas($kode_mapel, $kode_kelas){
    $this->db->where('kode_mapel', $kode_mapel);
    $this->db->where('kode_kelas', $kode_kelas);
    $this->db->order_by('tgl_dibuat', 'DESC');
    return $this->db->get('tugas')->result();
  }

  function load_detail_tugas($kode_tugas){
    $this->db->where('kode_tugas', $kode_tugas);
    return $this->db->get('tugas')->result();  
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



}

?>