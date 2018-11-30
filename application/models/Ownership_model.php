<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ownership_model extends CI_Model {

	public function get($id='')
	{
		if ($id == '') {
			$query = $this->db->get('ownership');
			return $query->result_array();
		} else {
			$query = $this->db->get_where('ownership', array('ownership_id' => $id));
			return $query->row_array();
		}
	}

}

/* End of file Ownership_model.php */
/* Location: ./application/models/Ownership_model.php */