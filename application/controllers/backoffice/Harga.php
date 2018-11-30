<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pricechoice_model');
		$this->load->model('unittype_model');
		$this->load->model('developer_model');
		$this->load->model('project_model');
	}

	public function index()
	{
		
	}

	public function tambah($unit_type_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		$project_id = $this->unittype_model->get($unit_type_id)['project_id'];
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
			$this->form_validation->set_rules('dp', 'DP', 'required|numeric', array(
				'required' => '%s tidak boleh kosong.',
				'numeric' => '%s hanya boleh diisi angka/bilangan.'
			));
			$this->form_validation->set_rules('installment', 'Angsuran', 'required|numeric', array(
				'required' => '%s tidak boleh kosong.',
				'numeric' => '%s hanya boleh diisi angka/bilangan.'
			));
			$this->form_validation->set_rules('tenor', 'Tenor', 'required|integer',  array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat (dalam tahun).'
			));

			if ($this->form_validation->run()) 
			{
				# code...
				$dp = $this->input->post('dp', TRUE);
				$installment = $this->input->post('installment', TRUE);
				$tenor = $this->input->post('tenor', TRUE);
				//$total = $dp + ($installment * $tenor * 12);

				$data = array(
					'unit_type_id' => $unit_type_id,
					'dp' => $dp,
					'installment' => $installment,
					'tenor' => $tenor * 12,
				);
				$this->pricechoice_model->tambah($data);
				redirect(base_url('proyek/detil/'.$project_id));
			}

			$unit_type = $this->unittype_model->get($unit_type_id);

			$data = array(
				'title' => 'Tambah pilihan kredit',
				'unit_type_id' => $unit_type_id,
				'project' => $project,
				'unit_type' => $unit_type,
				'content' => 'backoffice/proyek/tambah_kredit', 
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

	public function edit($price_choice_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		// Cek proyek
		$project = $this->pricechoice_model->get_project($price_choice_id);
		// Jika proyek kosong atau proyek lebih dari satu
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		// Cek user anggota team dari developer mana
		$developer = $this->developer_model->get_by_user_id($user_id);
		// Jika user termasuk anggota team developer
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			// Cek apakah developernya sama dengan proyek ini
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam)
		{
			$this->form_validation->set_rules('dp', 'DP', 'required|numeric', array(
				'required' => '%s tidak boleh kosong.',
				'numeric' => '%s hanya boleh diisi angka/bilangan.'
			));
			$this->form_validation->set_rules('installment', 'Angsuran', 'required|numeric', array(
				'required' => '%s tidak boleh kosong.',
				'numeric' => '%s hanya boleh diisi angka/bilangan.'
			));
			$this->form_validation->set_rules('tenor', 'Tenor', 'required|integer',  array(
				'required' => '%s tidak boleh kosong.',
				'integer' => '%s hanya boleh diisi angka/bilangan bulat (dalam tahun).'
			));

			if ($this->form_validation->run()) 
			{
				# code...
				$dp = $this->input->post('dp', TRUE);
				$installment = $this->input->post('installment', TRUE);
				$tenor = $this->input->post('tenor', TRUE);
				//$total = $dp + ($installment * $tenor * 12);

				$data = array(
					//'unit_type_id' => $unit_type_id,
					'dp' => $dp,
					'installment' => $installment,
					'tenor' => $tenor * 12,
				);
				$this->pricechoice_model->edit($data, $price_choice_id);
				redirect(base_url('proyek/detil/' . $project['project_id']));
			}

			$price_choice = $this->pricechoice_model->get($price_choice_id);
			$unit_type = $this->unittype_model->get($price_choice['unit_type_id']);

			$data = array(
				'title' => 'Edit pilihan kredit',
				'price_choice' => $price_choice,
				'project' => $project,
				'unit_type' => $unit_type,
				'content' => 'backoffice/proyek/edit_kredit', 
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

	public function hapus($price_choice_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_devteam = FALSE;

		// Cek proyek
		$project = $this->pricechoice_model->get_project($price_choice_id);
		// Jika proyek kosong atau proyek lebih dari satu
		if (!$project || !array_key_exists('developer_id', $project))
			redirect(base_url('backoffice/proyek'));
		// Cek user anggota team dari developer mana
		$developer = $this->developer_model->get_by_user_id($user_id);
		// Jika user termasuk anggota team developer
		if ($developer && array_key_exists('developer_id', $developer)) 
		{
			// Cek apakah developernya sama dengan proyek ini
			$is_devteam = $this->auth->cek_dev_team($project['developer_id']);
		}

		if ($is_devteam)
		{
			$this->pricechoice_model->delete($price_choice_id);
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

}

/* End of file Harga.php */
/* Location: ./application/controllers/backoffice/Harga.php */