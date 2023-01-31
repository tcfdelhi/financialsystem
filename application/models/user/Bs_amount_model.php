<?php
class Bs_amount_model extends CI_Model
{
	public $client_id = '';

	public function __construct()
	{
		parent::__construct();
		$user_id = $this->session->userdata('user_id');
		$this->client_id = $this->db->get_where('ci_users', array('id' => $user_id))->row()->client_id;
	}

	//-----------------------------------------------------
	public function get_codes($year = 0 , $client_id = 0)
	{
		// $query = $this->db->get('ci_bs_code');
		$query = 'SELECT * from ci_bs_amount';
		
		$id = $this->session->userdata('user_id');
		$client_id = $this->db->get_where('ci_users', array('id' => $id))->row()->client_id;

		// Year And client condition
		if(empty($year)) $WHERE = "client_id = $client_id";
		elseif($year != 0 and $client_id != 0) $WHERE = "year = $year and client_id = $client_id";
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

	public function bs_amount_data($year)
	{

		if ($year != 0 ) $sql = "where client_id = $this->client_id and year = $year";
		else $sql = "";

		$query = "SELECT * from ci_bs_amount $sql";
		$query = $this->db->query($query);
		return $query->result_array();
	}

	public function get_bs_amount_data ($year)
	{
		$query = $this->db->query("SELECT * FROM ci_bs_amount where client_id='$this->client_id' and year = '$year' ");
		return $query->num_rows();
	}

	public function insert_bs_amount_data($year){
		$query = $this->db->get('ci_bs_code');
		$code_data = $query->result_array();
		$data =[];
		foreach($code_data as $key => $value){
			// Generate BS Amonut data
			$data['client_id'] = $this->client_id;
			$data['year'] = $year;
			$data['code'] = $value['code'];
			$data['title'] = $value['title'];
			$data['data'] = " ";
			$this->add_code($data);
		}
	}
}
