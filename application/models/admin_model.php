<?php
class admin_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	// DATA TABLE FUNCTIONS

	public function read_recipe(){
		$query = $this->db->query("
			SELECT re.id id, re.name nm, re.price prc, re.instructions ins, re.cooking_time ct, re.servings se, re.status st, rg.name rnm, rg.id rid, co.name cnm, co.id cid
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
			SELECT br.id AS br_id, br.code AS br_code, br.manager_id br_mi, br.name AS br_name, br.branch_address AS br_address, br.status AS br_status, br.created_date AS br_create, br.updated_date AS br_update
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

	public function read_order(){ // CHANGE THIS IF NEEDED
		$query = $this->db->query("
			SELECT od.id AS od_id, od.code AS od_code, od.status AS od_status, ua.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname, br.name AS od_branch
			FROM delivery od
			INNER JOIN user_activity ua ON od.activity_id = ua.id
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
			WHERE re.id = '$id'
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

	public function read_ingredients(){
		$query = $this->db->query("
			SELECT ing.id in_id, ing.unit_id in_unit_id, ing.name in_nm
			FROM ingredients ing
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
			WHERE cs.id = '$id' 
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
			WHERE ua.customer_id = '$id'
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
			WHERE ua.customer_id = '$id'
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
			WHERE br.id = '$id'
		");
		return $query->result();
	}

	public function view_branch_order($id){
		$query = $this->db->query("
			SELECT od.code AS od_code, od.status AS od_status, ua.created_date AS od_create, cs.first_name AS od_fname, cs.last_name AS od_lname, re.name AS od_recipe
			FROM delivery od
			INNER JOIN user_activity ua ON od.activity_id = ua.id
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

	// DELETE FUNCTIONS

	public function delete_recipe($id){
		$this->db->query("
			UPDATE recipe rcp
			SET rcp.status = 'I' 
			WHERE rcp.id = '$id'
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

	public function add_branch($branchdata){
		$this->db->insert('branch', $branchdata);
	}

	public function add_user_manager($mngrdata){
		$this->db->insert('user', $mngrdata);
	}
	public function add_manager($managerdata){
		$this->db->insert('branch_manager', $managerdata);
	}

	// EDIT FUNCTIONS
	
	public function update_recipe($upt_date){
		$name = $this->input->post('name');
		$cooking_time = $this->input->post('cooktime');
		$servings = $this->input->post('servings');
		$price = $this->input->post('price');
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

	// DASHBOARD FUNCTIONS - Robert / 12-02-18 - THIS MODULE IS SUBJECT TO FURTHER IMPROVEMENTS

	public function read_activity_feed(){
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
	
}

