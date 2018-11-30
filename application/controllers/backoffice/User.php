<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('role_model');
		$this->load->model('userrole_model');
	}

	public function index()
	{
		$role_types = array_column($this->session->userdata('user_roles'), 'role_type_id');
		if (!(in_array(1, $role_types))) {
			redirect(base_url('user/profile'));
		}
		$users = $this->user_model->get();
		$data = array(
			'title' => 'Manajemen User',
			'users' => $users,
			'content' => 'backoffice/user/list_user' 
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function profile($user_id='')
	{
		if ($user_id == '')
		{
			$user_id = $this->session->userdata('user_id');
		}
		$user = $this->user_model->get($user_id);
		
		$data = array(
			'title' => 'User Profile',
			
			'user' => $user,
			'content' => 'backoffice/user/profile'
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function register($value='')
	{
		$gender = $this->user_model->get_gender();
		$role = $this->role_model->get_op();

		// Validasi
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'trim|required|min_length[5]',
			array(
				'required' => '%s tidak boleh kosong',
				'min_length' => '%s minimal 5 karakter'));
		$this->form_validation->set_rules('gender_id', 'Jenis Kelamin', 'required',
			array(
				'required' => '%s tidak boleh kosong'));
		$this->form_validation->set_rules('phone', 'Nomor Telp/WhatsApp', 'trim|required|min_length[11]|max_length[15]',
			array(
				'required' => '%s tidak boleh kosong',
				'min_length' => 'sepertinya %s yang Anda masukkan kurang lengkap',
				'max_length' => 'sepertinya %s yang Anda masukkan terlalu banyak'));
		$this->form_validation->set_rules('role', 'Role', 'required',
			array(
				'required' => '%s tidak boleh kosong'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]',
			array(
				'required' => '%s tidak boleh kosong',
				'valid_email' => '%s yang Anda masukkan tidak valid. Contoh %s yang valid: emailsaya@gmail.com',
				'is_unique' => '%s sudah digunakan, silakan gunakan %s yang lain'));
		$this->form_validation->set_rules('username', 'Username', 'trim|is_unique[user.username]',
			array(
				'is_unique' => '%s sudah digunakan, silakan gunakan Username yang lain'));
		$this->form_validation->set_rules('password', 'Password', 'required',
			array(
				'required' => '%s tidak boleh kosong'));
		$this->form_validation->set_rules('password2', 'Ulangi Password', 'required|matches[password]',
			array(
				'required' => '%s tidak boleh kosong',
				'matches' => 'Password yang Anda ketikkan tidak cocok/tidak sama'));
		if ($this->form_validation->run()) {
			$input = $this->input;
			$data = array(
				'full_name' => $input->post('full_name'),
				'gender_id' => $input->post('gender_id'),
				'phone' => $input->post('phone'),
				'username' => $input->post('username'),
				'email' => $input->post('email'),
				'password' => md5($input->post('password'))
			);
			$user_id = $this->user_model->add($data);
			$ur_data = array(
				'user_id' => $user_id,
				'role_id' => $input->post('role')
			);
			$this->user_model->add_user_role($ur_data);
			$this->session->set_flashdata('sukses_register', 'Selamat! Registrasi Anda berhasil');
			redirect(base_url('login'));
		} else {
			# code...
		}

		$data = array(
			'title' => 'Registrasi',
			'gender' => $gender,
			'role' => $role
		);
		$this->load->view('register', $data, FALSE);
		//redirect(base_url('login'));
	}

	public function login()
	{
		//$this->load->library('user_agent');
		//$referrer = $this->agent->referrer();
		$username_or_email = $this->input->post('username_or_email');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username_or_email', 'Username atau Email', 'required', array('required' => '%s tidak boleh kosong'));
		$this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s tidak boleh kosong'));

		if ($this->form_validation->run()) {
			$this->auth->masuk($username_or_email, $password);
		}

		$data = array(
			'title' => 'Login',
			//'referrer' => $referrer
		);
		$this->load->view('login', $data, FALSE);
	}

	public function logout()
	{
		$this->auth->keluar();
	}

	public function mdo($user_role_id='')
	{
		$this->load->model('developer_model');
		$this->load->model('devteam_model');

		// Cek role
		$allowed_roles = array(1);
		$allowed = $this->auth->cek_role($allowed_roles);

		if(!$allowed)
		{
			redirect(base_url('user/profile'));
		}

		// Cek apakah $user_role_id ada
		if(!$this->userrole_model->get($user_role_id) || $user_role_id == '')
		{
			redirect(base_url('user'));
		}

		$uid = $this->userrole_model->get($user_role_id)['user_id'];
		$full_name = $this->user_model->get($uid)['full_name'];
		// echo $full_name;die();
		// Cek apakah user_role sudah di-assign ke developer
		$member = $this->devteam_model->get_by_user_role_id($user_role_id); //print_r($member);
		
		if($member && count($member) > 0)
		{
			$developer = $this->developer_model->get($member['developer_id']);
			$message = $full_name . ' telah di-assign/menjadi anggota tim developer ' . $developer['developer_name'];
			$data = array('message' => $message );
			$this->session->set_flashdata('warn_member', $message);
			//die($message);
		}
		else
		{
			// Edit table user_role, ubah role_id menjadi 2 (Owner developer)
			$data = array('role_id' => 2);
			$this->userrole_model->edit($data, $user_role_id);

			// Tambah developer
			$dev_data = array('developer_name' => $full_name, 'ownership_id' => 1);
			$developer_id = $this->developer_model->add($dev_data);

			// Assign user_role ke developer, tambahkan dalam table developer_tim
			$dev_team_data = array('developer_id' => $developer_id, 'user_role_id' => $user_role_id);
			$this->devteam_model->add($dev_team_data);			
		}

		//echo "OK"; die();


		redirect(base_url('user'));
	}

	public function mag($user_role_id='')
	{
		# code...
	}

}

/* End of file User.php */
/* Location: ./application/controllers/backoffice/User.php */