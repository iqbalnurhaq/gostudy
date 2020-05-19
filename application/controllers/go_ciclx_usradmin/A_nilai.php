<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_nilai extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_nilai');
  	}

	public function index()
	{
        $this->load->view('admin/header');
        $this->load->view('admin/nilai/v_nilai');
    }
    
    function data_nilai(){
        $arr = [];
        $datanilai = $this->M_a_nilai->load_data_nilai();
        foreach ($datanilai as $val) {
            $arr[$val->kode_nilai] = $val->nama_nilai;
        }
    	$output['datanilai'] = $arr;
    	echo json_encode($output);
    }

    function load_data_nilai(){
        $sql = "SELECT * FROM nilai";
        $output['datanilai'] = $this->db->query($sql)->result();
    	echo json_encode($output);
    }

    function tmb_nilai(){
		$r = 0;
        while ($r == 0 ) {
            $kode_nilai = helper_kodenilai();
            $cek_kode_nilai = $this->M_a_nilai->cek_kode_nilai($kode_nilai);
            if ($cek_kode_nilai == 0) {
                $datanilai = array('kode_nilai' => $kode_nilai,
                'nama_nilai' => $this->input->post('nama_nilai'));

                $insert_nilai = $this->M_a_nilai->tambah_nilai($datanilai);
                if ($insert_nilai) {
                    $r += 1;
                    $output['status'] = 'success';
    	            echo json_encode($output);
                }
            }else{
                $r += 0;
            }
        }
				
		
		
    }

    function hapus_nilai(){
		$kode_nilai = $this->input->post('id');
		$del = $this->M_a_nilai->delete_nilai($kode_nilai);
		if ($del) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }
    
    function edit_nilai(){
        $kode_nilai = $this->input->post('kode_nilai');
        $nama_nilai = $this->input->post('nama_nilai');
        $update = $this->M_a_nilai->update_nilai($kode_nilai, $nama_nilai);
		if ($update) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }


}
