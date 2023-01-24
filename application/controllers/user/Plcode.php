<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plcode extends UR_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/user_model', 'user_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library		
	}

	//-----------------------------------------------------------------------
	public function index()
	{
		$id = $this->session->userdata('user_id');
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('year', 'Year', 'trim|required|min_length[3]|max_length[4]');

			if ($this->form_validation->run() == TRUE) {

				$year  = $this->input->post('year');


				$record_exist = $this->db->get_where('ci_pl_year', array('client_id' => $id, 'year' => $year))->row()->year;
				if (empty($record_exist)) {

					$data['client_id'] = $id;
					$data['year'] = $year;
					$this->db->insert('ci_pl_year', $data);
					$this->session->set_flashdata('msg', 'Year Added Sucessfully');
				} else {
					$this->session->set_flashdata('error', 'Year Already Exist');
				}
			}
		}
		$data['years'] = $this->db->get_where('ci_pl_year', array('client_id' => $id))->result_array();
		$data['view'] = 'user/plcode/codes';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------
	public function list($year = 0)
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST')
			$year  = $this->input->post('year');
		else if($this->input->server('REQUEST_METHOD') === 'GET'){}

		else redirect(base_url('user/bscode'));

		$id = $this->session->userdata('user_id');
		$data['years'] = $this->db->get_where('ci_pl_year', array('client_id' => $id))->result_array();
		$data['year'] = $year;
		$data['view'] = 'user/plcode/list';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------

	public function get_codes()
	{
		$year  = $this->input->get('year');
		$records = $this->user_model->get_pl_codes($year);
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {

			$data[] = array(
				++$i,
				$row['year'],
				$row['code'],
				$row['title'],
				$row['major_name'],
				$row['medium_name'],
				$row['cat'],
				$row['cash_flow'],


				// '<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">visibility</i></a>
				// <a title="Edit" class="update btn btn-sm btn-primary" href="'.base_url('admin/clients/edit/'.$row['client_id']).'"> <i class="material-icons">edit</i></a>
				// <a title="Delete" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/clients/delete/'.$row['client_id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				// ',
				'<a title="Edit" class="update btn btn-sm btn-primary" href="' . base_url('user/plcode/add_code/' . $row['id']) . '"> <i class="material-icons">edit</i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger"  data-href="' . base_url('user/plcode/delete/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}
	public function import_excel()
	{
		if ($this->input->post('submit')) {
			$id = $this->session->userdata('user_id');
			$client_id = $this->db->get_where('ci_users', array('id' => $id))->row()->client_id;
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
						$result = $this->user_model->add_pl_code($data);
					}
					if ($result) {
						$this->session->set_flashdata('msg', 'Files Has Been Imported Successfully!');
					}
					// echo "<pre>";
					// print_r($allDataInSheet);
					// die;
					redirect("user/plcode", 'refresh');
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

	public function export_excel($year = 0)
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

		$records = $this->user_model->get_pl_codes_export($year);
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

	// Add bs Code here
	public function add_code($id = 0)
	{
		$login_id = $this->session->userdata('user_id');
		$data['major_items'] = $this->user_model->get_pl_major_items();
		$data['medium_items'] = $this->user_model->get_pl_medium_items();
		$data['cash_flow_categories'] = $this->user_model->get_pl_cash_flow_categories();
		$data['breakdown_cat'] = $this->user_model->get_pl_breakdown_cats();
		$data['years'] = $this->db->get_where('ci_pl_year', array('client_id' => $login_id))->result_array();

		if ($id == 0) {
			$data['title'] = "Add New Pl Code";
			$data['button'] = "Add";
		} else {
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
				$data['view'] = 'user/plcode/add_code';
				$this->load->view('layout', $data);
			} else {

				$client_id = $this->db->get_where('ci_users', array('id' => $login_id))->row()->client_id;
				// Prepare Client data
				$user_data = array(
					'client_id' => $client_id,
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

				if ($id == 0) $result = $this->user_model->add_pl_code($data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_pl_code', $data);
					$result = true;
				}

				// print_r($result); die;
				if ($result) {
					// Add User Activity
					$this->activity_model->add(1);
					$year = $this->input->post('year');

					$this->session->set_flashdata('msg', 'Code has been added successfully!');
					redirect(base_url("user/plcode/list/$year"));
				}
			}
		} else {

			$data['view'] = 'user/plcode/add_code';
			$this->load->view('layout', $data);
		}
	}

	public function delete($id = 0)
	{

		$SQL = 'SELECT year FROM ci_pl_code where id ='.$id;
		$query = $this->db->query($SQL);
		$data = $query->row_array();
		$year = $data['year'];


		$this->db->delete('ci_pl_code', array('id' => $id));
		$this->activity_model->add(3);
		$this->session->set_flashdata('msg', 'BS Code has been deleted successfully!');
		redirect(base_url("user/plcode/list/$year"));
	}
}
