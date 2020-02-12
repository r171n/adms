<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')=="") {
			redirect('login');
		}
		//cek akses
		// $this->load->model('menu_model');
		// if ( $this->menu_model->akses('verifikasi') != 1){
		// 	redirect('dashboard');
		// }
	}
	public function index()
	{
		$data = array(
				'namepage' => 'Dashboard'
		);
		$this->template->render('welcome_message',$data);
	}
}
