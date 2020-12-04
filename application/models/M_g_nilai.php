<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_g_nilai extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  
  function data_siswa($kode_kelas){
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('siswa')->result();
  }

  function data_nilai_siswa($kode_kelas){
    $sql = "SELECT *, nilai.kode_nilai FROM nilai JOIN has_nilai ON nilai.kode_nilai=has_nilai.kode_nilai WHERE has_nilai.kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->result();
  }

  function nilai_siswa($kode_kelas){
    $sql = "SELECT *, siswa.kode_siswa FROM siswa LEFT JOIN nilai_siswa ON siswa.kode_siswa=nilai_siswa.kode_siswa WHERE siswa.kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->result();
  }

  function cek_nilai($kode_siswa, $kode_nilai, $kode_mapel){
    $this->db->where('kode_siswa', $kode_siswa);
    $this->db->where('kode_nilai', $kode_nilai);
    $this->db->where('kode_mapel', $kode_mapel);
    return $this->db->get('nilai_siswa')->num_rows();
  }

  function insert_nilai($nilai, $kode_siswa, $kode_nilai, $kode_guru, $kode_mapel){
    $ins = array('nilai' => $nilai,
                'kode_siswa' => $kode_siswa,
                'kode_nilai' => $kode_nilai,
                'kode_guru' => $kode_guru,
                'kode_mapel' => $kode_mapel);
    return $this->db->insert('nilai_siswa', $ins);
  }
  
  function update_nilai($nilai, $kode_siswa, $kode_nilai, $kode_guru, $kode_mapel){
      $this->db->where('kode_siswa', $kode_siswa);
      $this->db->where('kode_nilai', $kode_nilai);
      $this->db->where('kode_mapel', $kode_mapel);
      return $this->db->update('nilai_siswa', array('nilai' => $nilai));
  }

  function open_nilai($kode_nilai, $kode_kelas){
    $this->db->where('kode_nilai', $kode_nilai);
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->update('has_nilai', array('status' => 1));
  }

  function clear_nilai($kode_nilai, $kode_kelas){
    $this->db->where('kode_nilai', $kode_nilai);
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->update('has_nilai', array('status' => 0));
  }

  function delete_nilai($kode_nilai, $kode_kelas){
    $sql = "DELETE nilai_siswa FROM nilai_siswa INNER JOIN siswa ON nilai_siswa.kode_siswa=siswa.kode_siswa WHERE siswa.kode_kelas='$kode_kelas' AND nilai_siswa.kode_nilai='$kode_nilai'";
    return $this->db->query($sql);
  }

  



}

?>