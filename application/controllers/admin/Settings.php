<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/setting_model', 'settings_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library		
	}

	//-----------------------------------------------------------------------
	public function index()
	{

		$data['view'] = 'admin/settings/admin_list';
		$this->load->view('layout', $data);
	}
	//-----------------------------------------------------------------------
	public function add($id = 0)
	{
		$data['country'] = $this->user_model->get_countries();
		if ($id != 0) $data['admin'] =  $this->db->get_where('ci_users', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;
		if ($this->input->post('submit')) {

			// $this->form_validation->set_rules('username', 'USername', 'trim|required');
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			if ($id == 0)
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');

			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/settings/add_admin';
				$this->load->view('layout', $data);
			} else {
				// Prepare Client data
				$user_data = array(
					'username' => $this->input->post('email'),
					'firstname' => $this->input->post('first_name'),
					'lastname' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'role' => 1,
					'is_admin' => 1,
					'is_verify' => 1,
					'country' => $this->input->post('country'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($user_data);
				if ($id == 0) $result = $this->user_model->add_user($data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_users', $data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(1);

					$this->session->set_flashdata('msg', 'User has been added successfully!');
					redirect(base_url('admin/settings'));
				}
			}
		} else {

			$data['view'] = 'admin/settings/add_admin';
			$this->load->view('layout', $data);
		}
	}


	public function get_admins()
	{
		$login_user_id =  $this->session->userdata('admin_id');
		$records = $this->settings_model->get_admins();
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {
			$disabled = ($row['id'] == $login_user_id) ? 'disabled' : '' . '<span>';
			$data[] = array(
				++$i,
				$row['firstname'],
				$row['email'],
				$row['country'],

				date('F j, Y', strtotime($row['created_at'])),

				// '<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">visibility</i></a>
				// <a title="Edit" class="update btn btn-sm btn-primary" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">edit</i></a>
				// <a title="Delete" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/clients/delete/'.$row['client_id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				// ',
				'<a title="Delete" class="delete btn btn-sm btn-danger ' . $disabled . '" data-href="' . base_url('admin/settings/delete/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}

	public function currency()
	{

		$data['view'] = 'admin/settings/currency';
		$data['currency'] =  $this->settings_model->get_currencies();
		$this->load->view('layout', $data);
	}

	public function add_currency($id = 0)
	{
		if ($id != 0) $data['currency'] =  $this->db->get_where('ci_currency', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('short_name', 'Short name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/settings/add_currency';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name'),
					'short_name' => $this->input->post('short_name'),
				);

				if ($id == 0) $result = $this->settings_model->add_currency($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_currency', $user_data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Currency has been added successfully!');
					redirect(base_url('admin/settings/currency'));
				}
			}
		} else {
			$data['view'] = 'admin/settings/add_currency';
			$this->load->view('layout', $data);
		}
	}

	// Languages

	public function languages()
	{

		$data['view'] = 'admin/settings/languages';
		$data['currency'] =  $this->settings_model->get_languages();
		$this->load->view('layout', $data);
	}

	public function add_language($id = 0)
	{
		if ($id != 0) $data['language'] =  $this->db->get_where('ci_languages', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('english', 'English', 'trim|required');
			$this->form_validation->set_rules('japanese', 'Japanese', 'trim|required');
			$this->form_validation->set_rules('vietnamese', 'Vietnamese', 'trim|required');
			$this->form_validation->set_rules('thai', 'Thai', 'trim|required');
			$this->form_validation->set_rules('indonesian', 'Indonesian', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/settings/add_language';
				$this->load->view('layout', $data);
			} else {
				// Prepare Language data
				$user_data = array(
					'english' => $this->input->post('english'),
					'japanese' => $this->input->post('japanese'),
					'vietnamese' => $this->input->post('vietnamese'),
					'thai' => $this->input->post('thai'),
					'indonesian' => $this->input->post('indonesian'),
				);

				if ($id == 0) $result = $this->settings_model->add_language($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_languages', $user_data);
					$result = true;
				}
				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Language has been added successfully!');
					redirect(base_url('admin/settings/languages'));
				}
			}
		} else {
			$data['view'] = 'admin/settings/add_language';
			$this->load->view('layout', $data);
		}
	}

	public function delete($id = 0)
	{

		$this->db->delete('ci_users', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'User has been deleted successfully!');
		redirect(base_url('admin/settings'));
	}

	public function delete_language($id = 0)
	{
		$this->db->delete('ci_languages', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'Language has been deleted successfully!');
		redirect(base_url('admin/settings/languages'));
	}

	public function delete_currency($id = 0)
	{
		$this->db->delete('ci_currency', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'Currency has been deleted successfully!');
		redirect(base_url('admin/settings/currency'));
	}

	public function import_excel()
	{

		if (isset($_FILES['uploadFile'])) {
			$path = 'uploads' . DIRECTORY_SEPARATOR . 'excel';
			// echo $path; die;
			require_once APPPATH . "third_party/PHPExcel.php";

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('uploadFile')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			if (empty($error)) {
				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file = $data['upload_data']['file_name'];
				} else {
					$import_xls_file = 0;
				}

				$inputFileName = $data['upload_data']['full_path'];
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$data = [];
					foreach ($allDataInSheet as $key => $value) {
						if ($key == 0) continue;
						$user_data = array(
							'english' => $value['A'],
							'japanese' => $value['B'],
							'vietnamese' => $value['C'],
							'thai' => $value['D'],
							'indonesian' => $value['E'],
						);
						$this->settings_model->add_language($user_data);
					}
					redirect(base_url('admin/settings/languages'));
				} catch (Exception $e) {
					die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
				}
			} else {
				echo $error['error'];
			}
		}
	}

	public function password()
	{
		$id = $this->session->userdata('admin_id');
		
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/settings/password';
				$this->load->view('layout', $data);
			} else {
				$data = array(
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
				);
				$data = $this->security->xss_clean($data);
				$result = $this->settings_model->change_pwd($data, $id);
				if ($result) {
					$this->session->set_flashdata('msg', 'Password has been changed successfully!');
					redirect(base_url('admin/settings'));
				}
			}
		}
		else {
			$data['view'] = 'admin/settings/password';
			$this->load->view('layout', $data);

		}

	}
}
