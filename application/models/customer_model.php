<?php
class customer_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	//CUSTOMER PROFILE FUNCTIONS 

	//VIEW FUNCTIONS

	public function view_profile($id){ //MODIFY FOR CUSTOMER IMAGE
		$query = $this->db->query("
			SELECT cs.id AS cs_id,  cs.code AS cs_code, cs.first_name AS cs_fname, cs.last_name AS cs_lname, cs.image AS cs_image, cs.email_address AS cs_email, cs.home_address AS cs_address, u.id AS cs_uid, u.username AS cs_username, u.password AS cs_password, u.created_date AS cs_create, u.updated_date AS cs_update
			FROM customer cs
			INNER JOIN user u ON cs.user_id = u.id
			WHERE u.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function view_history($id){
		$query = $this->db->query("
			SELECT ua.activity_type_id fb_type, ua.created_date fb_cdate, co.message fb_comment, ra.rating fb_rating, cs.first_name fb_fname, cs.last_name fb_lname, re.name fb_recipe
			FROM user_activity ua
			INNER JOIN recipe re ON ua.recipe_id = re.id		
			RIGHT JOIN customer cs ON ua.customer_id = cs.id
			LEFT JOIN comment co ON ua.id = co.activity_id
			LEFT JOIN rating ra ON ua.id = ra.activity_id
			WHERE cs.user_id = '$id' 
			ORDER BY ua.created_date DESC
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function view_recent_order($id){
		$query = $this->db->query("
			SELECT ua.created_date cdate, tr.total_cost total, re.name rname
			FROM order_content oc
			INNER JOIN delivery de ON oc.order_id = de.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN customer cu ON de.customer_id = cu.id
			INNER JOIN branch br ON de.branch_id = br.id
			INNER JOIN transaction tr ON de.id = tr.order_id
			INNER JOIN user_activity ua ON de.activity_id = ua.id
			WHERE de.customer_id = '$id' AND de.status = 'C'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	//EDIT FUNCTIONS

	public function edit_profile($upt_date){ //ADD IMAGE 
		$customer_id = $this->input->post('cs_id');
		$user_id = $this->input->post('u_id');
		$first_name = $this->input->post('cs_fname');
		$last_name = $this->input->post('cs_lname');
		$home_address = $this->input->post('cs_address');
		$email_address = $this->input->post('cs_email');
		$username = $this->input->post('cs_username');
		$this->db->query("
			UPDATE customer cs, user u
			SET cs.first_name = '$first_name', cs.last_name = '$last_name', cs.home_address = '$home_address', cs.email_address = '$email_address', u.username = '$username', u.updated_date = '$upt_date'
			WHERE cs.id ='$customer_id' AND u.id = '$user_id'
		");
	}

	public function edit_password($upt_date){
		$password = $this->input->post('new_password');
		$user_id = $this->input->post('user_id');
		$this->db->query("
			UPDATE user u
			SET u.password = '$password', u.updated_date = '$upt_date' 
			WHERE u.id = '$user_id'
		");
	}

	//CART FUNCTION

	// public function view_cart($id){
	// 	$query = $this->db->query("
	// 		SELECT re.name AS re_name, re.price AS re_price, ai.ingredient_amount AS re_amount, ig.name = re_additional
	// 		FROM delivery od
	// 		INNER JOIN order_content oc ON oc.order_id = od.id
	// 		INNER JOIN recipe re ON oc.recipe_id = re.id
	// 		-- INNER JOIN add_ingredient ai ON ai.order_id = od.id  
	// 		INNER JOIN ingredients ig ON ai.ingredient_id = ig.id
	// 		INNER JOIN customer cs ON od.customer_id = cs.id
	// 		WHERE oc.order_id = '$id' 
	// 	");
	// 	if ($query->num_rows() > 0){ 
	// 		return $query->result(); 
	// 	}
	// 	else{
	// 		return NULL;
	// 	}
	// }

	//BROWSING FUNCTIONS 
	
	public function browse_recipe($id){
		$query = $this->db->query("
			SELECT re.country_id AS re_cid, re_name AS re_name, re.cooking_time AS re_cooking, re.servings AS re_servings, re.image AS re_image, re.status AS re_status, cn.name AS re_country, rg.name AS re_region
			FROM recipe re
			INNER JOIN country cn ON re.country_id = cn.id
			INNER JOIN region rg ON cn.region_id = rg.id
			WHERE re.status = 'A' AND cn.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	//CHECKER

	public function user_check($id){
		$query = $this->db->query("
			SELECT c.email_address cemail, u.username usrnm
			FROM customer c
			INNER JOIN user u ON c.user_id = u.id
			WHERE c.user_id = '$id' AND u.id = '$id'
		");
		return $query->result();
	}

}