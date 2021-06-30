<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kurikulum extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_nama') == "") {
			redirect('auth');
		}
		$this->load->model('menu_model');
		$this->load->model('mata_pelajaran_model');
		//$this->load->model('siswa_model');
	}

	public function index()
	{
		//cek akses
		if ($this->menu_model->akses('kurikulum') != 1) {
			redirect('dashboard');
		}
		$data = array(
			'namepage' => 'Kurikulum'
		);
		$this->template->render('kurikulum_mata_pelajaran_list', $data);
	}

	public function matapelajaran()
	{
		//cek akses
		if ($this->menu_model->akses('kurikulum/matapelajaran') != 1) {
			redirect('dashboard');
		}
		$matapelajaran = $this->db->get('ms_mata_pelajaran');
		$tingkat = $this->db->get('ms_tingkat');

		$data = array(
			'namepage' => 'Daftar Mata Pelajaran',
			'js' => 'kurikulum_matapelajaran.js',
			'matapelajaran' => $matapelajaran,
			'tingkat' => $tingkat,
		);
		$this->template->render('kurikulum_mata_pelajaran_list', $data);
	}

	function get_data_mata_pelajaran()
	{
		if ($this->menu_model->akses('kurikulum/matapelajaran') != 1) {
			redirect('dashboard');
		}
		$list = $this->mata_pelajaran_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->mata_pelajaran_nama;
			$row[] = $field->mata_pelajaran_kode;
			$row[] = $field->tingkat_nama;
			$row[] = $field->mata_pelajaran_kkm;
			$row[] = '<a class="btn btn-sm bg-blue bg-accent-2 white" href="javascript:void()" title="Edit" onclick="edit(' . "'" . $field->mata_pelajaran_id . "'" . ')">Edit</a>
						<a class="btn btn-sm bg-red bg-darken-1 white" href="javascript:void()" title="Delete Mata Pelajaran" onclick="delete_mata_pelajaran(' . "'" . $field->mata_pelajaran_id . "'," . '' . "'" . $field->mata_pelajaran_nama . "'" . ')">Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mata_pelajaran_model->count_all(),
			"recordsFiltered" => $this->mata_pelajaran_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function matapelajaransave()
	{
		//cek akses
		if ($this->menu_model->akses('kurikulum/matapelajaran') != 1) {
			redirect('dashboard');
		}
		$post = $this->input->post();;
		if ($post["mata_pelajaran_nama"] == "") {
			$this->json['status'] = false;
			$this->json['msg'] = "Semua Form Wajib Di Isi";
			echo json_encode($this->json);
		} else {
			$mata_pelajaran = $this->mata_pelajaran_model;

			if ($mata_pelajaran->getBykode($post["mata_pelajaran_kode"])->num_rows() == 0) {
				$mata_pelajaran->save();
				$this->json['status'] = TRUE;
				$this->json['msg'] = "Data Berhasil Diperbarui!";
				echo json_encode($this->json);
			} else {
				$this->json['status'] = false;
				$this->json['msg'] = "Kode Pelajaran Sudah Digunakan!";
				echo json_encode($this->json);
			}
		}
	}

	public function matapelajaranupdate()
	{
		//cek akses
		if ($this->menu_model->akses('kurikulum/matapelajaran') != 1) {
			redirect('dashboard');
		}
		$post = $this->input->post();;
		if ($post["mata_pelajaran_nama"] == "") {
			$this->json['status'] = false;
			$this->json['msg'] = "Semua Form Wajib Di Isi";
			echo json_encode($this->json);
		} else {
			$mata_pelajaran = $this->mata_pelajaran_model;

			if ($mata_pelajaran->getBykodenId($post["mata_pelajaran_kode"],$post["mata_pelajaran_id"])->num_rows() == 0) {
				$mata_pelajaran->update();
				$this->json['status'] = TRUE;
				$this->json['msg'] = "Data Berhasil Diperbarui!";
				echo json_encode($this->json);
			} else {
				$this->json['status'] = false;
				$this->json['msg'] = "Kode Pelajaran Sudah Digunakan!";
				echo json_encode($this->json);
			}
		}
	}

	public function get_data_mata_pelajaran_edit($id)
	{
		if ($this->menu_model->akses('kurikulum/matapelajaran') != 1) {
			redirect('dashboard');
		}
		$data = $this->mata_pelajaran_model->getById($id);
		echo json_encode($data->row());
	}

	public function delete_mata_pelajaran($id)
	{
		$this->db->where('mata_pelajaran_id', $id);
		$this->db->delete('ms_mata_pelajaran');
		$this->json['status'] = TRUE;
		$this->json['msg'] = "Data Berhasil Dihapus!";
		echo json_encode($this->json);
	}
}
