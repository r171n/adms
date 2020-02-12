<?php

class Menu_model extends CI_Model
{
	public $table_name = 'ms_menu';

	public function get()
	{
		$this->db->select('*');
	  $this->db->from($this->table_name);
	  $this->db->join('ms_group_akses','ms_menu.mn_id = ms_group_akses.mn_id');
	  $this->db->join('ms_group.ms_group_akses.group_id = ms_group.group_id');
	  $this->db->join('ms_user_group,ms_group.group_id = ms_user_group.group_id');
	  $this->db->where('ms_user_group.user_id',$this->session->userdata('user_id'));
		$query = $this->db->get();
		return $query->result();
	}

	public function akses($link)
	{
	  $this->db->select('*');
	  $this->db->from($this->table_name);
	  $this->db->join('ms_group_akses','ms_menu.mn_id = ms_group_akses.mn_id');
	  $this->db->join('ms_group','ms_group_akses.group_id = ms_group.group_id');
	  $this->db->join('ms_user_group','ms_group.group_id = ms_user_group.group_id');
	  $this->db->where('ms_user_group.user_id',$this->session->userdata('user_id'));
	  $this->db->where('ms_menu.mn_url',$link);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
