<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {

	//private $id_project = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('project_model');
		$this->load->model('developer_model');
		$this->load->model('devteam_model');
		$this->load->model('area_model');
		$this->load->model('statusunit_model');
		$this->load->model('unit_model');
		$this->load->model('unittype_model');
		$this->load->model('unittypechoice_model');
		$this->load->model('pricechoice_model');
		$this->load->model('gallery_model');
		$this->load->model('projectmarketing_model');
		$this->load->model('user_model');
	}

	public function index()
	{
		
		$user_id = $this->session->userdata('user_id');
		redirect(base_url('user/profile/') . $user_id);
		return;
		//$is_devteam = FALSE;
		$projects = $this->project_model->get();
		$developer = $this->developer_model->get_by_user_id($user_id);
		$itr=0;
		foreach ($projects as $project) {
			$lowest_price = $this->project_model->get_lowest_price($project['project_id']);
			$projects[$itr]['lowest_price'] = $lowest_price;
			if ($developer && array_key_exists('developer_id', $developer)) 
			{
				$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
			}
			$itr++;
		}
		
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = TRUE;
		}
		$data = array(
			'title' => 'Listing Proyek',
			'is_devteam' => $is_devteam,
			'projects' => $projects,
			'content' => 'backoffice/proyek/list',
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function developer($developer_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		if ($developer_id == '')
		{
			//$developer = $this->developer_model->get_by_user_id($user_id);
			// if ($developer && array_key_exists('developer_id', $developer)) 
			// {
			// 	$projects = $this->project_model->get_by_dev($developer['developer_id']);
			// 	$is_devteam = $this->auth->cek_dev_team($developer['developer_id']);
			// }
			// else
			// {
			// 	$projects = FALSE;
			// }
			$developer_team = $this->devteam_model->get_by_user_id($user_id);
			if ($developer_team && array_key_exists('developer_id', $developer_team)) 
			{
				$projects = $this->project_model->get_by_dev($developer_team['developer_id']);
				$is_devteam = $this->auth->cek_dev_team($developer_team['developer_id']);
			}
			else
			{
				$projects = FALSE;
			}			
		}
		else
		{
			$projects = $this->project_model->get_by_dev($developer_id);
			$is_devteam = $this->auth->cek_dev_team($developer_id);			
		}

		if (!$is_devteam)
		{
			$projects = $this->projectmarketing_model->get_by_marketing($user_id);
		}

		$itr=0;
		if ($projects) {
			foreach ($projects as $p) {
				$lowest_price = $this->project_model->get_lowest_price($p['project_id']);
				$projects[$itr]['lowest_price'] = $lowest_price;

				$total_unit = $this->project_model->count_unit($p['project_id']);
				$projects[$itr]['total_unit'] = $total_unit;

				$available_unit = $this->project_model->count_available_unit($p['project_id']);
				$projects[$itr]['available_unit'] = $available_unit;
				$itr++;
			}
		}

		$actions = array();
		$actions[] = array(
			'url' => base_url('proyek/detil/'),
			'fa' => 'fa-eye',
			'label' => 'Lihat Detil'
		);
		if ($is_devteam) {
			$actions[] = array(
				'url' => base_url('proyek/edit/'),
				'fa' => 'fa-edit',
				'label' => 'Edit'
			);
			$actions[] = array(
				'url' => '',
				'fa' => '',
				'label' => ''
			);
			$actions[] = array(
				'url' => base_url('proyek/marketing/'),
				'fa' => 'fa-users',
				'label' => 'Marketing'
			);
		}


		$data = array(
			'title' => 'Listing Proyek',
			'is_devteam' => $is_devteam,
			'projects' => $projects,
			'actions' => $actions,
			'content' => 'backoffice/proyek/list' 
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);

	}

	public function tambah()
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;


		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($developer['developer_id']);
		}

		if ($is_devteam) 
		{
			# code...
			//$kota = $this->area_model->get_kota();
			$kota = $this->area_model->get_prov_kec();
			$status_unit = $this->statusunit_model->get();
			$this->form_validation->set_rules('project_name', 'Nama proyek', 'trim|required', array('required' => '%s tidak boleh kosong'));
			$this->form_validation->set_rules('project_description', 'Deskripsi proyek', 'required',
				array('required' => '%s tidak boleh kosong')
			);
			$this->form_validation->set_rules('area_id', 'Lokasi', 'required',
				array('required' => '%s tidak boleh kosong')
			);
			$this->form_validation->set_rules('project_address', 'Alamat lengkap proyek', 'required',
				array('required' => '%s tidak boleh kosong')
			);
			$this->form_validation->set_rules('status_unit_id', 'Status proyek', 'required',
				array('required' => '%s tidak boleh kosong')
			);
			$this->form_validation->set_rules('project_note', 'Catatan untuk marketing', 'required',
				array('required' => '%s tidak boleh kosong')
			);

			if ($this->form_validation->run()) 
			{
				// cek apakah ada foto yang diupload
				if (!empty($_FILES['project_path_img']['name'])) 
				{
					# code...
					// Konfigurasi upload
					$config['upload_path']		= './assets/uploads/projects/';
					$config['allowed_types']	= 'gif|jpg|jpeg|png';
					$config['max_size']			= '2000';
					$config['file_ext_tolower']	= TRUE;
					//$config['encrypt_name']		= FALSE;
					$this->load->library('upload', $config);

					// Proses upload gagal
					if (!$this->upload->do_upload('project_path_img')) 
					{
						# code...
						$data = array(
							'title' => 'Tambah Proyek',
							'error_upload' => $this->upload->display_errors(),
							'status_unit' => $status_unit,
							'kota' => $kota,
							'content' => 'backoffice/proyek/add',
						);
						$this->load->view('backoffice/layout/wrapper', $data, FALSE);
					} 
					else //UPLOAD SUKSES
					{
						// Upload berhasil
						// Menampung data upload file
						$upload_data        = array('uploads' =>$this->upload->data());

          				// Menjalankan configurasi memanipulasi gambar
						$config['image_library']	= 'gd2';
						$config['source_image']		= './assets/uploads/projects/'.$upload_data['uploads']['file_name']; 
						$config['new_image']		= './assets/uploads/projects/thumbs/';
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


						$input = $this->input;
						$project_slug = url_title($input->post('project_name'), '-', TRUE);
						$data = array(
							'project_slug'			=> $project_slug,
							'project_name'			=> $input->post('project_name'), 
							'project_description'	=> $input->post('project_description'),
							'area_id'				=> $input->post('area_id'),
							'project_address'		=> $input->post('project_address'),
							'project_gmaps'			=> $input->post('project_gmaps'),
							'status_unit_id'		=> $input->post('status_unit_id'),
							'project_path_img'		=> $upload_data['uploads']['file_name'],
							'project_note'			=> $input->post('project_note'),
							'developer_id'			=> $developer['developer_id'],
						);

						$this->project_model->add($data);
						$this->session->set_flashdata('sukses', 'Berhasil menambahkan proyek');
						redirect(base_url('proyek/developer/' . $developer['developer_id']));
					}
				} 
				else 
				{
					$input = $this->input;
					$project_slug = url_title($input->post('project_name'), '-', TRUE);
					$data = array(
						'project_slug'			=> $project_slug,
						'project_name'			=> $input->post('project_name'), 
						'project_description'	=> $input->post('project_description'),
						'area_id'				=> $input->post('area_id'),
						'project_address'		=> $input->post('project_address'),
						'project_gmaps'			=> $input->post('project_gmaps'),
						'status_unit_id'		=> $input->post('status_unit_id'),
						'project_note'			=> $input->post('project_note'),
						'developer_id'			=> $developer['developer_id'],
					);

					$this->project_model->add($data);
					$this->session->set_flashdata('sukses', 'Berhasil menambahkan proyek');
					redirect(base_url('proyek/developer/' . $developer['developer_id']));
				}
			}
			$this->load->library('upload');
			$data = array(
				'title' => 'Tambah Proyek',
				'status_unit' => $status_unit,
				'kota' => $kota,
				'content' => 'backoffice/proyek/add',
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

	public function edit($project_id='')
	{
		# code...

		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->project_model->get($project_id);
		if(!$project || !array_key_exists('project_id', $project))
		{
			$data = array(
				'title'		=> 'Proyek tidak ditemukan',
				'content'	=> 'errors/adminlte/404',
			);
			$this->load->view('backoffice/layout/wrapper', $data, FALSE);
			return;
		}
		else
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
			if (!$is_devteam) 
			{
				$data = array(
					'title' => 'Unauthorized!',
					'content' => 'errors/adminlte/unauthorized'
				);
				$this->load->view('backoffice/layout/wrapper', $data, FALSE);
			} 
			else 
			{
				$kota = $this->area_model->get_prov_kec();
				$status_unit = $this->statusunit_model->get();
				$this->form_validation->set_rules('project_name', 'Nama proyek', 'trim|required', array('required' => '%s tidak boleh kosong'));
				$this->form_validation->set_rules('project_description', 'Deskripsi proyek', 'required',
					array('required' => '%s tidak boleh kosong')
				);
				$this->form_validation->set_rules('area_id', 'Lokasi', 'required',
					array('required' => '%s tidak boleh kosong')
				);
				$this->form_validation->set_rules('project_address', 'Alamat lengkap proyek', 'required',
					array('required' => '%s tidak boleh kosong')
				);
				$this->form_validation->set_rules('status_unit_id', 'Status proyek', 'required',
					array('required' => '%s tidak boleh kosong')
				);
				$this->form_validation->set_rules('project_note', 'Catatan untuk marketing', 'required',
					array('required' => '%s tidak boleh kosong')
				);

				if ($this->form_validation->run()) 
				{
					// cek apakah ada foto yang diupload
					if (!empty($_FILES['project_path_img']['name'])) 
					{
						# code...
						// Konfigurasi upload
						$config['upload_path']		= './assets/uploads/projects/';
						$config['allowed_types']	= 'gif|jpg|jpeg|png';
						$config['max_size']			= '2000';
						$config['file_ext_tolower']	= TRUE;
						//$config['encrypt_name']		= FALSE;
						$this->load->library('upload', $config);

						// Proses upload gagal
						if (!$this->upload->do_upload('project_path_img')) 
						{
							# code...
							$data = array(
								'title' => 'Tambah Proyek',
								'error_upload' => $this->upload->display_errors(),
								'status_unit' => $status_unit,
								'kota' => $kota,
								'content' => 'backoffice/proyek/edit',
							);
							$this->load->view('backoffice/layout/wrapper', $data, FALSE);
						} 
						else //UPLOAD SUKSES
						{
							// Upload berhasil
							// Menampung data upload file
							$upload_data        = array('uploads' =>$this->upload->data());

	          				// Menjalankan configurasi memanipulasi gambar
							$config['image_library']	= 'gd2';
							$config['source_image']		= './assets/uploads/projects/'.$upload_data['uploads']['file_name']; 
							$config['new_image']		= './assets/uploads/projects/thumbs/';
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
							$file = file_exists('./assets/uploads/projects/thumbs/' . $project['project_path_img']);
							// Hapus file jika ditemukan
							if ($file !== "") {
								unlink('./assets/uploads/projects/' . $project['project_path_img']);
								unlink('./assets/uploads/projects/thumbs/' . $project['project_path_img']);
							}


							$input = $this->input;
							$project_slug = url_title($input->post('project_name'), '-', TRUE);
							$data = array(
								'project_slug'			=> $project_slug,
								'project_name'			=> $input->post('project_name'), 
								'project_description'	=> $input->post('project_description'),
								'area_id'				=> $input->post('area_id'),
								'project_address'		=> $input->post('project_address'),
								'project_gmaps'			=> $input->post('project_gmaps'),
								'status_unit_id'		=> $input->post('status_unit_id'),
								'project_path_img'		=> $upload_data['uploads']['file_name'],
								'project_note'			=> $input->post('project_note'),
								'developer_id'			=> $project['developer_id'],
							);

							$this->project_model->edit($data, $project_id);
							$this->session->set_flashdata('sukses', 'Proyek ' . $project['project_name'] . ' berhasil diubah.');
							redirect(base_url('proyek/developer/' . $project['developer_id']));
						}
					} 
					else 
					{
						$input = $this->input;
						$project_slug = url_title($input->post('project_name'), '-', TRUE);
						$data = array(
							'project_slug'			=> $project_slug,
							'project_name'			=> $input->post('project_name'), 
							'project_description'	=> $input->post('project_description'),
							'area_id'				=> $input->post('area_id'),
							'project_address'		=> $input->post('project_address'),
							'project_gmaps'			=> $input->post('project_gmaps'),
							'status_unit_id'		=> $input->post('status_unit_id'),
							'project_note'			=> $input->post('project_note'),
							'developer_id'			=> $project['developer_id'],
						);

						$this->project_model->edit($data, $project_id);
						$this->session->set_flashdata('sukses', 'Proyek ' . $project['project_name'] . ' berhasil diubah.');
						redirect(base_url('proyek/developer/' . $project['developer_id']));
					}
				}
				$this->load->library('upload');
				$data = array(
					'title' => 'Edit Proyek',
					'project' => $project,
					'status_unit' => $status_unit,
					'kota' => $kota,
					'content' => 'backoffice/proyek/edit',
				);
				$this->load->view('backoffice/layout/wrapper', $data, FALSE);
			}			
		}
	}

	public function detil($project_id='')
	{
		# code...
		if ($project_id == '')
		{
			$data = array(
				'title'		=> 'detil proyek',
				'content'	=> 'errors/adminlte/404',
			);
			$this->load->view('backoffice/layout/wrapper', $data, FALSE);
			
		}
		else
		{
			$project = $this->project_model->get($project_id);
			if (!$project) 
			{
				$data = array(
					'title'		=> 'detil proyek',
					'content'	=> 'errors/adminlte/404',
				);
				$this->load->view('backoffice/layout/wrapper', $data, FALSE);
				return $this;
			}

			$user_id = $this->session->userdata('user_id');
			$is_devteam = FALSE;


			$developer = $this->developer_model->get_by_user_id($user_id);
			if ($developer && array_key_exists('developer_id', $developer)) 
			{
				$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
			}

			$units = $this->unit_model->get_by_project($project['project_id']);
			for ($i=0; $i < count($units); $i++) { 
				$types = $this->unit_model->get_types($units[$i]['unit_id']);
				for ($j=0; $j < count($types); $j++) { 
					$price_choices_u = $this->unittype_model->price_choices($types[$j]['unit_type_id']);
					$k = 0;
					if ($price_choices_u) {
						foreach ($price_choices_u as $pcu) {
							$price_choices_u[$k]['total'] = $pcu['dp'] + ($pcu['installment'] * $pcu['tenor']);
							$k++;
						}
					}
					$types[$j]['price_choices'] = $price_choices_u;
				}
				$units[$i]['types'] = $types;
			}

			$unit_types = $this->unittype_model->get_by_project($project['project_id']);
			for ($i=0; $i < count($unit_types); $i++) { 
				$unit_choice = $this->unittype_model->get_units($unit_types[$i]['unit_type_id']);
				$unit_types[$i]['units'] = $unit_choice;
				$price_choices = $this->unittype_model->price_choices($unit_types[$i]['unit_type_id']);
				$x=0;
				if($price_choices) 
				{
					foreach ($price_choices as $pc) 
					{
						$price_choices[$x]['total'] = $pc['dp'] + ($pc['installment'] * $pc['tenor']);
						$x++;
					}
				}
				$unit_types[$i]['price_choices'] = $price_choices;
			}

			$area = $this->area_model->get_prov_kec($project['area_id']);
			$area_name = trim($area['area_name']);
			if($area['induk'])
			{
				$area_name .= ', ' . $area['induk'];
				if($area['induk2'])
				{
					$area_name .= ', ' . $area['induk2'];
				}
			}
			if($project['project_gmaps'])
			{
				$fa = '<span class="fa fa-map-marker"></span> ';
									//echo anchor($project['project_gmaps'], $fa . $project['area_name'], 'target="_blank"');
				$h2 = anchor($project['project_gmaps'], $fa . $area_name, 'target="_blank"');
			}
			else
			{
									//echo $project['area_name'];
				$h2 = $area_name;
			}

			$project_gallery = $this->gallery_model->get_by_project($project_id);
			$start_price = $this->project_model->get_lowest_price($project_id);
			$status_unit = $this->statusunit_model->get();

			$data = array(
				'title' => $project['project_name'],
				'h2' => $h2,
				'h3' => 'Mulai '. rupiah($start_price),
				'is_devteam' => $is_devteam,
				'project' => $project,
				'units' => $units,
				'unit_types' => $unit_types,
				'status_unit' => $status_unit,
				'project_gallery' => $project_gallery,
				'content' => 'backoffice/proyek/detil'
			);
			$this->load->view('backoffice/layout/wrapper', $data, FALSE);

		}


	}

	public function tambahunit($project_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->project_model->get($project_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->form_validation->set_rules('prefix', 'Blok/Prefix', 'trim|required', array('required' => '%s tidak boleh kosong.'));
			$this->form_validation->set_rules('start_no', 'Nomor unit awal', 'integer', array('integer' => 'Nomor unit awal harus berupa angka/bilangan bulat'));
			$this->form_validation->set_rules('end_no', 'Nomor unit akhir', 'integer|greater_than_equal_to['.$this->input->post('start_no').']', array(
				'greater_than_equal_to' => 'Nomor akhir harus sama atau lebih dari nomor unit awal',
				'integer' => '%s harus angka/bilangan bulat'
			));
			if ($this->form_validation->run()) 
			{
				//$project_id = $this->input->post('project_id', TRUE);
				$prefix = $this->input->post('prefix', TRUE);
				$start_no = $this->input->post('start_no', TRUE);
				$end_no = $this->input->post('end_no', TRUE);
				$project = $this->project_model->get($project_id);

				$null_start = empty($start_no);
				$null_end = empty($end_no);
				if (!$null_start && !$null_end && ($start_no != $end_no)) 
				{
					for ($i=$start_no; $i <= $end_no ; $i++) { 
						$unit_name = $prefix . $i;
						$unit_slug = url_title($unit_name, "-", TRUE);
						$data[$i] = array(
							'unit_name'	=> $unit_name,
							'unit_slug'	=> $unit_slug,
							'status_unit_id'	=> 1,
							'project_id' => $project_id,
						);
					}
					
					// echo '<pre>';
					// print_r($data);
					// echo '</pre>';
					// echo "<hr>";
					// echo count($data) . ' data';

					$this->unit_model->add_batch($data);
					redirect(base_url('proyek/detil/' . $project_id));

				}
				elseif ((!$null_start && $null_end) || ($null_start && !$null_end) || ($start_no == $end_no))
				{
					if ($null_end) $unit_name = $prefix . $start_no;
					if ($null_start) $unit_name = $prefix . $end_no;
					if ($start_no == $end_no) $unit_name = $prefix . $end_no;
					$unit_slug = url_title($unit_name, "-", TRUE);
					$data = array(
						'unit_name' => $unit_name,
						'unit_slug' => $unit_slug,
						'status_unit_id' => 1,
						'project_id' => $project_id,
					);
					// echo '<pre>';
					// print_r($data);
					// echo '</pre>';
					// echo "<hr> 1 Data";

					$this->unit_model->add($data);
					redirect(base_url('proyek/detil/' . $project_id));

				}
			} 
			// else 
			// {
			// 	echo validation_errors();
			// }
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

	public function editunit($unit_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->unit_model->get_project($unit_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->form_validation->set_rules('unit_name', 'Nama/Nomor Unit', 'trim|required', array('required' => '%s tidak boleh kosong.'));
			$this->form_validation->set_rules('status_unit_id', 'Status Unit', 'required', array('required' => '%s tidak boleh kosong.'));
			if ($this->form_validation->run()) 
			{
				//$project_id = $this->input->post('project_id', TRUE);
				$unit_name = $this->input->post('unit_name', TRUE);
				$status_unit_id = $this->input->post('status_unit_id', TRUE);

				$data = array(
					'unit_name' => $unit_name,
					'status_unit_id' => $status_unit_id,
				);

				$this->unit_model->edit($data, $unit_id);
				redirect(base_url('proyek/detil/' . $project['project_id']));
			} 
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

	public function hapusunit($unit_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->unit_model->get_project($unit_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->unit_model->delete($unit_id);
			$this->session->set_flashdata('s_rm_unit', 'Unit berhasil dihapus');
			redirect(base_url('proyek/detil/' . $project['project_id']));
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

	public function tambahtipe($project_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->project_model->get($project_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->form_validation->set_rules('floor', 'Jumlah lantai', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('lb', 'Luas bangunan', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('lt', 'Luas tanah', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('kt', 'Jumlah Kamar Tidur', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('km', 'Jumlah Kamar Mandi', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('price', 'Luas bangunan', 'required|numeric', array(
				'required' => '%s tidak boleh kosong.',
				'numeric' => '%s hanya boleh diisi angka'
			));
			if ($this->form_validation->run()) 
			{
				$floor 	= $this->input->post('floor', TRUE);
				$lb 	= $this->input->post('lb', TRUE);
				$lt 	= $this->input->post('lt', TRUE);
				$kt 	= $this->input->post('kt', TRUE);
				$km 	= $this->input->post('km', TRUE);
				$price 	= $this->input->post('price', TRUE);
				$units 	= $this->input->post('units', TRUE);

				$data_type = array(
					'floor' => $floor,
					'lb' => $lb,
					'lt' => $lt,
					'kt' => $kt,
					'km' => $km,
					'price' => $price,
					'project_id' => $project_id,
				);

				$unit_type_id = $this->unittype_model->add($data_type);
				//$unit_type_id = 1;
				if($units && count($units) == 1)
				{
					$data_units = array(
						'unit_type_id' => $unit_type_id,
						'unit_id' => $units[0],
					);
					$this->unittypechoice_model->add($data_units);
				}
				elseif ($units && count($units) > 1) 
				{
					foreach ($units as $unit) 
					{
						$data_units[] = array(
						'unit_type_id' => $unit_type_id,
						'unit_id' => $unit,
						);
					}
					$this->unittypechoice_model->add_batch($data_units);
				}
				redirect(base_url('proyek/detil/' . $project_id));
			} 
			// else 
			// {
			// 	echo validation_errors();
			// }
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

	public function edittipe($unit_type_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->unittype_model->get_project($unit_type_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->form_validation->set_rules('floor', 'Jumlah lantai', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('lb', 'Luas bangunan', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('lt', 'Luas tanah', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('kt', 'Jumlah Kamar Tidur', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('km', 'Jumlah Kamar Mandi', 'required|integer', array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat'
			));
			$this->form_validation->set_rules('price', 'Luas bangunan', 'required|numeric', array(
				'required' => '%s tidak boleh kosong.',
				'numeric' => '%s hanya boleh diisi angka'
			));
			if ($this->form_validation->run()) 
			{
				$floor 	= $this->input->post('floor', TRUE);
				$lb 	= $this->input->post('lb', TRUE);
				$lt 	= $this->input->post('lt', TRUE);
				$kt 	= $this->input->post('kt', TRUE);
				$km 	= $this->input->post('km', TRUE);
				$price 	= $this->input->post('price', TRUE);
				$units 	= $this->input->post('units', TRUE);

				$data_type = array(
					'floor' => $floor,
					'lb' => $lb,
					'lt' => $lt,
					'kt' => $kt,
					'km' => $km,
					'price' => $price,
					'project_id' => $project['project_id'],
				);

				$update_type = $this->unittype_model->edit($data_type, $unit_type_id);
				if ($update_type)
				{
					$this->unittypechoice_model->delete('unit_type_id', $unit_type_id);
					if ($units && count($units) == 1)
					{
						$data_units = array(
							'unit_type_id' => $unit_type_id,
							'unit_id' => $units[0],
						);
						$this->unittypechoice_model->add($data_units);
					}
					elseif ($units && count($units) > 1) 
					{
						foreach ($units as $unit) 
						{
							$data_units[] = array(
							'unit_type_id' => $unit_type_id,
							'unit_id' => $unit,
							);
						}
						$this->unittypechoice_model->add_batch($data_units);
					}
				}
				redirect(base_url('proyek/detil/' . $project['project_id']));
			} 
			// else 
			// {
			// 	echo validation_errors();
			// }
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

	public function hapustipe($unit_type_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->unittype_model->get_project($unit_type_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->unittype_model->delete($unit_type_id);
			$this->session->set_flashdata('s_rm_type', 'Tipe berhasil dihapus');
			redirect(base_url('proyek/detil/' . $project['project_id']));
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

	public function tambahgaleri($project_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->project_model->get($project_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}
		if ($is_devteam)
		{
			// $this->form_validation->set_rules('path_file', 'File', 'required', array(
			// 	'required' => '%s tidak boleh kosong.'
			// ));
			if (!empty($_FILES['path_file']['name']))
			{
				// Upload image, simpan db dst
				// Konfigurasi upload
				$config['upload_path']		= './assets/uploads/projects/';
				$config['allowed_types']	= 'gif|jpg|jpeg|png';
				$config['max_size']			= '2000';
				$config['file_ext_tolower']	= TRUE;
					//$config['encrypt_name']		= FALSE;
				$this->load->library('upload', $config);

				// Proses upload gagal
				if (!$this->upload->do_upload('path_file')) 
				{
					//echo $this->upload->display_errors();
					$this->session->set_flashdata('error_upload', 'Gagal mengupload gambar');
					redirect(base_url('proyek/detil/' . $project_id));
				} 
				else //UPLOAD SUKSES
				{
					// Upload berhasil
					// Menampung data upload file
					$upload_data        = array('uploads' => $this->upload->data());

          			// Menjalankan configurasi memanipulasi gambar
					$config['image_library']	= 'gd2';
					$config['source_image']		= './assets/uploads/projects/'.$upload_data['uploads']['file_name']; 
					$config['new_image']		= './assets/uploads/projects/thumbs/';
					$config['create_thumb']		= TRUE;
					$config['quality']			= "100%";
					$config['maintain_ratio']	= TRUE;
          			// $config['master_dim']  = 'auto';
					$config['width']			= 120;
          			// Pixel
					//$config['height']			= 120;
          			// Pixel
					$config['x_axis']			= 0;
					$config['y_axis']			= 0;
					$config['thumb_marker']		= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$data = array(
						'project_id'	=> $project_id,
						'path_file'		=> $upload_data['uploads']['file_name'],
					);
					$this->gallery_model->add($data);
					redirect(base_url('proyek/detil/' . $project_id));
				}
			}
			else
			{
				redirect(base_url('proyek/detil/' . $project_id));
			}
		}
		else
		{
			redirect(base_url('proyek/detil/' . $project_id));
		}
	}
	public function hapusgaleri($project_gallery_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$gallery = $this->gallery_model->get($project_gallery_id);
		if (!$gallery) redirect(base_url('backoffice/proyek'));

		$project = $this->gallery_model->get_project($project_gallery_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}
		if ($is_devteam)
		{
			$gambar = file_exists('./assets/uploads/projects/thumbs/' . $gallery['path_file']);
			if ($gambar != "") 
			{
				unlink('./assets/uploads/projects/' . $gallery['path_file']);
				unlink('./assets/uploads/projects/thumbs/' . $gallery['path_file']);
			}
			$this->gallery_model->delete($project_gallery_id);
			redirect(base_url('proyek/detil/' . $project['project_id']));
		}
		else
		{
			redirect(base_url('proyek/detil/' . $project['project_id']));
		}
	}

	public function marketing($project_id='')
	{
		if ($project_id == '')
			redirect(base_url('proyek/developer'));

		$project = $this->project_model->get($project_id);
		if (!$project || !array_key_exists('project_id', $project))
			redirect(base_url('proyek/developer'));

		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if(!$is_devteam) redirect(base_url('proyek/developer'));

		$area = $this->area_model->get_prov_kec($project['area_id']);
		$area_name = trim($area['area_name']);
		if($area['induk'])
		{
			$area_name .= ', ' . $area['induk'];
			if($area['induk2'])
			{
				$area_name .= ', ' . $area['induk2'];
			}
		}
		if($project['project_gmaps'])
		{
			$fa = '<span class="fa fa-map-marker"></span> ';
									//echo anchor($project['project_gmaps'], $fa . $project['area_name'], 'target="_blank"');
			$h2 = anchor($project['project_gmaps'], $fa . $area_name, 'target="_blank"');
		}
		else
		{
									//echo $project['area_name'];
			$h2 = $area_name;
		}

		$available_marketing = $this->projectmarketing_model->available_marketing($project_id);
		$marketings = $this->projectmarketing_model->get_by_project($project_id);
		$data = array(
			'title' => $project['project_name'],
			'h2' => $h2,
			'project' => $project,
			'marketings' => $marketings,
			'available_marketing' => $available_marketing,
			'content' => 'backoffice/proyek/marketing/list',
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);

	}

	public function tambahmarketing($project_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->project_model->get($project_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->form_validation->set_rules('marketings', 'Marketing', 'callback_marketing_check');
			if ($this->form_validation->run()) 
			{
				$marketings = $this->input->post('marketings', TRUE);
				$data = array();
				foreach ($marketings as $marketing) {
					$data[] = array(
						'project_id' => $project_id,
						'user_id' => $marketing,
					);
				}

				$this->projectmarketing_model->add_batch($data);
				redirect(base_url('proyek/marketing/' . $project_id));
			}
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

	public function marketing_check()
	{
		if (empty($this->input->post('marketings'))) {
			$this->form_validation->set_message('marketing_check', 'Pilih minimal satu marketing');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function hapusmarketing($project_marketing_id='')
	{
		# code...
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project = $this->projectmarketing_model->get_project($project_marketing_id);
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		$developer = $this->developer_model->get_by_user_id($user_id);
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam) 
		{
			$this->projectmarketing_model->delete($project_marketing_id);
			redirect(base_url('proyek/marketing/' . $project['project_id']));
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


}

/* End of file Proyek.php */
/* Location: ./application/controllers/backoffice/Proyek.php */