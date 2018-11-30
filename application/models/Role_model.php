<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

	public function get($role_id='')
	{
		if ($role_id == '') {
			$query = $this->db->get('role');
			return $query->result_array();
		} else {
			$query = $this->db->get_where('role', array('role_id' => $role_id));
			return $query->row_array();
		}
	}

	public function get_op()
	{
		$this->db->select('role.*, role_type.role_type_name');
		$this->db->from('role');
		$this->db->join('role_type', 'role.role_type_id = role_type.role_type_id', 'left');
		$this->db->where(array('left(role,5) !=' => 'Owner', 'role.role_type_id >' => 1));
		$query = $this->db->get();

		return $query->result_array();
	}

}

/* End of file Role_model.php */
/* Location: ./application/models/Role_model.php */