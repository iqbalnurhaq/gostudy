<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_g_tugas extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function insert_tugas($data, $kode_kelas, $kode_mapel){
    $siswa = $this->db->query("SELECT * FROM siswa WHERE kode_kelas='$kode_kelas'")->result();
    $notif = array();
    foreach ($siswa as $val) {
      array_push($notif, array(
        'kode_siswa' => $val->kode_siswa,
        'kode_kelas' => $kode_kelas,
        'kode_notif' => 2,
        'kode_mapel' => $kode_mapel
      ));
    }
    $this->db->insert_batch('has_notif', $notif);
    return $this->db->insert('tugas', $data);
  }

  function cek_kode_tugas(){
    $this->db->where('kode_kelas', $kode_kelas);
    return $this->db->get('tugas')->num_rows();  
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

  function save_deskripsi($desc, $kode_tugas){
    $this->db->where('kode_tugas', $kode_tugas);
    return $this->db->update('tugas', array('deskripsi' => $desc));
  }

  function daftar_siswa($kode_kelas, $kode_tugas){
    return$this->db->query("SELECT *, siswa.kode_siswa FROM siswa LEFT JOIN nilai_tugas ON siswa.kode_siswa=nilai_tugas.kode_siswa AND nilai_tugas.kode_tugas='$kode_tugas' WHERE siswa.kode_kelas='$kode_kelas' ORDER BY siswa.nis ASC")->result();
  }

  function load_hasil_siswa($kode_tugas){
    $sql = "SELECT * FROM has_upload JOIN upload_tugas JOIN siswa ON has_upload.id_file=upload_tugas.id AND has_upload.kode_siswa=siswa.kode_siswa WHERE has_upload.kode_tugas='$kode_tugas'";
    return $this->db->query($sql)->result();
  }

  function hasil_tugas_siswa($kode_siswa, $kode_tugas){
    $sql = "SELECT * FROM upload_tugas JOIN has_upload ON upload_tugas.id=has_upload.id_file WHERE has_upload.kode_siswa='$kode_siswa' AND has_upload.kode_tugas='$kode_tugas'";
    return $this->db->query($sql)->result();
  }

  function cek_nilai_tugas($kode_siswa, $kode_tugas){
    $this->db->where('kode_siswa', $kode_siswa);
    $this->db->where('kode_tugas', $kode_tugas);
    return $this->db->get('nilai_tugas')->num_rows();
  }

  function insert_nilai_tugas($nilai, $kode_siswa, $kode_tugas){
    $ins = array('nilai' => $nilai,
                'kode_siswa' => $kode_siswa,
                'kode_tugas' => $kode_tugas);
    return $this->db->insert('nilai_tugas', $ins);
  }
  
  function update_nilai_tugas($nilai, $kode_siswa, $kode_tugas){
      $this->db->where('kode_siswa', $kode_siswa);
      $this->db->where('kode_tugas', $kode_tugas);
      return $this->db->update('nilai_tugas', array('nilai' => $nilai));
  }
  function cek_backup($kode_tugas){
    $sql = "SELECT * FROM nilai_tugas WHERE kode_tugas='$kode_tugas' AND kode_nilai=null";
    return $this->db->query($sql)->num_rows();
  }
  function get_nilai_tugas_siswa($kode_tugas){
    $this->db->where('kode_tugas', $kode_tugas);
    return $this->db->get('nilai_tugas')->result();
  }





}

?>