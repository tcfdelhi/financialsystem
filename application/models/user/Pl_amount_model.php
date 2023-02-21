<?php
class Pl_amount_model extends CI_Model
{

	public $client_id = '';
	public $user_id = '';
	public function __construct()
	{
		parent::__construct();
		$user_id = $this->session->userdata('user_id');
		$this->client_id = $this->db->get_where('ci_users', array('id' => $user_id))->row()->client_id;
		$this->user_id = $user_id;
	}

	//-----------------------------------------------------
	public function get_codes($year = 0, $client_id = 0)
	{
		// $query = $this->db->get('ci_pl_code');
		$query = 'SELECT * from ci_pl_amount';


		// Year And client condition
		if ($year != 0 and $client_id != 0) $WHERE = "year = $year and client_id = $client_id";
		else $WHERE = "";
		return $this->datatable->LoadJson($query, $WHERE);
	}

	//-----------------------------------------------------
	public function get_pl_codes()
	{
		$query = $this->db->get('ci_pl_code');
		return $query->result_array();
	}

	//-----------------------------------------------------
	public function get_pl_name($id)
	{
		return $this->db->get_where('ci_pl_code', array('id' => $id))->row()->title;
	}

	//-----------------------------------------------------
	public function add_code($data)
	{
		$this->db->insert('ci_pl_amount_data', $data);
		return true;
	}

	public function get_years()
	{
		$this->db->select('year');
		$query = $this->db->get_where('ci_pl_year', array('client_id' => $this->user_id));
		return $query->result_array();
	}

	public function pl_amount_data($year)
	{

		if ($year != 0) $sql = "where client_id = $this->client_id and year = $year";
		else $sql = "";

		$query = "SELECT * from ci_pl_amount $sql";
		$query = $this->db->query($query);
		return $query->result_array();
	}

	public function get_pl_amount_data($year, $category)
	{
		$query = $this->db->query("SELECT * FROM ci_pl_amount where client_id='$this->client_id' and year = '$year' and category='$category' ");
		// echo "SELECT * FROM ci_pl_amount where client_id='$client_id' and year = '$year'"; die;
		return $query->num_rows();
	}

	public function insert_pl_amount_data($year, $category)
	{
		
		for ($i = 0; $i < 10; $i++) {
			// Generate Pl Amonut data
			$data['client_id'] = $this->client_id;
			$data['year'] = $year;
			$data['category'] = $category;
			$data['code'] = '';
			$data['title'] = '';
			$data['data'] = " ";
			$this->db->insert('ci_pl_amount', $data);
		}
	}

	public function get_imported_data($year)
	{

		// Year And client condition
		if ($year != 0 and $this->client_id != 0) $WHERE = "where year = '$year' and client_id = '$this->client_id' ";
		else $WHERE = "";

		$SQL = "SELECT * from ci_pl_amount_data_new $WHERE";

		// echo $SQL; die;
		$query = $this->db->query($SQL);
		return $query->result_array();
	}

	public function get_breakdown_categories()
	{
		$this->db->order_by("list_order", "ASC");
		$query = $this->db->get('ci_pl_breakdown_cat');
		return $query->result_array();
	}

	public function add_new_amount_data($data)
	{
		// print_r($data); die;
		foreach ($data as $key => $value) {

			$insertedData['client_id'] = $value['client_id'];
			$insertedData['category'] = $value['category'];
			$insertedData['pl_code'] = $value['pl_code'];
			$insertedData['year'] = $key;
			$insertedData['code'] =  $value['code'];
			$insertedData['title'] = $value['title'];
			$insertedData['data'] = $value['data'];
			$this->db->insert('ci_pl_amount_data_new', $insertedData);
		}
	}
	
}
