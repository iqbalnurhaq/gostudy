<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_g_siswa extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  
  function get_data_siswa($kode_kelas){
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('siswa')->result();
  }



}

?>