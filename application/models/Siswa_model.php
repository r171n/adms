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
		$this->siswa_agama = $post["siswa_agama"];

		return $this->db->insert($this->_table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->product_id = $post["id"];
		$this->name = $post["name"];
		$this->price = $post["price"];
		$this->description = $post["description"];
		return $this->db->update($this->_table, $this, array('product_id' => $post['id']));
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("product_id" => $id));
	}
}
