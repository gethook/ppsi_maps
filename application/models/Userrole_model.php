<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userrole_model extends CI_Model {

	public function get($id='')
	{
		if ($id == '') {
			$query = $this->db->get('user_role');
			return $query->result_array();
		} else {
			$query = $this->db->get_where('user_role', array('user_role_id' => $id));
			return $query->row_array();
		}
	}

	public function get_by_devteam($user_id='', $developer_id='')
	{
		$this->db->select('user_role.*, developer_team.developer_id');
		$this->db->from('user_role');
		$this->db->join('developer_team', 'user_role.user_role_id = developer_team.user_role_id', 'left');
		$this->db->where(array(
			'developer_team.developer_id' => $developer_id,
			'user_role.user_id' => $user_id
		));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function add($data='')
	{
		$this->db->insert('user_role', $data);
		return $this->db->insert_id();
	}

	public function get_by_user_id($user_id='')
	{
		$query = $this->db->get_where('user_role', array('user_id' => $user_id));
		return $query->result_array();

	}

	public function edit($data='', $id='')
	{
		$this->db->where('user_role_id', $id);
		$this->db->update('user_role', $data);
	}

}

/* End of file Userroles_model.php */
/* Location: ./application/models/Userroles_model.php */