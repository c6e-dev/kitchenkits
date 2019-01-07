<?php
class branch_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	public function order_view($id){
		$query = $this->db->query("
			SELECT od.status as od_status, cu.first_name as od_fname, cu.last_name as od_lname, br.name as od_branch, ua.created_date as od_create, re.name as od_recipe
			FROM delivery od
			INNER JOIN customer cu ON od.customer_id = cu.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			INNER JOIN recipe re ON ua.recipe_id = re.id
			INNER JOIN user u ON bm.user_id = u.id 
			WHERE u.id = '$id' AND od.status = 'I'
			ORDER BY ua.created_date DESC		
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function supply_view($id){
		$query = $this->db->query("
			SELECT ig.name as ig_name, ig.stock as ig_stock, un.id as ig_unit
			FROM ingredients ig 
			INNER JOIN branch br ON ig.branch_id = br.id
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE br.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// public function add_stock(){

	// }
}