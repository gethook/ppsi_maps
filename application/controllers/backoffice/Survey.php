<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('projectsurvey_model');
		$this->load->model('projectmarketing_model');
		$this->load->model('customer_model');
		$this->load->model('devteam_model');
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$is_marketing = $this->auth->cek_role(array(6));
		$is_devteam = FALSE;
		$developer_team = $this->devteam_model->get_by_user_id($user_id);
		if ($developer_team && array_key_exists('developer_id', $developer_team))
		{
			$is_devteam = TRUE;
		}
		if ($is_devteam)
		{
			redirect(base_url('survey/developer/' . $developer_team['developer_id']));
		}
		if ($is_marketing)
		{
			redirect(base_url('survey/marketing/' . $user_id));
		}
		redirect(base_url('user/profile'));
	}

	public function marketing($marketing_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$role_allowed_to_add = array(6);
		$allowed_to_add = $this->auth->cek_role($role_allowed_to_add);

		$jadwal_survey = $this->projectsurvey_model->get_by_marketing($user_id);

		$data = array(
			'title' => 'Jadwal Survey',
			'jadwal_survey' => $jadwal_survey,
			'allowed_to_add' => $allowed_to_add,
			'content' => 'backoffice/survey/list'
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function developer($developer_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$developer_team = $this->devteam_model->get_by_user_id($user_id);
		if ($developer_team && array_key_exists('developer_id', $developer_team))
		{
			$developer_id = $developer_team['developer_id'];
		}
		$jadwal_survey = $this->projectsurvey_model->get_by_developer($developer_id);

		$data = array(
			'title' => 'Jadwal Survey',
			'jadwal_survey' => $jadwal_survey,
			'content' => 'backoffice/survey/list_by_developer'
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function tambah()
	{
		$user_id = $this->session->userdata('user_id');
		$customers = $this->customer_model->get_by_user($user_id);
		$projects = $this->projectmarketing_model->get_by_marketing($user_id);

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', array(
			'required' => '%s harus diisi'
		));
		$this->form_validation->set_rules('jam', 'Jam', 'trim|required', array(
			'required' => '%s harus diisi'
		));
		$this->form_validation->set_rules('project_id', 'Proyek', 'required', array(
			'required' => '%s harus diisi'
		));
		$this->form_validation->set_rules('customer_id', 'Konsumen', 'required', array(
			'required' => '%s harus diisi'
		));

		if ($this->form_validation->run())
		{
			$tanggal = $this->input->post('tanggal', TRUE);
			$jam = $this->input->post('jam', TRUE);
			$project_id = $this->input->post('project_id', TRUE);
			$customer_id = $this->input->post('customer_id', TRUE);
			$datetime = $tanggal . ' ' . $jam . ':00';
			$project_survey_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $datetime)));

			$data = array(
				'project_survey_date' => $project_survey_date,
				'project_id' => $project_id,
				'customer_id' => $customer_id,
				'created_by' => $user_id,
			);

			$this->projectsurvey_model->add($data);
			$this->session->set_flashdata('sukses', 'Jadwal Survey berhasil ditambahkan.');
			redirect(base_url('survey/marketing'));
		}

		$data = array(
			'title' => 'Buat Jadwal Survey',
			'customers' => $customers,
			'projects' => $projects,
			'content' => 'backoffice/survey/add'
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function edit($project_survey_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$customers = $this->customer_model->get_by_user($user_id);
		$projects = $this->projectmarketing_model->get_by_marketing($user_id);
		$project_survey = $this->projectsurvey_model->get($project_survey_id);
		if ($user_id != $project_survey['created_by'])
		{
			redirect(base_url('survey/marketing'));
		}

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', array(
			'required' => '%s harus diisi'
		));
		$this->form_validation->set_rules('jam', 'Jam', 'trim|required', array(
			'required' => '%s harus diisi'
		));
		$this->form_validation->set_rules('project_id', 'Proyek', 'required', array(
			'required' => '%s harus diisi'
		));
		$this->form_validation->set_rules('customer_id', 'Konsumen', 'required', array(
			'required' => '%s harus diisi'
		));

		if ($this->form_validation->run())
		{
			$tanggal = $this->input->post('tanggal', TRUE);
			$jam = $this->input->post('jam', TRUE);
			$project_id = $this->input->post('project_id', TRUE);
			$customer_id = $this->input->post('customer_id', TRUE);
			$datetime = $tanggal . ' ' . $jam . ':00';
			$project_survey_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $datetime)));

			$data = array(
				'project_survey_date' => $project_survey_date,
				'project_id' => $project_id,
				'customer_id' => $customer_id,
			);

			$this->projectsurvey_model->edit($data, $project_survey_id);
			$this->session->set_flashdata('sukses', 'Jadwal Survey berhasil diubah.');
			redirect(base_url('survey/marketing'));
		}

		$data = array(
			'title' => 'Ubah Jadwal Survey',
			'customers' => $customers,
			'projects' => $projects,
			'project_survey' => $project_survey,
			'content' => 'backoffice/survey/edit'
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

}

/* End of file Survey.php */
/* Location: ./application/controllers/backoffice/Survey.php */