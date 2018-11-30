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
		$this->load->view('admin/layout/header');
		$this->load->view('admin/recipe',$data);
		$this->load->view('admin/layout/footer');
	}
	public function delete_recipe($id){
		$this->admin_model->delete_recipe($id);
		redirect('admin/recipe_view');
	}
}
