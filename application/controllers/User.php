<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_nama')=="") {
			redirect('auth');
		}
		//cek akses
		$this->load->model('menu_model');
		if ($this->menu_model->akses('user') != 1){
			redirect('dashboard');
		}
	}

	public function index()
	{
		$data = array(
				'namepage' => 'Users'
		);
		$this->template->render('user',$data);	}

}
