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
		$data['v_recent_order'] = $this->customer_model->view_recent_order($data['v_profile'][0]->cs_id);
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
		$user_id = $_POST['u_id'];
		$username = $_POST['cs_username'];
		$check = $this->customer_model->user_check($user_id);
		if($this->input->post('cs_username') == $check[0]->usrnm) {
		   	$is_unique =  '';
		} else {
			$is_unique =  '|is_unique[user.username]';
		}
		if($this->input->post('cs_email') == $check[0]->cemail) {
		   	$is_unique1 =  '';
		} else {
			$is_unique1 =  '|is_unique[customer.email_address]';
		}
		$this->form_validation->set_rules('cs_username', 'Username', 'required'.$is_unique,
			array(
				'is_unique' => 'The %s You Entered Is Already Taken'
		));
		$this->form_validation->set_rules('cs_fname', 'First Name', 'required');
		$this->form_validation->set_rules('cs_lname', 'Last Name', 'required');
		$this->form_validation->set_rules('cs_address', 'Address', 'required');
		$this->form_validation->set_rules('cs_email', 'E-Mail', 'required|valid_email'.$is_unique1,
			array(
				'required' => 'You must provide an %s',
				'valid_email' => 'The %s You Entered Is Invalid or Already Taken',
				'is_unique' => 'The %s You Entered Is Invalid or Already Taken'
		));

		if ($this->form_validation->run() == TRUE) {
			$_SESSION['user'] = $username;
			$upt_date = date('Y-m-d H:i:s');
			$data = $this->customer_model->edit_profile($upt_date);
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function edit_password(){
		$response = array();
		$password = $_POST['new_password'];
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('curr_password', 'Current Password', 'required|matches[password]',
			array(
				'matches' => 'The %s you supplied does not match your existing password.'
		));
		$this->form_validation->set_rules('new_password', 'New Password', 'required',
			array(
				'required' => 'You must provide a %s'
		));
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[new_password]',
			array(
		 		'matches' => 'Passwords do not match'
			));
		if ($this->form_validation->run() == TRUE) {
			$_SESSION['pass'] = $password;
			$upt_date = date('Y-m-d H:i:s');
			$data = $this->customer_model->edit_password($upt_date);
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