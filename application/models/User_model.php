<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function get($user_id='')
	{
		if ($user_id == '') {
			$this->db->select('user.*, gender.gender_code, gender.gender_name');
			$this->db->from('user');
			$this->db->join('gender', 'user.gender_id = gender.gender_id', 'left');
			$query = $this->db->get();
			return $query->result_array();
			# code...
		} else {
			$this->db->select('user.*, gender.gender_code, gender.gender_name');
			$this->db->from('user');
			$this->db->join('gender', 'user.gender_id = gender.gender_id', 'left');
			$this->db->where('user.user_id', $user_id);
			$query = $this->db->get();
			return $query->row_array();
		}
	}

	public function add($data='')
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	public function edit($data='', $id='')
	{
		$this->db->where('user_id', $id);
		$this->db->update('user', $data);
	}

	public function add_user_role($data='')
	{
		$this->db->insert('user_role', $data);
		return $this->db->insert_id();
	}

	public function get_gender()
	{
		$query = $this->db->get('gender');
		return $query->result_array();
	}

	public function get_user_roles($user_id='')
	{
		$this->db->select('user_role.*, role.role, role.role_type_id, role_type.role_type_name, developer.*');
		$this->db->from('user_role');
		$this->db->join('role', 'user_role.role_id = role.role_id', 'left');
		$this->db->join('role_type', 'role.role_type_id = role_type.role_type_id', 'left');
		$this->db->join('developer_team', 'user_role.user_role_id = developer_team.user_role_id', 'left');
		$this->db->join('developer', 'developer_team.developer_id = developer.developer_id', 'left');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('user_role.user_role_id', 'asc');
		$query = $this->db->get();
		//$query = $this->db->get_where('user_role', array('user_id' => $user_id));
		return $query->result_array();
	}

	public function add_dev_role($ur_data='', $developer_id)
	{
		$this->db->trans_start();
		$user_role_id = $this->add_user_role($ur_data);
		$developer_team_data = array(
			'user_role_id' => $user_role_id,
			'developer_id' => $developer_id
		);
		$this->db->insert('developer_team', $developer_team_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function rm_dev_role($user_role_id='')
	{
		$this->db->trans_start();
		$this->db->where('user_role_id', $user_role_id);
		$this->db->delete('user_role');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function get_by_role($role_id='')
	{
		$this->db->select('user.*');
		$this->db->from('user_role');
		$this->db->join('user', 'user.user_id = user_role.user_id', 'left');
		$this->db->where('user_role.role_id', $role_id);
		$query = $this->db->get();
		return $query->result_array();
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */