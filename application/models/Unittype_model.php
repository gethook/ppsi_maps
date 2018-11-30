<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unittype_model extends CI_Model {

	public function get($unit_type_id='')
	{
		if ($unit_type_id == '') {
			$query = $this->db->get('unit_type');
			return $query->result_array();
		} else {
			$query = $this->db->get_where('unit_type', array('unit_type_id' => $unit_type_id));
			return $query->row_array();
		}
		
	}

	public function get_by_project($project_id='')
	{
		$this->db->select('unit_type.*');
		$this->db->from('unit_type');
		$this->db->where('unit_type.project_id', $project_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_project($unit_type_id='')
	{
		$this->db->select('project.*');
		$this->db->from('unit_type');
		$this->db->join('project', 'unit_type.project_id = project.project_id', 'left');
		$this->db->where('unit_type.unit_type_id', $unit_type_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_units($unit_type_id='')
	{
		$this->db->select('unit.*');
		$this->db->from('unit_type');
		$this->db->join('unit_type_choice', 'unit_type.unit_type_id = unit_type_choice.unit_type_id', 'left');
		$this->db->join('unit', 'unit.unit_id = unit_type_choice.unit_id', 'left');
		$this->db->where('unit_type.unit_type_id', $unit_type_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function price_choices($unit_type_id='')
	{
		$this->db->select('price_choice.*, unit_type.project_id');
		$this->db->from('unit_type');
		$this->db->join('price_choice', 'unit_type.unit_type_id = price_choice.unit_type_id', 'left');
		$this->db->where('unit_type.unit_type_id', $unit_type_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($data='')
	{
		$this->db->insert('unit_type', $data);
		return $this->db->insert_id();
	}

	public function edit($data='', $unit_type_id='')
	{
		$this->db->where('unit_type_id', $unit_type_id);
		return $this->db->update('unit_type', $data);
	}

	public function delete($unit_type_id='')
	{
		$this->db->where('unit_type_id', $unit_type_id);
		return $this->db->delete('unit_type');		
	}

}

/* End of file Unittype_model.php */
/* Location: ./application/models/Unittype_model.php */