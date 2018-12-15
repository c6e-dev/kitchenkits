<?php
class user_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function login_check($user, $pass){
		$query = $this->db->query("
			SELECT us.id, us.username, us.password, us.user_type_id
			FROM user as us
			WHERE us.username = '$user' AND us.password = '$pass'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}					
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
}

