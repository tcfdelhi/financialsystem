<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bscode extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/setting_model', 'settings_model');
		$this->load->model('admin/bs_model', 'bs_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library		
	}

	//-----------------------------------------------------------------------
	public function index()
	{

		$data['view'] = 'admin/bscode/codes';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------

	public function get_codes()
	{
		$records = $this->bs_model->get_codes();
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {

			$data[] = array(
				++$i,
				$row['code'],
				$row['title'],
				$row['major_item'],
				$row['medium_item'],
				$row['cash_flow_category'],
				$row['cash_flow'],


				// '<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">visibility</i></a>
				// <a title="Edit" class="update btn btn-sm btn-primary" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">edit</i></a>
				// <a title="Delete" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/clients/delete/'.$row['client_id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				// ',
				'<a title="Edit" class="update btn btn-sm btn-primary" href="' . base_url('admin/bscode/add_code/' . $row['id']) . '"> <i class="material-icons">edit</i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger"  data-href="' . base_url('admin/bscode/delete/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}


	//-----------------------------------------------------------------------
	public function add_code($id = 0)
	{
		$data['major_items'] = $this->bs_model->get_major_items();
		$data['medium_items'] = $this->bs_model->get_medium_items();
		$data['cash_flow_categories'] = $this->bs_model->get_cash_flow_categories();
		$data['clients'] = $this->bs_model->get_clients();
		// print_r($data['clients']); die;


		if ($id != 0) $data['code_data'] =  $this->db->get_where('ci_bs_code', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;
		if ($this->input->post('submit')) {

			// $this->form_validation->set_rules('username', 'USername', 'trim|required');
			$this->form_validation->set_rules('code', 'Code', 'trim|required');
			$this->form_validation->set_rules('title', 'Accounting Code', 'trim|required');
			$this->form_validation->set_rules('major_item', 'Major items of BS', 'trim|required');
			$this->form_validation->set_rules('medium_item', 'Medium item of BS', 'trim|required');
			$this->form_validation->set_rules('cash_flow_category', 'Cash Flow category', 'trim|required');
			$this->form_validation->set_rules('cash_flow', 'Increase and Decrease in Cash Flow', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/bscode/add_code';
				$this->load->view('layout', $data);
			} else {
				// Prepare Client data
				$user_data = array(
					'client_id' => $this->input->post('client_id'),
					'code' => $this->input->post('code'),
					'title' => $this->input->post('title'),
					'major_item' => $this->input->post('major_item'),
					'medium_item' => $this->input->post('medium_item'),
					'cash_flow_category' =>  $this->input->post('cash_flow_category'),
					'cash_flow' => $this->input->post('cash_flow'),
				);
				$data = $this->security->xss_clean($user_data);
				if ($id == 0) $result = $this->bs_model->add_code($data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_bs_code', $data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(1);

					$this->session->set_flashdata('msg', 'Code has been added successfully!');
					redirect(base_url('admin/bscode'));
				}
			}
		} else {

			$data['view'] = 'admin/bscode/add_code';
			$this->load->view('layout', $data);
		}
	}

	public function major_item()
	{
		$data['view'] = 'admin/bscode/major_item';
		$data['major_items'] =  $this->bs_model->get_major_items();
		$this->load->view('layout', $data);
	}

	public function add_major_item($id = 0)
	{
		if ($id != 0) $data['currency'] =  $this->db->get_where('ci_major_item', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/bscode/add_major_item';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name')
				);

				if ($id == 0) $result = $this->bs_model->add_major_item($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_major_item', $user_data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Currency has been added successfully!');
					redirect(base_url('admin/bscode/major_item'));
				}
			}
		} else {
			$data['view'] = 'admin/bscode/add_major_item';
			$this->load->view('layout', $data);
		}
	}

	// Medium Item
	public function medium_item()
	{
		$data['view'] = 'admin/bscode/medium_item';
		$data['medium_items'] =  $this->bs_model->get_medium_items();
		$this->load->view('layout', $data);
	}

	public function add_medium_item($id = 0)
	{
		if ($id != 0) $data['currency'] =  $this->db->get_where('ci_medium_item', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/bscode/add_medium_item';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name')
				);

				if ($id == 0) $result = $this->bs_model->add_medium_item($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_medium_item', $user_data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Medium has been added successfully!');
					redirect(base_url('admin/bscode/medium_item'));
				}
			}
		} else {
			$data['view'] = 'admin/bscode/add_medium_item';
			$this->load->view('layout', $data);
		}
	}

	// Cash Flow Catgeoriers Section
	public function cash_flow()
	{
		$data['view'] = 'admin/bscode/cash_flow_category';
		$data['cash_flow_categories'] =  $this->bs_model->get_cash_flow_categories();
		$this->load->view('layout', $data);
	}

	public function add_cash_flow($id = 0)
	{
		if ($id != 0) $data['cash_flow'] =  $this->db->get_where('ci_cash_flow_category', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('cash_flow', 'Cash Flow Rate', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/bscode/add_cash_flow_category';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name'),
					'cash_flow' => $this->input->post('cash_flow')
				);
				if ($id == 0) $result = $this->bs_model->add_cash_flow_categories($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_cash_flow_category', $user_data);
					$result = true;
				}
				// echo "s"; die;

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Category has been added successfully!');
					redirect(base_url('admin/bscode/cash_flow'));
				}
			}
		} else {
			$data['view'] = 'admin/bscode/add_cash_flow_category';
			$this->load->view('layout', $data);
		}
	}


	public function delete($id = 0 )
	{
		$this->db->delete('ci_bs_code', array('id' => $id));
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'BS Code has been deleted successfully!');
		redirect(base_url('admin/bscode'));
	}
	public function delete_major($id = 0)
	{

		$this->db->delete('ci_major_item', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'User has been deleted successfully!');
		redirect(base_url('admin/bscode/major_item'));
	}

	public function delete_medium($id = 0)
	{
		$this->db->delete('ci_medium_item', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'Language has been deleted successfully!');
		redirect(base_url('admin/bscode/medium_item'));
	}

	public function delete_cash_flow($id = 0)
	{
		$this->db->delete('ci_cash_flow_category', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'Currency has been deleted successfully!');
		redirect(base_url('admin/bscode/cash_flow'));
	}

	public function import_excel()
	{
		if ($this->input->post('submit')) {
			$path = 'uploads' . DIRECTORY_SEPARATOR . 'bscode'.DIRECTORY_SEPARATOR;
			require_once APPPATH . "third_party/PHPExcel.php";

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv';
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
				$inputFileName = $path . $import_xls_file;
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);


					foreach ($allDataInSheet as $key => $value) {

						$data = [];
						if ($key == 1) continue;

						$cash_flow_category = $value['E'];
						$cash_flow = $value['F'];
						$cash_flow_category_id = $this->db->get_where('ci_cash_flow_category', array('name' => "$cash_flow_category", 'cash_flow' => "$cash_flow"))->row()->id;
						if (empty($cash_flow_category_id)) {
							$cash_cat_data['name'] = $cash_flow_category;
							$cash_cat_data['cash_flow'] = $cash_flow;
							$this->db->insert('ci_cash_flow_category', $cash_cat_data);
							$cash_flow_category_id = $this->db->insert_id();
						}

						// Major Item
						$major_item = $value['C'];
						$major_item_id = $this->db->get_where('ci_major_item', array('name' => "$major_item"))->row()->id;
						if (empty($major_item_id)) {
							$major_data['name'] = $major_item;
							$this->db->insert('ci_major_item', $major_data);
							$major_item_id = $this->db->insert_id();
						}


						// Medium Item
						$medium_item = $value['D'];
						$medium_item_id = $this->db->get_where('ci_medium_item', array('name' => "$medium_item"))->row()->id;
						if (empty($medium_item_id)) {
							$medium_data['name'] = $medium_item;
							$this->db->insert('ci_medium_item', $medium_data);
							$medium_item_id = $this->db->insert_id();
						}


						// Prepare Data For Bs Codes
						$data['code'] = $value['A'];
						$data['title'] = $value['B'];
						$data['major_item'] = $major_item_id;
						$data['medium_item'] = $medium_item_id;
						$data['cash_flow_category'] = $cash_flow_category_id;
						$data['cash_flow'] = $cash_flow;
						$result = $this->bs_model->add_code($data);
					}
					// echo "<pre>";
					// print_r($allDataInSheet);
					// die;
					redirect("admin/bscode", 'refresh');
				} catch (Exception $e) {
					$this->session->set_flashdata('error', 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
					unlink($path . $data['upload_data']['file_name']);
					redirect("admin/bscode", 'refresh');
				}
			} else {
				$this->session->set_flashdata('error', $error['error']);
				unlink($path . $data['upload_data']['file_name']);
				redirect("admin/bscode", 'refresh');
			}
		}
	}
}