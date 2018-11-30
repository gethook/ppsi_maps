<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developer_model extends CI_Model {

	public function get($developer_id='')
	{
		if ($developer_id == '') {
			//$query = $this->db->get('developer');
			$this->db->select('developer.*, ownership.ownership_code, ownership.ownership_name');
			$this->db->from('developer');
			$this->db->join('ownership', 'developer.ownership_id = ownership.ownership_id', 'left');
			$query = $this->db->get();
			return $query->result_array();
		} else {
			$this->db->select('developer.*, ownership.ownership_code, ownership.ownership_name');
			$this->db->from('developer');
			$this->db->join('ownership', 'developer.ownership_id = ownership.ownership_id', 'left');
			$this->db->where('developer_id', $developer_id);
			//$query = $this->db->get_where('developer', array('developer_id' => $developer_id));
			$query = $this->db->get();
			return $query->row_array();
		}
	}

	public function get_by_user_id($uid='')
	{
		$this->db->select('developer.*');
		$this->db->from('developer');
		$this->db->join('developer_team', 'developer.developer_id = developer_team.developer_id', 'left');
		$this->db->join('user_role', 'developer_team.user_role_id = user_role.user_role_id', 'left');
		$this->db->where('user_role.user_id', $uid);

		$query = $this->db->get();
		$result = $query->row_array();
		$developer_id = $result['developer_id'];
		return $this->get($developer_id);

		//return $query->row_array();
	}

	public function add($data='')
	{
		$this->db->insert('developer', $data);
		return $this->db->insert_id();
	}

	public function edit($data='', $id='')
	{
		$this->db->where('developer_id', $id);
		$this->db->update('developer', $data);
	}
}

/* End of file Developer_model.php */
/* Location: ./application/models/Developer_model.php */