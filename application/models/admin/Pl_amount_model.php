<?php
class Pl_amount_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
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
		$this->db->distinct();
		$this->db->select('year');
		$query = $this->db->get('ci_pl_year');
		return $query->result_array();
	}

	public function pl_amount_data($year, $client_id)
	{

		if ($year != 0 and $client_id != 0) $sql = "where data <> '' and client_id = $client_id and year = $year";
		else $sql = "";

		$query = "SELECT ci_pl_amount.*,ci_pl_breakdown_cat.id as cat_id ,ci_pl_breakdown_cat.name as cat_name from ci_pl_amount left JOIN ci_pl_breakdown_cat ON ci_pl_amount.category = ci_pl_breakdown_cat.id  $sql";
		$query = $this->db->query($query);
		return $query->result_array();
	}

	public function get_pl_amount_data($year, $client_id, $category)
	{
		// die($year);
		$query = $this->db->query("SELECT * FROM ci_pl_amount where year = '$year' and client_id  = '$client_id' and category='$category' ");
		// echo "SELECT * FROM ci_pl_amount where 'year' = '$year' and 'client_id'  = '$client_id' and category='$category' "; die;
		return $query->num_rows();
	}

	public function insert_pl_amount_data($year, $client_id, $category)
	{

		$data = [];
		// foreach($code_data as $key => $value){
		// 	if(empty($year)) $year = $value['year'];
		// 	// Generate Pl Amonut data
		// 	$data['client_id'] = $client_id;
		// 	$data['year'] = $year;
		// 	$data['code'] = $value['code'];
		// 	$data['title'] = $value['title'];
		// 	$data['data'] = " ";
		// 	$this->add_code($data);
		// }
		for ($i = 0; $i < 10; $i++) {
			$data['client_id'] = $client_id;
			$data['year'] = $year;
			$data['category'] = $category;
			$data['code'] = '';
			$data['title'] = '';
			$data['data'] = " ";
			$this->db->insert('ci_pl_amount', $data);
			// $this->add_code($data);
		}
	}
}
