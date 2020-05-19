<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_a_guru extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function cek_kode_user($kode_user){
    $sql = "SELECT * FROM users WHERE kode_user='$kode_user'";
    return $this->db->query($sql)->num_rows();
  }

  function cek_pwd_guru($pwd_guru){
    $sql = "SELECT * FROM users WHERE password='$pwd_guru'";
    return $this->db->query($sql)->num_rows();
  }

  function cek_kode_guru($kode_guru){
    $sql = "SELECT * FROM guru WHERE kode_guru='$kode_guru'";
    return $this->db->query($sql)->num_rows();  
  }

  function tambah_user_guru($data){
    return $this->db->insert('users', $data);
  }

  function tambah_guru($data){
    return $this->db->insert('guru', $data);
  }

  function load_data_guru(){
    $sql = "SELECT * FROM guru JOIN users ON guru.user_code=users.kode_user LEFT JOIN mapel ON guru.kode_mapel=mapel.kode_mapel WHERE users.akses=1";
    return $this->db->query($sql)->result();
  }

  function load_data_guru_banned(){
    $sql = "SELECT * FROM guru JOIN users ON guru.user_code=users.kode_user LEFT JOIN mapel ON guru.kode_mapel=mapel.kode_mapel WHERE users.akses=2";
    return $this->db->query($sql)->result();
  }

  function delete_guru($kode_guru){
    return $this->db->delete('guru', array('kode_guru' => $kode_guru));
  }

  function banned_guru($kode_guru){
    $kode_user = $this->db->query("SELECT user_code FROM guru WHERE kode_guru='$kode_guru'")->row_array()['user_code'];
    $this->db->where('kode_user', $kode_user);
    return $this->db->update('users', array('akses' => 2));
  }

  function aktif_guru($kode_guru){
    $kode_user = $this->db->query("SELECT user_code FROM guru WHERE kode_guru='$kode_guru'")->row_array()['user_code'];
    $this->db->where('kode_user', $kode_user);
    return $this->db->update('users', array('akses' => 1));
  }

  function update_guru_pengampu($kode_mapel, $kode_guru){
    $this->db->where('kode_guru', $kode_guru);
    return $this->db->update('guru', array('kode_mapel' => $kode_mapel));
  }


}

?>