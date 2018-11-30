<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function cek_dev_owner($user_id='', $developer_id)
	{
		$where = array(
			'user_role.user_id' => $user_id,
			'developer_team.developer_id' => $developer_id,
			'user_role.role_id' => 2,
		);
		$this->db->select('user_role.*');
		$this->db->from('user_role');
		$this->db->join('developer_team', 'user_role.user_role_id = developer_team.user_role_id', 'left');
		$this->db->where($where);
		$query = $this->db->get();
		//return $query->result_array();
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}

	public function cek_dev_team($user_id='', $developer_id)
	{
		$where = array(
			'user_role.user_id' => $user_id,
			'developer_team.developer_id' => $developer_id,
		);
		$this->db->select('user_role.*');
		$this->db->from('user_role');
		$this->db->join('developer_team', 'user_role.user_role_id = developer_team.user_role_id', 'left');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */