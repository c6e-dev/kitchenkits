<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Customer_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}

	//CONSTRUCTOR FUNCTIONS

	public function getRecommendations($id){
		$customer_data = $this->Customer_model->loggedin_customer($id);
		$myorders = $this->Customer_model->loggedin_customer_ordered_recipes($customer_data[0]->id);
		$cid = $this->Customer_model->read_all_customer($customer_data[0]->id);
		if ($myorders==NULL) {
			return NULL;
		}

		$recipes = array();
		foreach ($myorders as $val) {
			if(!array_key_exists($val->recipe_id, $recipes)){ 
				$recipes[$val->recipe_id] = $val->recipe_id; 
			}
		}
		
		foreach ($cid as $value) {
			$customer_orders[$value->id] = $this->Customer_model->customer_ordered_recipes($value->id);
		}

		$recommends = array();
 		foreach ($customer_orders as $otherCustomer => $values) {
 			$similar = array();
 			foreach ($customer_orders[$otherCustomer] as $key => $value) {
				if(array_key_exists($value->id, $recipes)){
        			$similar[$value->id] = 1;
            	}
			}
			if (count($similar) > 0) {
	        	foreach ($customer_orders[$otherCustomer] as $vals) {
	        		if (!array_key_exists($vals->id, $recipes)) {
	        			if(!array_key_exists($vals->id, $recommends)) {
                            $recommends[$vals->id] = $vals->id;
                        }
	        		}
	        	}
			}
 		}

        // $this->check_branch_ingredients($customer_orders);
        $result = array();
	    foreach ($recommends as $key => $recipe_ids) {
	    	$result[] = $this->Customer_model->recommended_recipe($recipe_ids);
	    }

	    if ($result!=NULL) {
	    	$n = count($result);
		    for ($i=0; $i < $n; $i++) { 
		    	for ($j=0; $j < $n; $j++) { 
		    		if ($result[$j][0]->average<$result[$i][0]->average) {
		    			$temp = $result[$i];
		    			$result[$i] = $result[$j];
		    			$result[$j] = $temp;
		    		}
		    	}
		    }
		    return $result;	
	    }else{
	    	return NULL;
	    }
	}

	public function check_branch_ingredients($arecipe){
		$branches = $this->Customer_model->read_branch();
		if ($arecipe!=NULL && $branches!=NULL) {
			$recipe_count = count($arecipe);
			$branch_count = count($branches);
			for ($i=0; $i < $recipe_count; $i++) { 
				$ingredient = $this->Customer_model->recipe_ingredient($arecipe[$i]->id);
				for ($k=0; $k < $branch_count; $k++) {
					$result = FALSE;
					for ($j=0; $j < count($ingredient); $j++) { 
						$result = $this->Customer_model->check_compatible_branch($branches[$k]->br_id,$ingredient[$j]->ing_id,$ingredient[$j]->ing_amnt*10);
						if (!$result) {
							break;
						}
					}
					if ($arecipe[$i]->status == 'U') {
						if ($result) {
							$this->Customer_model->activate_recipe($arecipe[$i]->id);
							break;
						}
					}
				}
				if ($arecipe[$i]->status == 'A') {
					if (!$result) {
						$this->Customer_model->disable_recipe($arecipe[$i]->id);
					}
				}
			}	
		}
	}

	//CUSTOMER PROFILE FUNCTIONS

	//VIEW FUNCTIONS
	public function fb_auth(){
		if($this->facebook->is_authenticated()){
			$fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email');
			$id = $fbUser['id'];
			$userdata = $this->Customer_model->fb_login_check($id);
			if ($userdata==NULL) {
				print_r($id);
				$userdata = array(
					'fb_id' => $id,
					'user_type_id' => 3,
					'status' => 'A',
					'logged_in' => 1
				);
				$this->Customer_model->add_customer_account($userdata);
				$user_id = $this->db->insert_id();
				$code = $this->Customer_model->get_code(3);
				$this->Customer_model->update_counter($code[0]->ct_count+1,3);
				$customerdata = array(
					'user_id' => $user_id,
					'code' => $code[0]->ct_code.(sprintf('%05d', $code[0]->ct_count+1)),
					'first_name' => $fbUser['first_name'],
					'last_name' => $fbUser['last_name'],
					'email_address' => $fbUser['email']
				);
				$this->Customer_model->add_customer($customerdata);
				$_SESSION = array(
					'id' => $user_id,
					'user' => '',
					'pass' => '',
					'utype' => 3,
					'logged_in' => TRUE,
					'fname' => $fbUser['first_name'],
					'lname' => $fbUser['last_name']
				);
			}else{
				if ($userdata[0]->status == 'A') {
					$sess_id = $userdata[0]->id;
					$customerdata = $this->Customer_model->get_customer($sess_id);
					$_SESSION = array(
						'id' => $sess_id,
						'user' => $userdata[0]->username,
						'pass' => '',
						'utype' => $userdata[0]->user_type_id,
						'logged_in' => TRUE,
						'fname' => $customerdata[0]->first_name,
						'lname' => $customerdata[0]->last_name
					);
					$this->Customer_model->logged_in($sess_id);
				}
				else{
					$this->session->set_flashdata('error_msg','Your Account Has Been Disabled!');
					redirect('login');die();
				}
			}
		}
	}


	public function index(){
		$this->fb_auth();
		if (isset($_SESSION['logged_in']) && $_SESSION['utype'] == 3) {
			$result = $this->getRecommendations($_SESSION['id']);
			$data['recommended_recipe'] = $result;
			$data['customerdata'] = $this->Customer_model->loggedin_customer($_SESSION['id']);
		}
		$msr = $this->Customer_model->most_sold_recipes();
		if ($msr!=NULL) {
			foreach ($msr as $value) {
				$res = $this->Customer_model->recommended_recipe($value->re_id);
				if ($res[0]->re_id!=''){
					$ids[] = $res;
				}
			}
			$data['top_of_the_month'] = $ids;
		}else{
			$data['top_of_the_month'] = NULL;
		}
		$this->load->view('customer/home',$data);
	}

	public function view_region(){
		$this->load->view('customer/region_view');
	}

	public function view_recipe(){
		$recipe_id = $_GET['id'];
		if (isset($_SESSION['logged_in']) && $_SESSION['utype'] == 3) {
			$id = $_SESSION['id'];
			$data['recipe_rts'] = $this->Customer_model->recipe_rates($recipe_id,$id);
			$data['revs'] = $this->Customer_model->recipe_reviews($recipe_id,$id);
			$data['myrate'] = $this->Customer_model->my_rate($recipe_id,$id);
			$data['myrev'] = $this->Customer_model->my_review($recipe_id,$id);
		}else{
			$data['recipe_rts'] = $this->Customer_model->recipe_rates($recipe_id,0);
			$data['revs'] = $this->Customer_model->recipe_reviews($recipe_id,0);
			$data['myrate'] = $this->Customer_model->my_rate($recipe_id,0);
			$data['myrev'] = $this->Customer_model->my_review($recipe_id,0);
		}
		$data['recipe_info'] = $this->Customer_model->view_recipe($recipe_id);
		$data['recipe_ings'] = $this->Customer_model->recipe_ingredients($recipe_id);
		$this->load->view('customer/recipe_view',$data);
	}

	public function browse_recipe(){
		$data['selected_country'] = $this->Customer_model->selected_country($_GET['id']);
		$country_id = $data['selected_country'][0]->co_id;
		$arecipe = $this->Customer_model->recipe($country_id);
		$this->check_branch_ingredients($arecipe);
		$result = $this->Customer_model->browse_recipe($country_id);
		foreach ($result as $value) {
			$recipes[] = $this->Customer_model->recommended_recipe($value->re_id);
		}
		$data['recipe'] = $recipes;
		$data['country'] = $this->Customer_model->read_countries();
		$this->load->view('customer/recipe_browse',$data);
	}

	public function submit_rating_and_review(){
		$this->form_validation->set_rules('review', 'Review Detail', 'required|alpha_numeric_spaces|max_length[600]', array(
			'required' => 'This %s Is Required!',
			'max_length' => 'Your Review is too long.'
		));
		if ($this->form_validation->run() == TRUE) {
			$recipe_id = $_POST['re_id'];
			$review = $_POST['review'];
			$rate = $_POST['rate'];
			$customer_data = $this->Customer_model->loggedin_customer($_SESSION['id']);
			$rate_act_data = array(
				'recipe_id' => $recipe_id,
				'customer_id' => $customer_data[0]->id,
				'activity_type_id' => 3
			);
			$this->Customer_model->new_rating_activity($rate_act_data);
			$rating_act_id = $this->db->insert_id();
			$rate_data = array(
				'activity_id' => $rating_act_id,
				'rating' => $rate
			);
			$this->Customer_model->new_rating($rate_data);
			$review_act_data = array(
				'recipe_id' => $recipe_id,
				'customer_id' => $customer_data[0]->id,
				'activity_type_id' => 4
			);
			$this->Customer_model->new_review_activity($review_act_data);
			$review_act_id = $this->db->insert_id();
			$review_data = array(
				'activity_id' => $review_act_id,
				'message' => $review
			);
			$this->Customer_model->new_review($review_data);
			$response['status'] = TRUE;
			$response['msg'] = 'Your Rate And Review Successfully Published.';
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function view_profile(){
		if (isset($_SESSION['logged_in'])) {
			$id = $_SESSION['id'];
			if ($_SESSION['utype'] == 3) {
				$data['cart'] = $this->Customer_model->view_cart($id);
				$data['v_profile'] = $this->Customer_model->loggedin_customer($id);
				$data['v_history'] = $this->Customer_model->view_history($id);
				$data['v_recent_order'] = $this->Customer_model->view_recent_order($data['v_profile'][0]->id);
				if ($data['v_recent_order']!=NULL) {
					$data['order_count'] = count($data['v_recent_order']);
				}
				if ($data['cart']!=NULL) {
					$data['count'] = $this->Customer_model->item_count($data['cart'][0]->od_id);
					$this->load->view('customer/layout/header',$data);
					$this->load->view('customer/profile_view');
					$this->load->view('customer/layout/footer');
				}else{
					$this->load->view('customer/layout/header',$data);
					$this->load->view('customer/profile_view');
					$this->load->view('customer/layout/footer');
				}
			}
			else{
				show_404();
			}
		}
		else{
			redirect('user');
		}
	}

	//EDIT FUNCTIONS

	public function edit_profile(){
		$response = array();
		$user_id = $_POST['u_id'];
		$username = $_POST['cs_username'];
		$fname = $_POST['cs_fname'];
		$lname = $_POST['cs_lname'];
		$check = $this->Customer_model->user_check($user_id);
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
		if($_SESSION['pass'] == ''){
			$this->form_validation->set_rules('cs_username', 'Username', 'alpha_numeric_spaces'.$is_unique, array(
				'is_unique' => 'The %s You Entered Is Already Taken'
			));
		}else{
			$this->form_validation->set_rules('cs_username', 'Username', 'required'.$is_unique, array(
				'is_unique' => 'The %s You Entered Is Already Taken'
			));
		}
		$this->form_validation->set_rules('cs_fname', 'First Name', 'required');
		$this->form_validation->set_rules('cs_lname', 'Last Name', 'required');
		$this->form_validation->set_rules('cs_address', 'Address', 'required');
		$this->form_validation->set_rules('cs_religion', 'Address', 'alpha_numeric_spaces');
		$this->form_validation->set_rules('cs_email', 'E-Mail', 'required|valid_email'.$is_unique1, array(
			'required' => 'You must provide an %s',
			'valid_email' => 'The %s You Entered Is Invalid or Already Taken',
			'is_unique' => 'The %s You Entered Is Invalid or Already Taken'
		));
		if ($this->form_validation->run() == TRUE) {
			$_SESSION['user'] = $username;
			$_SESSION['fname'] = $fname;
			$_SESSION['lname'] = $lname;
			$upt_date = date('Y-m-d H:i:s');
			$data = $this->Customer_model->edit_profile($upt_date);
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
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
		$this->form_validation->set_rules('new_password', 'New Password', 'required', array(
			'required' => 'You Must Provide A %s'
		));
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[new_password]', array(
	 		'matches' => 'Passwords Do Not Match'
		));
		if ($this->form_validation->run() == TRUE) {
			$_SESSION['pass'] = sha1($_POST['new_password']);
			$upt_date = date('Y-m-d H:i:s');
			$data = $this->Customer_model->edit_password($upt_date);
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
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['utype'] == 3) {
				$id = $_SESSION['id'];
				$data['cart'] = $this->Customer_model->view_cart($id);
				if ($data['cart']!=NULL) {
					$order_id = $data['cart'][0]->od_id;
					$data['count'] = $this->Customer_model->item_count($order_id);
					$data['additional'] = $this->Customer_model->additional_ingredients($order_id);
					$data['additional_ttl'] = $this->Customer_model->additional_ingredients_subtotal($order_id);
					$data['condiments'] = $this->Customer_model->read_condiments($order_id);
					$data['stotal'] = $this->Customer_model->item_subtotal($id);
					$data['stotalprice'] = $this->Customer_model->item_subtotal_price($id);
					$this->load->view('customer/layout/header', $data);
					$this->load->view('customer/cart_view');
					$this->load->view('customer/layout/footer');
				}else{
					$this->load->view('customer/layout/header', $data);
					$this->load->view('customer/cart_view');
					$this->load->view('customer/layout/footer');
				}
			}
			else{
				show_404();
			}
		}
		else{
			redirect('user');
		}
	}

	public function add_to_cart(){
		$response = array();
		$id = $_SESSION['id'];
		$result = $this->Customer_model->order_check($id);	
		if ($result==NULL) {
			$cu_id = $this->Customer_model->loggedin_customer($id);
			$data = array(
				'customer_id' => $cu_id[0]->id,
				'activity_id' => 0
			);
			$this->Customer_model->create_order($data);
			$order_id = $this->db->insert_id();
			$order_data = array(
				'recipe_id' => $_POST['recipe_id'],
				'order_id' => $order_id,
				'quantity' => str_replace("'","’",$_POST['quantity'])
			);
			$this->Customer_model->add_order($order_data);
			$response['status'] = TRUE;
			$response['notif'] = 'Recipe Successfully Added To Your Cart!';
		}
		else{
			$check = $this->Customer_model->recipe_check($result[0]->id, $_POST['recipe_id']);
			if ($check==NULL) {
				$order_data = array(
					'recipe_id' => $_POST['recipe_id'],
					'order_id' => $result[0]->id,
					'quantity' => str_replace("'","’",$_POST['quantity'])
				);
				$this->Customer_model->add_order($order_data);
				$response['status'] = TRUE;
				$response['notif'] = 'Recipe Successfully Added To Your Cart!';
			}else{
				$response['status'] = FALSE;
				$response['notif']	= 'Recipe Is Already In Your Cart!';
			}
		}
		echo json_encode($response);
	}

	public function edit_item_count(){
		$response = array();
		$this->form_validation->set_rules('itemcount', 'Item Count', 'required|numeric');
		if ($this->form_validation->run() == TRUE) {
			$this->Customer_model->edit_item_count();
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
		}
		echo json_encode($response);
	}

	public function item_count_decrease(){
		$itemcount = ($_POST['itemcount'] - 1);
		$data = $this->Customer_model->item_count_decrease($itemcount);
		echo json_encode($data);
	}

	public function item_count_increase(){
		$itemcount = ($_POST['itemcount'] + 1);
		$data = $this->Customer_model->item_count_decrease($itemcount);
		echo json_encode($data);
	}

	public function delete_cart_item($oc_id,$od_id,$od_count){
		if ($od_count == 1) {
			$this->Customer_model->delete_cart_item($oc_id,$od_id);
		}else{
			$this->Customer_model->delete_order($oc_id);
		}
		redirect('customer/view_cart');
	}

	public function additional_item(){
		$response = array();
		$this->form_validation->set_rules('ingredient', 'Ingredient', 'required|is_natural_no_zero',array(
			'is_natural_no_zero' => 'Please select an ingredient!',
			'required' => 'Please select an ingredient!'
		));
		$this->form_validation->set_rules('amount', 'Ingredient Amount', 'required|numeric', array(
	 		'numeric' => '%s Invalid!'
		));
		if ($this->form_validation->run() == TRUE) {
			$od_id = $_POST['order_id'];
			$ingr = $_POST['ingredient'];
			$amnt = $_POST['amount'];
			$data = array(
				'order_id' => $od_id,
				'ingredient_id' => $ingr,
				'ingredient_amount' => $amnt,
			);
			$this->Customer_model->additional_item($data);
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function delete_additional_item(){
		$this->Customer_model->delete_additional_item($_GET['id']);
		redirect('customer/view_cart');
	}

	public function update_additional_item(){
		$response = array();
		$this->form_validation->set_rules('amount', 'Ingredient Amount', 'required|numeric', array(
	 		'numeric' => '%s Invalid!'
		));
		if ($this->form_validation->run() == TRUE) {
			$this->Customer_model->update_additional_item();
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	//NOTIFICATION
	public function notify_me(){
		$id = $_SESSION['id'];
		$result = $this->Customer_model->notify_me($id);
		if ($result==NULL) {
			$response['notify'] = 'No Notification To View';
			echo json_encode($response);
		}else{
			echo json_encode($result);
		}
	}

	public function confirm_latest_order(){
		$this->Customer_model->confirm_last_order($_GET['id']);
		redirect('Customer/view_profile');
	}

}
