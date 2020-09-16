<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_nama') == "") {
			redirect('auth');
		}
		$this->load->model('menu_model');
	}

	public function index()
	{
		//cek akses
		if ($this->menu_model->akses('siswa') != 1) {
			redirect('dashboard');
		}
		$data = array(
			'namepage' => 'Users'
		);
		$this->template->render('welcome_message', $data);
	}

	public function biodata()
	{
		//cek akses
		if ($this->menu_model->akses('siswa/biodata') != 1) {
			redirect('dashboard');
		}
		if ($this->session->userdata('user_type') == 2) {
			$agama = $this->db->get('app_agama');
			$tempattinggal = $this->db->get('app_tempattinggal');
			$transportasi = $this->db->get('app_transportasi');


			//akun siswa
			$data = array(
				'namepage' => 'Biodata',
				'agama' => $agama,
				'tempattinggal' => $tempattinggal,
				'transportasi' => $transportasi,
			);
			$this->template->render('siswa_biodata', $data);
		} else {
			$data = array(
				'namepage' => 'Biodata Siswa'
			);
			$this->template->render('untuk bukan siswa', $data);
		}
	}
}
