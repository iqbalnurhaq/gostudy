<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_tugas extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		$cek = $this->session->userdata('login');
		if ($cek == 'usr_guru') {
			true;
		}else{
			redirect('Login');
		}
		$this->load->helper('create_random_helper');
		$this->load->model('M_g_tugas');
		$this->load->model('M_g_ujian');
    }


	public function index()
	{
        $kode_kelas = $this->session->userdata('kode_kelas');
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
        $this->load->view('guru/header', $data);
        $this->load->view('guru/tugas/v_tugas');
	}

	function ambil_data_tugas(){
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$data_tugas = $this->M_g_tugas->get_data_tugas($kode_mapel, $kode_kelas);
		$output['data_tugas'] = $data_tugas;
    	echo json_encode($output);
	}
	
	public function tambah_tugas(){
		date_default_timezone_set("Asia/Jakarta");
		$nama_tugas = $this->input->post("nama_tugas");
		$tipe = $this->input->post("tipe");

		$tgl_aktif = $this->input->post("tgl_aktif");

		// $tgl_akt1 = substr($tgl_aktif, 6, 4);
		// $tgl_akt2 = substr($tgl_aktif, 3, 2);
		// $tgl_akt3= substr($tgl_aktif, 0, 2);
		$wkt_aktif = substr($tgl_aktif, 11, 9);
		
		// $tgl_akh1 = substr($tgl_aktif, 29, 4);
		// $tgl_akh2 = substr($tgl_aktif, 26, 2);
		// $tgl_akh3= substr($tgl_aktif, 23, 2);
		$wkt_akhir = substr($tgl_aktif, 34, 9);
		

		$r = 0;
		while ($r == 0 ) {
			$kode_tugas = helper_kodeTugas();
			$cek_kode_tugas = $this->M_g_tugas->cek_kode_tugas($kode_tugas);
			if ($cek_kode_tugas == 0) {
				$data_tugas = array(
					'kode_tugas' => $kode_tugas,
					'nama_tugas' => $nama_tugas,
					'tgl_aktif' => substr($tgl_aktif, 0, 10),
					'wkt_aktif' => $wkt_aktif,
					'tgl_akhir' => substr($tgl_aktif, 23, 10),
					'wkt_akhir' => $wkt_akhir,
					'tipe' => $tipe,
					'kode_mapel' => $this->session->userdata('kode_mapel'),
					'kode_kelas' => $this->session->userdata('kode_kelas'),
					'status' => 1
				);

				$insert_tugas = $this->M_g_tugas->insert_tugas($data_tugas, $this->session->userdata('kode_kelas'), $this->session->userdata('kode_mapel'));
				$r += 1;
				$this->session->set_flashdata('pesan', 'sukses');
				redirect('guru_usr_clx/G_tugas');
			}else{
				$r += 0;
			}
		}

	}

	function detail_tugas(){
		$kode_tugas = $this->uri->segment(4);
		$this->session->set_userdata(array('kode_tugas' => $kode_tugas));
		$kode_kelas = $this->session->userdata('kode_kelas');

		$nilai_tugas = $this->M_g_tugas->daftar_siswa($kode_kelas, $kode_tugas);
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
		$data['data_tugas'] = $this->M_g_tugas->load_detail_tugas($kode_tugas);
		$data['daftar_siswa'] = $nilai_tugas;
		$this->load->view('guru/header', $data);
        $this->load->view('guru/tugas/v_detail_tugas', $data);
		
	}
	
	function save_desc(){
		$kode_tugas = $this->input->post('kode_tugas');
		$content = $this->input->post('content');
		$save = $this->M_g_tugas->save_deskripsi($content, $kode_tugas);
		$this->session->set_flashdata('pesan', 'sukses');
		redirect('guru_usr_clx/G_tugas/detail_tugas/'.$kode_tugas);
	}
	
	function hasil_siswa(){
		$kode_tugas = $this->uri->segment(4);
		$kode_kelas = $this->session->userdata('kode_kelas');
		$this->session->set_userdata(array('kode_tugas' => $kode_tugas));
		$daftar_siswa = $this->M_g_tugas->daftar_siswa($kode_kelas, $kode_tugas);
		$jml_siswa = $this->M_g_ujian->get_jml_siswa($kode_kelas); 
		$jml_nilai = $this->db->query("SELECT COUNT(id) AS jml FROM nilai_tugas WHERE kode_tugas='$kode_tugas'")->row_array()['jml'];
		$progress = number_format(($jml_nilai / $jml_siswa) * 100 , 2);
		$backup = $this->M_g_tugas->cek_backup($kode_tugas);

		$cek_backup = $backup / $jml_siswa;

		$data['data_tugas'] = $this->M_g_tugas->load_detail_tugas($kode_tugas);
		$data['daftar_siswa'] = $daftar_siswa; 
		$data['progress'] = $progress;
		$data['backup'] = $cek_backup;
	
		$data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
		$this->load->view('guru/header', $data);
        $this->load->view('guru/tugas/v_hasil_tugas', $data);

	}

	function load_hasil_siswa(){
		$kode_siswa = $this->input->post('kode_siswa');
		$kode_tugas = $this->session->userdata('kode_tugas');
		$hasil = $this->M_g_tugas->hasil_tugas_siswa($kode_siswa, $kode_tugas);
		$output['hasil'] = $hasil;
        echo json_encode($output);  
	}

	function input_nilai_tugas(){
		$nilai = $this->input->post('nilai');
		$kode_siswa = $this->input->post('kode_siswa');
		$kode_tugas = $this->session->userdata('kode_tugas');
		$cek = $this->M_g_tugas->cek_nilai_tugas($kode_siswa, $kode_tugas);
		if ($cek) {
			$update = $this->M_g_tugas->update_nilai_tugas($nilai, $kode_siswa, $kode_tugas);
			$output['kode_tugas'] = $kode_tugas;
			$output['pesan'] = 'success';
			echo json_encode($output);  
		} else {
			$insert_nilai = $this->M_g_tugas->insert_nilai_tugas($nilai, $kode_siswa, $kode_tugas);
			$output['kode_tugas'] = $kode_tugas;
			$output['pesan'] = 'success';
			echo json_encode($output);  
		}
		
	}

	function hapus_tugas(){
		$kode_tugas = $this->input->post("id");
		$this->db->delete('tugas', array('kode_tugas' => $kode_tugas));
		$output['pesan'] = 'success';
		echo json_encode($output);  

	}

	function aksi_backup_nilai(){
		$kode_nilai = $this->input->post('kode_nilai');
		$kode_tugas = $this->session->userdata('kode_tugas');
		$kode_mapel = $this->session->userdata('kode_mapel');
		$kode_guru = $this->session->userdata('kode_guru');
		$kode_kelas = $this->session->userdata('kode_kelas');
		$siswa = $this->M_g_tugas->get_nilai_tugas_siswa($kode_tugas);

		$data = array();
		foreach ($siswa as $val) {
			array_push($data, array(
				'kode_siswa' => $val->kode_siswa,
				'kode_guru' => $kode_guru,
				'kode_nilai' => $kode_nilai,
				'kode_mapel' => $kode_mapel,
				'nilai' => $val->nilai
			));
		}

		$this->db->insert_batch('nilai_siswa', $data);
		$this->db->query("UPDATE has_nilai SET status=1 WHERE kode_nilai='$kode_nilai' AND kode_kelas='$kode_kelas'");
		$output['pesan'] = 'sukses';
		$output['kode_tugas'] = $kode_tugas;
		echo json_encode($output);
	}

	function aksi_download(){
		$this->load->helper('download');
		$nama = $this->uri->segment(4);
    	force_download('file_upload_tugas/'.$nama, NULL);
	}



}
