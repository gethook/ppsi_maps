<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusunit_model extends CI_Model {

	public function get($status_unit_id='')
	{
		if ($status_unit_id == '') 
		{
			$query = $this->db->get('status_unit');
			return $query->result_array();
		}
		else
		{
			$query = $this->db->get_where('status_unit', array('status_unit_id' => $status_unit_id));
			return $query->row_array();
		}
	}

}

/* End of file Statusunit_model.php */
/* Location: ./application/models/Statusunit_model.php */