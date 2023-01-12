<?php
class User_model extends CI_Model
{

	//--------------------------------------------------------------------
	public function get_user_detail()
	{
		$id = $this->session->userdata('user_id');
		// $query = $this->db->get_where('ci_users', array('id' => $id));
		// return $result = $query->row_array();
		$SQL = 'SELECT ci_clients.*,ci_users.email,ci_users.role,ci_users.is_active,ci_users.id as client_id,ci_users.firstname,ci_users.lastname FROM ci_users LEFT JOIN ci_clients on ci_users.client_id=ci_clients.id where ci_users.id =' . $id;
		$query = $this->db->query($SQL);
		return $query->row_array();
	}
	//--------------------------------------------------------------------
	public function update_user($data)
	{
		$id = $this->session->userdata('user_id');
		$this->db->where('id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function change_pwd($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function get_countries()
	{
		$this->db->select('name');
		return $this->db->get('ci_countries')->result_array();
	}

	//-----------------------------------------------------
	public function get_currencies()
	{
		$query = $this->db->get('ci_currency');
		return $query->result_array();
	}

	// Edit client Record
	public function edit_client($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('ci_clients', $data);
		return true;
	}
	public function get_codes($year = 0)
	{
		$id = $this->session->userdata('user_id');
		$query = 'SELECT 
		ci_bs_code.*,ci_major_item.name as major_name , ci_medium_item.name as medium_name,ci_cash_flow_category.name as cat
		from ci_bs_code 
		INNER JOIN ci_major_item on ci_bs_code.major_item = ci_major_item.id 
		INNER JOIN ci_medium_item on ci_bs_code.medium_item = ci_medium_item.id 
		INNER JOIN ci_cash_flow_category on ci_bs_code.cash_flow_category = ci_cash_flow_category.id';

		$client_id = $this->db->get_where('ci_users', array('id' => $id))->row()->client_id;
		// Year And client condition
		if ($year != 0) $WHERE = "ci_bs_code.year = $year and ci_bs_code.client_id = $client_id";
		else $WHERE = "";

		// $WHERE = "ci_bs_code.client_id=".$id;
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

	//-----------------------------------------------------
	public function get_medium_items()
	{
		$query = $this->db->get('ci_medium_item');
		return $query->result_array();
	}

	//-----------------------------------------------------
	public function get_cash_flow_categories()
	{
		$query = $this->db->get('ci_cash_flow_category');
		return $query->result_array();
	}
}
