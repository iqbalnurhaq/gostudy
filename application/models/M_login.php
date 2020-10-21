<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function cek_user($user, $pass){
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";  
    return $this->db->query($sql)->num_rows();    
  }

  function kode_user($user, $pass){
    $sql = "SELECT kode_user FROM users WHERE username='$user' AND password='$pass'";  
    return $this->db->query($sql)->row_array();        
  }

  function cek_status($kode_user){
    $sql = "SELECT akses FROM users WHERE kode_user='$kode_user'";  
    return $this->db->query($sql)->row_array();        
  }

  function cek_lvl($kode_user){
    $sql = "SELECT lvl_usr FROM users WHERE kode_user='$kode_user'";  
    return $this->db->query($sql)->row_array();        
  }

  function ambil_data_guru($kode_user){
    $sql = "SELECT * FROM guru WHERE user_code='$kode_user'";
    return $this->db->query($sql)->row_array();
  }

  function ambil_data_siswa($kode_user){
    $sql = "SELECT * FROM siswa WHERE user_code='$kode_user'";
    return $this->db->query($sql)->row_array();
  }


}

?>