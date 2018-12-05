<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        $this->CI->load->model('auth_model');
	}

	// Fungsi login
	public function masuk($username_or_email='', $password='')
	{
		// Melakukan query untuk mencari data sesuai dengan parameter ( $username dan $password)
		$this->CI->db->where(array('username' => $username_or_email, 'password' => md5($password)));
		//$this->CI->db->or_where(array('email' => $username_or_email, 'password' => md5($password)));
		$query = $this->CI->db->get('user');
		//echo $query->num_rows();die();

		if ($query->num_rows() != 1)
		{
			$this->CI->db->where(array('email' => $username_or_email, 'password' => md5($password)));
			$query = $this->CI->db->get('user');
		}

		// Jika data ditemukan
		if($query->num_rows() == 1)
		{
			// Mengambil satu baris data berdasarkan parameter ($username dan $password)
			//$this->CI->db->select('*');
			//$this->CI->db->from('users');
			//$this->CI->db->where(array( 'username' => $username, 'password' => sha1($password)));
			//$query = $this->CI->db->get();

			// Menghasilkan baris data dalam bentuk array
			$result = $query->row_array();
			// print_r($result);die();

			// Membuat variabel untuk menampung data
			$login_id		= uniqid(rand());
			$user_id		= $result['user_id'];
			$username 		= $result['username'];
			$full_name		= $result['full_name'];
			$user_roles		= $this->CI->user_model->get_user_roles($result['user_id']);
			//print_r($user_roles);die();

			//$this->CI->load->model('role_model');
			//$role = $this->CI->role_model->get($role_id);

			$data_session = array(
				'login_id'		=> $login_id,
				'user_id'		=> $user_id,
				'username'		=> $username,
				'full_name'		=> $full_name,
				'user_roles'	=> $user_roles
			);
			// Melakukan penyimpanan data kedalam session
			$this->CI->session->set_userdata($data_session);

			redirect(base_url('backoffice/dashboard'));


		}
		else
		{
			// Jika data tidak ditemukan, membuat pesan error
			$this->CI->session->set_flashdata('warning', 'Opsss......!!! Username/ password yang anda masukkan salah.');

			// Dialirkan ke halaman login
			redirect(base_url('login'));
		}
		return false;
	}

	// Fungsi cek login user
	public function cek_login()
	{

		// Melakukan pengecekan data username dan akses_level didalam session
		if(!$this->CI->session->has_userdata('user_id'))//|| count($this->CI->session->userdata('user_roles')) == 0)
		{
			// Jika data tidak ditemukan, membuat pesan error
			$this->CI->session->set_flashdata('danger', 'Anda belum login, silahkan login untuk mengakses halaman ini.');
			// Dialihkan ke halaman login
			redirect(base_url('login'));
		}
	}

	public function keluar()
	{
		// Mengambil data login pada session
		$data_session = array('login_id', 'user_id', 'username', 'full_name', 'role');

		// Melakukan penghapusan pada session
		$this->CI->session->unset_userdata($data_session);

		// Menampilkan pesan setelah proses penghapusan data session berhasil
		$this->CI->session->set_flashdata('success_logout', 'Terima kasih, Anda berhasil keluar.');


		// Dialihkan ke halaman login
		redirect(base_url('login'));
	}

	public function cek_role($allowed_roles)
	{
		if (!$this->CI->session->userdata('user_id'))
		{
			return false;
		}

		$user_roles = $this->CI->session->userdata('user_roles');
		$role_ids = array_column($user_roles, 'role_id');
		if(count(array_intersect($allowed_roles, $role_ids)) > 0)
		{
			return true;
		}
		return false;
	}

	public function cek_dev_team($developer_id='')
	{
		// if (!$this->CI->session->userdata('user_id'))
		// {
		// 	return false;
		// }

		// $user_id = $this->CI->session->userdata('user_id');
		// $user_role = $this->CI->userrole_model->get_by_devteam($user_id, $developer_id);
		// if($user_role)
		// {
		// 	return true;
		// }
		// return false;
		
		if ($this->CI->session->userdata('user_id')) {
			$user_id = $this->CI->session->userdata('user_id');
			return $this->CI->auth_model->cek_dev_team($user_id, $developer_id);
		} else {
			return false;
		}
	}

	public function cek_dev_owner($developer_id='')
	{
		if ($this->CI->session->userdata('user_id')) {
			$user_id = $this->CI->session->userdata('user_id');
			return $this->CI->auth_model->cek_dev_owner($user_id, $developer_id);
		} else {
			return false;
		}
	}

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
