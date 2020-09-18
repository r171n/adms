<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_nama') == "") {
			redirect('auth');
		}
		$this->load->model('menu_model');
		$this->load->model('config_model');
	}

	public function index()
	{
		//cek akses
		if ($this->menu_model->akses('config') != 1) {
			redirect('dashboard');
		}
		$data = array(
			'namepage' => 'Users'
		);
		$this->template->render('welcome_message', $data);
	}

	public function identitas()
	{
		//cek akses
		if ($this->menu_model->akses('config/identitas') != 1) {
			redirect('dashboard');
		}
		if ($this->session->userdata('user_type') != 2) {
			$config = $this->config_model;
			$data = array(
				'namepage' => 'Identitas Sekolah',
				'data' => $config->getById(1)
			);
			$this->template->render('config_identitas', $data);
		} else {
			$data = array(
				'namepage' => 'Biodata Siswa'
			);
			$this->template->render('untuk bukan siswa', $data);
		}
	}

	public function identitassave()
	{
		//cek akses
		if ($this->menu_model->akses('config/identitas') != 1) {
			redirect('dashboard');
		}
		if ($this->session->userdata('user_type') != 2) {
			//sebagai siswa
			$config = $this->config_model;
			$data["config"] = $config->getById(1);

			if ($data["config"]->num_rows() == 0) {
				$config->save();
				$this->session->set_flashdata('success', 'Berhasil disimpan');
			} else {
				$config->update();
			}

			redirect('config/identitas');
		} else {
			$data = array(
				'namepage' => 'Biodata Siswa'
			);
			$this->template->render('untuk bukan siswa', $data);
		}
	}
}
