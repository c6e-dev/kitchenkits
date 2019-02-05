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
		$this->load->view('customer/home');
	}

	public function view_region(){
		$this->load->view('customer/region_view');
	}

	public function view_recipe(){
		$recipe_id = $_GET['id'];
		$data['recipe_info'] = $this->customer_model->view_recipe($recipe_id);
		$data['recipe_ings'] = $this->customer_model->recipe_ingredients($recipe_id);
		$data['recipe_revs'] = $this->customer_model->recipe_reviews($recipe_id);
		$this->load->view('customer/recipe_view',$data);
	}

	public function browse_recipe(){
		$data['selected_country'] = $this->customer_model->selected_country($_GET['id']);
		$country_id = $data['selected_country'][0]->co_id;
		$arecipe = $this->customer_model->recipe($country_id);
		$branches = $this->customer_model->read_branch();
		if ($arecipe!=NULL && $branches!=NULL) {
			$recipe_count = count($arecipe);
			$branch_count = count($branches);
			for ($i=0; $i < $recipe_count; $i++) { 
				$ingredient = $this->customer_model->recipe_ingredient($arecipe[$i]->id);
				for ($k=0; $k < $branch_count; $k++) {
					$result = FALSE;
					for ($j=0; $j < count($ingredient); $j++) { 
						$result = $this->customer_model->check_compatible_branch($branches[$k]->br_id,$ingredient[$j]->ing_id,$ingredient[$j]->ing_amnt*10);
						if (!$result) {
							break;
						}
					}
					if ($arecipe[$i]->status == 'U') {
						if ($result) {
							$this->customer_model->activate_recipe($arecipe[$i]->id);
							break;
						}
					}
				}
				if ($arecipe[$i]->status == 'A') {
					if (!$result) {
						$this->customer_model->disable_recipe($arecipe[$i]->id);
					}
				}
			}	
		}
		$data['recipe'] = $this->customer_model->browse_recipe($country_id);
		$data['country'] = $this->customer_model->read_countries();
		$this->load->view('customer/recipe_browse',$data);
	}

	public function submit_rating_and_review(){
		$this->form_validation->set_rules('review', 'Review Detail', 'required|alpha_dash|max_length[600]', array(
			'required' => 'This %s Is Required!',
			'max_length' => 'Your Review is too long.'
		));
		if ($this->form_validation->run() == TRUE) {
			$recipe_id = $_POST['re_id'];
			$review = $_POST['review'];
			$rate = $_POST['rate'];
			$customer_data = $this->customer_model->loggedin_customer($_SESSION['id']);
			$rate_act_data = array(
				'recipe_id' => $recipe_id,
				'customer_id' => $customer_data[0]->id,
				'activity_type_id' => 3
			);
			$this->customer_model->new_rating_activity($rate_act_data);
			$rating_act_id = $this->db->insert_id();
			$rate_data = array(
				'activity_id' => $rating_act_id,
				'rating' => $rate
			);
			$this->customer_model->new_rating($rate_data);
			$review_act_data = array(
				'recipe_id' => $recipe_id,
				'customer_id' => $customer_data[0]->id,
				'activity_type_id' => 4
			);
			$this->customer_model->new_review_activity($review_act_data);
			$review_act_id = $this->db->insert_id();
			$review_data = array(
				'activity_id' => $review_act_id,
				'message' => $review
			);
			$this->customer_model->new_review($review_data);
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
				$data['cart'] = $this->customer_model->view_cart($id);
				if ($data['cart']!=NULL) {
					$data['count'] = $this->customer_model->item_count($data['cart'][0]->od_id);
					$this->load->view('customer/layout/header',$data);
					$data['v_profile'] = $this->customer_model->view_profile($id);
					$data['v_history'] = $this->customer_model->view_history($id);
					$data['v_recent_order'] = $this->customer_model->view_recent_order($data['v_profile'][0]->cs_id);
					$this->load->view('customer/profile_view', $data);
					$this->load->view('customer/layout/footer');
				}else{
					$this->load->view('customer/layout/header',$data);
					$data['v_profile'] = $this->customer_model->view_profile($id);
					$data['v_history'] = $this->customer_model->view_history($id);
					$data['v_recent_order'] = $this->customer_model->view_recent_order($data['v_profile'][0]->cs_id);
					$this->load->view('customer/profile_view', $data);
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
		$this->form_validation->set_rules('cs_username', 'Username', 'required'.$is_unique, array(
			'is_unique' => 'The %s You Entered Is Already Taken'
		));
		$this->form_validation->set_rules('cs_fname', 'First Name', 'required');
		$this->form_validation->set_rules('cs_lname', 'Last Name', 'required');
		$this->form_validation->set_rules('cs_address', 'Address', 'required');
		$this->form_validation->set_rules('cs_email', 'E-Mail', 'required|valid_email'.$is_unique1, array(
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
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['utype'] == 3) {
				$id = $_SESSION['id'];
				$data['cart'] = $this->customer_model->view_cart($id);
				if ($data['cart']!=NULL) {
					$order_id = $data['cart'][0]->od_id;
					$data['count'] = $this->customer_model->item_count($order_id);
					$data['additional'] = $this->customer_model->additional_ingredients($order_id);
					$data['additional_ttl'] = $this->customer_model->additional_ingredients_subtotal($order_id);
					$data['condiments'] = $this->customer_model->read_condiments();
					$data['stotal'] = $this->customer_model->item_subtotal($id);
					$data['stotalprice'] = $this->customer_model->item_subtotal_price($id);
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
		$id = $_SESSION['id'];
		$result = $this->customer_model->order_check($id);
		if ($result==NULL) {
			$cu_id = $this->customer_model->loggedin_customer($id);
			$data = array(
				'customer_id' => $cu_id[0]->id,
				'activity_id' => 0
			);
			$this->customer_model->create_order($data);
			$order_id = $this->db->insert_id();
			$order_data = array(
				'recipe_id' => $_POST['recipe_id'],
				'order_id' => $order_id,
				'quantity' => str_replace("'","’",$_POST['quantity'])
			);
		}
		else{
			$order_data = array(
				'recipe_id' => $_POST['recipe_id'],
				'order_id' => $result[0]->id,
				'quantity' => str_replace("'","’",$_POST['quantity'])
			);
		}
		$response = $this->customer_model->add_order($order_data);
		echo json_encode($response);
	}

	public function edit_item_count(){
		$response = array();
		$this->form_validation->set_rules('itemcount', 'Item Count', 'required|numeric');
		if ($this->form_validation->run() == TRUE) {
			$this->customer_model->edit_item_count();
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
		}
		echo json_encode($response);
	}

	public function item_count_decrease(){
		$itemcount = ($_POST['itemcount'] - 1);
		$data = $this->customer_model->item_count_decrease($itemcount);
		echo json_encode($data);
	}

	public function item_count_increase(){
		$itemcount = ($_POST['itemcount'] + 1);
		$data = $this->customer_model->item_count_decrease($itemcount);
		echo json_encode($data);
	}

	public function delete_cart_item($oc_id,$od_id,$od_count){
		if ($od_count == 1) {
			$this->customer_model->delete_cart_item($oc_id,$od_id);
		}else{
			$this->customer_model->delete_order($oc_id);
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
			$this->customer_model->additional_item($data);
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function delete_additional_item(){
		$this->customer_model->delete_additional_item($_GET['id']);
		redirect('customer/view_cart');
	}

	public function update_additional_item(){
		$response = array();
		$this->form_validation->set_rules('amount', 'Ingredient Amount', 'required|numeric', array(
	 		'numeric' => '%s Invalid!'
		));
		if ($this->form_validation->run() == TRUE) {
			$this->customer_model->update_additional_item();
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

}
