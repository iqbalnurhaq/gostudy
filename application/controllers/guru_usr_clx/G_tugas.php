<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G_tugas extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		$this->load->helper('create_random_helper');
		$this->load->model('M_g_tugas');
       
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
		$nama_tugas = $this->input->post("nama_tugas$nama_tugas");

		$tgl_aktif = $this->input->post("tgl_aktif");

		$tgl_akt1 = substr($tgl_aktif, 6, 4);
		$tgl_akt2 = substr($tgl_aktif, 3, 2);
		$tgl_akt3= substr($tgl_aktif, 0, 2);
		$wkt_aktif = substr($tgl_aktif, 11, 9);
		
		$tgl_akh1 = substr($tgl_aktif, 29, 4);
		$tgl_akh2 = substr($tgl_aktif, 26, 2);
		$tgl_akh3= substr($tgl_aktif, 23, 2);
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
					'kode_mapel' => $this->session->userdata('kode_mapel'),
					'kode_kelas' => $this->session->userdata('kode_kelas'),
					'status' => 1
				);

				$insert_tugas = $this->M_g_tugas->insert_tugas($data_tugas);
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
        $data['nama_kelas'] = $this->db->query("SELECT nama_kelas FROM kelas WHERE kode_kelas='$kode_kelas'")->row_array()['nama_kelas']; 
		$data['data_tugas'] = $this->M_g_tugas->load_detail_tugas($kode_tugas);
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



}
