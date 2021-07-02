<?php

class Mata_pelajaran_model extends CI_Model
{
	private $table = 'ms_mata_pelajaran'; //nama tabel dari database
	var $column_order = array(null, 'ms_mata_pelajaran.mata_pelajaran_nama', 'ms_mata_pelajaran.mata_pelajaran_kode', 'tingkat_nama','ms_mata_pelajaran.mata_pelajaran_kkm'); //field yang ada di table mata pelajaran
	var $column_search = array('ms_mata_pelajaran.mata_pelajaran_nama', 'ms_mata_pelajaran.mata_pelajaran_kode','tingkat_nama', 'ms_mata_pelajaran.mata_pelajaran_kkm'); //field yang diizin untuk pencarian 
	var $order = array('ms_mata_pelajaran.mata_pelajaran_nama' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select("*");
		$this->db->from("ms_mata_pelajaran");
		$this->db->join('ms_tingkat', 'ms_tingkat.tingkat_id = ms_mata_pelajaran.mata_pelajaran_tingkat_id', 'left');

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
		return $this->db->get_where($this->table, ["mata_pelajaran_id" => $id]);
	}

	public function getByTingkat($id)
	{
		return $this->db->get_where($this->table, ["mata_pelajaran_tingkat_id" => $id]);
	}

	public function getBykode($kode)
	{
		return $this->db->get_where($this->table, ["mata_pelajaran_kode" => $kode]);
	}

	public function getBykodenId($kode,$mata_pelajaran_id)
	{
		return $this->db->get_where($this->table, ["mata_pelajaran_kode" => $kode,"mata_pelajaran_id !=" => $mata_pelajaran_id]);
	}

	public function save()
	{
		$post = $this->input->post();
		$this->mata_pelajaran_nama = $post["mata_pelajaran_nama"];
		$this->mata_pelajaran_kode = $post["mata_pelajaran_nama"];
		$this->mata_pelajaran_tingkat_id = $post["tingkat_id"];
		$this->mata_pelajaran_kode = $post["mata_pelajaran_kode"];
		$this->mata_pelajaran_kkm = $post["mata_pelajaran_kkm"];
		$this->mata_pelajaran_created_by = $this->session->userdata('user_id');
		$this->mata_pelajaran_created_at = (date("Y-m-d H:m:s", time()));
		return $this->db->insert($this->table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->mata_pelajaran_nama = $post["mata_pelajaran_nama"];
		$this->mata_pelajaran_kode = $post["mata_pelajaran_kode"];
		$this->mata_pelajaran_tingkat_id = $post["tingkat_id"];
		$this->mata_pelajaran_kkm = $post["mata_pelajaran_kkm"];
		$this->mata_pelajaran_updated_by = $this->session->userdata('user_id');
		$this->mata_pelajaran_updated_at = date("Y-m-d H:m:s", time());
		return $this->db->update($this->table, $this, array('mata_pelajaran_id' => $post["mata_pelajaran_id"]));
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, array("product_id" => $id));
	}
}
