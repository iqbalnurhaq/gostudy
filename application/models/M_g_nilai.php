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

  function data_nilai_siswa($kode_kelas, $kode_mapel){
    $sql = "SELECT *, nilai.kode_nilai FROM nilai JOIN has_nilai JOIN has_kelas ON nilai.kode_nilai=has_nilai.kode_nilai AND has_nilai.kode_kelas=has_kelas.kode_kelas WHERE has_nilai.kode_kelas='$kode_kelas' AND has_kelas.kode_mapel='$kode_mapel' ORDER BY nilai.nama_nilai";
    return $this->db->query($sql)->result();
  }

  function nilai_siswa($kode_kelas, $kode_nilai, $kode_mapel){
    $sql = "SELECT *, siswa.kode_siswa FROM siswa LEFT JOIN nilai_siswa ON siswa.kode_siswa=nilai_siswa.kode_siswa AND nilai_siswa.kode_nilai='$kode_nilai' AND nilai_siswa.kode_mapel='$kode_mapel' WHERE siswa.kode_kelas='$kode_kelas' ORDER BY siswa.nis";
    return $this->db->query($sql)->result();
  }

  function cek_nilai($kode_siswa, $kode_nilai, $kode_mapel){
    $this->db->where('kode_siswa', $kode_siswa);
    $this->db->where('kode_nilai', $kode_nilai);
    $this->db->where('kode_mapel', $kode_mapel);
    return $this->db->get('nilai_siswa')->num_rows();
  }

  function insert_nilai($nilai, $kode_siswa, $kode_nilai, $kode_guru, $kode_mapel, $kode_kelas){
    $ins = array('nilai' => $nilai,
                'kode_siswa' => $kode_siswa,
                'kode_nilai' => $kode_nilai,
                'kode_guru' => $kode_guru,
                'kode_mapel' => $kode_mapel);
    $this->db->insert('has_notif', array('kode_siswa' => $kode_siswa, 'kode_notif' => 4, 'kode_kelas' => $kode_kelas));
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

  // ------------- Import Excel -------------------
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
    $this->db->insert_batch('nilai_siswa', $data);
  }

  function get_data_nilai($kode_kelas, $kode_nilai){
    $sql = "SELECT * FROM siswa JOIN nilai_siswa ON siswa.kode_siswa=nilai_siswa.kode_siswa WHERE siswa.kode_kelas='$kode_kelas' AND nilai_siswa.kode_nilai='$kode_nilai' ORDER BY siswa.nis";
    return $this->db->query($sql)->result();
  }

  



}

?>