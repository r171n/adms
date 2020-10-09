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

		$data = array(
			'namepage' => 'Daftar Siswa Keluar ',
			'js' => 'siswa_keluar.js',
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
				$row[] = '<a class="btn btn-sm bg-blue bg-accent-2 white" href="javascript:void()" title="Biodata" onclick="biodata(' . "'" . $field->siswa_id . "'" . ')">Biodata</a>';
			} else {
				$row[] = '<a class="btn btn-sm bg-blue bg-accent-2 white" href="javascript:void()" title="Biodata" onclick="biodata(' . "'" . $field->siswa_id . "'" . ')">Biodata</a>
						<a class="btn btn-sm bg-amber bg-darken-3 white" href="javascript:void()" title="Registrasi" onclick="registrasi(' . "'" . $field->siswa_id . "'," . '' . "'" . $field->user_email . "'" . ')">Registrasi</a>';
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
				$row[] = '<a class="btn btn-sm bg-amber bg-darken-3 white" href="javascript:void()" title="Registrasi" onclick="registrasi(' . "'" . $field->siswa_id . "'," . '' . "'" . $field->user_email . "'" . ')">Registrasi</a>';
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
	public function get_data_edit($id)
	{
		if ($this->menu_model->akses('kesiswaan/siswa') != 1) {
			redirect('dashboard');
		}
		$user = $this->siswa_model;
		$data = $user->getById($id);
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
		$this->db->update("siswa", $this, array('siswa_id' => $post["siswa_id"]));
		echo json_encode(array("status" => TRUE));
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
		$sheet->getStyle('A1:AS1')->getFont()->setBold(true);

		$writer = new Xlsx($spreadsheet);

		$filename = 'Biodata_Siswa_' . date("dmYhis");

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
