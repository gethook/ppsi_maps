<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

	public function get_kota($kota_id='')
	{
		$this->db->select('k.area_id as area_id, p.area_name as provinsi, k.area_name as kota');
		$this->db->from('area as p');
		$this->db->join('area as k', 'k.parent_id = p.area_id', 'left');
		$this->db->where('k.area_level_id', 2);
		if ($kota_id) {
			$this->db->where('k.area_id', $kota_id);
			$query = $this->db->get();
			return $query->row_array();			
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_prov_kec($area_id='')
	{
		# code...
		/*
		select area.area_id, area.area_name, i.area_name as induk, i2.area_name as induk2, l.area_level_name as level
		from area
		left join area i on area.parent_id=i.area_id
		left join area i2 on i.parent_id=i2.area_id
		left join area_level l on area.area_level_id=l.area_level_id
		order by area.area_level_id ASC, i.area_id ASC, area.area_id ASC
		*/
		$this->db->select('area.area_id, area.area_name, i.area_name as induk, i2.area_name as induk2');
		$this->db->from('area');
		$this->db->join('area as i', 'area.parent_id=i.area_id', 'left');
		$this->db->join('area as i2', 'i.parent_id=i2.area_id', 'left');
		$this->db->order_by('area.area_level_id ASC, i.area_id ASC, area.area_id ASC');
		if ($area_id) 
		{
			$this->db->where('area.area_id', $area_id);
			$query = $this->db->get();
			return $query->row_array();
		}
		$query = $this->db->get();
		return $query->result_array();
	}

}

/* End of file Area_model.php */
/* Location: ./application/models/Area_model.php */