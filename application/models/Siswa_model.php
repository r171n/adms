<?php

class Siswa_model extends CI_Model
{
	private $table = 'siswa'; //nama tabel dari database
	var $column_order = array(null, 'users.user_email', 'users.user_nama', 'siswa.siswa_nisn', 'siswa.siswa_jeniskelamin', 'ms_kelas.kelas_nama', 'siswa.siswa_updated_at'); //field yang ada di table user
	var $column_search = array('users.user_email', 'users.user_nama', 'siswa.siswa_nisn', 'siswa.siswa_jeniskelamin', 'ms_kelas.kelas_nama', 'siswa.siswa_updated_at'); //field yang diizin untuk pencarian 
	var $order = array('siswa.siswa_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$walikelas = $this->db->get_where('ms_kelas', ["wali_user_id" => $this->session->userdata('user_id')]); //cek wali kelas
		$this->db->select("users.user_email as user_email,
						   users.user_nama as user_nama,
						   siswa.siswa_nisn as siswa_nisn,
						   siswa.siswa_jeniskelamin as siswa_jeniskelamin,
						   ms_kelas.kelas_nama as kelas_nama, 
						   siswa.siswa_updated_at as siswa_updated_at,
						   siswa.siswa_id as siswa_id,
						   siswa.siswa_tgl_nonaktif as siswa_tgl_nonaktif,
						   ");
		$this->db->from("siswa");
		$this->db->join('users', 'users.user_id = siswa.siswa_id', 'right');
		$this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.siswa_id', 'left');
		$this->db->join('ms_kelas', 'ms_kelas.kelas_id = kelas_siswa.kelas_id', 'left');
		$this->db->where('users.user_type', 2);
		$this->db->where('siswa.siswa_status', 1); //siswa status 1 = aktif, 0= tidak aktif
		if ($walikelas->num_rows() != 0) {
			$this->db->where('ms_kelas.wali_user_id', $this->session->userdata('user_id'));
		}


		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_keluar()
	{
		$walikelas = $this->db->get_where('ms_kelas', ["wali_user_id" => $this->session->userdata('user_id')]); //cek wali kelas
		$this->db->select("users.user_email as user_email,
						   users.user_nama as user_nama,
						   siswa.siswa_nisn as siswa_nisn,
						   siswa.siswa_jeniskelamin as siswa_jeniskelamin,
						   ms_kelas.kelas_nama as kelas_nama, 
						   siswa.siswa_updated_at as siswa_updated_at,
						   siswa.siswa_id as siswa_id,
						   ");
		$this->db->from("siswa");
		$this->db->join('users', 'users.user_id = siswa.siswa_id', 'right');
		$this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.siswa_id', 'left');
		$this->db->join('ms_kelas', 'ms_kelas.kelas_id = kelas_siswa.kelas_id', 'left');
		$this->db->where('users.user_type', 2);
		$this->db->where('siswa.siswa_status !=', 1); //siswa status 1 = aktif, 0= tidak aktif
		if ($walikelas->num_rows() != 0) {
			$this->db->where('ms_kelas.wali_user_id', $this->session->userdata('user_id'));
		}


		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_keluar()
	{
		$this->_get_datatables_query_keluar();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_filtered_keluar()
	{
		$this->_get_datatables_query_keluar();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	private $_table = "siswa";

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["siswa_id" => $id]);
	}

	public function save()
	{
		$post = $this->input->post();
		$this->siswa_id = $this->session->userdata('user_id');
		$this->siswa_nama = $post["siswa_nama"];
		if (!empty($post["siswa_jeniskelamin"])) {
			$this->siswa_jeniskelamin = $post["siswa_jeniskelamin"];
		}
		$this->siswa_nisn = $post["siswa_nisn"];
		$this->siswa_nik = $post["siswa_nik"];
		$this->siswa_kk = $post["siswa_kk"];
		$this->siswa_tempatlahir = $post["siswa_tempatlahir"];
		$this->siswa_tanggallahir = date("Y-m-d", strtotime($post["siswa_tanggallahir"]));
		$this->siswa_aktalahir = $post["siswa_aktalahir"];
		$this->siswa_agama = $post["siswa_agama"];
		$this->siswa_alamat = $post["siswa_alamat"];
		$this->siswa_rt = $post["siswa_rt"];
		$this->siswa_rw = $post["siswa_rw"];
		$this->siswa_kelurahan = $post["siswa_kelurahan"];
		$this->siswa_kecamatan = $post["siswa_kecamatan"];
		$this->siswa_kabupaten = $post["siswa_kabupaten"];
		$this->siswa_provinsi = $post["siswa_provinsi"];
		$this->siswa_kodepos = $post["siswa_kodepos"];
		$this->siswa_jenistinggal = $post["siswa_jenistinggal"];
		$this->siswa_alattransport = $post["siswa_alattransport"];
		$this->siswa_anakke = $post["siswa_anakke"];
		$this->siswa_kps = ($post["siswa_kps"] == "" ? 'TIDAK' : $post["siswa_kps"]);
		$this->siswa_kip = ($post["siswa_kip"] == "" ? 'TIDAK' : $post["siswa_kip"]);
		$this->siswa_nokip = $post["siswa_nokip"];
		$this->siswa_asalsekolah = $post["siswa_asalsekolah"];
		$this->siswa_notelp = $post["siswa_notelp"];
		$this->siswa_email = $post["siswa_email"];
		$this->siswa_nokps = $post["siswa_nokps"];
		$this->siswa_nama_ayah = $post["siswa_nama_ayah"];
		$this->siswa_nik_ayah = $post["siswa_nik_ayah"];
		$this->siswa_tahunlahir_ayah = $post["siswa_tahunlahir_ayah"];
		$this->siswa_pendidikan_ayah = $post["siswa_pendidikan_ayah"];
		$this->siswa_penghasilan_ayah = $post["siswa_penghasilan_ayah"];
		$this->siswa_pekerjaan_ayah = $post["siswa_pekerjaan_ayah"];
		$this->siswa_nama_ibu = $post["siswa_nama_ibu"];
		$this->siswa_nik_ibu = $post["siswa_nik_ibu"];
		$this->siswa_tahunlahir_ibu = $post["siswa_tahunlahir_ibu"];
		$this->siswa_pendidikan_ibu = $post["siswa_pendidikan_ibu"];
		$this->siswa_penghasilan_ibu = $post["siswa_penghasilan_ibu"];
		$this->siswa_pekerjaan_ibu = $post["siswa_pekerjaan_ibu"];
		$this->siswa_nama_wali = $post["siswa_nama_wali"];
		$this->siswa_nik_wali = $post["siswa_nik_wali"];
		$this->siswa_tahunlahir_wali = $post["siswa_tahunlahir_wali"];
		$this->siswa_pendidikan_wali = $post["siswa_pendidikan_wali"];
		$this->siswa_penghasilan_wali = $post["siswa_penghasilan_wali"];
		$this->siswa_pekerjaan_wali = $post["siswa_pekerjaan_wali"];
		$this->siswa_created_by = $this->session->userdata('user_id');
		$this->siswa_created_at = (date("Y-m-d H:m:s", time()));
		return $this->db->insert($this->_table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->siswa_nama = $post["siswa_nama"];
		if (!empty($post["siswa_jeniskelamin"])) {
			$this->siswa_jeniskelamin = $post["siswa_jeniskelamin"];
		}
		$this->siswa_nisn = $post["siswa_nisn"];
		$this->siswa_nik = $post["siswa_nik"];
		$this->siswa_kk = $post["siswa_kk"];
		$this->siswa_tempatlahir = $post["siswa_tempatlahir"];
		$this->siswa_tanggallahir = date("Y-m-d", strtotime($post["siswa_tanggallahir"]));
		$this->siswa_aktalahir = $post["siswa_aktalahir"];
		$this->siswa_agama = $post["siswa_agama"];
		$this->siswa_alamat = $post["siswa_alamat"];
		$this->siswa_rt = $post["siswa_rt"];
		$this->siswa_rw = $post["siswa_rw"];
		$this->siswa_kelurahan = $post["siswa_kelurahan"];
		$this->siswa_kecamatan = $post["siswa_kecamatan"];
		$this->siswa_kabupaten = $post["siswa_kabupaten"];
		$this->siswa_provinsi = $post["siswa_provinsi"];
		$this->siswa_kodepos = $post["siswa_kodepos"];
		$this->siswa_jenistinggal = $post["siswa_jenistinggal"];
		$this->siswa_alattransport = $post["siswa_alattransport"];
		$this->siswa_anakke = $post["siswa_anakke"];
		$this->siswa_kps = ($post["siswa_kps"] == "" ? 'TIDAK' : $post["siswa_kps"]);
		$this->siswa_kip = ($post["siswa_kip"] == "" ? 'TIDAK' : $post["siswa_kip"]);
		$this->siswa_nokip = $post["siswa_nokip"];
		$this->siswa_asalsekolah = $post["siswa_asalsekolah"];
		$this->siswa_notelp = $post["siswa_notelp"];
		$this->siswa_email = $post["siswa_email"];
		$this->siswa_nokps = $post["siswa_nokps"];
		$this->siswa_nama_ayah = $post["siswa_nama_ayah"];
		$this->siswa_nik_ayah = $post["siswa_nik_ayah"];
		$this->siswa_tahunlahir_ayah = $post["siswa_tahunlahir_ayah"];
		$this->siswa_pendidikan_ayah = $post["siswa_pendidikan_ayah"];
		$this->siswa_penghasilan_ayah = $post["siswa_penghasilan_ayah"];
		$this->siswa_pekerjaan_ayah = $post["siswa_pekerjaan_ayah"];
		$this->siswa_nama_ibu = $post["siswa_nama_ibu"];
		$this->siswa_nik_ibu = $post["siswa_nik_ibu"];
		$this->siswa_tahunlahir_ibu = $post["siswa_tahunlahir_ibu"];
		$this->siswa_pendidikan_ibu = $post["siswa_pendidikan_ibu"];
		$this->siswa_penghasilan_ibu = $post["siswa_penghasilan_ibu"];
		$this->siswa_pekerjaan_ibu = $post["siswa_pekerjaan_ibu"];
		$this->siswa_nama_wali = $post["siswa_nama_wali"];
		$this->siswa_nik_wali = $post["siswa_nik_wali"];
		$this->siswa_tahunlahir_wali = $post["siswa_tahunlahir_wali"];
		$this->siswa_pendidikan_wali = $post["siswa_pendidikan_wali"];
		$this->siswa_penghasilan_wali = $post["siswa_penghasilan_wali"];
		$this->siswa_pekerjaan_wali = $post["siswa_pekerjaan_wali"];
		$this->siswa_updated_by = $this->session->userdata('user_id');
		$this->siswa_updated_at = date("Y-m-d H:m:s", time());
		if ($this->session->userdata('user_type') != 2) {
			return $this->db->update($this->_table, $this, array('siswa_id' => $post["siswa_id"]));
		} else {
			return $this->db->update($this->_table, $this, array('siswa_id' => $this->session->userdata('user_id')));
		};
	}

	public function datadownload()
	{
		$walikelas = $this->db->get_where('ms_kelas', ["wali_user_id" => $this->session->userdata('user_id')]); //cek wali kelas
		$this->db->select("siswa.*,
						   users.user_email as user_email,
						   users.user_nama as user_nama,
						   ms_kelas.kelas_nama as kelas_nama,
						   app_agama.agama_keterangan as agama_keterangan,
						   app_tempattinggal.tempattinggal_keterangan as tempattinggal_keterangan,
						   app_transportasi.transportasi_keterangan as transportasi_keterangan,
						   pd_ayah.pendidikan_nama as pd_ayah,
						   pk_ayah.pekerjaan_keterangan as pk_ayah,
						   ph_ayah.penghasilan_keterangan as ph_ayah,
						   pd_ibu.pendidikan_nama as pd_ibu,
						   pk_ibu.pekerjaan_keterangan as pk_ibu,
						   ph_ibu.penghasilan_keterangan as ph_ibu,
						   pd_wali.pendidikan_nama as pd_wali,
						   pk_wali.pekerjaan_keterangan as pk_wali,
						   ph_wali.penghasilan_keterangan as ph_wali,
						   ");
		$this->db->from("siswa");
		$this->db->join('users', 'users.user_id = siswa.siswa_id', 'right');
		$this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.siswa_id', 'left');
		$this->db->join('ms_kelas', 'ms_kelas.kelas_id = kelas_siswa.kelas_id', 'left');
		$this->db->join('app_agama', 'app_agama.agama_id = siswa.siswa_agama', 'left');
		$this->db->join('app_tempattinggal', 'app_tempattinggal.tempattinggal_id = siswa.siswa_jenistinggal', 'left');
		$this->db->join('app_transportasi', 'app_transportasi.transportasi_id = siswa.siswa_alattransport', 'left');
		$this->db->join('app_pendidikan pd_ayah', 'pd_ayah.pendidikan_id = siswa.siswa_pendidikan_ayah', 'left');
		$this->db->join('app_pekerjaan pk_ayah', 'pk_ayah.pekerjaan_id = siswa.siswa_pekerjaan_ayah', 'left');
		$this->db->join('app_penghasilan ph_ayah', 'ph_ayah.penghasilan_id = siswa.siswa_penghasilan_ayah', 'left');
		$this->db->join('app_pendidikan pd_ibu', 'pd_ibu.pendidikan_id = siswa.siswa_pendidikan_ibu', 'left');
		$this->db->join('app_pekerjaan pk_ibu', 'pk_ibu.pekerjaan_id = siswa.siswa_pekerjaan_ibu', 'left');
		$this->db->join('app_penghasilan ph_ibu', 'ph_ibu.penghasilan_id = siswa.siswa_penghasilan_ibu', 'left');
		$this->db->join('app_pendidikan pd_wali', 'pd_wali.pendidikan_id = siswa.siswa_pendidikan_wali', 'left');
		$this->db->join('app_pekerjaan pk_wali', 'pk_wali.pekerjaan_id = siswa.siswa_pekerjaan_wali', 'left');
		$this->db->join('app_penghasilan ph_wali', 'ph_wali.penghasilan_id = siswa.siswa_penghasilan_wali', 'left');
		$this->db->where('users.user_type', 2);
		$this->db->where('siswa.siswa_status', 1); //siswa status 1 = aktif, 0= tidak aktif
		if ($walikelas->num_rows() != 0) {
			$this->db->where('ms_kelas.wali_user_id', $this->session->userdata('user_id'));
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("product_id" => $id));
	}
}
