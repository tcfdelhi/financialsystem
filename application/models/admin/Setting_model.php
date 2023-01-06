<?php
class Setting_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function update_general_setting($data)
	{
		$this->db->where('id', 1);
		$this->db->update('ci_general_settings', $data);
		return true;
	}

	//-----------------------------------------------------
	public function get_general_settings()
	{
		$this->db->where('id', 1);
		$query = $this->db->get('ci_general_settings');
		return $query->row_array();
	}

	//-----------------------------------------------------
	public function get_admins()
	{
		$wh = array();
		$SQL = 'SELECT * from ci_users';

		$wh[] = " is_admin = 1 and is_active = 1";
		if (count($wh) > 0)

			$WHERE = implode(' and ', $wh);
		return $this->datatable->LoadJson($SQL, $WHERE);
	}

	//-----------------------------------------------------
	public function get_currencies()
	{
		$query = $this->db->get('ci_currency');
		return $query->result_array();
	}
	
	public function add_currency($data){
		
		$this->db->insert('ci_currency', $data);
		return true;
	}

	// Languages 
	//-----------------------------------------------------
	public function get_languages()
	{
		$query = $this->db->get('ci_languages');
		return $query->result_array();
	}
	
	public function add_language($data){
		
		$this->db->insert('ci_languages', $data);
		return true;
	}
}
