<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth'));
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		
		$this->load->view('dashboard');
	}
}
