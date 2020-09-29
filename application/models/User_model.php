<?php

class User_model extends CI_Model
{

	private $table = 'users'; //nama tabel dari database
	var $column_order = array(null, 'user_nama', 'user_email', 'user_type', 'user_lastlogin'); //field yang ada di table user
	var $column_search = array('user_nama', 'user_email', 'user_type', 'user_lastlogin'); //field yang diizin untuk pencarian 
	var $order = array('user_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table);

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

	private $_table = "users";

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["user_id" => $id]);
	}

	public function getByUsername($username)
	{
		return $this->db->get_where($this->_table, ["user_nama" => $username]);
	}

	public function save()
	{
		$post = $this->input->post();
		$this->user_nama = $post["user_nama"];
		$this->user_email = $post["user_email"];
		$this->user_password = password_hash($post["user_password"], PASSWORD_DEFAULT);
		$this->user_type = $post["user_type"];
		$this->user_status = 1;
		$this->user_created_by = $this->session->userdata('user_id');
		$this->user_created_at = (date("Y-m-d H:m:s", time()));
		return $this->db->insert($this->_table, $this);
	}

	public function update()
	{
		$post = $this->input->post();


		if (isset($_POST['ganti_password'])) {
			$this->user_email = $post["user_email"];
			$this->user_password = password_hash($post["user_password"], PASSWORD_DEFAULT);
			$this->user_type = $post["user_type"];
			$this->user_status = 1;
			$this->user_updated_by = $this->session->userdata('user_id');
			$this->user_updated_at = date("Y-m-d H:m:s", time());
		} else {
			$this->user_email = $post["user_email"];
			// $this->user_password = password_hash($post["user_password"], PASSWORD_DEFAULT);
			$this->user_type = $post["user_type"];
			$this->user_status = 1;
			$this->user_updated_by = $this->session->userdata('user_id');
			$this->user_updated_at = date("Y-m-d H:m:s", time());
		}
		return $this->db->update($this->_table, $this, array('user_id' => $post["user_id"]));
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("user_id" => $id));
	}
}
