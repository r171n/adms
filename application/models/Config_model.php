<?php

class Config_model extends CI_Model
{
	private $_table = "config";

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["cf_id" => $id]);
	}

	public function save()
	{
		$post = $this->input->post();
		$this->cf_id = 1;
		$this->cf_nama = $post["cf_nama"];
		$this->cf_alamat = $post["cf_alamat"];
		$this->cf_telephone = $post["cf_telephone"];
		$this->cf_email = $post["cf_email"];
		$this->cf_logo = $post["cf_logo"];
		$this->cf_logo = $post["cf_kop_sekolah"];
		$this->cf_created_by = $this->session->userdata('user_id');
		$this->cf_created_at = (date("Y-m-d H:m:s", time()));
		return $this->db->insert($this->_table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		if (empty($_FILES['cf_logo']['name'])) {
			$this->cf_nama = $post["cf_nama"];
			$this->cf_alamat = $post["cf_alamat"];
			$this->cf_telephone = $post["cf_telephone"];
			$this->cf_email = $post["cf_email"];
			$this->cf_nama_kepala_sekolah = $post["cf_nama_kepala_sekolah"];
			$this->cf_nip_kepala_sekolah = $post["cf_nip_kepala_sekolah"];
			$this->cf_updated_by = $this->session->userdata('user_id');
			$this->cf_updated_at = date("Y-m-d H:m:s", time());
			//return $this->db->update($this->_table, $this, array('cf_id' => 1));
			if (empty($_FILES['cf_kop_sekolah']['name'])) {
				return $this->db->update($this->_table, $this, array('cf_id' => 1));
			} else {
				$config['upload_path'] = "./app-assets/images/kop";
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '2048';
				$config['overwrite'] = true;
				$config['file_name'] = "kop";
	
				$this->load->library('upload', $config);
				if ($this->upload->do_upload("cf_kop_sekolah")) {
					$data = array('upload_data' => $this->upload->data());
					// $this->cf_nama = $post["cf_nama"];
					// $this->cf_alamat = $post["cf_alamat"];
					// $this->cf_telephone = $post["cf_telephone"];
					// $this->cf_email = $post["cf_email"];
					$this->cf_kop_sekolah = $data['upload_data']['file_name'];
					$this->cf_updated_by = $this->session->userdata('user_id');
					$this->cf_updated_at = date("Y-m-d H:m:s", time());
					return $this->db->update($this->_table, $this, array('cf_id' => 1));
				}
			}
		} else {
			$config['upload_path'] = "./app-assets/images/logo";
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['overwrite'] = true;
			$config['file_name'] = "logo";

			$this->load->library('upload', $config);
			if ($this->upload->do_upload("cf_logo")) {
				$data = array('upload_data' => $this->upload->data());
				$this->cf_nama = $post["cf_nama"];
				$this->cf_alamat = $post["cf_alamat"];
				$this->cf_telephone = $post["cf_telephone"];
				$this->cf_email = $post["cf_email"];
				$this->cf_nama_kepala_sekolah = $post["cf_nama_kepala_sekolah"];
				$this->cf_nip_kepala_sekolah = $post["cf_nip_kepala_sekolah"];
				$this->cf_logo = $data['upload_data']['file_name'];
				$this->cf_updated_by = $this->session->userdata('user_id');
				$this->cf_updated_at = date("Y-m-d H:m:s", time());
				if (empty($_FILES['cf_kop_sekolah']['name'])) {
					return $this->db->update($this->_table, $this, array('cf_id' => 1));
				} else {
					//unset($config);
					$config['upload_path'] = "./app-assets/images/kop";
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = '2048';
					$config['overwrite'] = true;
					$config['file_name'] = "kop";

					$this->upload->initialize($config);
					$this->load->library('upload', $config);
					if ($this->upload->do_upload("cf_kop_sekolah")) {
						$data = array('upload_data2' => $this->upload->data());
						$this->cf_kop_sekolah = $data['upload_data2']['file_name'];
						return $this->db->update($this->_table, $this, array('cf_id' => 1));
					}
				}
			}
		}
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("product_id" => $id));
	}
}
