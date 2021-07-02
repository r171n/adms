<?php

class Jadwal_model extends CI_Model
{
	private $table = 'ms_jadwal'; //nama tabel dari database
	var $column_order = array(null, 'ms_kelas.kelas_nama', 'ms_mata_pelajaran.mata_pelajaran_nama', 'app_hari.hari_id', 'ms_jam_pelajaran.jam_pelajaran_nama','ms_jadwal.jadwal_jumlah_jam', 'users.user_email'); //field yang ada di table user
	var $column_search = array('ms_kelas.kelas_nama', 'ms_mata_pelajaran.mata_pelajaran_nama', 'app_hari.hari_id', 'users.user_email'); //field yang diizin untuk pencarian 
	var $order = array('ms_kelas.kelas_id' => 'asc', 'app_hari.hari_id' => 'asc', 'ms_jam_pelajaran.jam_pelajaran_nama' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select("*");
		$this->db->from("ms_jadwal");
		$this->db->join('ms_kelas', 'ms_kelas.kelas_id = ms_jadwal.jadwal_kelas_id', 'left');
		$this->db->join('ms_jam_pelajaran', 'ms_jam_pelajaran.jam_pelajaran_id = ms_jadwal.jadwal_jam_pelajaran_id', 'left');
		$this->db->join('app_hari', 'app_hari.hari_id = ms_jam_pelajaran.jam_pelajaran_hari_id', 'left');
		$this->db->join('ms_mata_pelajaran', 'ms_mata_pelajaran.mata_pelajaran_id = ms_jadwal.jadwal_mata_pelajaran_id	', 'left');
		$this->db->join('users', 'users.user_id = ms_jadwal.jadwal_guru_id', 'left');
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

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getAll()
	{
		return $this->db->get($this->table)->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->table, ["kelas_id" => $id]);
	}

	public function getBynama($nama)
	{
		return $this->db->get_where($this->table, ["kelas_nama" => $nama]);
	}

	public function save()
	{
		$post = $this->input->post();
		$this->jadwal_mata_pelajaran_id = $post["jadwal_mata_pelajaran_id"];
		$this->jadwal_guru_id = $post["jadwal_guru_id"];
		$this->jadwal_kelas_id = $post["jadwal_kelas_id"];
		$this->jadwal_jam_pelajaran_id = $post["jadwal_jam_pelajaran_id"];
		$this->jadwal_jumlah_jam = $post["jadwal_jumlah_jam"];
		$this->jadwal_created_by = $this->session->userdata('user_id');
		$this->jadwal_created_at = (date("Y-m-d H:m:s", time()));
		return $this->db->insert($this->table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->kelas_nama = $post["kelas_nama"];
		$this->kelas_kode = $post["kelas_nama"];
		$this->tingkat_id = $post["tingkat_id"];
		$this->jurusan_id = $post["jurusan_id"];
		$this->wali_user_id = $post["wali_user_id"];
		$this->kelas_updated_by = $this->session->userdata('user_id');
		$this->kelas_updated_at = date("Y-m-d H:m:s", time());
		return $this->db->update($this->table, $this, array('kelas_id' => $post["kelas_id"]));
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, array("product_id" => $id));
	}
}
