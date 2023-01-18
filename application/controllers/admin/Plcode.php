<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plcode extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/setting_model', 'settings_model');
		$this->load->model('admin/Pl_model', 'pl_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library		
	}

	//-----------------------------------------------------------------------
	public function index()
	{
		$data['years'] = $this->pl_model->get_years();
		$data['clients'] = $this->pl_model->get_clients();
		$data['view'] = 'admin/plcode/codes';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------
	public function list($year = 0, $client_id = 0)
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$year  = $this->input->post('year');
			$client_id  = $this->input->post('client_id');
		} else {
			redirect(base_url('admin/plcode'));
		}

		$data['years'] = $this->pl_model->get_years();
		$data['year'] = $year;
		$data['client_id'] = $client_id;
		$data['clients'] = $this->pl_model->get_clients();
		$data['view'] = 'admin/plcode/list';
		$this->load->view('layout', $data);
	}


	//-----------------------------------------------------------------------

	public function get_codes()
	{
		$year  = $this->input->get('year');
		$client_id  = $this->input->get('client_id');

		$records = $this->pl_model->get_codes($year, $client_id);
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {

			$data[] = array(
				++$i,
				// $row['year'],
				// $row['firstname'] . '  ' . $row['lastname'],
				$row['code'],
				$row['title'],
				$row['major_name'],
				$row['medium_name'],
				$row['break_cat_name'],
				$row['cat'],
				$row['cash_flow'],


				// '<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">visibility</i></a>
				// <a title="Edit" class="update btn btn-sm btn-primary" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">edit</i></a>
				// <a title="Delete" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/clients/delete/'.$row['client_id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				// ',
				'<a title="Edit" class="update btn btn-sm btn-primary" href="' . base_url('admin/plcode/add_code/' . $row['id']) . '"> <i class="material-icons">edit</i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger"  data-href="' . base_url('admin/plcode/delete/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}


	//-----------------------------------------------------------------------
	public function add_code($id = 0)
	{
		$data['major_items'] = $this->pl_model->get_major_items();
		$data['medium_items'] = $this->pl_model->get_medium_items();
		$data['cash_flow_categories'] = $this->pl_model->get_cash_flow_categories();
		$data['breakdown_categories'] = $this->pl_model->get_breakdown_categories();
		$data['clients'] = $this->pl_model->get_clients();
		$data['years'] = $this->pl_model->get_years();
		
		
		if($id == 0 ) {
			$data['title'] = "Add New Pl Code";
			$data['button'] = "Add";
		} 
		else {
			$data['title'] = "Update Code";
			$data['button'] = "Update";
		}



		if ($id != 0) $data['code_data'] =  $this->db->get_where('ci_pl_code', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;
		if ($this->input->post('submit')) {

			// $this->form_validation->set_rules('username', 'USername', 'trim|required');
			$this->form_validation->set_rules('code', 'Code', 'trim|required');
			$this->form_validation->set_rules('title', 'Accounting Code', 'trim|required');
			$this->form_validation->set_rules('major_item', 'Major items of BS', 'trim|required');
			$this->form_validation->set_rules('medium_item', 'Medium item of BS', 'trim|required');
			$this->form_validation->set_rules('cash_flow_category', 'Cash Flow category', 'trim|required');
			$this->form_validation->set_rules('cash_flow', 'Increase and Decrease in Cash Flow', 'trim|required');
			$this->form_validation->set_rules('year', 'Financial Year', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/plcode/add_code';
				$this->load->view('layout', $data);
			} else {
				// Prepare Client data
				$user_data = array(
					'client_id' => $this->input->post('client_id'),
					'code' => $this->input->post('code'),
					'title' => $this->input->post('title'),
					'major_item' => $this->input->post('major_item'),
					'medium_item' => $this->input->post('medium_item'),
					'breakdown_cat' => $this->input->post('breakdown_cat'),
					'cash_flow_category' =>  $this->input->post('cash_flow_category'),
					'cash_flow' => $this->input->post('cash_flow'),
					'year' => $this->input->post('year'),
				);
				$data = $this->security->xss_clean($user_data);
				if ($id == 0) $result = $this->pl_model->add_code($data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_pl_code', $data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(1);

					$this->session->set_flashdata('msg', 'Code has been added successfully!');
					redirect(base_url('admin/plcode'));
				}
			}
		} else {

			$data['view'] = 'admin/plcode/add_code';
			$this->load->view('layout', $data);
		}
	}

	public function major_item()
	{
		$data['view'] = 'admin/plcode/major_item';
		$data['major_items'] =  $this->pl_model->get_major_items();
		$this->load->view('layout', $data);
	}

	public function add_major_item($id = 0)
	{
		if ($id != 0) $data['currency'] =  $this->db->get_where('ci_pl_major_item', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if($id == 0 ) {
			$data['title'] = "Add New Pl Major Item";
			$data['button'] = "Add";
		} 
		else {
			$data['title'] = "Update Item";
			$data['button'] = "Update";
		}

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/plcode/add_major_item';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name')
				);

				if ($id == 0) $result = $this->pl_model->add_major_item($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_pl_major_item', $user_data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Currency has been added successfully!');
					redirect(base_url('admin/plcode/major_item'));
				}
			}
		} else {
			$data['view'] = 'admin/plcode/add_major_item';
			$this->load->view('layout', $data);
		}
	}

	// Medium Item
	public function medium_item()
	{
		$data['view'] = 'admin/plcode/medium_item';
		$data['medium_items'] =  $this->pl_model->get_medium_items();
		$this->load->view('layout', $data);
	}

	public function add_medium_item($id = 0)
	{
		if ($id != 0) $data['currency'] =  $this->db->get_where('ci_pl_medium_item', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if($id == 0 ) {
			$data['title'] = "Add New Pl Medium Item";
			$data['button'] = "Add";
		} 
		else {
			$data['title'] = "Update Item";
			$data['button'] = "Update";
		}

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/plcode/add_medium_item';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name')
				);

				if ($id == 0) $result = $this->pl_model->add_medium_item($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_pl_medium_item', $user_data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Medium has been added successfully!');
					redirect(base_url('admin/plcode/medium_item'));
				}
			}
		} else {
			$data['view'] = 'admin/plcode/add_medium_item';
			$this->load->view('layout', $data);
		}
	}

	// Cash Flow Catgeoriers Section
	public function cash_flow()
	{
		$data['view'] = 'admin/plcode/cash_flow_category';
		$data['cash_flow_categories'] =  $this->pl_model->get_cash_flow_categories();
		$this->load->view('layout', $data);
	}

	public function add_cash_flow($id = 0)
	{
		if ($id != 0) $data['cash_flow'] =  $this->db->get_where('ci_pl_cash_flow_category', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if($id == 0 ) {
			$data['title'] = "Add New Cashflow Category";
			$data['button'] = "Add";
		} 
		else {
			$data['title'] = "Update Category";
			$data['button'] = "Update";
		}

		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('cash_flow', 'Cash Flow Rate', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/plcode/add_cash_flow_category';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name'),
					'cash_flow' => $this->input->post('cash_flow')
				);
				if ($id == 0) $result = $this->pl_model->add_cash_flow_categories($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_pl_cash_flow_category', $user_data);
					$result = true;
				}
				// echo "s"; die;

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Category has been added successfully!');
					redirect(base_url('admin/plcode/cash_flow'));
				}
			}
		} else {
			$data['view'] = 'admin/plcode/add_cash_flow_category';
			$this->load->view('layout', $data);
		}
	}


	public function delete($id = 0)
	{
		$this->db->delete('ci_pl_code', array('id' => $id));
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'BS Code has been deleted successfully!');
		redirect(base_url('admin/plcode'));
	}
	public function delete_major($id = 0)
	{

		$this->db->delete('ci_pl_major_item', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'User has been deleted successfully!');
		redirect(base_url('admin/plcode/major_item'));
	}

	public function delete_medium($id = 0)
	{
		$this->db->delete('ci_pl_medium_item', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'Language has been deleted successfully!');
		redirect(base_url('admin/plcode/medium_item'));
	}

	public function delete_cash_flow($id = 0)
	{
		$this->db->delete('ci_pl_cash_flow_category', array('id' => $id));
		// Add User Activity
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'Currency has been deleted successfully!');
		redirect(base_url('admin/plcode/cash_flow'));
	}

	public function import_excel()
	{
		if ($this->input->post('submit')) {
			$client_id = $this->input->post('client_id');
			$year = $this->input->post('year');
			$path = 'uploads' . DIRECTORY_SEPARATOR . 'bscode' . DIRECTORY_SEPARATOR;
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

						$cash_flow_category = $value['F'];
						$cash_flow = $value['G'];
						$cash_flow_category_id = $this->db->get_where('ci_pl_cash_flow_category', array('name' => "$cash_flow_category", 'cash_flow' => "$cash_flow"))->row()->id;
						if (empty($cash_flow_category_id)) {
							$cash_cat_data['name'] = $cash_flow_category;
							$cash_cat_data['cash_flow'] = $cash_flow;
							$this->db->insert('ci_pl_cash_flow_category', $cash_cat_data);
							$cash_flow_category_id = $this->db->insert_id();
						}

						// Major Item
						$major_item = $value['C'];
						$major_item_id = $this->db->get_where('ci_pl_major_item', array('name' => "$major_item"))->row()->id;
						if (empty($major_item_id)) {
							$major_data['name'] = $major_item;
							$this->db->insert('ci_pl_major_item', $major_data);
							$major_item_id = $this->db->insert_id();
						}


						// Medium Item
						$medium_item = $value['D'];
						$medium_item_id = $this->db->get_where('ci_pl_medium_item', array('name' => "$medium_item"))->row()->id;
						if (empty($medium_item_id)) {
							$medium_data['name'] = $medium_item;
							$this->db->insert('ci_pl_medium_item', $medium_data);
							$medium_item_id = $this->db->insert_id();
						}


						// Break Down category
						$medium_item = $value['E'];
						$breakdwon_cat = $this->db->get_where('ci_pl_breakdown_cat', array('name' => "$medium_item"))->row()->id;
						if (empty($breakdwon_cat)) {
							$medium_data['name'] = $medium_item;
							$this->db->insert('ci_pl_breakdown_cat', $medium_data);
							$breakdwon_cat = $this->db->insert_id();
						}



						// Prepare Data For Bs Codes
						$data['year'] = $year;
						$data['client_id'] = $client_id;
						$data['code'] = $value['A'];
						$data['title'] = $value['B'];
						$data['major_item'] = $major_item_id;
						$data['medium_item'] = $medium_item_id;
						$data['breakdown_cat'] = $breakdwon_cat;
						$data['cash_flow_category'] = $cash_flow_category_id;
						$data['cash_flow'] = $cash_flow;
						$result = $this->pl_model->add_code($data);
					}
					if ($result) {
						$this->session->set_flashdata('msg', 'Files Has Been Imported Successfully!');
					}
					// echo "<pre>";
					// print_r($allDataInSheet);
					// die;
					redirect("admin/plcode", 'refresh');
				} catch (Exception $e) {
					$this->session->set_flashdata('error', 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
					unlink($path . $data['upload_data']['file_name']);
					redirect("admin/plcode", 'refresh');
				}
			} else {
				$this->session->set_flashdata('error', $error['error']);
				unlink($path . $data['upload_data']['file_name']);
				redirect("admin/plcode", 'refresh');
			}
		}
	}

	public function export_excel($client_id = 0, $year = 0)
	{
		require_once APPPATH . "third_party/PHPExcel.php";

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Accounting Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Title(Accounting Name)');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Major Item Of Bs');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Medium Item Of Bs');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Breakdown Category');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Cash Flow Category');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Increase Or Decrease In Cash Flow');

		$records = $this->pl_model->get_codes_export($year, $client_id);
		// print_r($records); die;
		$rowCount = 2;
		foreach ($records as $list) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['title']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['major_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['medium_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['break_cat_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['cat']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list['cash_flow']);
			$rowCount++;
		}
		$filename = "clients" . date("Y-m-d") . ".csv";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
		$objWriter->save('php://output');
	}

	public function list_view()
	{
		$data['major_items'] = $this->pl_model->get_major_items();
		$data['medium_items'] = $this->pl_model->get_medium_items();
		$data['cash_flow_categories'] = $this->pl_model->get_cash_flow_categories();
		$data['cashflow'] = $this->pl_model->cashflow();
		$data['view'] = 'admin/plcode/list_view';
		$this->load->view('layout', $data);
	}

	public function breakdown_cat(){
		
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();

		$data['view'] = 'admin/plcode/breakdown_category';
		$this->load->view('layout', $data);
	}
	
	public function add_breakdown($id = 0)
	{
		if ($id != 0) $data['currency'] =  $this->db->get_where('ci_pl_breakdown_cat', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;

		if($id == 0 ) {
			$data['title'] = "Add New Breakdown Category";
			$data['button'] = "Add";
		} 
		else {
			$data['title'] = "Update Category";
			$data['button'] = "Update";
		}

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/plcode/add_breakdown_category';
				$this->load->view('layout', $data);
			} else {
				// Prepare Currency data
				$user_data = array(
					'name' => $this->input->post('name')
				);

				if ($id == 0) $result = $this->pl_model->add_breakdown_categories($user_data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_pl_breakdown_cat', $user_data);
					$result = true;
				}

				if ($result) {
					// Add User Activity
					$this->activity_model->add(13);

					$this->session->set_flashdata('msg', 'Currency has been added successfully!');
					redirect(base_url('admin/plcode/breakdown_cat'));
				}
			}
		} else {
			$data['view'] = 'admin/plcode/add_breakdown_category';
			$this->load->view('layout', $data);
		}
	}
}
