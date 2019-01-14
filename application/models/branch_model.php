<?php
class branch_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	public function order_view($id){
		$query = $this->db->query("
			SELECT od.id AS od_id, od.status AS od_status, cu.first_name AS od_fname, cu.last_name AS od_lname, br.name AS od_branch, ua.created_date AS od_create, re.name AS od_recipe, oc.quantity AS od_quantity
			FROM delivery od
			INNER JOIN customer cu ON od.customer_id = cu.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			INNER JOIN recipe re ON ua.recipe_id = re.id
			INNER JOIN order_content oc ON oc.order_id = od.id
			INNER JOIN user u ON bm.user_id = u.id 
			WHERE u.id = '$id'
			ORDER BY ua.created_date ASC		
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function order_count($id){
		$query = $this->db->query("
			SELECT SUM(oc.quantity) AS qty
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			WHERE od.id = '$id'
		");
		return $query->result();
	}	

	public function detail_view($id){
		$query = $this->db->query("
			SELECT od.id AS od_id, od.code AS od_code, od.status AS od_status, oc.quantity AS od_quantity, re.name AS od_recipe, ri.ingredient_amount AS od_ig_amount, ig.name AS od_ingredient, un.name AS od_unit
			FROM delivery od 
			INNER JOIN order_content oc ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN recipe_ingredients ri ON ri.recipe_id = re.id
			INNER JOIN ingredients ig ON ri.ingredient_id = ig.id
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE od.id = '$id'
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
			SELECT bi.supply AS bi_supply, bi.updated_date AS bi_date, ig.name AS bi_name, un.name AS bi_unit
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