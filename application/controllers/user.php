<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
	}
	public function index(){
		$this->load->view('login');
		// $this->load->view('home');
	}
	public function load_login(){
		$this->load->view('login');
	}
	public function login(){
		$con = mysqli_connect("localhost","root","","kitchen_kits");
		$user = mysqli_real_escape_string($con, $_POST['username']);
		$pass = mysqli_real_escape_string($con, $_POST['password']);
		$userdata = $this->user_model->login_check($user, $pass);
		if(isset($userdata)){
			$_SESSION = array( 
				'id' => $userdata[0]->id, 
				'user' => $userdata[0]->username,
				'pass' => $userdata[0]->password,
				'utype' => $userdata[0]->user_type_id
			);
			$this->user_model->logged_in($_SESSION['id']);	
			switch ($userdata[0]->user_type_id) {
				case '1':
					redirect('admin');
					break;
				case '2':
					redirect('branch');
					break;
				case '3':
					redirect('customer');
					break;
			}
		}
		else{
			$this->session->set_flashdata('error_msg','Invalid Username or Password, Try again!'); 
			redirect();
		}
		mysqli_close($con);
	}
	public function logout(){
		$this->user_model->logged_out($_SESSION['id']);	
		session_destroy();
		redirect();
	}
	public function register_view(){
		$this->load->view('register');
	}
	// public function register(){
	// 	$response = array();
	// 	$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]',
	// 	array(
	//  		'is_unique' => 'Username already taken'
	// 	));
	// 	$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[8]');
	// 	$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]',
	// 	array(
	//  		'matches' => 'Passwords do not match'
	// 	));
	// 	if ($this->form_validation->run() == TRUE){
	//     	$data = $this->employee_model->change_password($pas);
	// 		$response['status'] = TRUE;
	// 		$response[] = $data;
	//     }
	//     else{
	//     	$response['status'] = FALSE;
	//     	$response['notif']	= validation_errors();
	    	
	//     }
 // 		echo json_encode($response);
	// }
}
