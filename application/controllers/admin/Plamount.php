<?php

use Mpdf\Tag\Em;

defined('BASEPATH') or exit('No direct script access allowed');

class Plamount extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('admin/Pl_model', 'pl_model');
		$this->load->model('admin/Pl_amount_model', 'pl_amount_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library		
	}

	//-----------------------------------------------------------------------
	public function index()
	{
		$data['years'] = $this->pl_amount_model->get_years();
		$data['clients'] = $this->pl_model->get_clients();
		$data['view'] = 'admin/plamount/codes';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------
	public function list($year = 0, $client_id = 0)
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$year  = $this->input->post('year');
			$client_id  = $this->input->post('client_id');
		} else if ($this->input->server('REQUEST_METHOD') === 'GET') {
		}


		$data['years'] = $this->pl_amount_model->get_years();
		$data['year'] = $year;
		$data['client_id'] = $client_id;
		$data['clients'] = $this->pl_model->get_clients();
		$data['view'] = 'admin/plamount/list';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------

	public function get_codes()
	{
		$year  = $this->input->get('year');
		$client_id  = $this->input->get('client_id');

		$records = $this->pl_amount_model->get_codes($year, $client_id);
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {

			$data[] = array(
				++$i,
				$row['code'],
				$row['title'],
				date("F", mktime(null, null, null, $row['month'])),
				$row['amount'],


				'<a title="Edit" class="update btn btn-sm btn-primary" href="' . base_url('admin/plamount/add_code/' . $row['id']) . '"> <i class="material-icons">edit</i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger"  data-href="' . base_url('admin/plamount/delete/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}

	//-----------------------------------------------------------------------
	public function add_code($id = 0)
	{

		$data['clients'] = $this->pl_model->get_clients();
		$data['years'] = $this->pl_amount_model->get_years();
		$data['accounting_code'] = $this->pl_amount_model->get_pl_codes();

		// Generate Month Array
		$data['month'] = [1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"];

		if ($id == 0) {
			$data['title'] = "Add New Pl Amount";
			$data['button'] = "Add";
		} else {
			$data['title'] = "Update Code";
			$data['button'] = "Update";
		}



		if ($id != 0) $data['code_data'] =  $this->db->get_where('ci_pl_amount', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;
		if ($this->input->post('submit')) {

			// $this->form_validation->set_rules('username', 'USername', 'trim|required');
			$this->form_validation->set_rules('code', 'Code', 'trim|required');
			$this->form_validation->set_rules('title', 'Accounting Code', 'trim|required');
			$this->form_validation->set_rules('client_id', 'Client', 'trim|required');
			$this->form_validation->set_rules('year', 'Financial Year', 'trim|required');
			$this->form_validation->set_rules('month', 'Month', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/plamount/add_code';
				$this->load->view('layout', $data);
			} else {
				// Get PL Code name 
				$code_name = $this->db->get_where('ci_pl_code', array('id' => $this->input->post('code')))->row()->code;
				// Prepare Amount data
				$user_data = array(
					'pl_code_id' => $this->input->post('code'),
					'client_id' => $this->input->post('client_id'),
					'code' => $code_name,
					'title' => $this->input->post('title'),
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'amount' => $this->input->post('amount'),
				);
				$data = $this->security->xss_clean($user_data);
				if ($id == 0) $result = $this->pl_amount_model->add_code($data);
				else {
					$this->db->where('id', $id);
					$this->db->update('ci_pl_amount', $data);
					$result = true;
				}

				if ($result) {

					// Pass Extra Var Here
					$year = $this->input->post('year');
					$client_id = $this->input->post('client_id');

					// Add User Activity
					$this->activity_model->add(1);

					$this->session->set_flashdata('msg', 'Code has been added successfully!');
					redirect(base_url("admin/plamount/list/$year/$client_id"));
				}
			}
		} else {

			$data['view'] = 'admin/plamount/add_code';
			$this->load->view('layout', $data);
		}
	}

	//-----------------------------------------------------------------------
	public function get_pl_name()
	{
		$id = $this->input->get('id');
		$pl_name = $this->pl_amount_model->get_pl_name($id);
		echo $pl_name;
	}

	public function import_excel()
	{
		if ($this->input->post('submit')) {
			$client_id = $this->input->post('client_id');
			// $year = $this->input->post('year');
			$path = 'uploads' . DIRECTORY_SEPARATOR . 'plamount' . DIRECTORY_SEPARATOR;
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


					// print_r($allDataInSheet); die;
					foreach ($allDataInSheet as $key => $value) {

						if ($key == 1 || $key == 2) continue;

						$code = $value['A'];
						$title = $value['B'];
						$pl_code_id = $this->db->get_where('ci_pl_code', array('code' => $code, 'title' => $title))->row()->id;
						// print_r($pl_code_id); die;
						if (!empty($pl_code_id)) {

							foreach ($value as $key1 => $value1) {

								if ($key1 == "A" || $key1 == "B") continue;

								if (!empty($value1)) {
									$year = $allDataInSheet[1][$key1];
									// Prepare Data For Bs Codes
									$data = [];
									$data['pl_code_id'] = $pl_code_id;
									$data['client_id'] = $client_id;
									$data['code'] = $code;
									$data['title'] = $title;
									$data['year'] = $year;
									$data['month'] = $allDataInSheet[2][$key1];
									$data['amount'] = $value1;
									$result = $this->pl_amount_model->add_code($data);
								}
							}
						}
					}
					if ($result) {
						$this->session->set_flashdata('msg', 'Files Has Been Imported Successfully!');
					}
					redirect(base_url("admin/plamount/list/$year/$client_id"));
				} catch (Exception $e) {
					$this->session->set_flashdata('error', 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
					unlink($path . $data['upload_data']['file_name']);
					redirect("admin/plamount", 'refresh');
				}
			} else {
				$this->session->set_flashdata('error', $error['error']);
				unlink($path . $data['upload_data']['file_name']);
				redirect("admin/plamount", 'refresh');
			}
		}
	}
}
