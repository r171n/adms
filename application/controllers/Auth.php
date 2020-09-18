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
}
