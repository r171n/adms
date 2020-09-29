<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_nama') == "") {
			redirect('auth');
		}
		$this->load->model('menu_model');
		$this->load->model('User_model');
	}

	public function index()
	{
		//cek akses
		if ($this->menu_model->akses('user') != 1) {
			redirect('dashboard');
		}
		$data = array(
			'namepage' => 'Akun'
		);
		$this->template->render('welcome_message', $data);
	}

	public function list()
	{
		//cek akses
		if ($this->menu_model->akses('user/list') != 1) {
			redirect('dashboard');
		}
		$data = array(
			'namepage' => 'Daftar Akun'
		);
		$this->template->render('user_list', $data);
	}

	function get_data_user()
	{
		if ($this->menu_model->akses('user/list') != 1) {
			redirect('dashboard');
		}
		$list = $this->User_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->user_nama;
			$row[] = $field->user_email;

			if ($field->user_type == 0) {
				$row[] = "Admin";
			} elseif ($field->user_type == 1) {
				$row[] = "Guru";
			} else {
				$row[] = "Siswa";
			}
			$row[] = $field->user_lastlogin;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_akun(' . "'" . $field->user_id . "'" . ')">Edit</a>
						<a class="btn btn-sm btn-success" href="javascript:void()" title="Group" onclick="edit_group(' . "'" . $field->user_id . "'" . ')">Group</a>
            			<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_akun(' . "'" . $field->user_id . "'" . ')">Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->User_model->count_all(),
			"recordsFiltered" => $this->User_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function get_data_edit($id)
	{
		if ($this->menu_model->akses('user/list') != 1) {
			redirect('dashboard');
		}
		$user = $this->User_model;
		$data = $user->getById($id);
		echo json_encode($data->row());
	}

	public function save()
	{
		//cek akses
		if ($this->menu_model->akses('user/list') != 1) {
			redirect('dashboard');
		}
		$user = $this->User_model;
		$post = $this->input->post();
		$data["user"] = $user->getByUsername($post["user_nama"]);

		if ($data["user"]->num_rows() == 0) {
			$user->save();
			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array("status" => FALSE));
		}
	}

	public function update()
	{
		//cek akses
		if ($this->menu_model->akses('user/list') != 1) {
			redirect('dashboard');
		}
		$user = $this->User_model;
		$post = $this->input->post();
		//$data["user"] = $user->getByUsername($post["user_nama"]);
		$data["id"] = $user->getById($post["user_id"]);
		// if ($data["user"]->num_rows() == 0) {
		if ($data["id"]->num_rows() != 0) {
			$user->update();
			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array("status" => FALSE));
		}
		// } else {
		// 	echo json_encode(array("status" => FALSE));
		// }
	}
}
