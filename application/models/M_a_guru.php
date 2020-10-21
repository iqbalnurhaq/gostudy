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
  function update_has_kelas($kode_mapel, $kode_guru){
    $this->db->where('kode_guru', $kode_guru);
    return $this->db->update('has_kelas', array('kode_guru' => null, 'nama_guru' => null));
  }


  function get_guru_edit($kode_guru){
    
    // $this->db->where('kode_guru', $kode_guru);
    return $this->db->query("SELECT * FROM guru WHERE kode_guru='$kode_guru'")->row_array();
  }

  function update_guru($data, $kode_guru){
    $this->db->where('kode_guru', $kode_guru);
    return $this->db->update('guru', $data);
  }

  function update_has_kelas_nama($data, $kode_guru){
     $this->db->where('kode_guru', $kode_guru);
    return $this->db->update('has_kelas', $data);
  }

  //-------------- Imporrt Excel ------------

  public function upload_file($filename){
    $this->load->library('upload'); // Load librari upload
    $config['upload_path'] = './excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = $filename;
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data

  public function insert_multiple($data){
    $this->db->insert_batch('guru', $data);
  }

  public function insert_multiple_user($data){
    $this->db->insert_batch('users', $data);
  }

}

?>