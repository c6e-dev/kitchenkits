<?php
class branch_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	public function order_view($id){
		$query = $this->db->query("
			SELECT od.status as od_status, cu.first_name as od_fname, cu.last_name as od_lname, br.name as od_branch, ua.created_date as od_create, re.name as od_recipe, oc.quantity as od_quantity
			FROM delivery od
			INNER JOIN customer cu ON od.customer_id = cu.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			INNER JOIN recipe re ON ua.recipe_id = re.id
			INNER JOIN order_content oc ON oc.order_id = od.id
			INNER JOIN user u ON bm.user_id = u.id 
			WHERE u.id = '$id'
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
			SELECT bi.supply as bi_supply, bi.updated_date as bi_date, ig.name as bi_name, un.name as bi_unit
			FROM branch_ingredients bi 
			INNER JOIN ingredients ig ON bi.ingredient_id = ig.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN unit un ON ig.unit_id = un.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user u ON bm.user_id = u.id
			WHERE u.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// public function add_supply(){

	// }
}