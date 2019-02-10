<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Branch_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}

	public function index(){
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['utype'] == 2) {
				$this->load->view('branch/layout/header');
				$data['order'] = $this->Branch_model->processed_order_view($_SESSION['id']);
				if ($data['order']!=NULL) {
					$var = count($data['order']);
					for ($i=0; $i < $var ; $i++) {
						$order_count[$i] = $this->Branch_model->order_count($data['order'][$i]->od_id);
					}
					$data['count'] = $order_count;
				}
				$data['inc_order'] = $this->Branch_model->incomplete_order_view($_SESSION['id']);
				if ($data['inc_order']!=NULL) {
					$ivar = count($data['inc_order']);
					for ($j=0; $j < $ivar ; $j++) {
						$inc_order_count[$j] = $this->Branch_model->order_count($data['inc_order'][$j]->od_id);
					}
					$data['icount'] = $inc_order_count;
				}
				$this->load->view('branch/order_view',$data);
				$this->load->view('branch/layout/footer');
			}
			else{
				show_404();
			}
		}
		else{
			redirect('user');
		}
	}

	public function detail_view(){
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['utype'] == 2) {
				$this->load->view('branch/layout/header');
				$data['detail'] = $this->Branch_model->detail_view($_GET['id']);
				if ($data['detail']!=NULL) {
					$var = count($data['detail']);
					for ($i=0; $i < $var ; $i++) { 
						$recipe_ingredients[$i] = $this->Branch_model->detail_ing($data['detail'][$i]->od_recipe_id);
					}
					$data['ingredient'] = $recipe_ingredients;
				}
				$this->load->view('branch/detail_view',$data);
				$this->load->view('branch/layout/footer');
			}
			else{
				show_404();
			}
		}
		else{
			redirect('user');
		}
	}

	public function order_complete(){
		$this->Branch_model->order_complete($_GET['id']);
		redirect('branch');
	}

	public function supply_view(){
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['utype'] == 2) {
				$this->load->view('branch/layout/header');
				$data['supply'] = $this->Branch_model->supply_view($_SESSION['id']);
				$data['ingredients'] = $this->Branch_model->all_ingredients($data['supply'][0]->branch_id);
				$this->load->view('branch/supply_view',$data);
				$this->load->view('branch/layout/footer');
			}
			else{
				show_404();
			}
		}
		else{
			redirect('user');
		}
	}

	public function update_supply(){
		$response = array();
		$ings_id = array();
		$ings_val = array();
		$ings_val = $_POST['ingredients_val'];
		$count = count($ings_val);
		for ($i=0; $i < $count; $i++) {
			$this->form_validation->set_rules('ingredients_val['.$i.']', 'Ingredient Amount', 'required|numeric',array(
				'numeric' => 'Please enter a valid amount!',
				'required' => 'Please Fill All %s Fields!'
			));
			if ($this->form_validation->run() == FALSE) {
				break;
			}
		}
		if ($this->form_validation->run() == TRUE) {
			$upt_date = date('Y-m-d H:i:s');
			$this->Branch_model->update_supply($upt_date);
			$ings_id = $_POST['ingredients_id'];
			$bri_id = $_POST['branch_ingr_id'];
			for ($j=0; $j < $count; $j++) { 
				$data = array(
					'branch_ingredients_id' => $bri_id[$j],
					'amount_change' => $ings_val[$j],
					'status' => 1,
					'type' => 1

				);
				$this->Branch_model->add_report($data);
			}
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function add_ingredient_supply(){
		$response = array();
		$ings_id = array();
		$ings_val = array();
		$ings_val = $_POST['ingredients_val'];
		$count = count($ings_val);
		for ($i=0; $i < $count; $i++) {
			$this->form_validation->set_rules('ingredients_val['.$i.']', 'Ingredient Amount', 'required|numeric',array(
				'numeric' => 'Please enter a valid amount!',
				'required' => 'Please Fill All %s Fields!'
			));
			if ($this->form_validation->run() == FALSE) {
				break;
			}
		}
		if ($this->form_validation->run() == TRUE) {
			$ings_id = $_POST['ingredients_id'];
			$br_id = $_POST['branch_id'];
			for ($j=0; $j < $count; $j++) { 
				$data = array(
					'ingredient_id' => $ings_id[$j],
					'branch_id' => $br_id,
					'supply' => $ings_val[$j]
				);
				$this->Branch_model->add_ingredient_supply($data);
			}
			$response['status'] = TRUE;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function reduce_supply(){
		$response = array();
		$current_amount = $_POST['current_amount'];
		$this->form_validation->set_rules('amount', 'Ingredient Amount', 'required|less_than_equal_to['.$current_amount.']',array(
			'less_than_equal_to' => 'Please enter a valid amount!'
		));
		$this->form_validation->set_rules('reason', 'Reason', 'required',array(
			'required' => 'You must provide a valid reason'
		));
		if ($this->form_validation->run() == TRUE) {
			$this->Branch_model->reduce_supply();
			$data = array(
				'branch_ingredients_id' => $_POST['bri_id'],
				'amount_change' => str_replace("'","’",$_POST['amount']),
				'reason' => str_replace("'","’",$_POST['reason']),
				'status' => 1,
				'type' => 0
			);
			$this->Branch_model->add_report($data);
			$response['status'] = TRUE;
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
			$data = $this->Branch_model->edit_password($upt_date);
			$response['status'] = TRUE;
			$response[] = $data;
		}
		else {
			$response['status'] = FALSE;
	    	$response['notif']	= validation_errors();
		}
		echo json_encode($response);
	}

	public function notify_branch(){
		$id = $_SESSION['id'];
		$supply = $this->Branch_model->supply_view($id);
		if ($supply!=NULL) {
			$count = count($supply);
			for ($i=0; $i < $count; $i++) { 
				$response[$i] = $this->Branch_model->check_critical_level($id,$supply[$i]->bi_id,$supply[$i]->bi_supply);
			}
			echo json_encode($response);
		}
		else{
			$response['notify'] = 'No Notification To View';
			echo json_encode($response);
		}
	}

	public function print_order_details(){
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['utype'] == 2) {
				$id = $_GET['id'];
				$data = array(
					'detail' => $this->Branch_model->detail_view($id),
					'additional' => $this->Branch_model->additional_ingredients($id),
					'additional_ttl' => $this->Branch_model->additional_ingredients_subtotal($id),
					'stotalprice' => $this->Branch_model->item_subtotal_price($id)
				);
				$this->load->view('branch/print',$data);
			}
			else{
				show_404();
			}
		}
		else{
			redirect('user');
		}
	}

} 
