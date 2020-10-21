<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_a_kelas extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function load_data_kelas(){
    $sql = "SELECT * FROM kelas";
    return $this->db->query($sql)->result();
  }

  function cek_kode_kelas($kode_kelas){
    $sql = "SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->num_rows();  
  }

  // ---------------- CRUD ----------------

  function tambah_kelas($data){
    return $this->db->insert('kelas', $data);
  }

  function delete_kelas($kode_kelas){
    return $this->db->delete('kelas', array('kode_kelas' => $kode_kelas));
  }

  function update_kelas($kode_kelas, $nama_kelas){
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->update('kelas', array('nama_kelas' => $nama_kelas));
  }

  // --------------- Aksi next ---------------

  function slc_mapel($kode_kelas){
    $sql = "SELECT * FROM mapel WHERE kode_mapel NOT IN (SELECT kode_mapel FROM has_kelas WHERE kode_kelas='$kode_kelas')";
    return $this->db->query($sql)->result();
  }

  function slc_siswa($kode_kelas){
    $sql = "SELECT * FROM siswa WHERE kode_kelas IS NULL";
    return $this->db->query($sql)->result();   
  }

  function slc_nilai($kode_kelas){
    $sql = "SELECT * FROM nilai WHERE kode_nilai NOT IN (SELECT kode_nilai FROM has_nilai WHERE kode_kelas='$kode_kelas')";
    return $this->db->query($sql)->result();   
  }

  // --------

  function slc_mapel_aktif($kode_kelas){
    $sql = "SELECT * FROM mapel WHERE kode_mapel IN (SELECT kode_mapel FROM has_kelas WHERE kode_kelas='$kode_kelas')";
    return $this->db->query($sql)->result();
  }

  function slc_data_mapel_aktif($arr, $kode_kelas){
    $ids = join("','", $arr);
    $sql = "SELECT * FROM has_kelas JOIN mapel ON has_kelas.kode_mapel=mapel.kode_mapel WHERE has_kelas.kode_mapel IN ('$ids') AND has_kelas.kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->result();  
  }

  // -----------

  function slc_siswa_aktif($kode_kelas){
    $sql = "SELECT * FROM siswa WHERE kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->result();
  }

  function slc_nilai_aktif($kode_kelas){
    $sql = "SELECT * FROM nilai WHERE kode_nilai IN (SELECT kode_nilai FROM has_nilai WHERE kode_kelas='$kode_kelas')";
    return $this->db->query($sql)->result();
  }

  function tmb_mapel_aktif($kode_mapel, $kode_kelas){
    return $this->db->insert('has_kelas', array('kode_mapel' => $kode_mapel, 'kode_kelas' => $kode_kelas));
  }

  function tmb_siswa_aktif($kode_siswa, $kode_kelas){
    $this->db->where('kode_siswa', $kode_siswa);
    return $this->db->update('siswa', array('kode_kelas' => $kode_kelas));
  }

  function tmb_nilai_aktif($kode_nilai, $kode_kelas){
    return $this->db->insert('has_nilai', array('kode_nilai' => $kode_nilai, 'kode_kelas' => $kode_kelas));
  }



  // ----------- Tmb guru in mapel -----------
  function load_data_guru_in_mapel($kode_mapel){
    $sql = "SELECT * FROM guru WHERE kode_mapel='$kode_mapel'";
    return $this->db->query($sql)->result();
  }

  function load_data_guru_in_mapel_p($kode_mapel, $kode_kelas){
    $sql = "SELECT kode_guru FROM has_kelas WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas'";
    return $this->db->query($sql)->result();  
  }

  function update_data_kelas_guru_in_mapel($kode_guru, $nama_guru, $kode_mapel, $kode_kelas){
    $this->db->where('kode_mapel', $kode_mapel);
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->update('has_kelas', array('kode_guru' => $kode_guru, 'nama_guru' => $nama_guru));
  }


  // -------- Modal delete in kelas --------

  function delete_mapel_in_kelas($kode_kelas, $kode_mapel){
    return $this->db->delete('has_kelas', array('kode_kelas' => $kode_kelas, 'kode_mapel' => $kode_mapel));
  }
 

}

?>