<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('admin_model');
	}
	public function index(){
		$this->load->view('admin/layout/header');
		$this->load->view('admin/home');
		$this->load->view('admin/layout/footer');
	}
	public function recipe_view(){
		$data['recipe'] = $this->admin_model->read_recipe();
		$data['country'] = $this->admin_model->country();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/read_recipe',$data);
		$this->load->view('admin/layout/footer');
	}
	public function delete_recipe(){
		$this->admin_model->delete_recipe($_GET['id']);
		redirect('admin/recipe_view');
	}
	public function create_recipe(){
		$response = array();
		$this->form_validation->set_rules('name', 'Recipe Name', 'required|is_unique[recipe.name]',array(
			'is_unique' => 'Recipe Name already exist!'
		));
		$this->form_validation->set_rules('servings', 'Servings', 'numeric',array(
			'numeric' => 'Number of Servings not valid!'
		));
		$this->form_validation->set_rules('price', 'Recipe Price', 'numeric',array(
			'numeric' => 'Value of Price not valid!'
		));
		if ($this->form_validation->run() == TRUE) {
			$data = $this->admin_model->create_recipe();
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}
	public function update_recipe(){
		$response = array();
		$this->form_validation->set_rules('servings', 'Servings', 'numeric',array(
			'numeric' => 'Number of Servings not valid!'
		));
		$this->form_validation->set_rules('price', 'Recipe Price', 'numeric',array(
			'numeric' => 'Value of Price not valid!'
		));
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->admin_model->update_recipe();
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}
	public function view_recipe(){
		$data['recipe'] = $this->admin_model->view_recipe($_GET['id']);
		$this->load->view('admin/layout/header');
		$this->load->view('admin/view_recipe',$data);
		$this->load->view('admin/layout/footer');
	}

	// DASHBOARD FUNCTION - Robert / 12-01-18

	public function ad_dashboard(){
		$this->load->view('admin/layout/header');
		$data = array(
			// 'admin' => $this->user->admin_count(),
			// 'admin_a' => $this->user->admin_count_a(),
			// 'admin_i' => $this->user->admin_count_i(),
			// 'branch' => $this->user->branch_count(),
			// 'branch_a' => $this->user->branch_count_a(),
			// 'branch_i' => $this->user->branch_count_i(),
			// 'manager' => $this->user->manager_count(),
			// 'manager_a' => $this->user->manager_count_a(),
			// 'manager_i' => $this->user->manager_count_u(),
			'customer' => $this->user->customer_count(),
			'customer_a' => $this->user->customer_count_a(),
			'customer_i' => $this->user->customer_count_i(),
			'logged_in' => $this->user->logged_in_count(),
			// 'recipe' => $this->user->recipe_count(),
			// 'recipe_a' => $this->user->recipe_count_a(),
			// 'recipe_i' => $this->user->recipe_count_i(),
			'order' => $this->user->order_count(),
			'order_a' => $this->user->order_count_c(),
			'order_i' => $this->user->order_count_i()
		);
		$this->load->view('admin/home',$data);
		$this->load->view('admin/layout/footer');
	}

	// DATA TABLE FUNCTIONS - Robert / 12-01-18

	// public function recipe_view(){
	// 	$data['recipe'] = $this->admin_model->read_recipe();
	// 	$this->load->view('admin/layout/header');
	// 	$this->load->view('admin/recipe',$data);
	// 	$this->load->view('admin/layout/footer');
	// }

	public function customer_view(){
		$this->load->view('admin/layout/header');
		$data['customer'] = $this->admin_model->read_customer();
		$this->load->view('admin/read_customer',$data);
		$this->load->view('admin/layout/footer');
	}

	public function branch_view(){
		$this->load->view('admin/layout/header');
		$data['branch'] = $this->admin_model->read_branch();
		$data['b_manager'] = $this->admin_model->read_branch_manager();
		$this->load->view('admin/read_branch',$data);
		$this->load->view('admin/layout/footer');
	}

	public function manager_view(){
		$this->load->view('admin/layout/header');
		$data['manager'] = $this->admin_model->read_manager();
		$this->load->view('admin/read_manager',$data);
		$this->load->view('admin/layout/footer');
	}

	public function order_view(){
		$this->load->view('admin/layout/header');
		$data['order'] = $this->admin_model->read_order();
		$this->load->view('admin/read_order',$data);
		$this->load->view('admin/layout/footer');
	}

	public function feedback_view(){
		$this->load->view('admin/layout/header');
		$data['feedback'] = $this->admin_model->read_feedback();
		$this->load->view('admin/read_feedback',$data);
		$this->load->view('admin/layout/footer');
	}

	// VIEW FUNCTIONS - Robert / 12-02-18 

	public function view_customer(){
		$this->load->view('admin/layout/header');
		$data = array(
			'customer' => $this->admin_model->view_customer($_GET['id']),
			'c_order' => $this->admin_model->view_customer_order($_GET['id']),
			'C_activity' => $this->admin_model->view_customer_activity($_GET['id']),
			'c_feedback' => $this->admin_model->view_customer_feedback($_GET['id'])
		);
		$this->load->view('admin/customer_view',$data);
		$this->load->view('admin/layout/footer');
	}

	public function view_branch(){
		$this->load->view('admin/layout/header');
		$data = array(
			'branch' => $this->admin_model->view_branch($_GET['id']),
			'b_order' => $this->admin_model->view_branch_order($_GET['id'])
		);
		$this->load->view('admin/branch_view',$data);
		$this->load->view('admin/layout/footer');
	}

	public function view_manager(){
		$this->load->view('admin/layout/header');
		$data['manager'] = $this->admin_model->view_manager($_GET['id']);
		$this->load->view('admin/manager_view',$data);
		// echo $manager[0]->;
		$this->load->view('admin/layout/footer');
	}

	public function view_order(){
		$this->load->view('admin/layout/header');
		$data['order'] = $this->admin_model->view_order($_GET['id']);
		$data['o_content'] = $this->admin_model->view_order_content($_GET['id']);
		$this->load->view('admin/order_view',$data);
		$this->load->view('admin/layout/footer');
	}

	public function view_feedback(){
		$this->load->view('admin/layout/header');
		$data['feedback'] = $this->admin_model->view_feedback($_GET['id']);
		$this->load->view('admin/feedback_view',$data);
		$this->load->view('admin/layout/footer');
	}

	// DELETE FUNCTIONS - Robert / 12-02-18

	// public function delete_recipe($id){
	// 	$this->admin_model->delete_recipe($id);
	// 	redirect('admin/recipe_view');
	// }

	public function delete_customer(){
		$this->admin_model->delete_customer($_GET['id']);
		redirect('admin/customer_view');
	}

	public function delete_branch($br_id,$br_mi){
		$this->admin_model->delete_branch($br_id,$br_mi);
		redirect('admin/branch_view');
	}

	public function delete_manager(){
		$this->admin_model->delete_manager($_GET['id']);
		redirect('admin/manager_view');	
	}

	// ACTIVATE FUNCTIONS - Robert / 12-02-18

	public function activate_recipe(){
		$this->admin_model->activate_recipe($_GET['id']);
		redirect('admin/recipe_view');
	}

	public function activate_customer(){
		$this->admin_model->activate_customer($_GET['id']);
		redirect('admin/customer_view');
	}

	public function activate_branch(){
		$this->admin_model->activate_branch($_GET['id']);
		redirect('admin/branch_view');
	}

	public function activate_manager(){
		$this->admin_model->activate_manager($_GET['id']);
		redirect('admin/manager_view');
	}

	// ADD FUNCTIONS 

	public function add_branch(){ // IMPROVE
		$response = array();
		$this->form_validation->set_rules('name', 'Branch Name', 'required|is_unique[branch.name]',array(
			'is_unique' => 'Branch Name Already Exists'
		));
		if ($this->form_validation->run() == TRUE) {
			$code = $this->admin_model->get_code(1);
			$this->admin_model->update_counter($code[0]->ct_count+1,1);
			if ($_POST['brmanager'] != 0) {
				$branchdata = array(
					'code' => $code[0]->ct_code.(sprintf('%08d', $code[0]->ct_count+1)),
					'name' => str_replace("'","’",$_POST['name']),
					'branch_address' => str_replace("'","’",$_POST['braddress']),
					'manager_id' => $_POST['brmanager'],
					'status' => 'A'
				);
			}else{
				$branchdata = array(
					'code' => $code[0]->ct_code.(sprintf('%08d', $code[0]->ct_count+1)),
					'name' => str_replace("'","’",$_POST['name']),
					'branch_address' => str_replace("'","’",$_POST['braddress']),
					'manager_id' => $_POST['brmanager'],
					'status' => 'I'
				);
			}
			$data = $this->admin_model->add_branch($branchdata);
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function add_manager(){ // IMPROVE
		$response = array();
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]',array(
			'is_unique' => 'Username Name Already Exists'
		));
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]',array(
	  		'matches' => 'Passwords do not match'
	 	));
	 	$this->form_validation->set_rules('name', 'Branch Manager Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			$mngrdata = array(
				'username' => str_replace("'","’",$_POST['username']),
				'password' => str_replace("'","’",$_POST['password']),
				'status' => 'A',
				'logged_in' => '0',
				'user_type_id' => $_POST['utid']
			);
			$this->admin_model->add_user_manager($mngrdata); 
			$user_id = $this->db->insert_id();
			$code = $this->admin_model->get_code(2);
			$this->admin_model->update_counter($code[0]->ct_count+1,2);
			$managerdata = array(
				'user_id' => $user_id,
				'code' => $code[0]->ct_code.(sprintf('%08d', $code[0]->ct_count+1)),
				'name' => str_replace("'","’",$_POST['name']),
				'status' => 'U'
			);
			$data = $this->admin_model->add_manager($managerdata);
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	// EDIT FUNCTIONS 

	public function edit_branch($id){

	}

	public function edit_manager($id){

	}	

}
