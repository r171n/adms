<?php

class Siswa_model extends CI_Model
{
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
		$this->siswa_jeniskelamin = $post["siswa_jeniskelamin"];
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
		$this->siswa_id = $this->session->userdata('user_id');
		$this->siswa_nama = $post["siswa_nama"];
		$this->siswa_jeniskelamin = $post["siswa_jeniskelamin"];
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
		return $this->db->update($this->_table, $this, array('siswa_id' => $this->session->userdata('user_id')));
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("product_id" => $id));
	}
}
