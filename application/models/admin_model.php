<?php
class admin_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function read_recipe(){
		$query = $this->db->query("
			SELECT re.id id, re.name nm, re.price prc, re.instructions ins, re.cooking_time ct, re.servings se, re.status st, rg.name rnm, rg.id rid, co.name cnm, co.id cid
			FROM recipe re
			INNER JOIN country co ON re.country_id = co.id
			INNER JOIN region rg ON co.region_id = rg.id
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
		}else{
			return NULL;
		}
	}
	public function delete_recipe($id){
		$this->db->query("
			UPDATE recipe rcp
			SET rcp.status = 'I' 
			WHERE rcp.id = '$id'
		");
	}
	public function create_recipe(){
		$data = array(
			'name' => $this->input->post('name'),
			'cooking_time' => $this->input->post('cooktime'),
			'servings' => $this->input->post('servings'),
			'price' => $this->input->post('price'),
			'country_id' => $this->input->post('country'),
			'status' => "I"
		);
		$this->db->insert('recipe', $data);
	}
	public function update_recipe($id){
		$cooking_time = $this->input->post('cooktime');
		$servings = $this->input->post('servings');
		$price = $this->input->post('price');
		// $id = $this->input->post('recipe_id');

		$this->db->set('cooking_time', $cooking_time);
		$this->db->set('servings', $servings);
		$this->db->set('price', $price);
		$this->db->where('id', $id);

		$result = $this->db->update('recipe');
		return $result;
	}
	public function view_recipe($id){
		$query = $this->db->query("
			SELECT re.id id, re.name nm, re.price prc, re.recipe_ingredients_id , re.instructions ins, re.cooking_time ct, re.servings se, re.status st, rg.name rnm, rg.id rid, co.name cnm, co.id cid
			FROM recipe re
			INNER JOIN recipe_ingredients ring ON re.recipe_ingredients_id = ring.id
			INNER JOIN country co ON re.country_id = co.id
			INNER JOIN region rg ON co.region_id = rg.id
			WHERE re.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}
	}

	// DATA TABLE FUNCTIONS - Robert / 12-01-18

	public function read_customer(){
		$query = $this->db->query("
			SELECT cs.id AS cs_id, cs.code AS cs_code, cs.first_name AS cs_fname, cs.last_name AS cs_lname, cs.email_address AS cs_email, cs.home_address AS cs_address, u.created_date AS cs_create, u.updated_date AS cs_update, u.id AS cs_uid, u.status AS cs_status
			FROM customer cs
			INNER JOIN user u ON cs.user_id = u.id
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
			SELECT br.id AS br_id, br.code AS br_code, br.name AS br_name, br.branch_address AS br_address, br.status AS br_status, br.created_date AS br_create, br.updated_date AS br_update
			FROM branch br 
			-- INNER JOIN branch_manager bm ON br.manager_id = bm.id REMOVE IF MANAGER WON'T BE DISPLAYED ON THE DATA TABLE; 'bm.code' & 'bm.name' TOO
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
			SELECT bm.id AS bm_id, bm.code AS bm_code, bm.name AS bm_name, bm.status AS bm_assign, u.created_date AS bm_create, u.updated_date AS bm_update, u.status AS bm_status
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

	public function read_order(){ // CHANGE THIS IF NEEDED
		$query = $this->db->query("
			SELECT od.id AS od_id, od.code AS od_code, od.status AS od_status, od.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname, br.name AS od_branch
			FROM delivery od
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN branch br ON od.branch_id = br.id
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
			SELECT fb.id AS fb_id, fb.message AS fb_message, fb.rating AS fb_rating, fb.created_date AS fb_create, cs.first_name AS fb_fname, cs.last_name AS fb_lname, re.name AS fb_recipe
			FROM feedback fb 
			INNER JOIN customer cs ON fb.customer_id = cs.id
			INNER JOIN recipe re ON fb.recipe_id = re.id
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// VIEW FUNCTIONS - Robert / 12-02-18

	//CUSTOMER FUNCTIONS 

	public function view_customer($id){ 
		$query = $this->db->query("
			SELECT cs.id AS cs_id, cs.code AS cs_code, cs.first_name AS cs_fname, cs.last_name AS cs_lname, cs.email_address AS cs_email, cs.home_address AS cs_address, u.created_date AS cs_create, u.updated_date AS cs_update
			FROM customer cs 
			INNER JOIN user u ON cs.user_id = u.id 
			WHERE cs.id = '$id' 
		");
		return $query->result();
	}

	public function view_customer_order($id){ // ADD BRANCH IF NEEDED
		$query = $this->db->query("
			SELECT od.code AS od_code, od.status AS od_status, od.created_date AS od_create, re.name AS od_recipe, br.name AS od_branch
			FROM delivery od
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN order_content oc ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN branch br ON od.branch_id = br.id
			WHERE od.customer_id = '$id'
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
			SELECT re.name AS ua_recipe, at.name AS ua_type
			FROM user_activity ua
			INNER JOIN customer cs ON ua.customer_id = cs.id
			INNER JOIN recipe re ON ua.recipe_id = re.id
			INNER JOIN activity_type at ON ua.activity_type_id = at.id
			WHERE ua.customer_id = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function view_customer_feedback($id){
		$query = $this->db->query("
			SELECT fb.message AS fb_message, fb.rating AS fb_rating, re.name AS fb_recipe 
			FROM feedback fb 
			INNER JOIN customer cs ON fb.customer_id = cs.id
			INNER JOIN recipe re ON fb.recipe_id = re.id
			WHERE fb.customer_id = '$id'
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
			SELECT br.code AS br_code, br.name AS br_name, br.branch_address AS br_address, bm.name AS br_manager, br.created_date AS br_create, br.updated_date AS br_update
			FROM branch br
			INNER JOIN branch_manager bm ON br.manager_id = bm.id
			WHERE br.id = '$id'
		");
		return $query->result();
	}

	public function view_branch_order($id){
		$query = $this->db->query("
			SELECT od.code AS od_code, od.status AS od_status, od.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname, re.name AS od_recipe
			FROM delivery od
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN order_content oc ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			WHERE od.branch_id = '$id'
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
			SELECT bm.id AS bm_id, bm.code AS bm_code, bm.name AS bm_name, u.created_date AS bm_create, u.updated_date bm_update
			FROM branch_manager bm
			-- INNER JOIN user u ON bm.user_id = u.id
			INNER JOIN user u ON bm.user_id = u.id 
			WHERE bm.id = '$id'
		");
		return $query->result();
	}

	// BRANCH FUNCTIONS

	public function view_order($id){
		$query = $this->db->query("
			SELECT od.code AS od_code, od.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname, br.name AS od_branch
			FROM delivery od
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN branch br ON od.branch_id = br.id
			WHERE od.id = '$id'
		");
		return $query->result();
	}

	public function view_order_content($id){ //CHANGE THIS FUNCTION TO ACCOMODATE ADDITIONAL INGREDIENTS
		$query = $this ->db->query("
			SELECT re.name AS oc_recipe
			FROM order_content oc 
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			WHERE oc.order_id = '$id'
		");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	// FEEDBACK FUNCTION

	public function view_feedback($id){
		$query = $this->db->query("
			SELECT fb.message AS fb_massage, fb.rating AS fb_rating, fb.created_date AS fb_create, cs.first_name AS fb_fname, cs.last_name AS cs_lname, re.name AS fb_recipe
			FROM feedback fb
			INNER JOIN customer cs ON fb.customer_id = cs.id
			INNER JOIN recipe re ON fb.recipe_id = re.id
			WHERE fb.id ='$id'
		");
		return $query->result();
	}

	// DELETE FUNCTIONS - Robert / 12-02-18

	// public function delete_recipe($id){
	// 	$this->db->query("
	// 		UPDATE recipe re
	// 		SET re.status = 'I' 
	// 		WHERE re.id = '$id'
	// 	");
	// }

	public function delete_customer($id){
		$this->db->query("
			UPDATE user u 
			SET u.status = 'I'
			WHERE u.id = '$id'
		");
	}

	public function delete_branch($id){
		$this->db->query("
			UPDATE branch br
			SET br.status = 'I'
			WHERE br.id ='$id'
		");
	}

	public function delete_manager($id){
		$this->db->query("
			UPDATE user u
			SET u.status = 'I'
			WHERE u.id = '$id'
		");
	}

	// ACTIVATE FUNCTIONS - Robert / 12-02-18

	public function activate_recipe($id){
		$this->db->query("
			UPDATE recipe re 
			SET re.status = 'A'
			WHERE re.id = '$id'
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
			WHERE br.id ='$id'
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

	public function add_branch(){ // INCLUDE BRANCH CODE
		$data = array(
			'name' => $this->input->post('name'),
			'branch_address' => $this->input->post('braddress'),
			'manager_id' => $this->input->post('brmanager'),
			'status' => "I"
		);
		$this->db->insert('branch', $data);
	}

	public function add_manager(){ // NEEDS A LOT OF WORK, FIND A WAY TO INCLUDE BRANCH_ID, BM_STATUS, USER/BM CODE
		$data = array(
			'name' => $this->input->post('name'),
			'user_type_id' => '2',
			'password' => $this->input->post('pass'),
			'status' => "I"
		);
		$this->db->insert('user', $data);
	}

	// EDIT FUNCTIONS

	public function edit_branch($id){
		$name = $this->input->post('name');
		$branch_address = $this->input->post('address');
		$id = $this->input->post('branch_id');

		$this->db->set('name', $name);
		$this->db->set('address', $address);
		$this->db->where('id', $id);

		$result = $this->db->update('branch');
		return $result;
	}

	public function edit_manager($id){
		$name = $this->input->post('name');
		$id = $this->input->post('manager_id');

		$this->db->set('name', $name);
		$this->db->where('id', $id);

		$result = $this->db->update('branch_manager');
		return $result;
	}	

	// DASHBOARD FUNCTIONS - Robert / 12-02-18 - THIS MODULE IS SUBJECT TO FURTHER IMPROVEMENTS

	// public function branch_count(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS br
	// 		FROM branch");
	// 	return $query->result();
	// }

	// public function branch_count_a(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS br_a
	// 		FROM branch
	// 		WHERE status = 'A'
	// 		");
	// 	return $query->result();
	// }

	// public function branch_count_i(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS br_i
	// 		FROM branch
	// 		WHERE status = 'I'
	// 		");
	// 	return $query->result();
	// }

	// public function manager_count(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS bm
	// 		FROM user
	// 		WHERE user_type_id = 2
	// 		");
	// 	return $query->result();
	// }

	// public function manager_count_a(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS bm_a
	// 		FROM user
	// 		WHERE user_type_id = 2 AND status = 'A'
	// 		");
	// 	return $query->result();
	// }

	// public function manager_count_i(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS bm_u
	// 		FROM user
	// 		WHERE user_type_id = 2 AND status = 'U'
	// 		");
	// 	return $query->result();
	// }

	public function customer_count(){
		$query = $this->db->query("SELECT COUNT(id) AS cs
			FROM user
			WHERE user_type_id = 3
			");
		return $query->result();
	}

	public function customer_count_a(){
		$query = $this->db->query("SELECT COUNT(id) AS cs_a
			FROM user
			WHERE user_type_id = 3 AND status = 'A'
			");
		return $query->result();
	}

	public function customer_count_i(){
		$query = $this->db->query("SELECT COUNT(id) AS cs_i
			FROM user
			WHERE user_type_id = 3 AND status = 'I'
			");
		return $query->result();
	}

	public function logged_in_count(){
		$query = $this->db->query("SELECT COUNT(id) AS li
			FROM user
			WHERE user_type_id = 3 AND logged_in = 1
			");
		return $query->result();
	}

	// public function recipe_count(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS rc
	// 		FROM recipe
	// 		");
	// 	return $query->result();
	// }

	// public function recipe_count_a(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS rc_a
	// 		FROM recipe
	// 		WHERE status = 'A'
	// 		");
	// 	return $query->result();
	// }

	// public function recipe_count_i(){
	// 	$query = $this->db->query("SELECT COUNT(id) AS rc_i
	// 		FROM recipe
	// 		WHERE status = 'I'
	// 		");
	// 	return $query->result();
	// }

	public function order_count(){
		$query = $this->db->query("SELECT COUNT(id) AS od
			FROM order 
			");
		return $query->result();
	}

	public function order_count_c(){
		$query = $this->db->query("SELECT COUNT(id) AS od_c
			FROM order 
			WHERE status = 'C'
			");
		return $query->result();
	}

	public function order_count_i(){
		$query = $this->db->query("SELECT COUNT(id) AS od_i
			FROM order 
			WHERE status = 'I'
			");
		return $query->result();
	}

}

