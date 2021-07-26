<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
  	}

	public function index()
	{
        session_destroy();
        redirect("go_ciclx_usradmin/login");
    }
    
    
	



}
