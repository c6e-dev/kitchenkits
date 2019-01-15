<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class branch extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('branch_model');
		date_default_timezone_set('Asia/Kuala_Lumpur');
	}

	public function index(){
		if (isset($_SESSION['logged_in'])) {
			$this->load->view('branch/layout/header');
			$data['order'] = $this->branch_model->processed_order_view($_SESSION['id']);
			if ($data['order']!=NULL) {
				$var = count($data['order']);
				for ($i=0; $i < $var ; $i++) {
					$order_count[$i] = $this->branch_model->order_count($data['order'][$i]->od_id);
					$data['count'] = $order_count;
				}
			}
			$data['inc_order'] = $this->branch_model->incomplete_order_view($_SESSION['id']);
			if ($data['inc_order']!=NULL) {
				$ivar = count($data['inc_order']);
				for ($j=0; $j < $ivar ; $j++) {
					$inc_order_count[$j] = $this->branch_model->order_count($data['inc_order'][$j]->od_id);
				}
				$data['icount'] = $inc_order_count;
			}
			$this->load->view('branch/order_view',$data);
			$this->load->view('branch/layout/footer');
		}
		else{
			redirect('user/load_login');
		}
	}

	public function detail_view(){
		$this->load->view('branch/layout/header');
		$data['detail'] = $this->branch_model->detail_view($_GET['id']);
		$data['ingredient'] = $this->branch_model->detail_ing($_GET['id']);
		$this->load->view('branch/detail_view',$data);
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