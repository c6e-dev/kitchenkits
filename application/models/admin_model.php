<?php
class admin_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	// DATA TABLE FUNCTIONS

	public function read_recipe(){
		$query = $this->db->query("
			SELECT md5(re.id) id, re.name nm, re.price prc, re.instructions ins, re.cooking_time ct, re.servings se, re.status st, rg.name rnm, rg.id rid, co.name cnm, co.id cid
			FROM recipe re
			INNER JOIN country co ON re.country_id = co.id
			INNER JOIN region rg ON co.region_id = rg.id
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recipe(){
		$query = $this->db->query("
			SELECT md5(id) AS id, status
			FROM recipe
			WHERE status = 'A' OR status = 'U'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recipe_ingredient($id){
		$query = $this->db->query("
			SELECT ri.ingredient_id ing_id, ri.ingredient_amount ing_amnt
			FROM recipe_ingredients ri
			INNER JOIN recipe re ON ri.recipe_id = re.id
			WHERE md5(ri.recipe_id) = '$id'
		");
		return $query->result();
	}

	public function read_customer(){
		$query = $this->db->query("
			SELECT md5(cs.id) AS cs_id, cs.code AS cs_code, cs.first_name AS cs_fname, cs.last_name AS cs_lname, cs.email_address AS cs_email, cs.home_address AS cs_address, u.created_date AS cs_create, u.updated_date AS cs_update, u.id AS cs_uid, u.status AS cs_status
			FROM customer cs
			INNER JOIN user u ON cs.user_id = u.id
			ORDER BY u.created_date DESC
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_branch(){
		$query = $this->db->query("
			SELECT md5(br.id) AS br_id, br.code AS br_code, br.manager_id br_mi, br.name AS br_name, br.branch_address AS br_address, br.status AS br_status, br.created_date AS br_create, br.updated_date AS br_update
			FROM branch br 
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_branch_manager(){
		$query = $this->db->query("
			SELECT bm.id AS bm_id, bm.name AS bm_name, bm.status AS bm_status
			FROM branch_manager bm 
			INNER JOIN user u ON bm.user_id = u.id
			WHERE bm.status = 'U' AND u.status = 'A'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_manager(){
		$query = $this->db->query("
			SELECT bm.id AS bm_id, bm.user_id bm_uid, bm.code AS bm_code, bm.name AS bm_name, bm.status AS bm_assign, u.created_date AS bm_create, u.updated_date AS bm_update, u.status AS bm_status
			FROM branch_manager bm
			INNER JOIN user u ON bm.user_id = u.id
			-- INNER JOIN branch br ON br.manager_id = bm.id
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_order(){
		$query = $this->db->query("
			SELECT md5(od.id) AS od_id, od.code AS od_code, od.status AS od_status, ua.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname, br.name AS od_branch
			FROM delivery od
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN branch br ON od.branch_id = br.id
			ORDER BY ua.created_date DESC
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_feedback(){
		$query = $this->db->query("
			SELECT ua.activity_type_id fb_type, ua.created_date fb_cdate, co.message fb_comment, ra.rating fb_rating, cs.first_name fb_fname, cs.last_name fb_lname, re.name fb_recipe
			FROM user_activity ua
			INNER JOIN recipe re ON ua.recipe_id = re.id		
			INNER JOIN customer cs ON ua.customer_id = cs.id
			LEFT JOIN comment co ON ua.id = co.activity_id
			LEFT JOIN rating ra ON ua.id = ra.activity_id
			ORDER BY ua.created_date DESC
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_ingredient(){
		$query = $this->db->query("
			SELECT ing.id ing_id, ing.name ing_nm, ing.unit_id ing_unit_id, un.name ing_un, ing.created_date ing_cd, ing.price ing_prc
			FROM ingredients ing
			INNER JOIN unit un ON ing.unit_id = un.id

		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_unit(){
		$query = $this->db->query("
			SELECT *
			FROM unit
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// VIEW FUNCTIONS - Robert / 12-02-18

	//RECIPE FUNCTIONS

	public function view_recipe($id){
		$query = $this->db->query("
			SELECT re.id re_id, re.name re_nm, re.price re_prc, re.instructions re_ins, re.cooking_time re_ct, re.servings re_se, re.image re_im, re.status re_st, re.created_date re_cd, re.updated_date re_ud, rg.name rg_nm, rg.id rid, co.name co_nm, co.id cid, ing.name in_nm, ring.ingredient_amount in_am
			FROM recipe_ingredients ring
			INNER JOIN ingredients ing ON ring.ingredient_id = ing.id
			RIGHT JOIN recipe re ON ring.recipe_id = re.id
			INNER JOIN country co ON re.country_id = co.id
			INNER JOIN region rg ON co.region_id = rg.id
			WHERE md5(re.id) = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}
	}

	public function add_recipe_ingredients($data){
		$this->db->insert('recipe_ingredients', $data);
	}

	public function edit_recipe_ingredients($upt_date){
		$ings_id = $_POST['ingrs_id'];
		$ings_val = $_POST['ingrs_val'];
		$ings_met = $_POST['ingrs_meth'];
		$re_id = $_POST['recipee_id'];
		for ($i=0; $i < count($ings_id); $i++) {
			$query = $this->db->query("
				UPDATE recipe_ingredients ri, recipe re
				SET ri.ingredient_amount = '$ings_val[$i]', ri.method = '$ings_met[$i]', re.updated_date = '$upt_date'
				WHERE ri.ingredient_id = '$ings_id[$i]' AND ri.recipe_id = '$re_id' AND re.id = '$re_id'
			");
		}
	}

	public function read_ingr($id){
		$query = $this->db->query("
			SELECT ig.id ig_id, ig.name ig_name, un.name ig_unit
			FROM ingredients ig
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE ig.id NOT IN (SELECT ri.ingredient_id FROM recipe_ingredients ri WHERE md5(ri.recipe_id) = '$id')
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_ingredients($id){
		$query = $this->db->query("
			SELECT md5(ri.id) in_id, ri.ingredient_amount in_am, ri.method in_meth, ig.id ig_id, ig.name in_nm, ut.name in_ut
			FROM recipe_ingredients ri
			INNER JOIN ingredients ig ON ri.ingredient_id = ig.id
			INNER JOIN unit ut ON ig.unit_id = ut.id 
			WHERE md5(ri.recipe_id) = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}
	}

	//CUSTOMER FUNCTIONS 

	public function view_customer($id){ 
		$query = $this->db->query("
			SELECT cs.id AS cs_id, cs.code AS cs_code, cs.first_name AS cs_fname, cs.last_name AS cs_lname, cs.email_address AS cs_email, cs.home_address AS cs_address, u.created_date AS cs_create, u.updated_date AS cs_update
			FROM customer cs 
			INNER JOIN user u ON cs.user_id = u.id 
			WHERE md5(cs.id) = '$id' 
		");
		return $query->result();
	}

	public function view_customer_order($id){
		$query = $this->db->query("
			SELECT od.code AS od_code, od.status AS od_status, ua.created_date AS od_create, br.name AS od_branch
			FROM delivery od
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN branch br ON od.branch_id = br.id
			WHERE md5(ua.customer_id) = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function view_customer_activity($id){
		$query = $this->db->query("
			SELECT ua.activity_type_id fb_type, ua.created_date fb_cdate, co.message fb_comment, ra.rating fb_rating, cs.first_name fb_fname, cs.last_name fb_lname, re.name fb_recipe
			FROM user_activity ua
			INNER JOIN recipe re ON ua.recipe_id = re.id		
			INNER JOIN customer cs ON ua.customer_id = cs.id
			LEFT JOIN comment co ON ua.id = co.activity_id
			LEFT JOIN rating ra ON ua.id = ra.activity_id
			WHERE md5(ua.customer_id) = '$id'
			ORDER BY ua.created_date DESC
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// BRANCH FUNCTIONS

	public function view_branch($id){
		$query = $this->db->query("
			SELECT br.id br_id, br.code AS br_code, br.name AS br_name, br.branch_address AS br_address, br.manager_id mngr_id, bm.name AS br_manager, bm.status bm_status, br.created_date AS br_create, br.updated_date AS br_update
			FROM branch br
			LEFT JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE md5(br.id) = '$id'
		");
		return $query->result();
	}

	public function view_branch_order($id){
		$query = $this->db->query("
			SELECT od.code AS od_code, od.status AS od_status, ua.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname
			FROM delivery od
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			WHERE md5(od.branch_id) = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// MANAGER FUNCTION

	public function view_manager($id){
		$query = $this->db->query("
			SELECT bm.id AS bm_id, bm.code AS bm_code, bm.name AS bm_name, bm.status bm_status, br.id br_id, br.name br_name, u.created_date AS bm_create, u.updated_date bm_update, bm.user_id user_id
			FROM branch br
			RIGHT JOIN branch_manager bm ON br.manager_id = bm.id 
			INNER JOIN user u ON bm.user_id = u.id
			WHERE bm.id = '$id'
		");
		return $query->result();
	}

	// ORDER FUNCTIONS

	public function view_order($id){
		$query = $this->db->query("
			SELECT od.code AS od_code, ua.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname, br.name AS od_branch
			FROM delivery od
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN branch br ON od.branch_id = br.id
			WHERE md5(od.id) = '$id'
		");
		return $query->result();
	}

	public function view_order_content($id){
		$query = $this ->db->query("
			SELECT re.name AS oc_recipe
			FROM order_content oc 
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			WHERE md5(oc.order_id) = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function view_additional_order_content($id){
		$query = $this ->db->query("
			SELECT ig.name ig_name, un.name ig_unit, ai.ingredient_amount amount
			FROM add_ingredient ai
			INNER JOIN delivery od ON ai.order_id = od.id
			INNER JOIN ingredients ig ON ai.ingredient_id = ig.id
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE md5(ai.order_id) = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// FEEDBACK FUNCTION

	public function view_comment($id){
		$query = $this->db->query("
			SELECT ua.created_date AS co_create, co.message AS ua_comment, cs.name AS ua_customer, re.name AS ua_recipe
			FROM user_activity ua
			INNER JOIN comment co ON 
			INNER JOIN customer cs ON ua.customer_id = cs.id
			INNER JOIN recipe re ON ua.recipe_id = re.id
			WHERE ua.id ='$id'
		");
		return $query->result();
	}

	// REPORT FUNCTION

	public function report(){
		$curryear = date('Y');
		$query = $this->db->query("
			SELECT SUM(tr.total_cost) AS salescost, YEAR(ua.created_date) AS currentyear
			FROM transaction tr
			INNER JOIN delivery od ON tr.order_id = od.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE YEAR(ua.created_date) = '$curryear'
			GROUP BY substring(ua.created_date,1,7)
			ORDER BY ua.created_date DESC
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function most_ordered_recipe(){
		$currmonth = date('Y-m');
		$query = $this->db->query("
			SELECT SUM(oc.quantity) AS recipe_total_sales, MONTHNAME(ua.created_date) AS month, re.id re_id, re.name re_name
			FROM order_content oc
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE substring(ua.created_date,1,7) = '$currmonth' AND od.status = 'C'
			GROUP BY oc.recipe_id
			ORDER BY SUM(oc.quantity) DESC
			LIMIT 10
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function best_branch(){
		$currmonth = date('Y-m');
		$query = $this->db->query("
			SELECT COUNT(od.customer_id) AS total_customers, MONTHNAME(ua.created_date) AS month, br.name br_name
			FROM delivery od
			INNER JOIN branch br ON od.branch_id = br.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE substring(ua.created_date,1,7) = '$currmonth' AND od.status = 'C'
			GROUP BY od.branch_id
			ORDER BY COUNT(od.customer_id) DESC
			LIMIT 10
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function supply_report(){
		$query = $this->db->query("
			SELECT br_rep.id br_rep_id, br_rep.amount_change br_rep_ar, br_rep.reason br_rep_rsn, br_rep.created_date br_rep_cd, bm.name bm_name, ing.name ing_name, br.name br_name, br_rep.type br_rep_tp
			FROM branch_reports br_rep
			INNER JOIN branch_ingredients bi ON br_rep.branch_ingredients_id = bi.id
			INNER JOIN ingredients ing ON bi.ingredient_id = ing.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE br_rep.status = 1
			GROUP BY substring(br_rep.created_date,1,18)
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

	public function branch_report(){
		$query = $this->db->query("
			SELECT br_rep.id br_rep_id, br_rep.amount_change br_rep_ar, br_rep.reason br_rep_rsn, br_rep.created_date br_rep_cd, bm.name bm_name, ing.name ing_name, br.name br_name, un.name un_name, br_rep.type br_rep_tp
			FROM branch_reports br_rep
			INNER JOIN branch_ingredients bi ON br_rep.branch_ingredients_id = bi.id
			INNER JOIN ingredients ing ON bi.ingredient_id = ing.id
			INNER JOIN unit un ON ing.unit_id = un.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			GROUP BY substring(br_rep.created_date,1,18)
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function report_viewed($id){
		$this->db->set('status', 0);
		$this->db->where('id', $id);
		$this->db->update('branch_reports');
	}

	public function view_branch_report($id){
		$query = $this->db->query("
			SELECT br_rep.id br_rep_id, br_rep.amount_change br_rep_ar, br_rep.reason br_rep_rsn, br_rep.created_date br_rep_cd, bm.name bm_name, ing.name ing_name, br.name br_name, br.branch_address br_addr, un.name un_name
			FROM branch_reports br_rep
			INNER JOIN branch_ingredients bi ON br_rep.branch_ingredients_id = bi.id
			INNER JOIN ingredients ing ON bi.ingredient_id = ing.id
			INNER JOIN unit un ON ing.unit_id = un.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE br_rep.id = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function view_branch_report1($id){
		$query = $this->db->query("
			SELECT br_rep.id br_rep_id, br_rep.amount_change br_rep_ar, br_rep.reason br_rep_rsn, br_rep.created_date br_rep_cd, bm.name bm_name, ing.name ing_name, br.name br_name, br.branch_address br_addr, un.name un_name
			FROM branch_reports br_rep
			INNER JOIN branch_ingredients bi ON br_rep.branch_ingredients_id = bi.id
			INNER JOIN ingredients ing ON bi.ingredient_id = ing.id
			INNER JOIN unit un ON ing.unit_id = un.id
			INNER JOIN branch br ON bi.branch_id = br.id
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE substring(br_rep.created_date,1,18) = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// DISABLE FUNCTION

	public function disable_recipe($id){
		$this->db->query("
			UPDATE recipe rcp
			SET rcp.status = 'U' 
			WHERE md5(rcp.id) = '$id'
		");
	}

	// DELETE FUNCTIONS

	public function delete_recipe($id){
		$this->db->query("
			UPDATE recipe rcp
			SET rcp.status = 'I' 
			WHERE md5(rcp.id) = '$id'
		");
	}

	public function delete_customer($id){
		$this->db->query("
			UPDATE user u 
			SET u.status = 'I'
			WHERE u.id = '$id'
		");
	}

	public function delete_branch($br_id,$br_mi){
		$this->db->query("
			UPDATE branch br, branch_manager bm
			SET br.status = 'I', bm.status = 'U', br.manager_id = 0
			WHERE br.id ='$br_id' AND bm.id = '$br_mi'
		");
	}

	public function delete_manager($bm_id,$bm_uid){
		$this->db->query("
			UPDATE user u, branch_manager bm, branch br
			SET u.status = 'I', bm.status = 'U', br.status = 'I', br.manager_id = 0
			WHERE u.id = '$bm_uid' AND bm.id = '$bm_id' AND br.manager_id = '$bm_id'
		");
	}

	public function delete_umanager($bm_uid){
		$this->db->query("
			UPDATE user u
			SET u.status = 'I'
			WHERE u.id = '$bm_uid'
		");
	}

	public function delete_ingredient($id){
		$this->db->query("
			DELETE FROM ingredients			
			WHERE ingredients.id = '$id'
		");
	}

	public function delete_recipe_ingredient($id){
		$this->db->query("
			DELETE FROM recipe_ingredients			
			WHERE md5(id) = '$id'
		");
		return TRUE;
	}

	// ACTIVATE FUNCTIONS - Robert / 12-02-18

	public function activate_recipe($id){
		$this->db->query("
			UPDATE recipe re 
			SET re.status = 'A'
			WHERE md5(re.id) = '$id'
		");
	}	

	public function activate_customer($id){
		$this->db->query("
			UPDATE user u 
			SET u.status = 'A'
			WHERE u.id = '$id'
		");
	}

	public function activate_branch($id){
		$this->db->query("
			UPDATE branch br
			SET br.status = 'A'
			WHERE md5(br.id) ='$id'
		");
	}

	public function activate_manager($id){
		$this->db->query("
			UPDATE user u 
			SET u.status = 'A'
			WHERE u.id = '$id'
		");
	}

	// ADD FUNCTIONS

	public function create_recipe(){
		$data = array(
			'name' => $this->input->post('name'),
			'cooking_time' => $this->input->post('cooktime'),
			'servings' => $this->input->post('servings'),
			'price' => round($this->input->post('price'), 2),
			'country_id' => $this->input->post('country'),
			'status' => "I"
		);
		$this->db->insert('recipe', $data);
	}

	public function add_branch($branchdata){
		$this->db->insert('branch', $branchdata);
	}

	public function add_user_manager($mngrdata){
		$this->db->insert('user', $mngrdata);
	}

	public function add_manager($managerdata){
		$this->db->insert('branch_manager', $managerdata);
	}

	public function add_unit($unit){
		$this->db->insert('unit', $unit);
	}
	
	public function add_ingredient($data){
		$this->db->insert('ingredients', $data);
	}

	// EDIT FUNCTIONS
	
	public function update_recipe($upt_date){
		$name = $this->input->post('name');
		$cooking_time = $this->input->post('cooktime');
		$servings = $this->input->post('servings');
		$price = round($this->input->post('price'), 2);
		$country = $this->input->post('country');
		$instruc = $this->input->post('instruc');
		$id = $this->input->post('recipe_id');

		$this->db->set('name', $name);
		$this->db->set('cooking_time', $cooking_time);
		$this->db->set('servings', $servings);
		$this->db->set('price', $price);
		$this->db->set('country_id', $country);
		$this->db->set('instructions', $instruc);
		$this->db->set('updated_date', $upt_date);
		$this->db->where('id', $id);

		$result = $this->db->update('recipe');
		return $result;
	}

	public function edit_branch($upt_date){
		$branch_id = $this->input->post('branch_id');
		$branch_name = $this->input->post('brname');
		$branch_address = $this->input->post('braddress');
		$branch_manager = $this->input->post('brmanager_id');
		$this->db->query("
			UPDATE branch br, branch_manager bm
			SET br.name = '$branch_name', br.branch_address = '$branch_address', br.manager_id = '$branch_manager', br.updated_date = '$upt_date', bm.status = 'A'
			WHERE br.id = '$branch_id' AND bm.id = '$branch_manager'
		");
	}

	public function edit_branchnm($upt_date){
		$branch_id = $this->input->post('branch_id');
		$branch_name = $this->input->post('brname');
		$branch_address = $this->input->post('braddress');
		$this->db->query("
			UPDATE branch br
			SET br.name = '$branch_name', br.branch_address = '$branch_address', br.manager_id = 0, br.updated_date = '$upt_date'
			WHERE br.id = '$branch_id'
		");
	}

	public function edit_branch1($upt_date){ //mngr to none 
		$branch_id = $this->input->post('branch_id');
		$branch_name = $this->input->post('brname');
		$branch_address = $this->input->post('braddress');
		$this->db->query("
			UPDATE branch br
			SET br.name = '$branch_name', br.branch_address = '$branch_address', br.manager_id = 0, br.updated_date = '$upt_date', br.status = 'I'
			WHERE br.id = '$branch_id'
		");
	}

	public function edit_branch_newmngr($mngr_id){ //mngr to new mngr
		$this->db->query("
			UPDATE branch_manager bm
			SET bm.status = 'U'
			WHERE bm.id = '$mngr_id'
		");
	}

	public function edit_manager($upt_date){
		$name = $this->input->post('mngr_nm');
		$id = $this->input->post('manager_id');
		$br_id = $this->input->post('br_id');
		$u_id = $this->input->post('user_id');
		$this->db->query("
			UPDATE branch_manager bm, branch br, user u
			SET bm.name = '$name', bm.status = 'A', u.updated_date = '$upt_date', br.manager_id = '$id', br.status = 'A'
			WHERE bm.id = '$id' AND br.id = '$br_id' AND u.id = '$u_id'
		");
	}

	public function edit_managernm($upt_date){
		$name = $this->input->post('mngr_nm');
		$id = $this->input->post('manager_id');
		$u_id = $this->input->post('user_id');
		$this->db->query("
			UPDATE branch_manager bm, user u
			SET bm.name = '$name', u.updated_date = '$upt_date'
			WHERE bm.id = '$id' AND u.id = '$u_id'
		");
	}

	public function edit_manager1($upt_date){
		$name = $this->input->post('mngr_nm');
		$id = $this->input->post('manager_id');
		$br_id = $this->input->post('br_id');
		$u_id = $this->input->post('user_id');
		$this->db->query("
			UPDATE branch_manager bm, user u
			SET bm.name = '$name', bm.status = 'U', u.updated_date = '$upt_date'
			WHERE bm.id = '$id'AND u.id = '$u_id'
		");
	}

	public function edit_manager_newbr($cubr_id){
		$this->db->query("
			UPDATE branch br
			SET br.status = 'I', br.manager_id = 0
			WHERE br.id = '$cubr_id'
		");
	}

	public function update_manager($id,$br_id){
		$this->db->query("
			UPDATE branch br, branch_manager bm
			SET br.manager_id = '$id', br.status = 'A', bm.status = 'A'
			WHERE br.id = '$br_id' AND bm.id = '$id'
		");
	}

	public function upload_recipe_image($re_id,$image,$upt_date){
		$this->db->set('image', $image);
		$this->db->set('updated_date', $upt_date);
		$this->db->where('id', $re_id);
		$this->db->update('recipe');
	}

	// DASHBOARD FUNCTIONS

	public function read_activity_feed(){
		$query = $this->db->query("
			SELECT ua.activity_type_id fb_type, ua.created_date fb_cdate, co.message fb_comment, ra.rating fb_rating, cs.first_name fb_fname, cs.last_name fb_lname, re.name fb_recipe
			FROM user_activity ua
			LEFT JOIN recipe re ON ua.recipe_id = re.id		
			INNER JOIN customer cs ON ua.customer_id = cs.id
			LEFT JOIN comment co ON ua.id = co.activity_id
			LEFT JOIN rating ra ON ua.id = ra.activity_id
			ORDER BY ua.created_date DESC
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function branch_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS br
			FROM branch");
		return $query->result();
	}

	public function branch_count_a(){
		$query = $this->db->query("
			SELECT COUNT(id) AS br_a
			FROM branch
			WHERE status = 'A'
			");
		return $query->result();
	}

	public function branch_count_i(){
		$query = $this->db->query("
			SELECT COUNT(id) AS br_i
			FROM branch
			WHERE status = 'I'
			");
		return $query->result();
	}

	public function manager_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS bm
			FROM branch_manager
			");
		return $query->result();
	}

	public function manager_count_a(){
		$query = $this->db->query("
			SELECT COUNT(id) AS bm_a
			FROM branch_manager
			WHERE status = 'A'
			");
		return $query->result();
	}

	public function manager_count_u(){
		$query = $this->db->query("
			SELECT COUNT(id) AS bm_u
			FROM branch_manager
			WHERE status = 'U'
			");
		return $query->result();
	}

	public function customer_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS cs
			FROM user
			WHERE user_type_id = 3
			");
		return $query->result();
	}

	public function customer_count_a(){
		$query = $this->db->query("
			SELECT COUNT(id) AS cs_a
			FROM user
			WHERE user_type_id = 3 AND status = 'A'
			");
		return $query->result();
	}

	public function customer_count_i(){
		$query = $this->db->query("
			SELECT COUNT(id) AS cs_i
			FROM user
			WHERE user_type_id = 3 AND status = 'I'
			");
		return $query->result();
	}

	public function logged_in_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS li
			FROM user
			WHERE user_type_id = 3 AND logged_in = 1
			");
		return $query->result();
	}

	public function recipe_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS rc
			FROM recipe
			");
		return $query->result();
	}

	public function recipe_count_a(){
		$query = $this->db->query("
			SELECT COUNT(id) AS rc_a
			FROM recipe
			WHERE status = 'A'
			");
		return $query->result();
	}

	public function recipe_count_i(){
		$query = $this->db->query("
			SELECT COUNT(id) AS rc_i
			FROM recipe
			WHERE status = 'I'
			");	
		return $query->result();
	}

	public function order_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS od
			FROM delivery 
			");
		return $query->result();
	}

	public function order_count_c(){
		$query = $this->db->query("
			SELECT COUNT(id) AS od_c
			FROM delivery 
			WHERE status = 'C'
			");
		return $query->result();
	}

	public function order_count_i(){
		$query = $this->db->query("
			SELECT COUNT(id) AS od_i
			FROM delivery
			WHERE status = 'I'
			");
		return $query->result();
	}

	public function comment_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS co
			FROM user_activity
			WHERE activity_type_id = '4'
		");
		return $query->result();
	}

	public function rating_count(){
		$query = $this->db->query("
			SELECT COUNT(id) AS ra
			FROM user_activity
			WHERE activity_type_id = '3'
		");
		return $query->result();
	}

	public function loggedin_count(){
		$query = $this->db->query("SELECT COUNT(id) AS li
			FROM user
			WHERE logged_in = '1'
		");
		return $query->result();
	}

	// Checker

	public function recipe_check($id){
		$query = $this->db->query("
			SELECT re.name re_nm
			FROM recipe re
			WHERE re.id = '$id'
		");
		return $query->result();
	}

	public function branch_check($id){
		$query = $this->db->query("
			SELECT br.name br_nm
			FROM branch br
			WHERE br.id = '$id'
		");
		return $query->result();
	}

	public function manager_check($id){
		$query = $this->db->query("
			SELECT brm.name bm_nm
			FROM branch_manager brm
			WHERE brm.id = '$id'
		");
		return $query->result();
	}

	public function check_branch_ingredients($br_id,$ing_id,$amnt){
		$query = $this->db->query("
			SELECT *
			FROM branch_ingredients bi
			WHERE bi.ingredient_id = '$ing_id' AND md5(bi.branch_id) = '$br_id' AND bi.supply >= '$amnt'
		");
		if ($query->num_rows() > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	// OTHER FUNCTIONS

	public function get_code($id){
		$query = $this->db->query("
			SELECT code ct_code, count ct_count
			FROM counter
			WHERE id = '$id'
		");
		return $query->result();
	}

	public function update_counter($val,$id){
		$this->db->query("
			UPDATE counter
			SET count = '$val' 
			WHERE id = '$id'
		");
	}

	public function read_i_branch(){
		$query = $this->db->query("
			SELECT br.id br_id, br.manager_id br_mi, br.name br_name
			FROM branch br
			WHERE br.status = 'I'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}
	}

	public function country(){
		$query = $this->db->query("
			SELECT co.name cnm, co.id cid
			FROM country co
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}
	public function country2($cid){
		$query = $this->db->query("
			SELECT co.name cnm, co.id cid
			FROM country co
			WHERE co.id <> $cid
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
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

	public function recipe_order($id){
		$query = $this->db->query("
			SELECT id, recipe_id, quantity
			FROM order_content oc
			WHERE order_id = '$id'
		");
		return $query->result();
	}

	public function recipe_order_ingredients($id,$qty){
		$query = $this->db->query("
			SELECT ingredient_id, ingredient_amount*$qty AS amount 
			FROM recipe_ingredients ri
			WHERE recipe_id = '$id'
		");
		return $query->result();
	}

	public function branch_info(){
		$query = $this->db->query("
			SELECT br.id, br.branch_address br_addr
			FROM branch br
			WHERE br.status = 'A'
		");
		return $query->result();
	}

	public function loggedin_customer($id){
		$query = $this->db->query("
			SELECT cu.id, cu.home_address addr
			FROM customer cu
			INNER JOIN user us ON cu.user_id = us.id
			WHERE cu.user_id = '$id'
		");
		return $query->result();
	}

	public function check_compatible_branch($br_id,$ing_id,$amnt){
		$query = $this->db->query("
			SELECT *
			FROM branch_ingredients bi
			WHERE bi.ingredient_id = '$ing_id' AND bi.branch_id = '$br_id' AND bi.supply >= '$amnt'
		");
		if ($query->num_rows() > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function reduce_supply($br_id,$ing_id,$amnt){
		$this->db->query("
			UPDATE branch_ingredients
			SET supply = supply - $amnt
			WHERE ingredient_id = '$ing_id' AND branch_id = '$br_id'
		");
	}

	public function new_order_transaction($transacdata){
		$this->db->insert('transaction', $transacdata);
	}
	
	public function new_order_activity($data){
		$this->db->insert('user_activity', $data);
	}

	public function confirm_order($id,$br_id,$act_id,$code){
		$this->db->set('branch_id', $br_id);
		$this->db->set('activity_id', $act_id);
		$this->db->set('code', $code);
		$this->db->set('status', 'I');
		$this->db->where('id', $id);

		$result = $this->db->update('delivery');
		return $result;
	}
}

