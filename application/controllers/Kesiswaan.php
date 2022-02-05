<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
		$this->load->model('kelas_model');
		$this->load->model('User_model');
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

	function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

	public function testmpdf()
	{
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<h1>Hello world!</h1>');
		$mpdf->Output();;
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
		$rombel = $this->db->get('ms_kelas');

		$data = array(
			'namepage' => 'Daftar Siswa Aktif',
			'js' => 'kesiswaan.js',
			'agama' => $agama,
			'tempattinggal' => $tempattinggal,
			'transportasi' => $transportasi,
			'pendidikan' => $pendidikan,
			'pekerjaan' => $pekerjaan,
			'penghasilan' => $penghasilan,
			'rombel' => $rombel,
		);
		$this->template->render('siswa_list', $data);
	}

	public function kelas()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/kelas') != 1) {
			redirect('dashboard');
		}

		$tingkat = $this->db->get('ms_tingkat');
		$jurusan = $this->db->get('ms_jurusan');
		$user = $this->db->get_where('users', array('user_type  !=' => '2'));

		$data = array(
			'namepage' => 'Rombel',
			'js' => 'kelas.js',
			'tingkat' => $tingkat,
			'jurusan' => $jurusan,
			'user' => $user,
		);
		$this->template->render('ms_kelas', $data);
	}

	public function siswakeluar()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/siswakeluar') != 1) {
			redirect('dashboard');
		}
		$agama = $this->db->get('app_agama');
		$tempattinggal = $this->db->get('app_tempattinggal');
		$transportasi = $this->db->get('app_transportasi');
		$pendidikan = $this->db->get('app_pendidikan');
		$pekerjaan = $this->db->get('app_pekerjaan');
		$penghasilan = $this->db->get('app_penghasilan');
		$rombel = $this->db->get('ms_kelas');

		$data = array(
			'namepage' => 'Daftar Siswa Keluar ',
			'js' => 'siswa_keluar.js',
			'agama' => $agama,
			'tempattinggal' => $tempattinggal,
			'transportasi' => $transportasi,
			'pendidikan' => $pendidikan,
			'pekerjaan' => $pekerjaan,
			'penghasilan' => $penghasilan,
			'rombel' => $rombel
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
			$walikelas = $this->db->get_where('ms_kelas', ["wali_user_id" => $this->session->userdata('user_id')]); //cek wali kelas
			if ($walikelas->num_rows() != 0) {
				if($field->kelas_nama == ""){
					$row[] = '';
				}else{
					$row[] = $field->kelas_nama;
				}
				$row[] = $field->siswa_updated_at;
				$row[] = '<a class="btn btn-sm bg-blue bg-accent-2 white" href="javascript:void()" title="Biodata" onclick="biodata(' . "'" . $field->siswa_id . "'" . ')">Biodata</a>';
			} else {
				if($field->siswa_tgl_nonaktif == "0000-00-00"){
					$tgl_non = "";
				} else{
					$tgl_non = date("d-m-Y", strtotime($field->siswa_tgl_nonaktif));
				}
				if($field->kelas_nama == ""){
					$row[] = '<a class="black bg-amber white" href="javascript:void()" title="Rombel" onclick="rombel(' . "'" . $field->siswa_id . "'," . '' . "'" . $field->user_email . "'," . '' . "'" . $field->user_nama . "'," . '' . "'" . $field->kelas_id . "'" . ')">Rombel</a>';
				}else{
					$row[] = '<a class="black" href="javascript:void()" title="Rombel" onclick="rombel(' . "'" . $field->siswa_id . "'," . '' . "'" . $field->user_email . "'," . '' . "'" . $field->user_nama . "'," . '' . "'" . $field->kelas_id . "'" . ')">'.$field->kelas_nama.'</a>';
				}
				$row[] = $field->siswa_updated_at;
				$row[] = '<a class="btn btn-sm bg-blue bg-accent-2 white" href="javascript:void()" title="Biodata" onclick="biodata(' . "'" . $field->siswa_id . "'" . ')">Biodata</a>
						<a class="btn btn-sm bg-amber bg-darken-3 white" href="javascript:void()" title="Registrasi" onclick="registrasi(' . "'" . $field->siswa_id . "'," . '' . "'" . $field->user_email . "'," . '' . "'" . $tgl_non . "'" . ')">Registrasi</a>';
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

	function get_data_keluar()
	{
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$list = $this->siswa_model->get_datatables_keluar();
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
				$row[] = '';
			} else {
				$row[] = '<a class="btn btn-sm bg-blue bg-darken-3 white" href="javascript:void()" title="Surat Keterangan Pindah" onclick="cetaksuratketeranganpindah(' . "'" . $field->siswa_id . "'," . '' . "'" . $field->user_email . "'" . ')">Surat Keterangan Pindah</a> 
						  <a class="btn btn-sm bg-amber bg-darken-3 white" href="javascript:void()" title="Registrasi" onclick="registrasi(' . "'" . $field->siswa_id . "'," . '' . "'" . $field->user_email . "'" . ')">Registrasi</a>';
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->siswa_model->count_all(),
			"recordsFiltered" => $this->siswa_model->count_filtered_keluar(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	function get_data_kelas()
	{
		if ($this->menu_model->akses('kesiswaan/kelas') != 1) {
			redirect('dashboard');
		}
		$list = $this->kelas_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->kelas_nama;
			$row[] = $field->tingkat_nama;
			$row[] = $field->jurusan_nama;
			$row[] = $field->user_email;
			$row[] = '<a class="btn btn-sm bg-blue bg-accent-2 white" href="javascript:void()" title="Edit" onclick="edit(' . "'" . $field->kelas_id . "'" . ')">Edit</a>
						<a class="btn btn-sm bg-red bg-darken-1 white" href="javascript:void()" title="Delete Kelas" onclick="delete_kelas(' . "'" . $field->kelas_id . "'," . '' . "'" . $field->user_email . "'" . ')">Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kelas_model->count_all(),
			"recordsFiltered" => $this->kelas_model->count_filtered(),
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

	public function get_data_kelas_edit($id)
	{
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$data = $this->kelas_model->getById($id);
		echo json_encode($data->row());
	}

	public function regsiswa()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$post = $this->input->post();
		$this->siswa_status = $post["siswa_status"];
		$this->siswa_tgl_nonaktif = date("Y-m-d", strtotime($post["siswa_tgl_nonaktif"]));
		$this->db->update("siswa", $this, array('siswa_id' => $post["siswa_id"]));
		echo json_encode(array("status" => TRUE));
	}

	public function regrombel()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$post = $this->input->post();
		if ($this->db->get_where('kelas_siswa', array('siswa_id' => $post["siswa_id"]))->num_rows() == 0) {
			$this->kelas_id = $post["kelas_id"];
			$this->siswa_id = $post["siswa_id"];
			$this->klssw_created_by = $this->session->userdata('user_id');
			$this->klssw_created_at = (date("Y-m-d H:m:s", time()));
			$this->db->insert("kelas_siswa", $this); //tambah group
			echo json_encode(array("status" => TRUE));
		} else {
			$this->kelas_id = $post["kelas_id"];
			$this->klssw_updated_by = $this->session->userdata('user_id');
			$this->klssw_updated_at = (date("Y-m-d H:m:s", time()));
			$this->db->update("kelas_siswa", $this, array('siswa_id' => $post["siswa_id"]));
			echo json_encode(array("status" => TRUE));
		}
	}

	function downloadbiodata()
	{
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$data = $this->siswa_model->datadownload();
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$baris = 1;
		$sheet->setCellValue('A' . $baris, 'Nama Lengkap');
		$sheet->setCellValue('B' . $baris, 'L/P');
		$sheet->setCellValue('C' . $baris, 'NISN');
		$sheet->setCellValue('D' . $baris, 'NIK');
		$sheet->setCellValue('E' . $baris, 'No Kartu Keluarga');
		$sheet->setCellValue('F' . $baris, 'Tempat Lahir');
		$sheet->setCellValue('G' . $baris, 'Tanggal Lahir');
		$sheet->setCellValue('H' . $baris, 'No Kartu Keluarga');
		$sheet->setCellValue('I' . $baris, 'Agama');
		$sheet->setCellValue('J' . $baris, 'Alamat');
		$sheet->setCellValue('K' . $baris, 'Desa/Kelurahan');
		$sheet->setCellValue('L' . $baris, 'Kecamatan');
		$sheet->setCellValue('M' . $baris, 'Kabupaten/Kota');
		$sheet->setCellValue('N' . $baris, 'Provinsi');
		$sheet->setCellValue('O' . $baris, 'Kode POS');
		$sheet->setCellValue('P' . $baris, 'Tempat Tinggal');
		$sheet->setCellValue('Q' . $baris, 'Moda Transportasi');
		$sheet->setCellValue('R' . $baris, 'Anak Ke-');
		$sheet->setCellValue('S' . $baris, 'Penerima KPS/PKH');
		$sheet->setCellValue('T' . $baris, 'NO KPS/PKH');
		$sheet->setCellValue('U' . $baris, 'Penerima KIP');
		$sheet->setCellValue('V' . $baris, 'NO KIP');
		$sheet->setCellValue('W' . $baris, 'NO HP');
		$sheet->setCellValue('X' . $baris, 'Email');
		$sheet->setCellValue('Y' . $baris, 'Rombel');
		$sheet->setCellValue('Z' . $baris, 'NIS');
		$sheet->setCellValue('AA' . $baris, 'No Registrasi Akta Lahir');
		$sheet->setCellValue('AB' . $baris, 'Nama Ayah');
		$sheet->setCellValue('AC' . $baris, 'NIK Ayah');
		$sheet->setCellValue('AD' . $baris, 'Tahun Lahir Ayah');
		$sheet->setCellValue('AE' . $baris, 'Pendidikan Ayah');
		$sheet->setCellValue('AF' . $baris, 'Pekerjaan Ayah');
		$sheet->setCellValue('AG' . $baris, 'Penghasilan Ayah');
		$sheet->setCellValue('AH' . $baris, 'Nama Ibu');
		$sheet->setCellValue('AI' . $baris, 'NIK Ibu');
		$sheet->setCellValue('AJ' . $baris, 'Tahun Lahir Ibu');
		$sheet->setCellValue('AK' . $baris, 'Pendidikan Ibu');
		$sheet->setCellValue('AL' . $baris, 'Pekerjaan Ibu');
		$sheet->setCellValue('AM' . $baris, 'Penghasilan Ibu');
		$sheet->setCellValue('AN' . $baris, 'Nama Wali');
		$sheet->setCellValue('AO' . $baris, 'NIK Wali');
		$sheet->setCellValue('AP' . $baris, 'Tahun Lahir Wali');
		$sheet->setCellValue('AQ' . $baris, 'Pendidikan Wali');
		$sheet->setCellValue('AR' . $baris, 'Pekerjaan Wali');
		$sheet->setCellValue('AS' . $baris, 'Penghasilan Wali');
		$sheet->setCellValue('AT' . $baris, 'Asal Sekolah');

		$baris++;
		foreach ($data as $dt) {
			$sheet->setCellValue('A' . $baris, $dt->siswa_nama);
			$sheet->setCellValue('B' . $baris, $dt->siswa_jeniskelamin);
			$sheet->setCellValue('C' . $baris, $dt->siswa_nisn);
			$sheet->setCellValueExplicit('D' . $baris, $dt->siswa_nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('E' . $baris, $dt->siswa_kk, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('F' . $baris, $dt->siswa_tempatlahir);
			$sheet->setCellValue('G' . $baris, $dt->siswa_tanggallahir);
			$sheet->setCellValue('H' . $baris, $dt->siswa_aktalahir);
			$sheet->setCellValue('I' . $baris, $dt->agama_keterangan);
			$sheet->setCellValue('J' . $baris, $dt->siswa_alamat);
			$sheet->setCellValue('K' . $baris, $dt->siswa_kelurahan);
			$sheet->setCellValue('L' . $baris, $dt->siswa_kecamatan);
			$sheet->setCellValue('M' . $baris, $dt->siswa_kabupaten);
			$sheet->setCellValue('N' . $baris, $dt->siswa_provinsi);
			$sheet->setCellValue('O' . $baris, $dt->siswa_kodepos);
			$sheet->setCellValue('P' . $baris, $dt->tempattinggal_keterangan);
			$sheet->setCellValue('Q' . $baris, $dt->transportasi_keterangan);
			$sheet->setCellValue('R' . $baris, $dt->siswa_anakke);
			$sheet->setCellValue('S' . $baris, $dt->siswa_kps);
			$sheet->setCellValue('T' . $baris, $dt->siswa_nokps);
			$sheet->setCellValue('U' . $baris, $dt->siswa_kip);
			$sheet->setCellValue('V' . $baris, $dt->siswa_nokip);
			$sheet->setCellValue('W' . $baris, $dt->siswa_notelp);
			$sheet->setCellValue('X' . $baris, $dt->siswa_email);
			$sheet->setCellValue('Y' . $baris, $dt->kelas_nama);
			$sheet->setCellValue('Z' . $baris, $dt->user_nama);
			$sheet->setCellValue('AA' . $baris, $dt->siswa_aktalahir);
			$sheet->setCellValue('AB' . $baris, $dt->siswa_nama_ayah);
			$sheet->setCellValueExplicit('AC' . $baris, $dt->siswa_nik_ayah, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('AD' . $baris, $dt->siswa_tahunlahir_ayah);
			$sheet->setCellValue('AE' . $baris, $dt->pd_ayah);
			$sheet->setCellValue('AF' . $baris, $dt->pk_ayah);
			$sheet->setCellValue('AG' . $baris, $dt->ph_ayah);
			$sheet->setCellValue('AH' . $baris, $dt->siswa_nama_ibu);
			$sheet->setCellValueExplicit('AI' . $baris, $dt->siswa_nik_ibu, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('AJ' . $baris, $dt->siswa_tahunlahir_ibu);
			$sheet->setCellValue('AK' . $baris, $dt->pd_ibu);
			$sheet->setCellValue('AL' . $baris, $dt->pk_ibu);
			$sheet->setCellValue('AM' . $baris, $dt->ph_ibu);
			$sheet->setCellValue('AN' . $baris, $dt->siswa_nama_wali);
			$sheet->setCellValueExplicit('AO' . $baris, $dt->siswa_nik_wali, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('AP' . $baris, $dt->siswa_tahunlahir_wali);
			$sheet->setCellValue('AQ' . $baris, $dt->pd_wali);
			$sheet->setCellValue('AR' . $baris, $dt->pk_wali);
			$sheet->setCellValue('AS' . $baris, $dt->ph_wali);
			$sheet->setCellValue('AT' . $baris, $dt->siswa_asalsekolah);
			$baris++; // Tambah 1 setiap kali looping
		}
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		$sheet->getColumnDimension('O')->setAutoSize(true);
		$sheet->getColumnDimension('P')->setAutoSize(true);
		$sheet->getColumnDimension('Q')->setAutoSize(true);
		$sheet->getColumnDimension('R')->setAutoSize(true);
		$sheet->getColumnDimension('S')->setAutoSize(true);
		$sheet->getColumnDimension('T')->setAutoSize(true);
		$sheet->getColumnDimension('U')->setAutoSize(true);
		$sheet->getColumnDimension('V')->setAutoSize(true);
		$sheet->getColumnDimension('Q')->setAutoSize(true);
		$sheet->getColumnDimension('X')->setAutoSize(true);
		$sheet->getColumnDimension('Y')->setAutoSize(true);
		$sheet->getColumnDimension('Z')->setAutoSize(true);
		$sheet->getColumnDimension('Z')->setAutoSize(true);
		$sheet->getStyle('A1:AT1')->getFont()->setBold(true);

		$writer = new Xlsx($spreadsheet);

		$filename = 'Biodata_Siswa_' . date("dmYhis");

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function kelasupdate()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/kelas') != 1) {
			redirect('dashboard');
		}
		$post = $this->input->post();
		if ($post["kelas_nama"] == "" || $post["wali_user_id"] == 0) {
			$this->json['status'] = false;
			$this->json['msg'] = "Semua Form Wajib Di Isi";
			echo json_encode($this->json);
		} else {
			$kelas = $this->kelas_model;
			$get = $kelas->getById($post["kelas_id"]);

			if ($get->row()->kelas_nama == $post["kelas_nama"]) {
				$kelas->update();
				$this->json['status'] = TRUE;
				$this->json['msg'] = "Data Berhasil Diperbarui!";
				echo json_encode($this->json);
			} else {
				if ($kelas->getBynama($post["kelas_nama"])->num_rows() == 0) {
					$kelas->update();
					$this->json['status'] = TRUE;
					$this->json['msg'] = "Data Berhasil Diperbarui!";
					echo json_encode($this->json);
				} else {
					$this->json['status'] = false;
					$this->json['msg'] = "Nama Sudah Digunakan!";
					echo json_encode($this->json);
				}
			}
		}
	}

	public function kelassave()
	{
		//cek akses
		if ($this->menu_model->akses('kesiswaan/kelas') != 1) {
			redirect('dashboard');
		}
		$post = $this->input->post();;
		if ($post["kelas_nama"] == "" || $post["wali_user_id"] == 0) {
			$this->json['status'] = false;
			$this->json['msg'] = "Semua Form Wajib Di Isi";
			echo json_encode($this->json);
		} else {
			$kelas = $this->kelas_model;

			if ($kelas->getBynama($post["kelas_nama"])->num_rows() == 0) {
				$kelas->save();
				$this->json['status'] = TRUE;
				$this->json['msg'] = "Data Berhasil Diperbarui!";
				echo json_encode($this->json);
			} else {
				$this->json['status'] = false;
				$this->json['msg'] = "Nama Sudah Digunakan!";
				echo json_encode($this->json);
			}
		}
	}

	public function delete_kelas($id)
	{
		if ($this->db->get_where('kelas_siswa', array('kelas_id' => $id))->num_rows() == 0) {
			$this->db->where('kelas_id', $id);
			$this->db->delete('ms_kelas');
			$this->json['status'] = TRUE;
			$this->json['msg'] = "Data Berhasil Dihapus!";
			echo json_encode($this->json);
		} else {
			$this->json['status'] = FALSE;
			$this->json['msg'] = "Rombel Masih Aktif, Masih Terdapat Siswa Di Rombel Tesebut";
			echo json_encode($this->json);
		}
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

	public function cetaksuratketeranganpindah($idsiswa)
	{
		$siswa = $this->siswa_model->getById($idsiswa)->row();
		$nis = $this->db->get_where('users', ["user_id" => $idsiswa])->row();
		
		$this->db->from("kelas_siswa");
		$this->db->join('ms_kelas', 'ms_kelas.kelas_id = kelas_siswa.kelas_id', 'left');
		$this->db->join('ms_jurusan', 'ms_jurusan.jurusan_id = ms_kelas.jurusan_id', 'left');
		$this->db->join('ms_tingkat', 'ms_tingkat.tingkat_id = ms_kelas.tingkat_id', 'left');
		$this->db->where('kelas_siswa.siswa_id', $idsiswa);
		$kelas = $this->db->get()->row();

		$this->db->select('*');
		$this->db->from('config');
		$this->db->where('config.cf_id', 1);
		$config = $this->db->get()->row();

		$nama_dokumen='Surat_Keterangan_Pindah';
		$mpdfConfig = array(
			'mode' => 'utf-8', 
			'format' => 'A4',
		);
		$mpdf->tabSpaces = 6;
		$mpdf = new \Mpdf\Mpdf($mpdfConfig);		
		ob_start();
		?>
		
		<style>
			h1{text-align: center ; font-size:16pt};
			.page {
				margin-top: 100mm; 
				margin-bottom: 100mm; 
				margin-left: 300mm; 
				margin-right: 200mm; 
			}
			.nosurat{ text-align: center;line-height:0.1;};
			.p_utama{ text-align: justify;line-height:1.5;};
			.p_sub{ text-indent: 50px;  display:inline-block;text-align: justify;line-height:1.5;};
			.tab1 {
				tab-size: 50;
			}
		</style>
		<body style="font-family: times new roman; font-size: 12pt;">
				<img src="<?php echo base_url(); ?>app-assets/images/kop/<?php echo $config->cf_kop_sekolah; ?>">
				<h1><b><u>SURAT KETERANGAN PINDAH</u></b></h1>
				<div class="nosurat">Nomor : 421 /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ Pendik / <?php echo date("Y"); ?> </div>
				<br>
				<p class="p_utama">
					Yang bertanda tangan dibawah ini Kepala <?php echo $config->cf_nama; ?>, menerangkan bahwa :
				</p>
				<table>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>Nama</td>
						<td>:</td>
						<td><?php echo $siswa->siswa_nama; ?></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>No. Induk Siswa / NISN</td>
						<td>:</td>
						<td> <?php echo $nis->user_nama; ?>/<?php echo $siswa->siswa_nisn; ?></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>Jurusan</td>
						<td>:</td>
						<td><?php echo $kelas->jurusan_nama; ?></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>Tingkat</td>
						<td>:</td>
						<td><?php echo $kelas->tingkat_nama; ?></td>
					</tr>
				</table>
				<p>
					Anak Dari:
				</p>
				<table>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>Nama Orang Tua &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>:</td>
						<td><?php echo $siswa->siswa_nama_ayah; ?></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>Alamat Orang Tua</td>
						<td>:</td>
						<td><?php echo $siswa->siswa_alamat; ?></td>
					</tr>
				</table>
				<p class="p_utama">
					Benar nama tersebuat di atas diterima di <?php echo $config->cf_nama; ?>, dan akan Pindah Ke Sekolah Lain atas permintaan orang tua siswa yang bersangkutan.
				<br>
				<br>

					Dan Sejak diterbitkan Surat Keterangan Pindah ini, Hak dan Kewajibannya tidak ada lagi, serta <?php echo $config->cf_nama; ?> tidak dapat menerima kembali.
				<br>
				<br>

					Demikianlah Surat Keterangan ini dibuat, dan untuk dapat dipergunakan sebagaimana mestinya.
				</p>
				<p>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $config->cf_kota ?>, <?php echo $this->tgl_indo(date('Y-m-d'))?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Kepala";?>
					<br>
					<br>
					<br>
					<br>
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b><?php echo $config->cf_nama_kepala_sekolah ?></b></u>
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP.<?php echo $config->cf_nip_kepala_sekolah ?>
				</p>
				<br>
				<br>
					Tembusan:
					<ol>
						<li>1 Lembar Untuk Sekolah Yang Di Tuju</li>
						<li>1 Lembar Untuk Arsip Sekolah</li>
					</ol>
		</body>
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		$mpdf->WriteHTML(utf8_encode($html));
		$mpdf->Output($nama_dokumen.".pdf" ,'I');
		$mpdf->Output();
	}

	public function tambah_siswa()
	{
		//cek akses
		if ($this->menu_model->akses('user/akun') != 1) {
			redirect('dashboard');
		}
		$user = $this->User_model;
		$post = $this->input->post();
		$data["user"] = $user->getByUsername($post["user_nama"]);

		if ($data["user"]->num_rows() == 0) {
			$user_id = $user->add_siswa();
			$this->group_id = 3;
			$this->user_id = $user_id;
			$this->set_by = $this->session->userdata('user_id');
			$this->set_time = (date("Y-m-d H:m:s", time()));
			$this->db->trans_start();
			$this->db->insert("ms_user_group", $this); //tambah group
			$this->db->trans_complete();

			$datasiswa = array(
								'siswa_id' => $user_id,
								'siswa_nama' => $post["user_email"],
								'siswa_tanggallahir' => '2000-01-01',
								'siswa_status' => 1,
								'siswa_created_by' => $this->session->userdata('user_id'),
								'siswa_created_at' => (date("Y-m-d H:m:s", time()))
						);

			$this->db->insert("siswa", $datasiswa); //tambah biodata
			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array("status" => FALSE));
		}
	}
}
