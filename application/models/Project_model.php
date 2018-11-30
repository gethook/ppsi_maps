<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	public function get($project_id='')
	{
		if ($project_id == '')
		{
			$query = $this->db->get('project');
			return $query->result_array();
		}
		else
		{
			$query = $this->db->get_where('project', array('project_id' => $project_id));
			return $query->row_array();
			// $this->db->where('project_id', $project_id);
			// $query = $this->db->get('project');
			// return $query->row_array();
		}
	}

	public function get_by_dev($developer_id='')
	{
		$this->db->select('project.*, developer.developer_name, area.area_name, status_unit.status_unit_name');
		$this->db->from('project');
		$this->db->join('developer', 'project.developer_id = developer.developer_id', 'left');
		$this->db->join('area', 'project.area_id = area.area_id', 'left');
		$this->db->join('status_unit', 'project.status_unit_id = status_unit.status_unit_id', 'left');
		$this->db->where('project.developer_id', $developer_id);
		$this->db->order_by('project.status_unit_id ASC, project.project_id ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($data='')
	{
		$this->db->insert('project', $data);
		return $this->db->insert_id();
	}

	public function edit($data='', $id='')
	{
		$this->db->where('project_id', $id);
		$this->db->update('project', $data);
	}

	public function delete($id)
	{
		$this->db->where('project_id', $id);
		return $this->db->delete('project');
	}

	public function get_lowest_price($project_id='')
	{
		$this->db->select('min(unit_type.price) as lowest_price');
		$this->db->from('unit_type');
		$this->db->join('project', 'unit_type.project_id = project.project_id', 'left');
		$this->db->where('unit_type.project_id', $project_id);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result['lowest_price'];
	}

}

/* End of file Project_model.php */
/* Location: ./application/models/Project_model.php */