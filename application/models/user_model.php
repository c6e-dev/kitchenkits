<?php
class user_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function login_check($user, $pass){
		$query = $this->db->query("
			SELECT us.id, us.username, us.password, us.user_type_id, us.status
			FROM user as us
			WHERE us.username = '$user' AND us.password = '$pass'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}					
	}
	public function get_manager($id){
		$query = $this->db->query("
			SELECT bm.name
			FROM branch_manager as bm
			INNER JOIN user us ON bm.user_id = us.id
			WHERE bm.user_id = '$id'
		");
		return $query->result();
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
	public function add_customer_account($customerdata){
		$this->db->insert('user', $customerdata);
	}
	public function add_customer($customerdata){
		$this->db->insert('customer', $customerdata);
	}
	public function logged_in($id){
		$this->db->query("
			UPDATE user
			SET logged_in = '1' 
			WHERE id = '$id'
		");
	}
	public function logged_out($id){
		$this->db->query("
			UPDATE user
			SET logged_in = '0' 
			WHERE id = '$id'
		");
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
}

