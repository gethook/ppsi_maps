<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		//print_r(session_id());
		// Get all user's roles
		$roles = $this->session->userdata('user_roles');
		$role_type_ids = array_column($roles, 'role_type_id');
		//print_r($role_type_ids);
		// Cek apakah role type termasuk Employee
		if (in_array(1, $role_type_ids)) {
			// Jika user termasuk employee redirect ke user controller (view semua user)
			redirect(base_url('user'));
		} else {
			redirect(base_url('user/profile'));
		}
		//print_r($this->session->userdata('role_id'));
		print_r($this->session->all_userdata());
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/backoffice/Dashboard.php */