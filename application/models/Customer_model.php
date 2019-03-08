<?php
class Customer_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

	//RECOMMENDATION FUNCTIONS

	public function loggedin_customer_ordered_recipes($id){
		$query = $this->db->query("
			SELECT DISTINCT oc.recipe_id
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			WHERE od.customer_id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_all_customer(){
		$query = $this->db->query("
			SELECT DISTINCT od.customer_id id
			FROM delivery od
			WHERE od.customer_id <> 1
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function customer_ordered_recipes($id){
		$query = $this->db->query("
			SELECT DISTINCT oc.recipe_id id
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			WHERE od.customer_id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recommended_recipe($id){
		$query = $this->db->query("
			SELECT SUM(ra.rating)/COUNT(ua.customer_id) AS average, re.id re_id, re.country_id AS re_cid, re.name AS re_name, re.cooking_time AS re_cooktime, re.servings AS re_serves, re.image AS re_img, re.status re_stat, re.religion re_rel
			FROM rating ra
			INNER JOIN user_activity ua ON ra.activity_id = ua.id
			INNER JOIN recipe re ON  ua.recipe_id = re.id
			WHERE re.status = 'A' AND re.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function most_sold_recipes(){
		$prev_month = date('Y-m-d', strtotime("-1 months"));
		$query = $this->db->query("
			SELECT COUNT(oc.recipe_id), oc.recipe_id re_id
			FROM order_content oc 
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE substring(ua.created_date,1,10) >= '$prev_month' AND od.status = 'P' OR od.status = 'C'
			GROUP BY oc.recipe_id
			ORDER BY COUNT(oc.recipe_id) DESC
		");
		return $query->result();
	}

	//CUSTOMER PROFILE FUNCTIONS 

	//VIEW FUNCTIONS

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
			SELECT oc.quantity*re.price total, ua.created_date cdate, re.id rid, re.name rname, re.image rimg
			FROM order_content oc
			INNER JOIN delivery de ON oc.order_id = de.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN user_activity ua ON de.activity_id = ua.id
			WHERE de.customer_id = '$id' AND ua.activity_type_id = 1
			ORDER BY ua.created_date DESC
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
		$religion = $this->input->post('cs_religion');
		$home_address = $this->input->post('cs_address');
		$email_address = $this->input->post('cs_email');
		$username = $this->input->post('cs_username');
		$this->db->query("
			UPDATE customer cs, user u
			SET cs.first_name = '$first_name', cs.last_name = '$last_name', cs.religion = '$religion', cs.home_address = '$home_address', cs.email_address = '$email_address', u.username = '$username', u.updated_date = '$upt_date'
			WHERE cs.id ='$customer_id' AND u.id = '$user_id'
		");
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

	//CART FUNCTION

	public function view_cart($id){
		$query = $this->db->query("
			SELECT re.id re_id, re.name re_name, re.price re_price, re.image re_img, oc.quantity qntty, oc.id oc_id, od.id od_id
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			WHERE cs.user_id = '$id' AND od.activity_id = 0
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function edit_item_count(){
		$newcount = $this->input->post('itemcount');
		$oc_id = $this->input->post('oc_id');
		$this->db->query("
			UPDATE order_content oc
			SET oc.quantity = '$newcount' 
			WHERE oc.id = '$oc_id'
		");
	}

	public function item_count($od_id){
		$query = $this->db->query("
			SELECT COUNT(order_id) AS od_id_count
			FROM order_content
			WHERE order_id = '$od_id'
			");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return 0;
		}
	}

	public function item_count_decrease($newcount){
		$oc_id = $this->input->post('oc_id');
		$this->db->query("
			UPDATE order_content oc
			SET oc.quantity = '$newcount'
			WHERE oc.id = '$oc_id'
		");
	}

	public function item_count_increase($newcount){
		$oc_id = $this->input->post('oc_id');
		$this->db->query("
			UPDATE order_content oc
			SET oc.quantity = '$newcount' 
			WHERE oc.id = '$oc_id'
		");
	}

	public function delete_cart_item($oc_id,$od_id){
		$this->db->query("
			DELETE order_content, delivery
			FROM order_content
			INNER JOIN delivery ON order_content.order_id = delivery.id
			WHERE order_content.id = '$oc_id' AND delivery.id = '$od_id'
		");
	}

	public function delete_order($oc_id){
		$this->db->query("
			DELETE FROM order_content			
			WHERE order_content.id = '$oc_id'
		");
	}

	public function item_subtotal($id){
		$query = $this->db->query("
			SELECT SUM(oc.quantity) AS stotalcount
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			WHERE cs.user_id = '$id' AND od.activity_id = 0
		");
		return $query->result();
	}

	public function item_subtotal_price($id){
		$query = $this->db->query("
			SELECT SUM(oc.quantity*re.price) AS stotalprice
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			INNER JOIN recipe re ON oc.recipe_id = re.id
			INNER JOIN customer cs ON od.customer_id = cs.id
			WHERE cs.user_id = '$id' AND od.activity_id = 0
		");
		return $query->result();
	}

	public function read_condiments($id){
		$query = $this->db->query("
			SELECT ig.id ig_id, ig.name ig_name, un.name ig_unit
			FROM ingredients ig
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE ig.condiments = 'Yes' AND ig.id NOT IN (SELECT ai.ingredient_id FROM add_ingredient ai WHERE ai.order_id = '$id')
		");
		return $query->result();
	}

	public function additional_ingredients($id){
		$query = $this->db->query("
			SELECT md5(ai.id) ai_id, ig.name ig_name, ig.price ig_prc, un.name ig_unit, ai.ingredient_id ig_id, ai.ingredient_amount ig_amnt
			FROM add_ingredient ai
			INNER JOIN ingredients ig ON ai.ingredient_id = ig.id
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE ai.order_id = '$id'
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
			WHERE ai.order_id = '$id'
		");
		return $query->result();
	}

	public function additional_item($data){
		$this->db->insert('add_ingredient', $data);
	}

	public function delete_additional_item($ai_id){
		$this->db->query("
			DELETE FROM add_ingredient			
			WHERE md5(id) = '$ai_id'
		");
	}

	public function update_additional_item(){
		$amount = $this->input->post('amount');
		$ai_id = $this->input->post('id');
		$this->db->query("
			UPDATE add_ingredient
			SET ingredient_amount = '$amount'
			WHERE md5(id) = '$ai_id'
		");
	}

	//BROWSING FUNCTIONS 
	
	public function selected_country($id){
		$query = $this->db->query("
			SELECT co.id co_id, co.region_id cor_id, co.name co_name
			FROM country co
			INNER JOIN region re ON co.region_id = re.id
			WHERE md5(co.id) = '$id'
		");
		return $query->result();
	}

	public function average_rating(){
		$query = $this->db->query("
			SELECT SUM(ra.rating)/COUNT(ua.customer_id) AS average
			FROM rating ra
			INNER JOIN user_activity ua ON ra.activity_id = ua.id
			GROUP BY ua.customer_id
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function browse_recipe($id){
		$query = $this->db->query("
			SELECT re.id re_id
			FROM recipe re
			INNER JOIN country cn ON re.country_id = cn.id
			WHERE re.status = 'A' AND re.country_id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_countries(){
		$query = $this->db->query("
			SELECT md5(co.id) co_id, co.region_id cor_id, co.name co_name
			FROM country co
			INNER JOIN region re ON co.region_id = re.id
		");
		return $query->result();
	}

	public function view_recipe($id){
		$query = $this->db->query("
			SELECT SUM(ra.rating)/COUNT(ua.customer_id) AS average, COUNT(ua.customer_id) AS total, re.id AS re_id, md5(re.country_id) AS re_cid, re.name AS re_name, re.cooking_time AS re_cooktime, re.servings AS re_serves, re.instructions AS re_instruc, re.image AS re_img
			FROM rating ra
			INNER JOIN user_activity ua ON ra.activity_id = ua.id
			INNER JOIN recipe re ON  ua.recipe_id = re.id
			WHERE re.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recipe_ingredients($id){
		$query = $this->db->query("
			SELECT ri.ingredient_amount ig_amount, ig.name ig_name, un.name ig_unit
			FROM recipe_ingredients ri
			INNER JOIN ingredients ig ON ri.ingredient_id = ig.id
			INNER JOIN unit un ON ig.unit_id = un.id
			WHERE ri.recipe_id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recipe_rates($re_id,$id){
		$query = $this->db->query("
			SELECT cu.first_name cu_fname, cu.last_name cu_lname, ua.created_date cdate, ra.rating rate, ra.id ra_id
			FROM user_activity ua
			INNER JOIN rating ra ON ra.activity_id = ua.id
			INNER JOIN customer cu ON ua.customer_id = cu.id
			WHERE ua.recipe_id = '$re_id' AND ua.activity_type_id = 3 AND cu.user_id <> '$id'
			ORDER BY ua.created_date DESC
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recipe_reviews($re_id,$id){
		$query = $this->db->query("
			SELECT co.message co_me
			FROM user_activity ua
			INNER JOIN comment co ON co.activity_id = ua.id
			INNER JOIN customer cu ON ua.customer_id = cu.id
			WHERE ua.recipe_id = '$re_id' AND ua.activity_type_id = 4 AND cu.user_id <> '$id'
			ORDER BY ua.created_date DESC
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function my_rate($re_id,$id){
		$query = $this->db->query("
			SELECT cu.first_name cu_fname, cu.last_name cu_lname, ua.created_date cdate, ra.rating rate, ra.id ra_id
			FROM user_activity ua
			INNER JOIN rating ra ON ra.activity_id = ua.id
			INNER JOIN customer cu ON ua.customer_id = cu.id
			WHERE ua.recipe_id = '$re_id' AND ua.activity_type_id = 3 AND cu.user_id = '$id'
			ORDER BY ua.created_date DESC
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function my_review($re_id,$id){
		$query = $this->db->query("
			SELECT co.message co_me
			FROM user_activity ua
			INNER JOIN comment co ON co.activity_id = ua.id
			INNER JOIN customer cu ON ua.customer_id = cu.id
			WHERE ua.recipe_id = '$re_id' AND ua.activity_type_id = 4 AND cu.user_id = '$id'
			ORDER BY ua.created_date DESC
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recipe($id){
		$query = $this->db->query("
			SELECT id, status
			FROM recipe
			WHERE country_id = '$id' AND (status = 'A' OR status = 'U')
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function read_branch(){
		$query = $this->db->query("
			SELECT br.id AS br_id
			FROM branch br 
		");
		if($query->num_rows()>0){
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
			WHERE ri.recipe_id = '$id'
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

	public function activate_recipe($id){
		$this->db->query("
			UPDATE recipe re 
			SET re.status = 'A'
			WHERE re.id = '$id'
		");
	}

	public function disable_recipe($id){
		$this->db->query("
			UPDATE recipe rcp
			SET rcp.status = 'U' 
			WHERE rcp.id = '$id'
		");
	}

	//ORDER FUNCTION

	public function create_order($data){
		$this->db->insert('delivery', $data);
	}

	public function add_order($data){
		$this->db->insert('order_content', $data);
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

	public function order_check($id){
		$query = $this->db->query("
			SELECT de.id
			FROM delivery de
			INNER JOIN customer cu ON de.customer_id = cu.id
			WHERE cu.user_id = '$id' AND de.activity_id = 0
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function recipe_check($od_id,$re_id){
		$query = $this->db->query("
			SELECT oc.recipe_id
			FROM order_content oc
			INNER JOIN delivery od ON oc.order_id = od.id
			WHERE oc.order_id = '$od_id' AND oc.recipe_id = '$re_id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	//RATE AND REVIEW FUNCTIONS

	public function new_rating_activity($data){
		$this->db->insert('user_activity', $data);
	}

	public function new_rating($data){
		$this->db->insert('rating', $data);
	}

	public function new_review_activity($data){
		$this->db->insert('user_activity', $data);
	}

	public function new_review($data){
		$this->db->insert('comment', $data);
	}

	//OTHER FUNCTION

	public function loggedin_customer($id){
		$query = $this->db->query("
			SELECT cs.id, cs.code AS cs_code, cs.first_name AS cs_fname, cs.last_name AS cs_lname, cs.image AS cs_image, cs.email_address AS cs_email, cs.religion AS cs_religion, cs.home_address AS cs_address, u.username AS cs_username, u.password AS cs_password, u.created_date AS cs_create, u.updated_date AS cs_update
			FROM customer cs
			INNER JOIN user u ON cs.user_id = u.id
			WHERE cs.user_id = '$id'
		");
		return $query->result();
	}

	//NOTIFICATION

	public function notify_me($id){
		$query = $this->db->query("
			SELECT ua.created_date ua_cd, od.id od_id, od.code od_code
			FROM delivery od
			INNER JOIN customer cs ON od.customer_id = cs.id
			INNER JOIN user u ON cs.user_id = u.id
			INNER JOIN user_activity ua ON od.activity_id = ua.id
			WHERE u.id = '$id' AND (od.status = 'I' OR od.status = 'P')
			");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return 0;
		}
	}
	public function confirm_last_order($id){
		$this->db->query("
			UPDATE delivery
			SET status = 'C'
			WHERE id = '$id'
		");
	}

	//RECOMMENDATION

	public function fb_login_check($id){
		$query = $this->db->query("
			SELECT us.id, us.username, us.password, us.user_type_id, us.status
			FROM user us
			WHERE us.fb_id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}
	}

	public function add_customer_account($customerdata){
		$this->db->insert('user', $customerdata);
	}

	public function add_customer($customerdata){
		$this->db->insert('customer', $customerdata);
	}

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

	public function get_customer($id){
		$query = $this->db->query("
			SELECT cs.first_name, cs.last_name
			FROM customer as cs
			INNER JOIN user us ON cs.user_id = us.id
			WHERE cs.user_id = '$id'
		");
		return $query->result();
	}

	public function logged_in($id){
		$this->db->query("
			UPDATE user
			SET logged_in = '1' 
			WHERE id = '$id'
		");
	}

}
