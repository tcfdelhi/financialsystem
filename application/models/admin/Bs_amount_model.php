<?php
class Bs_amount_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function get_codes($year = 0 , $client_id = 0)
	{
		// $query = $this->db->get('ci_bs_code');
		$query = 'SELECT * from ci_bs_amount';
		

		// Year And client condition
		if($year != 0 and $client_id != 0) $WHERE = "year = $year and client_id = $client_id";
		else $WHERE = "";
		return $this->datatable->LoadJson($query, $WHERE);
	}

	//-----------------------------------------------------
	public function get_bs_codes(){
		$query = $this->db->get('ci_bs_code');
		return $query->result_array();
	}

	//-----------------------------------------------------
	public function get_bs_name($id){
		return $this->db->get_where('ci_bs_code', array('id' => $id))->row()->title;
	}

	//-----------------------------------------------------
	public function add_code($data)
	{
		$this->db->insert('ci_bs_amount', $data);
		return true;
	}

	public function get_years(){
		$this->db->distinct();
		$this->db->select('year');		
		$query = $this->db->get('ci_bs_amount');
		return $query->result_array();
	}

}
