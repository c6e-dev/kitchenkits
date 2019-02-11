<?php
class Branch_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	public function processed_order_view($id){
		$query = $this->db->query("
			SELECT md5(od.id) AS od_id, od.status AS od_status, cu.first_name AS od_fname, cu.last_name AS od_lname, br.name AS od_branch, ua.created_date AS od_create
			FROM delivery od
			INNER JOIN customer cu ON od.customer_id = cu.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE bm.user_id = '$id' AND od.status = 'P'
			ORDER BY ua.created_date DESC
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
			SELECT md5(od.id) AS od_id, od.status AS od_status, cu.first_name AS od_fname, cu.last_name AS od_lname, br.name AS od_branch, ua.created_date AS od_create
			FROM delivery od
			INNER JOIN customer cu ON od.customer_id = cu.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE bm.user_id = '$id' AND od.status = 'I'
			ORDER BY ua.created_date DESC
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
			WHERE md5(od.id) = '$id'
		");
		return $query->result();
	}	

	public function detail_view($id){
		$query = $this->db->query("
			SELECT md5(od.id) AS od_id, od.code AS od_code, od.status AS od_status, oc.quantity AS od_quantity, re.id od_recipe_id, re.name AS od_recipe, re.instructions AS od_instructions, re.price re_price, od.status od_status, br.name br_name, br.branch_address br_addr, bm.name bm_name, cs.first_name cs_fname, cs.last_name cs_lname, cs.email_address cs_eaddr, cs.home_address cs_haddr
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			WHERE md5(od.id) = '$id'
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
			WHERE md5(od.id) = '$id'
		");
	}

	public function detail_ing($re_id){
		$query = $this->db->query("
			SELECT ri.ingredient_amount AS ri_amount, ig.name AS ri_ingredient, un.name AS ri_unit, ri.method AS ri_method
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
			SELECT bi.id bri_id, bi.supply AS bi_supply, bi.updated_date AS bi_date, ig.name AS bi_name, ig.id AS bi_id, un.name AS bi_unit, br.id AS branch_id
			FROM branch_ingredients bi
			INNER JOIN ingredients ig ON bi.ingredient_id = ig.id
			INNER JOIN unit un ON ig.unit_id = un.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE bm.user_id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function all_ingredients($id){
		$query = $this->db->query("
			SELECT ig.id ig_id, ig.name AS bi_name, un.name AS bi_unit
			FROM ingredients ig
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE ig.id NOT IN (SELECT bi.ingredient_id FROM branch_ingredients bi WHERE bi.branch_id = '$id')
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function update_supply($upt_date){
		$ings_id = $_POST['ingredients_id'];
		$ings_val = $_POST['ingredients_val'];
		$bri_id = $_POST['branch_ingr_id'];
		for ($i=0; $i < count($ings_id); $i++) {
			$query = $this->db->query("
				UPDATE branch_ingredients
				SET supply = supply + '$ings_val[$i]', updated_date = '$upt_date'
				WHERE id = '$bri_id[$i]' 
			");
		}
	}

	public function add_ingredient_supply($data){
		$this->db->insert('branch_ingredients', $data);
	}

	public function reduce_supply(){
		$amount = $this->input->post('amount');
		$current_amount = $this->input->post('current_amount');
		$id = $this->input->post('bri_id');
		$new_amount = $current_amount-$amount;
		
		$this->db->set('supply', $new_amount);
		$this->db->where('id', $id);

		$this->db->update('branch_ingredients');
	}

	public function add_report($data){
		$this->db->insert('branch_reports', $data);
	}

	public function edit_password($upt_date){
		$password = sha1($this->input->post('new_password'));
		$user_id = $this->input->post('user_id');
		$this->db->query("
			UPDATE user u
			SET u.password = '$password', u.updated_date = '$upt_date' 
			WHERE u.id = '$user_id'
		");
	}

	//REPORT FUNCTIONS

	public function new_recipe_report(){
		$query = $this->db->query("
			SELECT br_rep.id br_rep_id, br_rep.amount_reduced br_rep_ar, br_rep.reason br_rep_rsn, br_rep.created_date br_rep_cd, bm.name bm_name, ing.name ing_name, br.name br_name
			FROM branch_reports br_rep
			INNER JOIN branch_ingredients bi ON br_rep.branch_ingredients_id = bi.id
			INNER JOIN ingredients ing ON bi.ingredient_id = ing.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE br_rep.status = 0
			ORDER BY br_rep.created_date DESC
			LIMIT 10
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function check_critical_level($id,$bi_id,$supply){
		$query = $this->db->query("
			SELECT ing.name ing_name
			FROM branch_ingredients bi
			INNER JOIN ingredients ing ON bi.ingredient_id = ing.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE bm.user_id = '$id' AND ing.id = '$bi_id' AND ing.set_minimum >= '$supply'
			LIMIT 10
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return 0;
		}
	}

	//PRINTING FUNCTIONS

	public function additional_ingredients($id){
		$query = $this->db->query("
			SELECT ai.id ai_id, ig.name ig_name, ig.price ig_prc, un.name ig_unit, ai.ingredient_id ig_id, ai.ingredient_amount ig_amnt
			FROM add_ingredient ai
			INNER JOIN ingredients ig ON ai.ingredient_id = ig.id
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE md5(ai.order_id) = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function additional_ingredients_subtotal($id){
		$query = $this->db->query("
			SELECT SUM(ai.ingredient_amount*ig.price) AS additionaltotal
			FROM add_ingredient ai
			INNER JOIN ingredients ig ON ai.ingredient_id = ig.id
			WHERE md5(ai.order_id) = '$id'
		");
		return $query->result();
	}

	public function item_subtotal_price($id){
		$query = $this->db->query("
			SELECT SUM(oc.quantity*re.price) AS stotalprice
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			WHERE md5(od.id) = '$id'
		");
		return $query->result();
	}

}
