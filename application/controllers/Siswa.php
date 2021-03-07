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
		$this->load->model('siswa_model');
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
			$siswa = $this->siswa_model;
			$agama = $this->db->get('app_agama');
			$tempattinggal = $this->db->get('app_tempattinggal');
			$transportasi = $this->db->get('app_transportasi');
			$pendidikan = $this->db->get('app_pendidikan');
			$pekerjaan = $this->db->get('app_pekerjaan');
			$penghasilan = $this->db->get('app_penghasilan');
			//akun siswa
			$data = array(
				'namepage' => 'Biodata',
				'agama' => $agama,
				'tempattinggal' => $tempattinggal,
				'transportasi' => $transportasi,
				'pendidikan' => $pendidikan,
				'pekerjaan' => $pekerjaan,
				'penghasilan' => $penghasilan,
				'siswa' => $siswa->getById($this->session->userdata('user_id'))
			);
			$this->template->render('siswa_biodata', $data);
		} else {
			$data = array(
				'namepage' => 'Biodata Siswa'
			);
			$this->template->render('untuk bukan siswa', $data);
		}
	}

	public function biodatasave()
	{
		//cek akses
		if ($this->menu_model->akses('siswa/biodata') != 1) {
			redirect('dashboard');
		}
		if ($this->session->userdata('user_type') == 2) {
			//sebagai siswa
			$siswa = $this->siswa_model;
			$data["siswa"] = $siswa->getById($this->session->userdata('user_id'));

			if ($data["siswa"]->num_rows() == 0) {
				$siswa->save();
				$post = $this->input->post();
				$user_id = $this->session->userdata('user_id');
				$this->user_email = $post["siswa_nama"];
				$this->db->update("users", $this, array('user_id' => $user_id));
				$this->session->set_flashdata('success', 'Berhasil Disimpan');
			} else {
				$siswa->update();
				$post = $this->input->post();
				$user_id = $this->session->userdata('user_id');
				$this->user_email = $post["siswa_nama"];
				$this->db->update("users", $this, array('user_id' => $user_id));
				$this->session->set_flashdata('success', 'Berhasil Diperbarui');
			}

			redirect('siswa/biodata');
		} else {
			$siswa = $this->siswa_model;
			$data["siswa"] = $siswa->getById($this->input->post('siswa_id'));

			if ($data["siswa"]->num_rows() == 0) {
				$siswa->save();
				$post = $this->input->post();
				$user_id = $this->input->post('siswa_id');
				$this->user_email = $post["siswa_nama"];
				$this->db->update("users", $this, array('user_id' => $user_id));
				echo json_encode(array("status" => TRUE));
			} else {
				$siswa->update();
				$post = $this->input->post();
				$user_id = $this->input->post('siswa_id');
				$this->user_email = $post["siswa_nama"];
				$this->db->update("users", $this, array('user_id' => $user_id));
				echo json_encode(array("status" => TRUE));
			}
		}
	}
}
