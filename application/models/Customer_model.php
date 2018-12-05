<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function get($customer_id='')
	{
		$this->db->select('customer.*');
		$this->db->from('customer');

		if ($customer_id == '')
		{
			$query = $this->db->get();
			return $query->result_array();
		}
		else
		{
			$this->db->where('customer.customer_id', $customer_id);
			$query = $this->db->get();
			return $query->row_array();
		}
	}

	public function get_by_user($added_by='')
	{
		$this->db->select('customer.*, area.area_name, gender.gender_name');
		$this->db->from('customer');
		$this->db->join('area', 'customer.area_id = area.area_id', 'left');
		$this->db->join('gender', 'customer.gender_id = gender.gender_id', 'left');
		$this->db->where('customer.added_by', $added_by);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_gender()
	{
		$query = $this->db->get('gender');
		return $query->result_array();
	}

	public function add($data='')
	{
		$this->db->insert('customer', $data);
		return $this->db->insert_id();
	}

	public function edit($data='', $customer_id='')
	{
		$this->db->where('customer_id', $customer_id);
		return $this->db->update('customer', $data);
	}

}

/* End of file Customer_model.php */
/* Location: ./application/models/Customer_model.php */