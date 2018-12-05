<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectsurvey_model extends CI_Model {

	public function get($project_survey_id='')
	{
		$this->db->select('project_survey.*, project.project_name, customer.customer_name, user.full_name');
		$this->db->from('project_survey');
		$this->db->join('project', 'project_survey.project_id = project.project_id', 'left');
		$this->db->join('customer', 'project_survey.customer_id = customer.customer_id', 'left');
		$this->db->join('user', 'project_survey.created_by = user.user_id', 'left');
		if ($project_survey_id)
		{
			$this->db->where('project_survey.project_survey_id', $project_survey_id);
			$query = $this->db->get();
			return $query->row_array();
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_marketing($created_by='')
	{
		$this->db->select('project_survey.*, project.project_name, customer.*, user.full_name');
		$this->db->from('project_survey');
		$this->db->join('project', 'project_survey.project_id = project.project_id', 'left');
		$this->db->join('customer', 'project_survey.customer_id = customer.customer_id', 'left');
		$this->db->join('user', 'project_survey.created_by = user.user_id', 'left');
		$this->db->where('project_survey.created_by', $created_by);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_project($project_id='')
	{
		$this->db->select('project_survey.*, project.project_name, customer.customer_name, user.full_name');
		$this->db->from('project_survey');
		$this->db->join('project', 'project_survey.project_id = project.project_id', 'left');
		$this->db->join('customer', 'project_survey.customer_id = customer.customer_id', 'left');
		$this->db->join('user', 'project_survey.created_by = user.user_id', 'left');
		$this->db->where('project_survey.project_id', $project_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_developer($developer_id='')
	{
		$projects = $this->get_project_by_dev($developer_id);		
		$project_ids = array_column($projects, 'project_id');
		if (!$projects)
		{
			$project_ids = array(-1);
		}
		$this->db->select('project_survey.*, project.project_name, customer.*, user.full_name');
		$this->db->from('project_survey');
		$this->db->join('project', 'project_survey.project_id = project.project_id', 'left');
		$this->db->join('customer', 'project_survey.customer_id = customer.customer_id', 'left');
		$this->db->join('user', 'project_survey.created_by = user.user_id', 'left');
		$this->db->where_in('project_survey.project_id', $project_ids);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_date($start='', $end='')
	{
		$this->db->select('project_survey.*, project.project_name, customer.customer_name, user.full_name');
		$this->db->from('project_survey');
		$this->db->join('project', 'project_survey.project_id = project.project_id', 'left');
		$this->db->join('customer', 'project_survey.customer_id = customer.customer_id', 'left');
		$this->db->join('user', 'project_survey.created_by = user.user_id', 'left');
		if ($start) $this->db->where('project_survey.project_survey_date >=', $start);
		if ($end) $this->db->where('project_survey.project_survey_date <=', $end);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($data='')
	{
		return $this->db->insert('project_survey', $data);
	}

	public function edit($data='', $project_survey_id)
	{
		$this->db->where('project_survey_id', $project_survey_id);
		return $this->db->update('project_survey', $data);
	}

	private function get_project_by_dev($developer_id='')
	{
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('developer_id', $developer_id);
		$query = $this->db->get();
		return $query->result_array();
	}

}

/* End of file Projectsurvey_model.php */
/* Location: ./application/models/Projectsurvey_model.php */