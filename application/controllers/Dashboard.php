<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_nama')=="") {
			redirect('auth');
		}
	}
	public function index()
	{
		$data = array(
				'namepage' => 'Dashboard'
		);
		$this->template->render('welcome_message',$data);
	}
}
