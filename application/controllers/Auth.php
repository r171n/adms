<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		$data = array(
			'namepage' => "Login"
		);
		$this->load->view('login', $data);
	}

	protected function _verify_credentials($user_nama, $user_password)
	{
		$condition = [
			'user_nama' => $user_nama,
		];

		$result = $this->db->from('users')
			->where($condition)->get();
		if ($result->num_rows() === 1) {
			$user = $result->row_array();
			if (password_verify($user_password, $user['user_password'])) {
				unset($user['user_password']);
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function login()
	{
		if ($this->session->userdata('user_nama') != "") {
			redirect('dashboard');
		}
		$user_nama = $this->input->post('user_nama');
		$user_password = $this->input->post('user_password');
		if ($this->_verify_credentials($user_nama, $user_password) == true) {
			$condition = [
				'user_nama' => $user_nama,
			];

			$result = $this->db->from('users')
				->where($condition)->get();
			$user = $result->row_array();
			$dt = array(
				'user_nama'  => $user['user_nama'],
				'user_email'  => $user['user_email'],
				'user_id'  => $user['user_id'],
				'user_type'  => $user['user_type'],
				'logged_in' => TRUE
			);
			$lastlogin = array(
				'user_lastlogin' => date("Y-m-d H:m:s", time())
			);
			$this->db->update("users", $lastlogin, array('user_id' => $user['user_id']));
			$this->session->set_userdata($dt);
			redirect('dashboard');
		} else {
			$data = array(
				'namepage' => "Login ADMS | "
			);
			$this->session->set_flashdata('login_error', 'Username atau Password Salah');
			$this->load->view('login', $data);
		}
	}

	public function logout()
	{
		session_destroy();
		redirect('auth');
	}

	public function setting()
	{
		if ($this->session->userdata('user_nama') == "") {
			redirect('auth');
		}
		$data = array(
			'js' => 'user_setting.js',
			'namepage' => 'Pengaturan Akun'
		);
		$this->template->render('user_setting', $data);
	}

	public function update()
	{
		if ($this->session->userdata('user_nama') == "") {
			redirect('auth');
		}
		$user_nama = $this->session->userdata('user_nama');
		$user_password = $this->input->post('user_password');
		$password_baru = $this->input->post('password_baru');


		if ($this->_verify_credentials($user_nama, $user_password) == true) {
			//echo "oke";
			$dt = array(
				'user_password' => password_hash($password_baru, PASSWORD_DEFAULT)
			);
			$this->db->update("users", $dt, array('user_id' => $this->session->userdata('user_id')));
			//redirect('dashboard');
			$data = array(
				'js' => 'user_setting.js',
				'namepage' => 'Pengaturan Akun'
			);
			$this->session->set_flashdata('success', 'Password Berhasil Diperbarui');
			redirect('auth/setting');
		} else {
			$data = array(
				'js' => 'user_setting.js',
				'namepage' => 'Pengaturan Akun'
			);
			$this->session->set_flashdata('msg_error', 'Password Lama Salah!');
			redirect('auth/setting');
		}
	}
}
