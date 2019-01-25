<?php
class branch_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	public function processed_order_view($id){
		$query = $this->db->query("
			SELECT od.id AS od_id, od.status AS od_status, cu.first_name AS od_fname, cu.last_name AS od_lname, br.name AS od_branch, ua.created_date AS od_create
			FROM delivery od
			INNER JOIN customer cu ON od.customer_id = cu.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE bm.user_id = '$id' AND od.status = 'P'
			ORDER BY ua.created_date ASC
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function incomplete_order_view($id){
		$query = $this->db->query("
			SELECT od.id AS od_id, od.status AS od_status, cu.first_name AS od_fname, cu.last_name AS od_lname, br.name AS od_branch, ua.created_date AS od_create
			FROM delivery od
			INNER JOIN customer cu ON od.customer_id = cu.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE bm.user_id = '$id' AND od.status = 'I'
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
			SELECT od.id AS od_id, od.code AS od_code, od.status AS od_status, oc.quantity AS od_quantity, re.id od_recipe_id, re.name AS od_recipe, re.instructions AS od_instructions
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			WHERE od.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function order_complete($id){
		$this->db->query("
			UPDATE delivery od 
			SET od.status = 'P' 
			WHERE od.id = '$id'
		");
	}

	public function detail_ing($re_id){
		$query = $this->db->query("
			SELECT ri.ingredient_amount AS ri_amount, ig.name AS ri_ingredient, un.name AS ri_unit
			FROM recipe_ingredients ri
			INNER JOIN ingredients ig ON ri.ingredient_id = ig.id
			INNER JOIN recipe re ON ri.recipe_id = re.id
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE ri.recipe_id = '$re_id'
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

	public function edit_password($upt_date){
		$password = sha1($this->input->post('new_password'));
		$user_id = $this->input->post('user_id');
		$this->db->query("
			UPDATE user u
			SET u.password = '$password', u.updated_date = '$upt_date' 
			WHERE u.id = '$user_id'
		");
	}

}