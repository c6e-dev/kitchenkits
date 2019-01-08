<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class branch extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('branch_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}

	public function index(){
		$this->load->view('branch/layout/header');
		$data['order'] = $this->branch_model->order_view($_SESSION['id']);
		$this->load->view('branch/order_view',$data);
		$this->load->view('branch/layout/footer');
	}

	public function supply_view(){
		$this->load->view('branch/layout/header');
		$data['supply'] = $this->branch_model->supply_view($_SESSION['id']);
		$this->load->view('branch/supply_view',$data);
		$this->load->view('branch/layout/footer');
	}

	// public function add_supply(){

	// }
}  