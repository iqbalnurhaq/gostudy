<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_g_materi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function upload_file_materi($data){
    return $this->db->insert('materi', $data);
  }

  function get_data_materi($kode_mapel, $kode_kelas){
    $this->db->where('kode_mapel', $kode_mapel);
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('materi')->result();
  }



}

?>