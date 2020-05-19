<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_a_siswa extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function cek_kode_user($kode_user){
    $sql = "SELECT * FROM users WHERE kode_user='$kode_user'";
    return $this->db->query($sql)->num_rows();
  }

  function cek_pwd_siswa($pwd_siswa){
    $sql = "SELECT * FROM users WHERE password='$pwd_siswa'";
    return $this->db->query($sql)->num_rows();
  }

  function cek_kode_siswa($kode_siswa){
    $sql = "SELECT * FROM siswa WHERE kode_siswa='$kode_siswa'";
    return $this->db->query($sql)->num_rows();  
  }

//   ------------- Tambah ------------------

  function tambah_user_siswa($data){
    return $this->db->insert('users', $data);
  }

  function tambah_siswa($data){
    return $this->db->insert('siswa', $data);
  }

//   ------------- Load ----------------

  function load_data_siswa(){
    $sql = "SELECT * FROM siswa JOIN users ON siswa.user_code=users.kode_user LEFT JOIN kelas ON siswa.kode_kelas=kelas.kode_kelas WHERE users.akses=1";
    return $this->db->query($sql)->result();
  }

  function load_data_siswa_banned(){
    $sql = "SELECT * FROM siswa JOIN users ON siswa.user_code=users.kode_user LEFT JOIN kelas ON siswa.kode_kelas=kelas.kode_kelas WHERE users.akses=2";
    return $this->db->query($sql)->result();
  }

  //----------  Update delete  ---------------------

  function delete_siswa($kode_siswa){
    return $this->db->delete('siswa', array('kode_siswa' => $kode_siswa));
  }

  function banned_siswa($kode_siswa){
    $kode_user = $this->db->query("SELECT user_code FROM siswa WHERE kode_siswa='$kode_siswa'")->row_array()['user_code'];
    $this->db->where('kode_user', $kode_user);
    return $this->db->update('users', array('akses' => 2));
  }

  function aktif_siswa($kode_siswa){
    $kode_user = $this->db->query("SELECT user_code FROM siswa WHERE kode_siswa='$kode_siswa'")->row_array()['user_code'];
    $this->db->where('kode_user', $kode_user);
    return $this->db->update('users', array('akses' => 1));
  }


}

?>