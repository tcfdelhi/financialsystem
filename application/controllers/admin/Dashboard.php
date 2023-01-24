<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/dashboard_model', 'dashboard_model');
	}

	public function index()
	{

		// var_dump($this->general_settings); exit();
		$data['all_users'] = $this->dashboard_model->get_all_users();
		$data['active_users'] = $this->dashboard_model->get_active_users();
		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();
		$data['title'] = 'Dashboard';
		$data['view'] = 'admin/dashboard/index';
		$this->load->view('layout', $data);
	}

	public function set_session_language()
	{
		$this->load->library('user_agent');
		$this->load->library('session');
		if (($this->uri->segment(4) != '')) {
			$sessionyear = $this->uri->segment(4);
			if ($sessionyear) {
				$this->session->set_userdata('session_language', $sessionyear);
				redirect($this->agent->referrer());
			}
		}
	}
}
