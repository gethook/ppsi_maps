<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

	public function get_by_project($project_id='')
	{
		$this->db->select('unit.*, status_unit.status_unit_name');
		$this->db->from('unit');
		$this->db->join('status_unit', 'unit.status_unit_id = status_unit.status_unit_id', 'left');
		$this->db->where('unit.project_id', $project_id);
		$query = $this->db->get();
		$results = $query->result_array();
		if (count($results) > 0) {
			for ($i=0; $i < count($results); $i++) { 
				$unit_types = $this->get_types($results[$i]['unit_id']);
				if (count($unit_types) > 0) {
					$results[$i]['unit_types'] = $unit_types;
					$results[$i]['lowest_price'] = $unit_types[0]['price'];
				}
			}
		}
		array_multisort(array_column($results, 'lowest_price'));

		return $results;
	}

	public function add($data='')
	{
		$this->db->insert('unit', $data);
		return $this->db->insert_id();
	}

	public function add_batch($data='')
	{
		return $this->db->insert_batch('unit', $data);
	}

	public function edit($data='', $unit_id='')
	{
		$this->db->where('unit_id', $unit_id);
		$this->db->update('unit', $data);
	}

	public function delete($unit_id='')
	{
		$this->db->where('unit_id', $unit_id);
		return $this->db->delete('unit');
	}

	public function get_types($unit_id='')
	{
		$this->db->select('unit_type.*,');
		$this->db->from('unit');
		$this->db->join('unit_type_choice', 'unit.unit_id = unit_type_choice.unit_id', 'left');
		$this->db->join('unit_type', 'unit_type_choice.unit_type_id = unit_type.unit_type_id', 'left');
		$this->db->where('unit.unit_id', $unit_id);
		$this->db->order_by('unit_type.price', 'asc');

		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_project($unit_id='')
	{
		$this->db->select('project.*');
		$this->db->from('unit');
		$this->db->join('project', 'unit.project_id = project.project_id', 'left');
		$this->db->where('unit.unit_id', $unit_id);
		$query = $this->db->get();
		return $query->row_array();
	}

}

/* End of file Unit_model.php */
/* Location: ./application/models/Unit_model.php */