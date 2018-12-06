<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devteam_model extends CI_Model {

	public function get($id='')
	{
		if ($id == '') {
			$query = $this->db->get('developer_team');
			return $query->result_array();
		} else {
			$query = $this->db->get_where('developer_team', array('developer_team_id' => $id));
			return $query->row_array();
		}
	}

	public function get_by_user_role_id($user_role_id='')
	{
		$query = $this->db->get_where('developer_team', array('user_role_id' => $user_role_id));
		return $query->row_array();
	}

	public function get_available_operator()
	{
		$this->db->select('*');
		$this->db->from('user_role');
		$this->db->join('developer_team', 'user_role.user_role_id = developer_team.user_role_id', 'left');
		$this->db->join('user', 'user_role.user_id = user.user_id', 'left');
		$this->db->where('user_role.role_id', 3);
		$this->db->where('developer_team.user_role_id IS NULL');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_user_id($user_id='')
	{
		$this->db->select('developer_team.*');
		$this->db->from('developer_team');
		$this->db->join('user_role', 'developer_team.user_role_id = user_role.user_role_id', 'left');
		$this->db->where('user_role.user_id', $user_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_by_dev($developer_id='')
	{
		$this->db->select('developer_team.*, user_role.*, user.full_name, user.phone, user.email, role.role');
		$this->db->from('developer_team');
		//$this->db->join('user', 'developer_team.user_id = user.user_id', 'left');
		$this->db->join('user_role', 'developer_team.user_role_id = user_role.user_role_id', 'left');
		$this->db->join('user', 'user_role.user_id = user.user_id', 'left');
		$this->db->join('role', 'user_role.role_id = role.role_id', 'left');
		$this->db->where('developer_team.developer_id', $developer_id);
		$this->db->order_by('user_role.role_id', 'asc');
		$query = $this->db->get();
		//$query = $this->db->get_where('developer_team', array('developer_id' => $developer_id));
		return $query->result_array();
	}

	public function add($data='')
	{
		$this->db->insert('developer_team', $data);
		return $this->db->insert_id();
	}

	public function edit($data='', $id='')
	{
		$this->db->where('developer_team_id', $id);
		$this->db->update('developer_team', $data);
	}

}

/* End of file Devteam_model.php */
/* Location: ./application/models/Devteam_model.php */