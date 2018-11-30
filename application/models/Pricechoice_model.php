<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricechoice_model extends CI_Model {

	public function get($price_choice_id='')
	{
		if ($price_choice_id == '') {
			$query = $this->db->get('price_choice');
			return $query->result_array();
		} else {
			$this->db->where('price_choice_id', $price_choice_id);
			$query = $this->db->get('price_choice');
			return $query->row_array();
		}
		return FALSE;
	}

	public function get_by_unit_type($unit_type_id='')
	{
		$this->db->select('price_choice.*, unit_type.project_id');
		$this->db->from('price_choice');
		$this->db->join('unit_type', 'price_choice.unit_type_id = unit_type.unit_type_id', 'left');
		$this->db->where('unit_type.unit_type_id', $unit_type_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_project($price_choice_id)
	{
		$this->db->select('project.*');
		$this->db->from('price_choice');
		$this->db->join('unit_type', 'price_choice.unit_type_id = unit_type.unit_type_id', 'left');
		$this->db->join('project', 'unit_type.project_id = project.project_id', 'left');
		$this->db->where('price_choice.price_choice_id', $price_choice_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function tambah($data='')
	{
		$this->db->insert('price_choice', $data);
		return $this->db->insert_id();
	}

	public function edit($data='', $id='')
	{
		$this->db->where('price_choice_id', $id);
		$this->db->update('price_choice', $data);
	}

	public function delete($id)
	{
		$this->db->where('price_choice_id', $id);
		return $this->db->delete('price_choice');
	}

}

/* End of file Pricechoice_model.php */
/* Location: ./application/models/Pricechoice_model.php */