<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
	}
	public function index(){
		//$this->load->view('login');
		$this->load->view('customer/home');
	}
	public function load_csregion(){
		$this->load->view('customer/cs_region');
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
	public function register(){
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]',
		array(
	 		'is_unique' => 'Username already taken'
		));
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]',
		array(
	 		'matches' => 'Passwords do not match'
		));
		if ($this->form_validation->run() == TRUE){
	    	$userdata = array(
				'username' => str_replace("'","’",$_POST['username']),
				'password' => str_replace("'","’",$_POST['password']),
				'status' => 'A',
				'user_type_id' => $_GET['id']
			);
			$this->user_model->add_customer_account($userdata);
			$user_id = $this->db->insert_id();
			$code = $this->user_model->get_code(3);
			$this->user_model->update_counter($code[0]->ct_count+1,3);
			$customerdata = array(
				'user_id' => $user_id,
				'code' => $code[0]->ct_code.(sprintf('%05d', $code[0]->ct_count+1)),
				'first_name' => str_replace("'","’",$_POST['fname']),
				'last_name' => str_replace("'","’",$_POST['lname']),
				'email_address' => str_replace("'","’",$_POST['emailaddr']),
				'home_address' => str_replace("'","’",$_POST['haddress'])
			);
			$this->user_model->add_customer($customerdata);
			redirect();
			// $customer_id = $this->db->insert_id(); //don't delete
			// $_SESSION = array(
			// 	'id' => $customer_id,
			// 	'username' => str_replace("'","’",$_POST['username']),
			// );
			// $this->user_model->logged_in($user_id);
	    }
	    else{
			$this->load->view('register');
	    }
	}
}
