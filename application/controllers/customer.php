<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('admin_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}

	//CUSTOMER PROFILE FUNCTIONS

	//VIEW FUNCTIONS 

	public function view_profile(){
		$data['v_profile'] = $this->customer_model->view_profile();
		$this->load->view('customer/layout/header');
		$this->load->view('customer/view_profile', $data);
		$this->load->view('customer/layout/footer');
	}

	public function view_history(){
		$data['v_history'] = $this->customer_model->view_history();
		$this->load->view('customer/layout/header');
		$this->load->view('customer/view_history', $data);
		$this->load->view('customer/layout/footer');
	}

	//EDIT FUNCTIONS

	public function edit_profile(){
		$response = array();
		$this->form_validation->set_rules('cs_fname', 'First Name', 'required');
		$this->form_validation->set_rules('cs_lname', 'Last Name', 'required');
		$this->form_validation->set_rules('cs_address', 'Address', 'required');
		$this->form_validation->set_rules('cs_email', 'EMail', 'required');
		$this->form_validation->set_rules('cs_username', 'Username', 'required');

		if($this->form_validation->run() == TRUE){
			$data = $this->customer_model->edit_profile();
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else{
			$response['status'] = FALSE;
			$response['notif'] = validation_errors();
		}
		echo json_encode($response);
	}

	//CART FUNCTIONS

	public function view_cart(){
		$date['cart'] = $this->customer_model->view_cart();
		$this->load->view('customer/layout/header');
		$this->load->view('customer/view_cart', $data);
		$this->load->view('customer/layout/footer');
	}

}