<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('admin_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}
	public function index(){
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['utype'] == 1) {
				$this->load->view('admin/layout/header');
				$data = array(
					'branch' => $this->admin_model->branch_count(),
					'branch_a' => $this->admin_model->branch_count_a(),
					'branch_i' => $this->admin_model->branch_count_i(),
					'manager' => $this->admin_model->manager_count(),
					'manager_a' => $this->admin_model->manager_count_a(),
					'manager_u' => $this->admin_model->manager_count_u(),
					'customer' => $this->admin_model->customer_count(),
					'customer_a' => $this->admin_model->customer_count_a(),
					'customer_i' => $this->admin_model->customer_count_i(),
					'logged_in' => $this->admin_model->logged_in_count(),
					'recipe' => $this->admin_model->recipe_count(),
					'recipe_a' => $this->admin_model->recipe_count_a(),
					'recipe_i' => $this->admin_model->recipe_count_i(),	
					'order' => $this->admin_model->order_count(),
					'order_c' => $this->admin_model->order_count_c(),
					'order_i' => $this->admin_model->order_count_i(),
					'comment' => $this->admin_model->comment_count(),
					'rating' => $this->admin_model->rating_count(),
					'logged_in' => $this->admin_model->loggedin_count(),
					'act_feed' => $this->admin_model->read_activity_feed()
				);
				$this->load->view('admin/home',$data);
				$this->load->view('admin/layout/footer');
			}
			else{
				show_404();
			}
		}
		else{
			redirect('user/load_login');
		}
	}

	// DATA TABLE FUNCTIONS - Robert / 12-01-18

	public function recipe_view(){
		$arecipe = $this->admin_model->recipe();
		$branches = $this->admin_model->read_branch();
		if ($arecipe!=NULL && $branches!=NULL) {
			$recipe_count = count($arecipe);
			$branch_count = count($branches);
			for ($i=0; $i < $recipe_count; $i++) { 
				$ingredient = $this->admin_model->recipe_ingredient($arecipe[$i]->id);
				for ($k=0; $k < $branch_count; $k++) {
					$result = FALSE;
					for ($j=0; $j < count($ingredient); $j++) { 
						$result = $this->admin_model->check_compatible_branch($branches[$k]->br_id,$ingredient[$j]->ing_id,$ingredient[$j]->ing_amnt*10);
						if (!$result) {
							break;
						}
					}
					if ($arecipe[$i]->status == 'U') {
						if ($result) {
							$this->admin_model->activate_recipe($arecipe[$i]->id);
							break;
						}
					}
				}
				if ($arecipe[$i]->status == 'A') {
					if (!$result) {
						$this->admin_model->disable_recipe($arecipe[$i]->id);
					}
				}
			}
		}
		$data['recipe'] = $this->admin_model->read_recipe();
		$data['country'] = $this->admin_model->country();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/read_recipe',$data);
		$this->load->view('admin/layout/footer');
	}

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
		$data['ibranch'] = $this->admin_model->read_i_branch();
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

	public function ingredient_view(){
		$this->load->view('admin/layout/header');
		$data['ingredient'] = $this->admin_model->read_ingredient();
		$data['unit'] = $this->admin_model->read_unit();
		$this->load->view('admin/read_ingredient',$data);
		$this->load->view('admin/layout/footer');
	}
	
	// VIEW FUNCTIONS

	public function view_recipe($rcp_id,$co_id){
		$data['recipe'] = $this->admin_model->view_recipe($rcp_id);
		$data['country'] = $this->admin_model->country2($co_id);
		$data['ingredients'] = $this->admin_model->read_ingredients();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/recipe_view',$data);
		$this->load->view('admin/layout/footer');
	}

	public function view_customer(){
		$this->load->view('admin/layout/header');
		$data = array(
			'customer' => $this->admin_model->view_customer($_GET['id']),
			'c_order' => $this->admin_model->view_customer_order($_GET['id']),
			'c_activity' => $this->admin_model->view_customer_activity($_GET['id']),
		);
		$this->load->view('admin/customer_view',$data);
		$this->load->view('admin/layout/footer');
	}

	public function view_branch(){
		$this->load->view('admin/layout/header');
		$data = array(
			'branch' => $this->admin_model->view_branch($_GET['id']),
			'b_order' => $this->admin_model->view_branch_order($_GET['id']),
			'b_manager' => $this->admin_model->read_branch_manager()
		);
		$this->load->view('admin/branch_view',$data);
		$this->load->view('admin/layout/footer');
	}

	public function view_manager(){
		$this->load->view('admin/layout/header');
		$data['manager'] = $this->admin_model->view_manager($_GET['id']);
		$data['ibranch'] = $this->admin_model->read_i_branch();
		$this->load->view('admin/manager_view',$data);
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

	public function sales_report(){
		$result = $this->admin_model->report();
		if ($result!=NULL) {
			foreach ($result as $res) {
				$data[] = $res;
			}
			echo json_encode($data);
		}	
	}

	public function branch_report(){
		$this->load->view('admin/layout/header');
		$data['report'] = $this->admin_model->branch_report();
		$this->load->view('admin/read_report',$data);
		$this->load->view('admin/layout/footer');
	}

	public function view_branch_report(){
		$this->load->view('admin/layout/header');
		$this->admin_model->report_viewed($_GET['id']);
		$data['report_details'] = $this->admin_model->view_branch_report($_GET['id']);
		$this->load->view('admin/report_view',$data);
		$this->load->view('admin/layout/footer');
	}

	// DELETE FUNCTIONS

	public function delete_recipe(){
		$this->admin_model->delete_recipe($_GET['id']);
		redirect('admin/recipe_view');
	}

	public function delete_customer(){
		$this->admin_model->delete_customer($_GET['id']);
		redirect('admin/customer_view');
	}

	public function delete_branch($br_id,$br_mi){
		$this->admin_model->delete_branch($br_id,$br_mi);
		redirect('admin/branch_view');
	}

	public function delete_manager($bm_id,$bm_uid,$bm_us){
		if ($bm_us == 'A') {
			$this->admin_model->delete_manager($bm_id,$bm_uid);
		}else{
			$this->admin_model->delete_umanager($bm_uid);
		}
		redirect('admin/manager_view');	
	}

	public function delete_ingredient(){
		$this->admin_model->delete_ingredient($_GET['id']);
		redirect('admin/ingredient_view');	
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

	public function create_recipe(){
		$response = array();
		$this->form_validation->set_rules('name', 'Recipe Name', 'required|is_unique[recipe.name]',array(
			'is_unique' => '%s already exist!'
		));
		$this->form_validation->set_rules('servings', 'Servings', 'numeric',array(
			'numeric' => 'Number of %s not valid!'
		));
		$this->form_validation->set_rules('price', 'Recipe Price', 'numeric',array(
			'numeric' => 'Value of Price not valid!'
		));
		if ($this->form_validation->run() == TRUE) {
			$dir = $_POST['name'];
			mkdir('Recipe_Folder/'.$dir);
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

	public function add_branch(){
		$response = array();
		$this->form_validation->set_rules('name', 'Branch Name', 'required|is_unique[branch.name]',array(
			'is_unique' => '%s Already Exists'
		));
		$this->form_validation->set_rules('braddress', 'Branch Address', 'required');
		if ($this->form_validation->run() == TRUE) {
			$code = $this->admin_model->get_code(1);
			$this->admin_model->update_counter($code[0]->ct_count+1,1);
			if ($_POST['brmanager'] != 0) {
				$branchdata = array(
					'code' => $code[0]->ct_code.(sprintf('%05d', $code[0]->ct_count+1)),
					'name' => str_replace("'","’",$_POST['name']),
					'branch_address' => str_replace("'","’",$_POST['braddress']),
					'manager_id' => $_POST['brmanager'],
					'status' => 'A'
				);
			}else{
				$branchdata = array(
					'code' => $code[0]->ct_code.(sprintf('%05d', $code[0]->ct_count+1)),
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

	public function add_manager(){
		$response = array();
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]',array(
			'is_unique' => '%s Already Exists'
		));
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]',array(
	  		'matches' => 'Passwords do not match'
	 	));
	 	$this->form_validation->set_rules('name', 'Branch Manager Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			$br_id = $_POST['br_id'];
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
				'code' => $code[0]->ct_code.(sprintf('%05d', $code[0]->ct_count+1)),
				'name' => str_replace("'","’",$_POST['name'])
			);
			if ($br_id != 0) {
				$data = $this->admin_model->add_manager($managerdata);
				$manager_id = $this->db->insert_id();
				$this->admin_model->update_manager($manager_id,$br_id);
			}else{
				$data = $this->admin_model->add_manager($managerdata);
			}
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function add_ingredient(){
		$response = array();
		$this->form_validation->set_rules('name', 'Ingredient', 'required|is_unique[ingredients.name]',array(
			'is_unique' => '%s already exist!'
		));
		$this->form_validation->set_rules('new_unit', 'Unit', 'alpha|is_unique[unit.name]',array(
			'alpha' => 'Invalid %s!',
			'is_unique' => '%s already exist!'
		));
		if ($this->form_validation->run() == TRUE) {
			$new_unit = $_POST['new_unit'];
			$name = $_POST['name'];
			if ($new_unit != '') {
				$new_unit = $_POST['new_unit'];
				$unit = array(
					'name' => $new_unit
				);
				$this->admin_model->add_unit($unit);
				$unit_id = $this->db->insert_id();
				$data = array(
					'unit_id' => $unit_id,
					'name' => $name
				);
			}
			else{
				$unit = $_POST['unit'];
				$data = array(
					'unit_id' => $unit,
					'name' => $name
				);
			}
			$this->admin_model->add_ingredient($data);
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	// EDIT FUNCTIONS 

	public function update_recipe(){
		$response = array();
		$ings_id = array();
		$ings_val = array();
		$ings_id = $_POST['ingredients_id'];
		$ings_val = $_POST['ingredients_val'];
		$recipe_id = $_POST['recipe_id'];
		$id_count = count($ings_id);
		for ($i=0; $i < $id_count; $i++) { 
			$data = array(
				'recipe_id' => $recipe_id,
				'ingredient_id' => $ings_id[$i],
				'ingredient_amount' => $ings_val[$i]
			);
			$this->admin_model->add_recipe_ingredients($data);
		}
		$check = $this->admin_model->recipe_check($recipe_id);
		if($this->input->post('name') == $check[0]->re_nm) {
		   	$is_unique =  '';
		} else {
			$is_unique =  '|is_unique[recipe.name]';
		}
		$this->form_validation->set_rules('name', 'Recipe Name', 'required'.$is_unique,
			array(
				'is_unique' => '%s already exist!'
			));
		$this->form_validation->set_rules('servings', 'Servings', 'numeric',array(
			'numeric' => 'Number of %s not valid!'
		));
		$this->form_validation->set_rules('price', 'Recipe Price', 'numeric',array(
			'numeric' => 'Value of Price not valid!'
		));
		
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

	public function edit_branch(){
		$response = array();
		$branch_id = $_POST['branch_id'];
		$check = $this->admin_model->branch_check($branch_id);
		if($this->input->post('brname') == $check[0]->br_nm) {
		   	$is_unique =  '';
		} else {
			$is_unique =  '|is_unique[branch.name]';
		}
		$this->form_validation->set_rules('brname', 'Branch Name', 'required'.$is_unique,
			array(
				'is_unique' => '%s Already Exists'
			));
		$this->form_validation->set_rules('braddress', 'Branch Address', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			$upt_date = date('Y-m-d H:i:s');
			$mngr_id = $_POST['mngr_id'];
			$brmngr_id = $_POST['brmanager_id'];
			if ($mngr_id == 0 && $brmngr_id == 0) {
				$data = $this->admin_model->edit_branchnm($upt_date);			}
			elseif ($mngr_id == $brmngr_id || ($mngr_id == 0 && $brmngr_id != 0)) {
				$data = $this->admin_model->edit_branch($upt_date);
			}
			elseif ($mngr_id != 0 && $brmngr_id == 0) {
				$this->admin_model->edit_branch_newmngr($mngr_id);
				$data = $this->admin_model->edit_branch1($upt_date);
			}
			else{
				$this->admin_model->edit_branch_newmngr($mngr_id);
				$data = $this->admin_model->edit_branch($upt_date);
			}
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function edit_manager(){
		$response = array();
		$manager_id = $_POST['manager_id'];
		$check = $this->admin_model->manager_check($manager_id);
		if($this->input->post('mngr_nm') == $check[0]->bm_nm) {
		   	$is_unique =  '';
		} else {
			$is_unique =  '|is_unique[branch_manager.name]';
		}
		$this->form_validation->set_rules('mngr_nm', 'Branch Manager Name', 'required'.$is_unique,
			array(
				'is_unique' => '%s Already Exists'
			));
		if ($this->form_validation->run() == TRUE) {
			$upt_date = date('Y-m-d H:i:s');
			$cubr_id = $_POST['cubr_id'];
			$br_id = $_POST['br_id'];
			if (($cubr_id == NULL && $br_id == 0) || ($cubr_id == '' && $br_id == 0)) {
				$data = $this->admin_model->edit_managernm($upt_date);
			}
			elseif ($cubr_id == $br_id || ($cubr_id == 0 && $br_id != 0)) {
				$data = $this->admin_model->edit_manager($upt_date);
			}
			elseif ($cubr_id != 0 && $br_id == 0) {
				$this->admin_model->edit_manager_newbr($cubr_id);
				$data = $this->admin_model->edit_manager1($upt_date);
			}
			else{
				$this->admin_model->edit_manager_newbr($cubr_id);
				$data = $this->admin_model->edit_manager($upt_date);
			}
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}	

	public function upload_recipe_image(){
		$recipe_name = $_POST['re_nm'];
		$re_id = $_POST['re_id'];
		$co_id = $_POST['country_id'];
		$config = array(
			'upload_path' => './Recipe_Folder/'.$recipe_name,
		 	'allowed_types' => 'jpg|png|jpeg',
		 	'max_size' => '3072',
		 	'max_width' => '350',
			'max_height' => '200'
		);
        $this->load->library('upload', $config);
        $this->upload->do_upload('recipe_image');
       	$uploaded_image = $this->upload->data();       	
  		$image = $uploaded_image[file_name];
  		$upt_date = date('Y-m-d H:i:s'); 
		$this->admin_model->upload_recipe_image($re_id,$image,$upt_date);
		redirect('admin/view_recipe/'.$re_id.'/'.$co_id); 
	}

	public function supply_report(){
		$data = $this->admin_model->supply_report();
		if ($data==NULL) {
			$response['notify'] = 'No Notification To View';
			echo json_encode($response);
		}else{
			echo json_encode($data);
		}		
	}

	public function password_check(){
		$curr_pass = sha1($_POST['curr_password']);
		if ($curr_pass == $_SESSION['pass']) {
			return TRUE;
		}
		else{
			$this->form_validation->set_message('password_check', 'The {field} You Supplied Does Not Match Your Existing Password');
			return FALSE;
		}
	}

	public function edit_password(){
		$response = array();
		$this->form_validation->set_rules('curr_password', 'Current Password', 'callback_password_check');
		$this->form_validation->set_rules('new_password', 'New Password', 'required',
			array(
				'required' => 'You Must Provide A %s'
		));
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[new_password]',
			array(
		 		'matches' => 'Passwords Do Not Match'
			));
		if ($this->form_validation->run() == TRUE) {
			$_SESSION['pass'] = sha1($_POST['new_password']);
			$upt_date = date('Y-m-d H:i:s');
			$data = $this->admin_model->edit_password($upt_date);
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function confirm_order(){
		$recipe_data = $this->admin_model->recipe_order($_GET['id']);
		$count = count($recipe_data);
		for ($i=0; $i < $count; $i++) { 
			$ingredients[$i] = $this->admin_model->recipe_order_ingredients($recipe_data[$i]->recipe_id,$recipe_data[$i]->quantity);
		}
		$var = count($ingredients) ;
		$totals = array();
		for($i = 0; $i < $var; $i++){ 
			foreach($ingredients[$i] as $key => $lol){ 
				if(!array_key_exists($lol->ingredient_id, $totals)){ 
					$totals[$lol->ingredient_id] = $lol->amount; 
				} 
				else{ 
					$totals[$lol->ingredient_id] += $lol->amount; 
				} 
			} 
		}
		$customer_data = $this->admin_model->loggedin_customer($_SESSION['id']);
		$branch_data = $this->admin_model->branch_info();
		$count1 = count($branch_data);
		for ($i=0; $i < $count1; $i++) { 
			$distance[$i] = getDistance($customer_data[0]->addr, $branch_data[$i]->br_addr);
			$branch_ids[$i] = $branch_data[$i]->id;
		}
		asort($distance);
		foreach ($distance as $key => $dis) {
			foreach($totals as $ing_id => $total){
			    $result = $this->admin_model->check_compatible_branch($branch_ids[$key],$ing_id,$total);
			    if (!$result)break;
			}
			if ($result) {
				foreach($totals as $ing_id => $total){
			    	$this->admin_model->reduce_supply($branch_ids[$key],$ing_id,$total);
				}
				$data = array(
					'recipe_id' => 0,
					'customer_id' => $customer_data[0]->id,
					'activity_type_id' => 1
				);
				$this->admin_model->new_order_activity($data);
				$activity_id = $this->db->insert_id();
				$code = $this->admin_model->get_code(4);
				$this->admin_model->update_counter($code[0]->ct_count+1,4);
				$order_code = $code[0]->ct_code.(sprintf('%05d', $code[0]->ct_count+1));
				$this->admin_model->confirm_order($_GET['id'],$branch_ids[$key],$activity_id,$order_code);
				break;
			}
		}
		redirect('customer/view_cart');
	}
}

function getDistance($addressFrom, $addressTo){
    $apiKey = 'AIzaSyDhfAMuCR-qXYfDCT0l-ieHJVSb3Qc7tV0';
    
    $formattedAddrFrom  = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo = str_replace(' ', '+', $addressTo);
    
    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $outputFrom = json_decode($geocodeFrom);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
    $outputTo = json_decode($geocodeTo);
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }
    
    $latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo = $outputTo->results[0]->geometry->location->lng;
    
    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;

    return round($miles * 1609.344, 2);
}

