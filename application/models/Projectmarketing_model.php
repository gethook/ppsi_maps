<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectmarketing_model extends CI_Model {

	public function get($project_marketing_id='')
	{
		$this->db->select('project_marketing.*, project.*, user.*');
		$this->db->from('project_marketing');
		$this->db->join('project', 'project_marketing.project_id = project.project_id', 'left');
		$this->db->join('user', 'project_marketing.user_id = user.user_id', 'left');

		if ($project_marketing_id == '')
		{
			$query = $this->db->get();
			return $query->result_array();
		}
		else
		{
			$this->db->where('project_marketing.project_marketing_id', $project_marketing_id);
			$query = $this->db->get();
			return $query->row_array();
		}
		
	}

	public function get_by_project($project_id='')
	{
		$this->db->select('project_marketing.*, project.*, user.*');
		$this->db->from('project_marketing');
		$this->db->join('project', 'project_marketing.project_id = project.project_id', 'left');
		$this->db->join('user', 'project_marketing.user_id = user.user_id', 'left');

		$this->db->where('project_marketing.project_id', $project_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_marketing($user_id='')
	{
		$this->db->select('project_marketing.*, project.*, user.*');
		$this->db->from('project_marketing');
		$this->db->join('project', 'project_marketing.project_id = project.project_id', 'left');
		$this->db->join('user', 'project_marketing.user_id = user.user_id', 'left');

		$this->db->where('project_marketing.user_id', $user_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function available_marketing($project_id='')
	{
		$this->db->select('user.*, project_marketing.project_marketing_id, project_marketing.project_id');
		$this->db->from('user');
		$this->db->join('user_role', 'user.user_id = user_role.user_id', 'left');
		$this->db->join('project_marketing', 'user.user_id = project_marketing.user_id AND project_marketing.project_id = ' . $project_id, 'left');
		$this->db->where('user_role.role_id', 6);
		$this->db->where('(project_marketing.project_id != ' . $project_id . ' OR project_marketing.project_id IS NULL)');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function add_batch($data='')
	{
		return $this->db->insert_batch('project_marketing', $data);
	}

	public function delete($project_marketing_id='')
	{
		$this->db->where('project_marketing_id', $project_marketing_id);
		return $this->db->delete('project_marketing');
	}

	public function get_project($project_marketing_id='')
	{
		$this->db->select('project.*');
		$this->db->from('project_marketing');
		$this->db->join('project', 'project_marketing.project_id = project.project_id', 'left');
		$this->db->where('project_marketing.project_marketing_id', $project_marketing_id);
		$query = $this->db->get();
		return $query->row_array();
	}

}

/* End of file Projectmarketing_model.php */
/* Location: ./application/models/Projectmarketing_model.php */