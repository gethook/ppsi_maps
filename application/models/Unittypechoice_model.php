<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unittypechoice_model extends CI_Model {

	public function add($data='')
	{
		$this->db->insert('unit_type_choice', $data);
		return $this->db->insert_id();
	}

	public function add_batch($data='')
	{
		return $this->db->insert_batch('unit_type_choice', $data);
	}

	public function delete($column='', $value='')
	{
		$this->db->where($column, $value);
		$this->db->delete('unit_type_choice');
	}

}

/* End of file Unittypechoice_model.php */
/* Location: ./application/models/Unittypechoice_model.php */