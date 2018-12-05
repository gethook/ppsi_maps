<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model');
		$this->load->model('area_model');
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$is_marketing = $this->auth->cek_role(array(6));
		if (!$is_marketing) redirect(base_url('user/profile'));
		if ($is_marketing)
		{
			$customers = $this->customer_model->get_by_user($user_id);
			$data = array(
				'title' => 'Konsumen',
				'customers' => $customers,
				'content' => 'backoffice/konsumen/list',
			);
			$this->load->view('backoffice/layout/wrapper', $data, FALSE);
		}
	}

	public function tambah()
	{
		$user_id = $this->session->userdata('user_id');
		$is_marketing = $this->auth->cek_role(array(6));
		if (!$is_marketing) redirect(base_url('user/profile'));

		$this->form_validation->set_rules('customer_name', 'Nama konsumen', 'trim|required|min_length[3]|callback_check_name', array(
			'required' => '%s tidak boleh kosong',
			'alpha' => '%s harus berupa huruf alfabet/tidak boleh mengandung angka',
			'min_length' => '%s minimal 3 huruf',
		));
		$this->form_validation->set_rules('gender_id', 'Jenis kelamin', 'required', array(
			'required' => '%s tidak boleh kosong',
		));
		$this->form_validation->set_rules('customer_phone', 'No Telp/WA', 'trim|required|is_natural', array(
			'required' => '%s tidak boleh kosong',
			'is_natural' => '%s harus berupa angka 0-9',
		));
		$this->form_validation->set_rules('customer_email', 'Email', 'trim|required|valid_email', array(
			'required' => '%s tidak boleh kosong',
			'valid_email' => '%s tidak valid',
		));

		if ($this->form_validation->run())
		{
			$customer_name = $this->input->post('customer_name', TRUE);
			$gender_id = $this->input->post('gender_id', TRUE);
			$customer_phone = $this->input->post('customer_phone', TRUE);
			$customer_email = $this->input->post('customer_email', TRUE);
			$area_id = $this->input->post('area_id', TRUE);

			$data = array(
				'customer_name' => $customer_name,
				'gender_id' => $gender_id,
				'customer_phone' => $customer_phone,
				'customer_email' => $customer_email,
				'area_id' => $area_id,
				'added_by' => $user_id
			);
			$this->customer_model->add($data);
			$this->session->set_flashdata('sukses', 'Data konsumen berhasil ditambahkan');
			redirect(base_url('konsumen'));
		}

		$gender = $this->customer_model->get_gender();
		$kota = $this->area_model->get_prov_kec();
		$data = array(
			'title' => 'Tambah Konsumen',
			'kota' => $kota,
			'gender' => $gender,
			'content' => 'backoffice/konsumen/add',
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function edit($customer_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$is_marketing = $this->auth->cek_role(array(6));
		if (!$is_marketing) redirect(base_url('user/profile'));
		if ($customer_id == '') redirect(base_url('konsumen'));

		$this->form_validation->set_rules('customer_name', 'Nama konsumen', 'trim|required|min_length[3]|callback_check_name', array(
			'required' => '%s tidak boleh kosong',
			'alpha' => '%s harus berupa huruf alfabet/tidak boleh mengandung angka',
			'min_length' => '%s minimal 3 huruf',
		));
		$this->form_validation->set_rules('gender_id', 'Jenis kelamin', 'required', array(
			'required' => '%s tidak boleh kosong',
		));
		$this->form_validation->set_rules('customer_phone', 'No Telp/WA', 'trim|required|is_natural', array(
			'required' => '%s tidak boleh kosong',
			'is_natural' => '%s harus berupa angka 0-9',
		));
		$this->form_validation->set_rules('customer_email', 'Email', 'trim|required|valid_email', array(
			'required' => '%s tidak boleh kosong',
			'valid_email' => '%s tidak valid',
		));

		if ($this->form_validation->run())
		{
			$customer_name = $this->input->post('customer_name', TRUE);
			$gender_id = $this->input->post('gender_id', TRUE);
			$customer_phone = $this->input->post('customer_phone', TRUE);
			$customer_email = $this->input->post('customer_email', TRUE);
			$area_id = $this->input->post('area_id', TRUE);

			$data = array(
				'customer_name' => $customer_name,
				'gender_id' => $gender_id,
				'customer_phone' => $customer_phone,
				'customer_email' => $customer_email,
				'area_id' => $area_id,
				//'added_by' => $user_id
			);
			$this->customer_model->edit($data, $customer_id);
			$this->session->set_flashdata('sukses', 'Data konsumen berhasil diubah');
			redirect(base_url('konsumen'));
		}

		$gender = $this->customer_model->get_gender();
		$kota = $this->area_model->get_prov_kec();
		$customer = $this->customer_model->get($customer_id);
		$data = array(
			'title' => 'Edit Konsumen',
			'customer' => $customer,
			'kota' => $kota,
			'gender' => $gender,
			'content' => 'backoffice/konsumen/edit',
		);
		$this->load->view('backoffice/layout/wrapper', $data, FALSE);
	}

	public function check_name($str)
	{
		if (! preg_match('/^[a-zA-Z\s]+$/', $str)) {
			$this->form_validation->set_message('check_name', '%s hanya boleh diisi huruf dan spasi');
			return FALSE;
		} else {
			return TRUE;
    	}
	}

}

/* End of file Konsumen.php */
/* Location: ./application/controllers/backoffice/Konsumen.php */