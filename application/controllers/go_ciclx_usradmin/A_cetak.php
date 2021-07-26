<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_cetak extends CI_Controller {
	private $filename = "import_data_siswa";
	public function __construct()
  	{
		parent::__construct();
		$cek = $this->session->userdata('login');
		if ($cek == 'admin') {
			true;
		}else{
			redirect('go_ciclx_usradmin/Login');
		}
		//Codeigniter : Write Less Do More
		$this->load->helper('create_random_helper');
		$this->load->model('M_a_siswa');
	}
	  
	public function index()
	{
    
        $this->load->view('admin/header');
        $this->load->view('admin/v_cetak');
		
	}

    function load_data(){
        $sql = "SELECT * FROM kode_cetak";
        $output['datakelas'] = $this->db->query($sql)->result();
    	echo json_encode($output);
    }

    function hapus(){
		$id = $this->input->post('id');
		$del = $this->db->delete('kode_cetak', array('id' => $id));
		if ($del) {
		$output['msg'] = 'success';
		echo json_encode($output);
		}
    }

    function tmb_kelas(){
       
        $datakelas = array('kode' => $this->input->post('nama_kelas'));
        $insert_kelas = $this->db->insert('kode_cetak', $datakelas);
        if ($insert_kelas) {
            $r += 1;
            $output['status'] = 'success';
            echo json_encode($output);
        }
    
		
    }
    


}
