<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	public function get($project_gallery_id='')
	{
		$this->db->where('project_gallery_id', $project_gallery_id);
		$query = $this->db->get('project_gallery');
		return $query->row_array();
	}

	public function get_by_project($project_id='')
	{
		$this->db->select('*');
		$this->db->from('project_gallery');
		$this->db->where('project_id', $project_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_project($project_gallery_id='')
	{
		$this->db->select('project.*');
		$this->db->from('project_gallery');
		$this->db->join('project', 'project_gallery.project_id = project.project_id', 'left');
		$this->db->where('project_gallery.project_gallery_id', $project_gallery_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function edit($data='', $project_gallery_id)
	{
		$this->db->where('project_gallery_id', $project_gallery_id);
		return $this->db->update('project_gallery', $data);
	}

	public function delete($project_gallery_id='')
	{
		$this->db->where('project_gallery_id', $project_gallery_id);
		return $this->db->delete('project_gallery');
	}

	public function add($data='')
	{
		$this->db->insert('project_gallery', $data);
		return $this->db->insert_id();
	}

	public function add_batch($data='')
	{
		return $this->db->insert_batch('project_gallery', $data);
	}
}

/* End of file Gallery_model.php */
/* Location: ./application/models/Gallery_model.php */