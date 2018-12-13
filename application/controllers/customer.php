<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('admin_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}

	public function view_profile(){
		$data['profile'] = $this->customer_model->view_profile();
		$this->load->view('customer/layout/header');
		$this->load->view('customer/view_profile', $data);
		$this->load->view('customer/layout/footer');
	}

	public function edit_profile(){
		$response = array();
		$this->form_validation->set_rules('cs_fname', 'First Name', 'required');
		$this->form_validation->set_rules('cs_lname', 'Last Name', 'required');
		$this->form_validation->set_rules('cs_address', 'Address', 'required');
		$this->form_validation->set_rules('cs_email', 'EMail', 'required');
		$this->form_validation->set_rules('cs_username', 'Username', 'required');
	}

	// public function view_cart(){

	// }

}