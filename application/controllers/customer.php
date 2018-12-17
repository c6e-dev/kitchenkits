<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('customer_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}

	//CUSTOMER PROFILE FUNCTIONS

	//VIEW FUNCTIONS 

	public function index(){
		$this->load->view('customer/layout/header');
		$data['v_profile'] = $this->customer_model->view_profile($_SESSION['id']);
		$data['v_history'] = $this->customer_model->view_history($_SESSION['id']);		
		$this->load->view('customer/cs_profile', $data);
		$this->load->view('customer/layout/footer');
	}

	// public function view_profile(){
	// 	$data['v_profile'] = $this->customer_model->view_profile();
	// 	$this->load->view('customer/layout/header');
	// 	$this->load->view('customer/view_profile', $data);
	// 	$this->load->view('customer/layout/footer');
	// }

	//EDIT FUNCTIONS

	public function edit_profile(){
		$response = array();
		$this->form_validation->set_rules('cs_username', 'Username', 'required');
		$this->form_validation->set_rules('cs_fname', 'First Name', 'required');
		$this->form_validation->set_rules('cs_lname', 'Last Name', 'required');
		$this->form_validation->set_rules('cs_address', 'Address', 'required');
		$this->form_validation->set_rules('cs_email', 'E-Mail', 'required');

		if ($this->form_validation->run() == TRUE) {
			$upt_date = date('Y-m-d H:i:s');
			$data = $this->admin_model->update_recipe($upt_date);
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
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