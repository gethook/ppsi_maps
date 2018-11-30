<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('developer_model');
		$this->load->model('devteam_model');
		$this->load->model('area_model');
		$this->load->model('ownership_model');
		$this->load->model('user_model');
	}
	public function index()
	{
		
	}

	public function profile($developer_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_owner_developer = FALSE;

		if ($developer_id == '')
		{
			$developer = $this->developer_model->get_by_user_id($user_id);
		}
		else
		{
			$developer = $this->developer_model->get($developer_id);
		}

		//print_r(array_key_exists('developer_id', $developer));die();

		if($developer && array_key_exists('developer_id', $developer))
		{
			$is_owner_developer = $this->auth->cek_dev_owner($developer['developer_id']);
			$kota = $this->area_model->get_kota($developer['area_id']);
			$team = $this->devteam_model->get_by_dev($developer['developer_id']);
			$users = $this->user_model->get();

			$team_uids = array_column($team, 'user_id');
			//print_r($team_uids);die();
			$i = 0;
			foreach ($users as $user) {
				$slf = ($user['user_id'] == $user_id);
				$member = in_array($user['user_id'], $team_uids);
				if ($slf || $member) {
					$users[$i]['disabled'] = TRUE;
				} else {
					$users[$i]['disabled'] = FALSE;
				}
				$i++;
			}
			// print_r($users);
			// die();

			$data = array(
				'title' => 'Profil Developer: ' . $developer['developer_name'],
				'developer' => $developer,
				'is_owner_developer' => $is_owner_developer,
				'team' => $team,
				'users' => $users,
				'kota' => $kota,
				'content' => 'backoffice/developer/profile'
			);
		}
		else
		{
			$data = array(
				'title'		=> 'Profil Developer',
				'heading'	=> 'Not Found',
				'message'	=> '<p>Halaman tidak ditemukan</p>',
				'content'	=> 'errors/html/error_404'
			);
		}
		//$is_team_member = $this->auth->cek_dev_team($developer['developer_id']);
		//$is_owner_developer = $this->auth->cek_role(array(2)) && $is_team_member;
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function edit($developer_id='')
	{
		if ($this->auth->cek_dev_owner($developer_id)) 
		{
			$developer = $this->developer_model->get($developer_id);
			$ownerships = $this->ownership_model->get();
			$kota = $this->area_model->get_kota();
			//print_r($kota);
			//print_r($this->auth->cek_dev_owner($developer_id));

			$this->form_validation->set_rules('developer_name', 'Nama Developer', 'trim|required',
				array(
					'required' => '%s tidak boleh kosong'
				)
			);
			$this->form_validation->set_rules('ownership_id', 'Legalitas', 'required',
				array('required' => '%s tidak boleh kosong')
			);
			$this->form_validation->set_rules('area_id', 'Kota', 'required',
				array('required' => '%s tidak boleh kosong')
			);
			$this->form_validation->set_rules('developer_address', 'Alamat kantor developer', 'trim|required',
				array(
					'required' => '%s tidak boleh kosong'
				)
			);
			$this->form_validation->set_rules('developer_description', 'Deskripsi', 'trim|required',
				array(
					'required' => '%s tidak boleh kosong'
				)
			);

			if ($this->form_validation->run()) 
			{
				// cek apakah ada logo yang diupload
				if (!empty($_FILES['developer_path_logo']['name'])) {
					# code...
					// Konfigurasi upload
					$config['upload_path']		= './assets/uploads/developers/';
					$config['allowed_types']	= 'gif|jpg|jpeg|png';
					$config['max_size']			= '2000';
					$config['file_ext_tolower']	= TRUE;
					//$config['encrypt_name']		= FALSE;
					$this->load->library('upload', $config);

					// Proses upload gagal
					if (!$this->upload->do_upload('developer_path_logo')) {
						# code...
						$data = array(
							'title' => 'Edit Developer Profile',
							'error_upload' => $this->upload->display_errors(),
							'developer' => $developer,
							'ownerships' => $ownerships,
							'kota' => $kota,
							'content' => 'backoffice/developer/edit',
						);
						$this->load->view('backoffice/layout/wrapper', $data, FALSE);
					} else {
						// Upload berhasil
						// Menampung data upload file
						$upload_data        = array('uploads' =>$this->upload->data());

          				// Menjalankan configurasi memanipulasi gambar
						$config['image_library']	= 'gd2';
						$config['source_image']		= './assets/uploads/developers/'.$upload_data['uploads']['file_name']; 
						$config['new_image']		= './assets/uploads/developers/thumbs/';
						$config['create_thumb']		= TRUE;
						$config['quality']			= "100%";
						$config['maintain_ratio']	= FALSE;
          				// $config['master_dim']  = 'auto';
						$config['width']			= 120;
          				// Pixel
						$config['height']			= 120;
          				// Pixel
						$config['x_axis']			= 0;
						$config['y_axis']			= 0;
						$config['thumb_marker']		= '';
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						// Kode untuk menghapus file gambar/photo kalau sudah ada
						// Mulai dari cek file gambar sudah ada atau belum
						$file = file_exists('./assets/uploads/developers/thumbs/' . $developer['developer_path_logo']);
						// Hapus file jika ditemukan
						if ($file !== "") {
							unlink('./assets/uploads/developers/' . $developer['developer_path_logo']);
							unlink('./assets/uploads/developers/thumbs/' . $developer['developer_path_logo']);
						}

						$input = $this->input;
						$developer_slug = url_title($input->post('developer_name'), '-', TRUE);
						$data = array(
							'developer_slug'		=> $developer_slug,
							'developer_path_logo'	=> $upload_data['uploads']['file_name'],
							'developer_name'		=> $input->post('developer_name'), 
							'ownership_id'			=> $input->post('ownership_id'),
							'area_id'				=> $input->post('area_id'),
							'developer_address'		=> $input->post('developer_address'),
							'developer_gmaps'		=> $input->post('developer_gmaps'),
							'developer_description'	=> $input->post('developer_description')
						);

						$this->developer_model->edit($data, $developer_id);
						$this->session->set_flashdata('sukses', 'Profile Developer berhasil diubah.');
						redirect(base_url('developer/profile'));

					}
				} else {
					$input = $this->input;
					$developer_slug = url_title($input->post('developer_name'), '-', TRUE);
					$data = array(
						'developer_slug'		=> $developer_slug,
						'developer_name'		=> $input->post('developer_name'), 
						'ownership_id'			=> $input->post('ownership_id'),
						'area_id'				=> $input->post('area_id'),
						'developer_address'		=> $input->post('developer_address'),
						'developer_gmaps'		=> $input->post('developer_gmaps'),
						'developer_description'	=> $input->post('developer_description')
					);

					$this->developer_model->edit($data, $developer_id);
					$this->session->set_flashdata('sukses', 'Profile Developer berhasil diubah.');
					redirect(base_url('developer/profile'));

				}
			}

			$this->load->library('upload');

			$data = array(
				'title' => 'Edit Developer Profile',
				'error_upload' => $this->upload->display_errors(),
				'developer' => $developer,
				'ownerships' => $ownerships,
				'kota' => $kota,
				'content' => 'backoffice/developer/edit',
			);
			$this->load->view('backoffice/layout/wrapper', $data, FALSE);
		}
		else
		{
			$data = array(
				'title' => 'Unauthorized!',
				'content' => 'errors/adminlte/unauthorized'
			);
			$this->load->view('backoffice/layout/wrapper', $data, FALSE);
		}
	}

	public function addteam()
	{
		$user_id = $this->session->userdata('user_id');
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer  && array_key_exists('developer_id', $developer)) {
			if ($this->auth->cek_dev_owner($developer['developer_id'])) {
				// Cek validation
				$this->form_validation->set_rules('team_members', 'Anggota Tim', 'callback_team_check');
				if ($this->form_validation->run()) {
					$team_members = $this->input->post('team_members', TRUE);
					//$i_developer_id = $this->input->post('developer_id', TRUE); //bahaya
					$developer_id = $developer['developer_id'];
					//var_dump($team_members);
					//echo "$developer_id";die();
					foreach ($team_members as $team_member) {
						$ur_data = array(
							'role_id' => '3',
							'user_id' => $team_member
						);
						if($this->user_model->add_dev_role($ur_data, $developer_id)) {
							$this->session->set_flashdata('addteam_sukses', 'Tambah tim berhasil.');
						}
					}
				}
				redirect(base_url('developer/profile'));
			}
		}

		$data = array(
			'title' => 'Unauthorized!',
			'content' => 'errors/adminlte/unauthorized'
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);

		//redirect(base_url('developer/profile'));
		# code...
	}

	public function rmteam($user_role_id='')
	{
		if ($this->user_model->rm_dev_role($user_role_id)) {			
			$this->session->set_flashdata('rmteam_sukses', 'User berhasil dihapus dari anggota tim developer.');
		} else {
			$this->session->set_flashdata('error_team', 'Terjadi kesalahan.');
		}
		redirect(base_url('developer/profile'));
	}

	public function team_check()
	{
		if (empty($this->input->post('team_members'))) {
			$this->form_validation->set_message('team_check', 'Pilih minimal satu user sebagai anggota tim');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}

/* End of file Developer.php */
/* Location: ./application/controllers/backoffice/Developer.php */