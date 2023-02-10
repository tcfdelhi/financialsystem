<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plamount extends UR_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/user_model', 'user_model');
		$this->load->model('user/Pl_amount_model', 'pl_amount_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library		
	}
	//-----------------------------------------------------------------------
	public function index()
	{
		$data['years'] = $this->pl_amount_model->get_years();
		$data['view'] = 'user/plamount/codes';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------
	public function list($year = 0)
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$year  = $this->input->post('year');
		} else if ($year == 0) {
			redirect(base_url("user/plamount"));
		}

		// Check if year and client exists in amount data or not
		$num_rows =  $this->pl_amount_model->get_pl_amount_data($year);
		if ($num_rows === 0) {
			// Insert Data into bs amoutn table
			$this->pl_amount_model->insert_pl_amount_data($year);
		}


		$data['years'] = $this->pl_amount_model->get_years();
		$data['year'] = $year;
		$data['pl_amount_data'] = $this->pl_amount_model->pl_amount_data($year);
		$data['view'] = 'user/plamount/list';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------

	public function get_codes()
	{
		$year  = $this->input->get('year');

		$records = $this->pl_amount_model->get_codes($year);
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {

			$data[] = array(
				++$i,
				$row['code'],
				$row['title'],
				date("F", mktime(null, null, null, $row['month'])),
				$row['amount'],


				'<a title="Edit" class="update btn btn-sm btn-primary" href="' . base_url('user/plamount/add_code/' . $row['id']) . '"> <i class="material-icons">edit</i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger"  data-href="' . base_url('user/plamount/delete/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
				',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}

	//-----------------------------------------------------------------------
	public function add_code($id = 0)
	{

		$data['years'] = $this->pl_amount_model->get_years();
		$data['accounting_code'] = $this->pl_amount_model->get_bs_codes();
		$user_id = $this->session->userdata('user_id');
		$client_id = $this->db->get_where('ci_users', array('id' => $user_id))->row()->client_id;


		// Generate Month Array
		$data['month'] = [1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"];

		if ($id == 0) {
			$data['title'] = "Add New BS Amount";
			$data['button'] = "Add";
		} else {
			$data['title'] = "Update Code";
			$data['button'] = "Update";
		}



		if ($id != 0) $data['code_data'] =  $this->db->get_where('ci_bs_amount', array('id' => $id))->row_array();
		if ($id != 0) $data['id'] =  $id;
		if ($this->input->post('submit')) {

			// $this->form_validation->set_rules('username', 'USername', 'trim|required');
			$this->form_validation->set_rules('code', 'Code', 'trim|required');
			$this->form_validation->set_rules('title', 'Accounting Code', 'trim|required');
			$this->form_validation->set_rules('year', 'Financial Year', 'trim|required');
			$this->form_validation->set_rules('month', 'Month', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'user/plamount/add_code';
				$this->load->view('layout', $data);
			} else {
				// Get PL Code name 
				$code_name = $this->db->get_where('ci_bs_code', array('id' => $this->input->post('code')))->row()->code;
				// Prepare Amount data
				$user_data = array(
					'bs_code_id' => $this->input->post('code'),
					'client_id' => $client_id,
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
					$this->db->update('ci_bs_amount', $data);
					$result = true;
				}

				if ($result) {

					// Pass Extra Var Here
					$year = $this->input->post('year');
					// Add User Activity
					$this->activity_model->add(1);

					$this->session->set_flashdata('msg', 'Code has been added successfully!');
					redirect(base_url("user/plamount/list/$year"));
				}
			}
		} else {

			$data['view'] = 'user/plamount/add_code';
			$this->load->view('layout', $data);
		}
	}

	//-----------------------------------------------------------------------
	public function get_bs_name()
	{
		$id = $this->input->get('id');
		$pl_name = $this->pl_amount_model->get_bs_name($id);
		echo $pl_name;
	}

	//-----------------------------------------------------------------------
	public function import_excel()
	{
		$user_id = $this->session->userdata('user_id');
		$client_id = $this->db->get_where('ci_users', array('id' => $user_id))->row()->client_id;

		if ($this->input->post('submit')) {
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
						
						foreach ($value as $key1 => $value1) {

							if ($key1 == "A" || $key1 == "B") continue;

							if (!empty($value1)) {
								$year = $allDataInSheet[1][$key1];
								// Prepare json data

								if ($allDataInSheet[2][$key1] == '01') $month = 'jan';
								if ($allDataInSheet[2][$key1] == '02') $month = 'feb';
								if ($allDataInSheet[2][$key1] == '03') $month = 'mar';
								if ($allDataInSheet[2][$key1] == '04') $month = 'apr';
								if ($allDataInSheet[2][$key1] == '05') $month = 'may';
								if ($allDataInSheet[2][$key1] == '06') $month = 'jun';
								if ($allDataInSheet[2][$key1] == '07') $month = 'jul';
								if ($allDataInSheet[2][$key1] == '08') $month = 'aug';
								if ($allDataInSheet[2][$key1] == '09') $month = 'sep';
								if ($allDataInSheet[2][$key1] == '10') $month = 'oct';
								if ($allDataInSheet[2][$key1] == '11') $month = 'nov';
								if ($allDataInSheet[2][$key1] == '12') $month = 'dec';
								$arr[$month] = $value1;
								// $data['month'] = $allDataInSheet[2][$key1];
								// $data['amount'] = $value1;

								// }
							}
						}
						$imported_data['client_id'] = $client_id;
						$imported_data['year'] = $year;
						$imported_data['code'] = $code;
						$imported_data['title'] = $title;
						$imported_data['data'] = json_encode($arr);

						$result = $this->pl_amount_model->add_code($imported_data);
					}
					if ($result) {
						$this->session->set_flashdata('msg', 'Files Has Been Imported Successfully!');
					}
					redirect(base_url("user/plcode/import/$year"));
				} catch (Exception $e) {
					$this->session->set_flashdata('error', 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
					unlink($path . $data['upload_data']['file_name']);
					redirect("user/plcode", 'refresh');
				}
			} else {
				$this->session->set_flashdata('error', $error['error']);
				unlink($path . $data['upload_data']['file_name']);
				redirect("user/plcode", 'refresh');
			}
		}
	}

	public function save_data()
	{

		if (!empty($this->input->post('row_id'))) {
			$post_data = $this->input->post('form_data');
			$post_data = json_decode($post_data, true);

			$user_data = array(
				'data' => $post_data['data'],
				'code' => $post_data['code'],
				'title' => $post_data['title']
			);
		} else {

			$post_data = $this->input->post('form_data');
			$code = $this->input->post('code');
			$title = $this->input->post('title');

			$user_data = array(
				'data' => json_encode($post_data),
				'code' => $code,
				'title' => $title
			);
		}
		$updateData = $this->security->xss_clean($user_data);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('ci_pl_amount', $updateData);

		echo json_encode('ll');
	}

	public function get_data()
	{
		$user_id = $this->session->userdata('user_id');
		$client_id = $this->db->get_where('ci_users', array('id' => $user_id))->row()->client_id;

		$code = $this->input->post('code');
		$year = $this->input->post('year');

		$query = $this->db->get_where('ci_pl_amount_data', array('code' => $code, 'year' => $year, 'client_id' => $client_id));
		$res = $query->row_array();
		if(empty($res)) echo 0;
		else echo json_encode($res);
	}
}
