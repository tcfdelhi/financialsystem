<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/setting_model', 'settings_model');
		$this->load->model('activity_model','activity_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		}
		//-----------------------------------------------------------------------
		public function index(){
			$data['view'] = 'admin/users/user_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------------------
		public function terminated_client(){
			$data['view'] = 'admin/users/terminated_clients';
			$this->load->view('layout', $data);
		}
		//-----------------------------------------------------------------------
		public function terminated_clients(){
			$records = $this->user_model->get_all_users('user');
			$data = array();
			$i = 0;
			// print_r($records); die;
			foreach ($records['data']  as $row) 
			{  
				$status = ($row['is_active'] == 0)? 'inactive': 'active'.'<span>';
				$disabled = ($row['is_admin'] == 1)? 'disabled': ''.'<span>';
				$data[]= array(
					++$i,
					$row['country'],
					$row['currency'],
					$row['unit'],
					$row['company_name'],
					$row['company_abbreviation'],
					$row['accounting_term'],
					$row['start_year'],
					$row['email'],
					date('F j, Y',strtotime($row['created_at'])),
					// '<span class="btn bg-teal  waves-effect" title="status">'.getGroupyName($row['role']).'<span>',	// get Group name by ID (getGroupyName() is a helper function)
					// '<span class="btn bg-blue  waves-effect" title="status">'.$status.'<span>',			
					
					'<a title="Edit" class="update btn btn-sm btn-primary" href="'.base_url('admin/clients/restore/'.$row['client_id']).'"> <i class="material-icons">restore</i></a>
					<a title="Delete" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/clients/delete/'.$row['client_id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',
					
				);
			}
			$records['data']=$data;
			echo json_encode($records);
		}
		//-----------------------------------------------------------------------

		public function restore($id = 0){
			$this->db->where('id', $id);
			$this->db->update('ci_users', array('is_active'=>1));
			redirect(base_url('admin/clients/terminated_client'));
		}

		public function datatable_json(){
			$records = $this->user_model->get_all_users();
			$data = array();
			$i = 0;
			// print_r($records); die;
			foreach ($records['data']  as $row) 
			{  
				$status = ($row['is_active'] == 0)? 'inactive': 'active'.'<span>';
				$disabled = ($row['is_admin'] == 1)? 'disabled': ''.'<span>';
				$data[]= array(
					++$i,
					$row['company_name'].'<p>'.$row['email'].'</p>',
					$row['company_abbreviation'],
					$row['accounting_term'],
					$row['country'],
					$row['unit'],
					$row['start_year'],
					// $row['email'],
					date('F j, Y',strtotime($row['created_at'])),
					// '<span class="btn bg-teal  waves-effect" title="status">'.getGroupyName($row['role']).'<span>',	// get Group name by ID (getGroupyName() is a helper function)
					// '<span class="btn bg-blue  waves-effect" title="status">'.$status.'<span>',			
					
					'<a title="Edit" class="update btn btn-sm btn-primary" href="'.base_url('admin/clients/edit/'.$row['id']).'"> <i class="material-icons">edit</i></a>
					<a title="Delete" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/clients/del/'.$row['id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',
					
				);
			}
			$records['data']=$data;
			echo json_encode($records);						   
		}
		//-----------------------------------------------------------------------
		public function add(){
			$data['user_groups'] = $this->user_model->get_user_groups();
			$data['country'] = $this->user_model->get_countries();
			$data['currency'] = $this->settings_model->get_currencies();

			if($this->input->post('submit')){
				// $this->form_validation->set_rules('username', 'Username', 'trim|min_length[3]|required');
				$this->form_validation->set_rules('country', 'Country', 'trim|required');
				$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
				$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
				$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
				$this->form_validation->set_rules('company_abbreviation', 'Company Abbreviation', 'trim|required');
				$this->form_validation->set_rules('accounting_term', 'Accounting Term', 'trim|required');
				$this->form_validation->set_rules('start_year', 'Start Year', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/users/user_add';
					$this->load->view('layout', $data);
				}
				else{
					// Prepare Client data
					$client_data = array(
						'country' => $this->input->post('country'),
						'currency' => $this->input->post('currency'),
						'unit' => $this->input->post('unit'),
						'company_name' => $this->input->post('company_name'),
						'company_abbreviation' => $this->input->post('company_abbreviation'),
						'accounting_term' => $this->input->post('accounting_term'),
						'start_year' => $this->input->post('start_year'),
						'email' => $this->input->post('email'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT)
					);

					$insert_id = $this->user_model->add_client($client_data);

					// Prepare User Data
					$data = array(
						'client_id' => $insert_id,
						'username' => $this->input->post('email'),
						'firstname' => $this->input->post('company_name'),
						'lastname' => $this->input->post('company_name'),
						'email' => $this->input->post('email'),
						'mobile_no' => 0,
						'address' => $this->input->post('email'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
						// 'role' => $this->input->post('group'),
						'role' => 2,
						'is_admin' => 0,
						'is_verify' => 1,
						'country' => $this->input->post('country'),
						'created_at' => date('Y-m-d : h:m:s'),
						'updated_at' => date('Y-m-d : h:m:s'),
					);
					
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->add_user($data);

					if($result){
						// Add User Activity
						$this->activity_model->add(1);

						$this->session->set_flashdata('msg', 'User has been added successfully!');
						redirect(base_url('admin/clients'));
					}
				}
			}
			else{
				$data['view'] = 'admin/users/user_add';
				$this->load->view('layout', $data);
			}
			
		}
		//-----------------------------------------------------------------------
		public function edit($id = 0){
			$data['country'] = $this->user_model->get_countries();
			$data['user'] = $this->user_model->get_user_by_id($id);
			$data['currency'] = $this->settings_model->get_currencies();

			if($this->input->post('submit')){
				// $this->form_validation->set_rules('username', 'Username', 'trim|min_length[3]|required');
				$this->form_validation->set_rules('country', 'Country', 'trim|required');
				$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
				$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
				$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
				$this->form_validation->set_rules('company_abbreviation', 'Company Abbreviation', 'trim|required');
				$this->form_validation->set_rules('accounting_term', 'Accounting Term', 'trim|required');
				$this->form_validation->set_rules('start_year', 'Start Year', 'trim|required');

				if($this->input->post('email') != $data['user']['email']) {

					$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
				}
				else {
					$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

				}

				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				// $this->form_validation->set_rules('group', 'Group', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->user_model->get_user_by_id($id);
					// $data['user_groups'] = $this->user_model->get_user_groups();
					$data['view'] = 'admin/users/user_edit';
					$this->load->view('layout', $data);
				}
				else{
					$data = array(
						// 'username' => $this->input->post('email'),
						// 'firstname' => $this->input->post('email'),
						// 'lastname' => $this->input->post('email'),
						'email' => $this->input->post('email'),
						'country' => $this->input->post('country'),
						// 'mobile_no' => $this->input->post('email'),
						// 'address' => $this->input->post('email'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
						// 'role' => $this->input->post('group'),
						// 'is_admin' => $this->input->post('group'),
						// 'is_verify' => 1,
						// 'is_active' => $this->input->post('status'),
						// 'created_at' => date('Y-m-d : h:m:s'),
						// 'updated_at' => date('Y-m-d : h:m:s'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->edit_user($data, $id);

					// Prepare Client data
					$client_data = array(
						'country' => $this->input->post('country'),
						'currency' => $this->input->post('currency'),
						'unit' => $this->input->post('unit'),
						'company_name' => $this->input->post('company_name'),
						'company_abbreviation' => $this->input->post('company_abbreviation'),
						'accounting_term' => $this->input->post('accounting_term'),
						'start_year' => $this->input->post('start_year'),
						'email' => $this->input->post('email'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT)
					);

					$result = $this->user_model->edit_client($client_data, $id);
					// echo $str = $this->db->last_query(); die;
					if($result){

						// Add User Activity
						$this->activity_model->add(2);

						$this->session->set_flashdata('msg', 'User has been updated successfully!');
						redirect(base_url('admin/users'));
					}
				}
			}
			else{
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['client'] = $this->user_model->get_client_by_user_id($id);
				$data['user_groups'] = $this->user_model->get_user_groups();
				$data['view'] = 'admin/users/user_edit';
				$this->load->view('layout', $data);
			}
		}
		//-----------------------------------------------------------------------
		public function del($id = 0){

			$data = ['is_active'=>0];
			$this->db->where('client_id', $id);
			$this->db->update('ci_users', $data);
			// $this->db->delete('ci_users', array('id' => $id));

			// Add User Activity
			$this->activity_model->add(12);

			$this->session->set_flashdata('msg', 'Client has been terminated successfully!');
			redirect(base_url('admin/clients'));
		}

		//-----------------------------------------------------------------------
		public function delete($id = 0){

			$client_id = $this->db->get_where('ci_users', array('id' => $id))->row()->client_id;
			$this->db->delete('ci_clients', array('id' => $client_id));
			$this->db->delete('ci_users', array('id' => $id));
			// Add User Activity
			$this->activity_model->add(3);
			$this->session->set_flashdata('msg', 'Client has been deleted successfully!');
			redirect(base_url('admin/clients/terminated_client'));
		}

	}
?>