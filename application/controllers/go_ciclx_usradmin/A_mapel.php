<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_mapel extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_mapel');
  	}

	public function index()
	{
        $this->load->view('admin/header');
        $this->load->view('admin/mapel/v_mapel');
        
        
    }
    
    function data_mapel(){
        $arr = [];
        $dataMapel = $this->M_a_mapel->load_data_mapel();
        foreach ($dataMapel as $val) {
            $arr[$val->kode_mapel] = $val->nama_mapel;
        }
    	$output['dataMapel'] = $arr;
    	echo json_encode($output);
    }

    function load_data_mapel(){
        $sql = "SELECT * FROM mapel";
        $output['datamapel'] = $this->db->query($sql)->result();
    	echo json_encode($output);
    }

    function tmb_mapel(){
		$r = 0;
        while ($r == 0 ) {
            $kode_mapel = helper_kodemapel();
            $cek_kode_mapel = $this->M_a_mapel->cek_kode_mapel($kode_mapel);
            if ($cek_kode_mapel == 0) {
                $datamapel = array('kode_mapel' => $kode_mapel,
                'nama_mapel' => $this->input->post('nama_mapel'));
                $insert_mapel = $this->M_a_mapel->tambah_mapel($datamapel);
                if ($insert_mapel) {
                    $r += 1;
                    $output['status'] = 'success';
    	            echo json_encode($output);
                }
            }else{
                $r += 0;
            }
        }
				
		
		
    }

    function hapus_mapel(){
		$kode_mapel = $this->input->post('id');
		$del = $this->M_a_mapel->delete_mapel($kode_mapel);
		if ($del) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }
    
    function edit_mapel(){
        $kode_mapel = $this->input->post('kode_mapel');
        $nama_mapel = $this->input->post('nama_mapel');
        $update = $this->M_a_mapel->update_mapel($kode_mapel, $nama_mapel);
		if ($update) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }


}
