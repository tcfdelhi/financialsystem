<?php defined('BASEPATH') or exit('No direct script access allowed');
class Profile extends UR_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/user_model', 'user_model');
	}
	//-------------------------------------------------------------------------
	public function index()
	{
		$data['country'] = $this->user_model->get_countries();
		$data['currency'] = $this->user_model->get_currencies();
		$data['user'] = $this->user_model->get_user_detail();


		if ($this->input->post('submit')) {

			// Validation Here
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
			$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('company_abbreviation', 'Company Abbreviation', 'trim|required');
			$this->form_validation->set_rules('accounting_term', 'Accounting Term', 'trim|required');
			$this->form_validation->set_rules('start_year', 'Start Year', 'trim|required');

			if ($this->input->post('email') != $data['user']['email']) {

				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
			} else {
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			}


			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'User Profile';
				$data['view'] = 'user/profile';
				$this->load->view('layout', $data);
			} else {
				$data = array(
					'email' => $this->input->post('email'),
					'country' => $this->input->post('country'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->update_user($data);
				// Prepare Client Data
				$client_data = array(
					'country' => $this->input->post('country'),
					'currency' => $this->input->post('currency'),
					'unit' => $this->input->post('unit'),
					'company_name' => $this->input->post('company_name'),
					'company_abbreviation' => $this->input->post('company_abbreviation'),
					'accounting_term' => $this->input->post('accounting_term'),
					'start_year' => $this->input->post('start_year'),
					'email' => $this->input->post('email')
				);
				$id = $this->session->userdata('user_id');
				$client_id =  $this->db->get_where('ci_users', array('id' => $id))->row()->client_id;
				$result = $this->user_model->edit_client($client_data, $client_id);
			}
			if ($result) {
				$this->session->set_flashdata('msg', 'Profile has been Updated Successfully!');
				redirect(base_url('user/profile'), 'refresh');
			}
		} else {

			$data['title'] = 'User Profile';
			$data['view'] = 'user/profile';
			$this->load->view('layout', $data);
		}
	}

	//-------------------------------------------------------------------------
	public function change_pwd()
	{
		$id = $this->session->userdata('user_id');
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->get_user_detail();
				$data['view'] = 'user/profile';
				$this->load->view('layout', $data);
			} else {
				$data = array(
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->change_pwd($data, $id);
				if ($result) {
					$this->session->set_flashdata('msg', 'Password has been changed successfully!');
					redirect(base_url('user/profile'));
				}
			}
		} else {
			$data['user'] = $this->user_model->get_user_detail();
			$data['title'] = 'Change Password';
			$data['view'] = 'user/profile';
			$this->load->view('layout', $data);
		}
	}

	public function set_session_language()
	{
		$this->load->library('session');
		if (($this->uri->segment(4) != '')) {
			$sessionyear = $this->uri->segment(4);
			if ($sessionyear) {
				$this->session->set_userdata('session_language', $sessionyear);
				redirect(base_url('/'));
			}
		}
	}
}
