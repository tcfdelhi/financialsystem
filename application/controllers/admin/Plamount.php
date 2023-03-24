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
		} else if ($year == 0 and $client_id == 0) {
			redirect(base_url("admin/plamount"));
		}

		// Get Breakdown Catgeory Here
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();

		// die('jj');
		// // echo"<pre>";print_r($data['breakdown_cat']); die;
		// foreach ($data['breakdown_cat'] as $key => $value) {
		// 	$num_rows =  $this->pl_amount_model->get_pl_amount_data($year, $client_id, $value['id']);
		// 	// echo $num_rows; die;
		// 	if ($num_rows === 0) {
		// 		$this->pl_amount_model->insert_pl_amount_data($year, $client_id, $value['id']);
		// 	}
		// }

		$data['pl_codes'] =  $this->pl_model->get_codes_export();
		// echo "<pre>"; print_r($data['breakdown_cat']); die;
		$data['years'] = $this->pl_amount_model->get_years();
		$data['year'] = $year;
		$data['client_id'] = $client_id;
		$data['clients'] = $this->pl_model->get_clients();
		//$data['pl_amount_data'] = $this->pl_amount_model->pl_amount_data($year, $client_id);
		// echo "<pre>";print_r($data['pl_amount_data']); die;
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
						// $pl_code_id = $this->db->get_where('ci_pl_code', array('code' => $code, 'title' => $title))->row()->id;
						// print_r($pl_code_id); die;
						// if (!empty($pl_code_id)) {

						$arr = [];
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
					redirect(base_url("admin/plcode/import_amount/$year/$client_id"));
				} catch (Exception $e) {
					$this->session->set_flashdata('error', 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
					unlink($path . $data['upload_data']['file_name']);
					redirect("admin/plcode/import_amount", 'refresh');
				}
			} else {
				$this->session->set_flashdata('error', $error['error']);
				unlink($path . $data['upload_data']['file_name']);
				redirect("admin/plcode/import_amount", 'refresh');
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

			$user_data = array(
				'data' => json_encode($post_data)
			);
		}
		$updateData = $this->security->xss_clean($user_data);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('ci_pl_amount_data_new', $updateData);

		echo json_encode('ll');
	}

	public function get_data()
	{
		$code = $this->input->post('code');
		$year = $this->input->post('year');
		$client_id = $this->input->post('client_id');

		$query = $this->db->get_where('ci_pl_amount_data', array('code' => $code, 'year' => $year, 'client_id' => $client_id));
		$res = $query->row_array();
		echo json_encode($res);
	}
	public function report($client_id, $year, $categoryId)
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$year  = $this->input->post('year');
			$client_id  = $this->input->post('client_id');
		} else if ($year == 0 and $client_id == 0) {
			redirect(base_url("admin/plamount"));
		}

		// Get Breakdown Catgeory Here
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();
		// echo "<pre>"; print_r($data['breakdown_cat']); die;
		$data['categoryName'] = $this->db->get_where('ci_pl_breakdown_cat', array('id' => $categoryId))->row()->name;

		$data['pl_codes'] =  $this->pl_model->get_codes_export();

		$data['year'] = $year;
		$data['client_id'] = $client_id;
		$data['categoryId'] = $categoryId;

		$data['view'] = 'admin/plamount/report';
		$this->load->view('layout', $data);
	}

	public function import_excel_new()
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


					foreach ($allDataInSheet as $key => $value) {

						if ($key == 1) continue;

						if (empty($value['A']) and empty($value['C']) and empty($value['D']) and !empty($value['B'])) {
							$catName = $value['B'];
							// Get Breakdown Category ID here
							$categoryId = $this->db->get_where('ci_pl_breakdown_cat', array('name' => $catName))->row()->id;

							if (empty($categoryId)) {
								$cat['name'] = $catName;
								$this->db->insert('ci_pl_breakdown_cat', $cat);
								$categoryId = $this->db->insert_id();
							}
							continue;
						}

						// Bypass Amount Total column
						if (empty($value['A'])) continue;
						$code = $value['A'];
						$title = $value['B'];
						// $pl_code_id = $this->db->get_where('ci_pl_code', array('code' => $code, 'title' => $title))->row()->id;
						// print_r($pl_code_id); die;
						// if (!empty($pl_code_id)) {

						if (!empty($value)) :
							$arr = [];
							foreach ($value as $key1 => $value1) {

								if ($key1 == "A" || $key1 == "B") continue;


								$year = substr($allDataInSheet[1][$key1], 6, 4);
								$month = substr($allDataInSheet[1][$key1], 0, 3);


								$arr[$month] = !empty($value1) ? $value1 : 0;
								$imported_data[$year]['client_id'] = $client_id;
								$imported_data[$year]['category'] = $categoryId;
								$imported_data[$year]['pl_code'] = 1;
								$imported_data[$year]['code'] = $code;
								$imported_data[$year]['title'] = $title;
								$imported_data[$year]['data'] = json_encode($arr);
							}
						endif;

						$result = $this->pl_amount_model->add_new_amount_data($imported_data);
					}
					if ($result) {
						$this->session->set_flashdata('msg', 'Files Has Been Imported Successfully!');
					}
					redirect(base_url("admin/plcode/import_amount/$year/$client_id"));
				} catch (Exception $e) {
					$this->session->set_flashdata('error', 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
						. '": ' . $e->getMessage());
					unlink($path . $data['upload_data']['file_name']);
					redirect("admin/plcode/import_amount", 'refresh');
				}
			} else {
				$this->session->set_flashdata('error', $error['error']);
				unlink($path . $data['upload_data']['file_name']);
				redirect("admin/plcode/import_amount", 'refresh');
			}
		}
	}

	public function comparison($yearCount = 4, $categoryId = 6)
	{
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();
		$data['categoryName'] = $this->db->get_where('ci_pl_breakdown_cat', array('id' => $categoryId))->row()->name;

		$yearData = date("Y") - $yearCount;
		$chart_data = [];
		$counter = 0;
		$xAxis = 10;
		for ($i = date("Y"); $i > $yearData; $i--) {

			// Get total here
			$query = $this->db->get_where('ci_pl_amount_data_new', array('category' => $categoryId, 'year' => date("Y") - $counter, 'client_id' => 10))->result_array();

			if (!empty($query)) {
				$january = $february = $march = $april = $may1 = $may = $june = $july = $august = $september = $october = $november = $december = 0;

				foreach ($query as $key => $value) {
					$amount_data = !empty($value['data']) ? json_decode($value['data'], true) : 0;
					$data['amount_data'][date("Y") - $counter] = $amount_data;

					$jan = str_replace(",", "", $amount_data['Jan']);
					$january = str_replace(",", "", (int)$january) + (int)$jan;

					$feb = str_replace(",", "", $amount_data['Feb']);
					$february = str_replace(",", "", (int)$february) + (int)$feb;

					$mar = str_replace(",", "", $amount_data['Mar']);
					$march = str_replace(",", "", (int)$march) + (int)$mar;

					$apr = str_replace(",", "", $amount_data['Apr']);
					$april = str_replace(",", "", (int)$april) + (int)$apr;

					$may1 = str_replace(",", "", $amount_data['May']);
					$may = str_replace(",", "", (int)$may) + (int)$may1;

					$jun = str_replace(",", "", $amount_data['Jun']);
					$june = str_replace(",", "", (int)$june) + (int)$jun;


					$jul = str_replace(",", "", $amount_data['Jul']);
					$july = str_replace(",", "", (int)$july) + (int)$jul;

					$aug = str_replace(",", "", $amount_data['Aug']);
					$august = str_replace(",", "", (int)$august) + (int)$aug;

					$sep = str_replace(",", "", $amount_data['Sep']);
					$september = str_replace(",", "", (int)$september) + (int)$sep;

					$oct = str_replace(",", "", $amount_data['Oct']);
					$october = str_replace(",", "", (int)$october) + (int)$oct;

					$nov = str_replace(",", "", $amount_data['Nov']);
					$november = str_replace(",", "", (int)$november) + (int)$nov;

					$dec = str_replace(",", "", $amount_data['Dec']);
					$december = str_replace(",", "", (int)$december) + (int)$dec;
				}
			}

			$chart_data[$counter]['x'] = $xAxis;
			$chart_data[$counter]['y'] = $january + $february + $march + $april + $may + $june + $july + $august + $september + $october + $november + $december;
			$chart_data[$counter]['label'] = date("Y") - $counter;
			$chart_data[$counter]['color'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
			$xAxis += 10;
			$counter++;
		}

		// Remove comma from amount 
		foreach ($data['amount_data'] as $key => $value) {
			$data['amount_data'][$key]['Jan'] = str_replace(',', '', $value['Jan']);
			$data['amount_data'][$key]['Feb'] = str_replace(',', '', $value['Feb']);
			$data['amount_data'][$key]['Mar'] = str_replace(',', '', $value['Mar']);
			$data['amount_data'][$key]['Apr'] = str_replace(',', '', $value['Apr']);
			$data['amount_data'][$key]['May'] = str_replace(',', '', $value['May']);
			$data['amount_data'][$key]['Jun'] = str_replace(',', '', $value['Jun']);
			$data['amount_data'][$key]['Jul'] = str_replace(',', '', $value['Jul']);
			$data['amount_data'][$key]['Aug'] = str_replace(',', '', $value['Aug']);
			$data['amount_data'][$key]['Sep'] = str_replace(',', '', $value['Sep']);
			$data['amount_data'][$key]['Oct'] = str_replace(',', '', $value['Oct']);
			$data['amount_data'][$key]['Nov'] = str_replace(',', '', $value['Nov']);
			$data['amount_data'][$key]['Dec'] = str_replace(',', '', $value['Dec']);
		}

		// echo "<pre>";
		// print_r($data['amount_data']);
		// die;
		$data['dataPoints'] = $chart_data;
		$data['yearCount'] =  $yearCount;
		$data['categoryId'] = $categoryId;

		$data['view'] = 'admin/plamount/comparison';
		$this->load->view('layout', $data);
	}

	public function gross_profit($categoryId = 1)
	{
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();
		$data['categoryName'] = $this->db->get_where('ci_pl_breakdown_cat', array('id' => $categoryId))->row()->name;

		$chart_data = [];
		$counter = 0;
		$xAxis = 10;

		// Get Last 3 Years Data
		$this->db->distinct('year');
		$this->db->select('year');
		$this->db->from('ci_pl_amount_data_new');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(3);
		$last3Years = $this->db->get()->result_array();


		foreach ($last3Years as $key => $value) {
			$query = $this->db->get_where('ci_pl_amount_data_new', array('category' => $categoryId, 'year' => $value['year'], 'client_id' => 10))->result_array();

			if (!empty($query)) {
				$january = $february = $march = $april = $may1 = $may = $june = $july = $august = $september = $october = $november = $december = 0;

				foreach ($query as $key => $value) {
					$amount_data = !empty($value['data']) ? json_decode($value['data'], true) : 0;
					$data['amount_data'][$value['year']] = $amount_data;

					$jan = str_replace(",", "", $amount_data['Jan']);
					$january = str_replace(",", "", (int)$january) + (int)$jan;

					$feb = str_replace(",", "", $amount_data['Feb']);
					$february = str_replace(",", "", (int)$february) + (int)$feb;

					$mar = str_replace(",", "", $amount_data['Mar']);
					$march = str_replace(",", "", (int)$march) + (int)$mar;

					$apr = str_replace(",", "", $amount_data['Apr']);
					$april = str_replace(",", "", (int)$april) + (int)$apr;

					$may1 = str_replace(",", "", $amount_data['May']);
					$may = str_replace(",", "", (int)$may) + (int)$may1;

					$jun = str_replace(",", "", $amount_data['Jun']);
					$june = str_replace(",", "", (int)$june) + (int)$jun;


					$jul = str_replace(",", "", $amount_data['Jul']);
					$july = str_replace(",", "", (int)$july) + (int)$jul;

					$aug = str_replace(",", "", $amount_data['Aug']);
					$august = str_replace(",", "", (int)$august) + (int)$aug;

					$sep = str_replace(",", "", $amount_data['Sep']);
					$september = str_replace(",", "", (int)$september) + (int)$sep;

					$oct = str_replace(",", "", $amount_data['Oct']);
					$october = str_replace(",", "", (int)$october) + (int)$oct;

					$nov = str_replace(",", "", $amount_data['Nov']);
					$november = str_replace(",", "", (int)$november) + (int)$nov;

					$dec = str_replace(",", "", $amount_data['Dec']);
					$december = str_replace(",", "", (int)$december) + (int)$dec;
				}
			}

			$chart_data[$counter]['label'] = $value['year'];
			$chart_data[$counter]['data'] = [$january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december];
			$chart_data[$counter]['backgroundColor'] = ($counter == 0 ? "#FFCCCB" : '') . ($counter == 1 ? "#90EE90" : '') . ($counter == 2 ? "#ADD8E6" : '');
			$xAxis += 10;
			$counter++;
		}
		// echo "<pre>";
		// print_r($chart_data); die;

		$data['dataPoints'] = $chart_data;
		$data['categoryId'] = $categoryId;
		$data['view'] = 'admin/plamount/gross_profit';
		$this->load->view('layout', $data);
	}

	public function ordinary_profit($categoryId = 1)
	{
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();
		$data['categoryName'] = $this->db->get_where('ci_pl_breakdown_cat', array('id' => $categoryId))->row()->name;

		$chart_data = [];
		$counter = 0;
		$xAxis = 10;

		// Get Last 3 Years Data
		$this->db->distinct('year');
		$this->db->select('year');
		$this->db->from('ci_pl_amount_data_new');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(3);
		$last3Years = $this->db->get()->result_array();


		foreach ($last3Years as $key => $value) {
			$query = $this->db->get_where('ci_pl_amount_data_new', array('category' => $categoryId, 'year' => $value['year'], 'client_id' => 10))->result_array();

			if (!empty($query)) {
				$january = $february = $march = $april = $may1 = $may = $june = $july = $august = $september = $october = $november = $december = 0;

				foreach ($query as $key => $value) {
					$amount_data = !empty($value['data']) ? json_decode($value['data'], true) : 0;
					$data['amount_data'][$value['year']] = $amount_data;

					$jan = str_replace(",", "", $amount_data['Jan']);
					$january = str_replace(",", "", (int)$january) + (int)$jan;

					$feb = str_replace(",", "", $amount_data['Feb']);
					$february = str_replace(",", "", (int)$february) + (int)$feb;

					$mar = str_replace(",", "", $amount_data['Mar']);
					$march = str_replace(",", "", (int)$march) + (int)$mar;

					$apr = str_replace(",", "", $amount_data['Apr']);
					$april = str_replace(",", "", (int)$april) + (int)$apr;

					$may1 = str_replace(",", "", $amount_data['May']);
					$may = str_replace(",", "", (int)$may) + (int)$may1;

					$jun = str_replace(",", "", $amount_data['Jun']);
					$june = str_replace(",", "", (int)$june) + (int)$jun;


					$jul = str_replace(",", "", $amount_data['Jul']);
					$july = str_replace(",", "", (int)$july) + (int)$jul;

					$aug = str_replace(",", "", $amount_data['Aug']);
					$august = str_replace(",", "", (int)$august) + (int)$aug;

					$sep = str_replace(",", "", $amount_data['Sep']);
					$september = str_replace(",", "", (int)$september) + (int)$sep;

					$oct = str_replace(",", "", $amount_data['Oct']);
					$october = str_replace(",", "", (int)$october) + (int)$oct;

					$nov = str_replace(",", "", $amount_data['Nov']);
					$november = str_replace(",", "", (int)$november) + (int)$nov;

					$dec = str_replace(",", "", $amount_data['Dec']);
					$december = str_replace(",", "", (int)$december) + (int)$dec;
				}
			}

			$chart_data[$counter]['label'] = $value['year'];
			$chart_data[$counter]['data'] = [$january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december];
			$chart_data[$counter]['backgroundColor'] = ($counter == 0 ? "#FFCCCB" : '') . ($counter == 1 ? "#90EE90" : '') . ($counter == 2 ? "#ADD8E6" : '');
			$xAxis += 10;
			$counter++;
		}

		$data['dataPoints'] = $chart_data;
		$data['categoryId'] = $categoryId;
		$data['view'] = 'admin/plamount/ordinary_profit';
		$this->load->view('layout', $data);
	}

	public function annual_graph($categoryId = 1)
	{
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();
		$data['categoryName'] = $this->db->get_where('ci_pl_breakdown_cat', array('id' => $categoryId))->row()->name;

		$chart_data = [];
		$counter = 0;


		// Get Last 3 Years Data
		$this->db->distinct('year');
		$this->db->select('year');
		$this->db->from('ci_pl_amount_data_new');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(3);
		$last3Years = $this->db->get()->result_array();

		$graphlabels = [];

		foreach ($last3Years as $key => $value) {
			$query = $this->db->get_where('ci_pl_amount_data_new', array('category' => $categoryId, 'year' => $value['year'], 'client_id' => 10))->result_array();


			//$graphlabels = "Jan-" . $value['year'] . ',' . "Feb-" . $value['year'];
			if (!empty($query)) {
				$january = $february = $march = $april = $may1 = $may = $june = $july = $august = $september = $october = $november = $december = 0;

				foreach ($query as $key1 => $value1) {

					$amount_data = !empty($value1['data']) ? json_decode($value1['data'], true) : 0;
					$data['amount_data'][$value1['year']] = $amount_data;

					$jan = str_replace(",", "", $amount_data['Jan']);
					$january = str_replace(",", "", (int)$january) + (int)$jan;

					$feb = str_replace(",", "", $amount_data['Feb']);
					$february = str_replace(",", "", (int)$february) + (int)$feb;

					$mar = str_replace(",", "", $amount_data['Mar']);
					$march = str_replace(",", "", (int)$march) + (int)$mar;

					$apr = str_replace(",", "", $amount_data['Apr']);
					$april = str_replace(",", "", (int)$april) + (int)$apr;

					$may1 = str_replace(",", "", $amount_data['May']);
					$may = str_replace(",", "", (int)$may) + (int)$may1;

					$jun = str_replace(",", "", $amount_data['Jun']);
					$june = str_replace(",", "", (int)$june) + (int)$jun;


					$jul = str_replace(",", "", $amount_data['Jul']);
					$july = str_replace(",", "", (int)$july) + (int)$jul;

					$aug = str_replace(",", "", $amount_data['Aug']);
					$august = str_replace(",", "", (int)$august) + (int)$aug;

					$sep = str_replace(",", "", $amount_data['Sep']);
					$september = str_replace(",", "", (int)$september) + (int)$sep;

					$oct = str_replace(",", "", $amount_data['Oct']);
					$october = str_replace(",", "", (int)$october) + (int)$oct;

					$nov = str_replace(",", "", $amount_data['Nov']);
					$november = str_replace(",", "", (int)$november) + (int)$nov;

					$dec = str_replace(",", "", $amount_data['Dec']);
					$december = str_replace(",", "", (int)$december) + (int)$dec;
				}
			}

			$chart_data[$counter]['label'] = $value['year'];
			$chart_data[$counter]['data'] = [$january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december, $january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december, $january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december];
			$chart_data[$counter]['fill'] =  false;
			$chart_data[$counter]['legend'] =  true;
			$chart_data[$counter]['borderColor'] =  ($counter == 0 ? "#FFCCCB" : '') . ($counter == 1 ? "#90EE90" : '') . ($counter == 2 ? "#ADD8E6" : '');
			$counter++;
		}


		$data['graphlabels'] = $graphlabels;
		$data['dataPoints'] = $chart_data;
		$data['categoryId'] = $categoryId;
		$data['view'] = 'admin/plamount/annual_graph';
		$this->load->view('layout', $data);
	}

	public function annual_ordinary_graph($categoryId = 1)
	{
		$data['breakdown_cat'] =  $this->pl_model->get_breakdown_categories();
		$data['categoryName'] = $this->db->get_where('ci_pl_breakdown_cat', array('id' => $categoryId))->row()->name;

		$chart_data = [];
		$counter = 0;


		// Get Last 3 Years Data
		$this->db->distinct('year');
		$this->db->select('year');
		$this->db->from('ci_pl_amount_data_new');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(3);
		$last3Years = $this->db->get()->result_array();

		$graphlabels = [];

		foreach ($last3Years as $key => $value) {
			$query = $this->db->get_where('ci_pl_amount_data_new', array('category' => $categoryId, 'year' => $value['year'], 'client_id' => 10))->result_array();


			//$graphlabels = "Jan-" . $value['year'] . ',' . "Feb-" . $value['year'];
			if (!empty($query)) {
				$january = $february = $march = $april = $may1 = $may = $june = $july = $august = $september = $october = $november = $december = 0;

				foreach ($query as $key1 => $value1) {

					$amount_data = !empty($value1['data']) ? json_decode($value1['data'], true) : 0;
					$data['amount_data'][$value1['year']] = $amount_data;

					$jan = str_replace(",", "", $amount_data['Jan']);
					$january = str_replace(",", "", (int)$january) + (int)$jan;

					$feb = str_replace(",", "", $amount_data['Feb']);
					$february = str_replace(",", "", (int)$february) + (int)$feb;

					$mar = str_replace(",", "", $amount_data['Mar']);
					$march = str_replace(",", "", (int)$march) + (int)$mar;

					$apr = str_replace(",", "", $amount_data['Apr']);
					$april = str_replace(",", "", (int)$april) + (int)$apr;

					$may1 = str_replace(",", "", $amount_data['May']);
					$may = str_replace(",", "", (int)$may) + (int)$may1;

					$jun = str_replace(",", "", $amount_data['Jun']);
					$june = str_replace(",", "", (int)$june) + (int)$jun;


					$jul = str_replace(",", "", $amount_data['Jul']);
					$july = str_replace(",", "", (int)$july) + (int)$jul;

					$aug = str_replace(",", "", $amount_data['Aug']);
					$august = str_replace(",", "", (int)$august) + (int)$aug;

					$sep = str_replace(",", "", $amount_data['Sep']);
					$september = str_replace(",", "", (int)$september) + (int)$sep;

					$oct = str_replace(",", "", $amount_data['Oct']);
					$october = str_replace(",", "", (int)$october) + (int)$oct;

					$nov = str_replace(",", "", $amount_data['Nov']);
					$november = str_replace(",", "", (int)$november) + (int)$nov;

					$dec = str_replace(",", "", $amount_data['Dec']);
					$december = str_replace(",", "", (int)$december) + (int)$dec;
				}
			}

			$chart_data[$counter]['label'] = $value['year'];
			$chart_data[$counter]['data'] = [$january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december, $january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december, $january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december];
			$chart_data[$counter]['fill'] =  false;
			$chart_data[$counter]['legend'] =  true;
			$chart_data[$counter]['borderColor'] =  ($counter == 0 ? "#FFCCCB" : '') . ($counter == 1 ? "#90EE90" : '') . ($counter == 2 ? "#ADD8E6" : '');
			$counter++;
		}


		$data['graphlabels'] = $graphlabels;
		$data['dataPoints'] = $chart_data;
		$data['categoryId'] = $categoryId;
		$data['view'] = 'admin/plamount/annual_ordinary_graph';
		$this->load->view('layout', $data);
	}
}
