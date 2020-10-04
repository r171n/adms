<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kesiswaan extends CI_Controller
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
		if ($this->menu_model->akses('kesiswaan') != 1) {
			redirect('dashboard');
		}
		$data = array(
			'namepage' => 'Kesiswaan'
		);
		$this->template->render('user_list', $data);
	}

	public function siswa()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$agama = $this->db->get('app_agama');
		$tempattinggal = $this->db->get('app_tempattinggal');
		$transportasi = $this->db->get('app_transportasi');
		$pendidikan = $this->db->get('app_pendidikan');
		$pekerjaan = $this->db->get('app_pekerjaan');
		$penghasilan = $this->db->get('app_penghasilan');

		$data = array(
			'namepage' => 'Daftar Siswa Aktif',
			'js' => 'kesiswaan.js',
			'agama' => $agama,
			'tempattinggal' => $tempattinggal,
			'transportasi' => $transportasi,
			'pendidikan' => $pendidikan,
			'pekerjaan' => $pekerjaan,
			'penghasilan' => $penghasilan,
		);
		$this->template->render('siswa_list', $data);
	}

	function get_data_siswa()
	{
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$list = $this->siswa_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->user_email;
			$row[] = $field->user_nama;
			$row[] = $field->siswa_nisn;
			$row[] = $field->siswa_jeniskelamin;
			$row[] = $field->kelas_nama;
			$row[] = $field->siswa_updated_at;
			$walikelas = $this->db->get_where('ms_kelas', ["wali_user_id" => $this->session->userdata('user_id')]); //cek wali kelas
			if ($walikelas->num_rows() != 0) {
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Biodata" onclick="biodata(' . "'" . $field->siswa_id . "'" . ')">Biodata</a>';
			} else {
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Biodata" onclick="biodata(' . "'" . $field->siswa_id . "'" . ')">Biodata</a>
						<a class="btn btn-sm btn-danger" href="javascript:void()" title="Registrasi" onclick="registrasi(' . "'" . $field->siswa_id . "'" . ')">Registrasi</a>';
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->siswa_model->count_all(),
			"recordsFiltered" => $this->siswa_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function get_data_edit($id)
	{
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$user = $this->siswa_model;
		$data = $user->getById($id);
		echo json_encode($data->row());
	}

	public function biodatasave()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
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
			//bukan sebagai siswa
			$siswa = $this->siswa_model;
			$siswa_id = $this->input->post('siswa_id');
			$data["siswa"] = $siswa->getById($siswa_id);

			if ($data["siswa"]->num_rows() == 0) {
				$siswa->save();
				$post = $this->input->post();
				$user_id = $siswa_id;
				$this->user_email = $post["siswa_nama"];
				$this->db->update("users", $this, array('user_id' => $user_id));
				echo json_encode(array("status" => TRUE));
			} else {
				$siswa->update();
				$user_id = $siswa_id;
				$post = $this->input->post();
				$this->user_email = $post["siswa_nama"];
				$this->db->update("users", $this, array('user_id' => $user_id));
				echo json_encode(array("status" => TRUE));
			}
		}
	}
}
