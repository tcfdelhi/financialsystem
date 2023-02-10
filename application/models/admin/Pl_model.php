<?php
class Pl_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function get_codes($year = 0, $client_id = 0)
	{
		// $query = $this->db->get('ci_pl_code');
		$query = 'SELECT 
		ci_pl_code.*,ci_pl_major_item.name as major_name , ci_pl_medium_item.name as medium_name,ci_pl_cash_flow_category.name as cat, ci_users.firstname,ci_users.lastname,ci_pl_breakdown_cat.name as break_cat_name
		from ci_pl_code 
		INNER JOIN ci_users on ci_pl_code.client_id = ci_users.client_id 
		INNER JOIN ci_pl_major_item on ci_pl_code.major_item = ci_pl_major_item.id 
		INNER JOIN ci_pl_medium_item on ci_pl_code.medium_item = ci_pl_medium_item.id 
		INNER JOIN ci_pl_breakdown_cat on ci_pl_code.breakdown_cat = ci_pl_breakdown_cat.id 
		INNER JOIN ci_pl_cash_flow_category on ci_pl_code.cash_flow_category = ci_pl_cash_flow_category.id';


		// Year And client condition
		if ($year != 0 and $client_id != 0) $WHERE = "ci_pl_code.year = $year and ci_pl_code.client_id = $client_id";
		else $WHERE = "";
		return $this->datatable->LoadJson($query, $WHERE);
	}

	//-----------------------------------------------------
	public function add_code($data)
	{
		// Insert Data In Amount Table Also (Prepare bs amount data)
		$pl_amount['client_id'] = $data['client_id'];
		$pl_amount['year'] = $data['year'];
		$pl_amount['code'] = $data['code'];
		$pl_amount['title'] = $data['title'];
		$pl_amount['data'] = ' ';
		$this->db->insert('ci_pl_amount', $pl_amount);
		// End Here

		$this->db->insert('ci_pl_code', $data);
		return true;
	}

	//-----------------------------------------------------
	public function get_major_items()
	{
		$query = $this->db->get('ci_pl_major_item');
		return $query->result_array();
	}
	public function add_major_item($data)
	{
		$this->db->insert('ci_pl_major_item', $data);
		return true;
	}

	//-----------------------------------------------------
	public function get_medium_items()
	{
		$query = $this->db->get('ci_pl_medium_item');
		return $query->result_array();
	}
	public function add_medium_item($data)
	{
		$this->db->insert('ci_pl_medium_item', $data);
		return true;
	}

	public function get_breakdown_categories()
	{
		$this->db->order_by("list_order", "ASC");
		$query = $this->db->get('ci_pl_breakdown_cat');
		return $query->result_array();
	}

	public function add_breakdown_categories($data)
	{
		$this->db->insert('ci_pl_breakdown_cat', $data);
		return true;
	}

	//-----------------------------------------------------
	public function get_cash_flow_categories()
	{
		$query = $this->db->get('ci_pl_cash_flow_category');
		return $query->result_array();
	}
	public function add_cash_flow_categories($data)
	{
		$this->db->insert('ci_pl_cash_flow_category', $data);
		return true;
	}
	public function get_clients()
	{
		$SQL = 'SELECT ci_clients.*,ci_users.email,ci_users.role,ci_users.is_active,ci_users.id as client_id,ci_users.firstname,ci_users.lastname FROM ci_users LEFT JOIN ci_clients on ci_users.client_id=ci_clients.id where is_admin = 0 and is_active = 1';
		$query = $this->db->query($SQL);
		return $query->result_array();
	}
	public function get_years()
	{

		$this->db->distinct();
		$this->db->select('year');
		$query = $this->db->get('ci_pl_year');
		return $query->result_array();
	}

	public function cashflow()
	{
		$this->db->select('cash_flow');
		$this->db->distinct('cash_flow');
		$this->db->from('ci_pl_cash_flow_category');
		return $this->db->get()->result_array();
	}

	//-----------------------------------------------------
	public function get_codes_export($client_id = 0, $year = 0)
	{

		// Year And client condition
		if ($year != 0 and $client_id != 0) $WHERE = "where ci_pl_code.year = $year and ci_pl_code.client_id = $client_id";
		else $WHERE = "";

		$SQL = "SELECT 
		ci_pl_code.*,ci_pl_major_item.name as major_name , ci_pl_medium_item.name as medium_name,ci_pl_cash_flow_category.name as cat, ci_users.firstname,ci_users.lastname,ci_pl_breakdown_cat.name as break_cat_name
		from ci_pl_code 
		INNER JOIN ci_users on ci_pl_code.client_id = ci_users.client_id 
		INNER JOIN ci_pl_major_item on ci_pl_code.major_item = ci_pl_major_item.id 
		INNER JOIN ci_pl_medium_item on ci_pl_code.medium_item = ci_pl_medium_item.id 
		INNER JOIN ci_pl_breakdown_cat on ci_pl_code.breakdown_cat = ci_pl_breakdown_cat.id 
		INNER JOIN ci_pl_cash_flow_category on ci_pl_code.cash_flow_category = ci_pl_cash_flow_category.id $WHERE";


		// echo $SQL ;die; 
		$query = $this->db->query($SQL);
		return $query->result_array();
	}

	public function get_reports($bs_code, $client_id, $year)
	{

		// Year And client condition
		if ($year != 0 and $client_id != 0 and $bs_code != 0) $WHERE = "where year = $year and client_id = $client_id  and code = '$bs_code' ";
		else $WHERE = "";

		$SQL = "SELECT * from ci_pl_amount $WHERE";

		$query = $this->db->query($SQL);
		return $query->row_array();
	}

	public function get_imported_data($year, $client_id)
	{

		// Year And client condition
		if ($year != 0 and $client_id != 0) $WHERE = "where year = $year and client_id = $client_id";
		else $WHERE = "";


		$SQL = "SELECT * from ci_pl_amount_data $WHERE";

		$query = $this->db->query($SQL);
		return $query->result_array();
	}
}
