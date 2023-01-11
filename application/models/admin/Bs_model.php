<?php
class Bs_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function get_codes()
	{
		// $query = $this->db->get('ci_bs_code');
		$query = 'SELECT * from ci_bs_code';
		$WHERE = "";
		return $this->datatable->LoadJson($query, $WHERE);
	}

	//-----------------------------------------------------
	public function add_code($data)
	{
		$this->db->insert('ci_bs_code', $data);
		return true;
	}

	//-----------------------------------------------------
	public function get_major_items()
	{
		$query = $this->db->get('ci_major_item');
		return $query->result_array();
	}
	public function add_major_item($data)
	{
		$this->db->insert('ci_major_item', $data);
		return true;
	}

	//-----------------------------------------------------
	public function get_medium_items()
	{
		$query = $this->db->get('ci_medium_item');
		return $query->result_array();
	}
	public function add_medium_item($data)
	{
		$this->db->insert('ci_medium_item', $data);
		return true;
	}

	//-----------------------------------------------------
	public function get_cash_flow_categories()
	{
		$query = $this->db->get('ci_cash_flow_category');
		return $query->result_array();
	}
	public function add_cash_flow_categories($data)
	{
		$this->db->insert('ci_cash_flow_category', $data);
		return true;
	}
	public function get_clients()
	{
		$SQL = 'SELECT ci_clients.*,ci_users.email,ci_users.role,ci_users.is_active,ci_users.id as client_id,ci_users.firstname,ci_users.lastname FROM ci_users LEFT JOIN ci_clients on ci_users.client_id=ci_clients.id where is_admin = 0 and is_active = 1';
		$query = $this->db->query($SQL);
		return $query->result_array();
	}
}
