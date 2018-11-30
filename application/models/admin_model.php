<?php
class admin_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function read_recipe(){
		$query = $this->db->query("
			SELECT re.id id, re.name nm, re.price prc, re.instructions ins, re.cooking_time ct, re.servings se, re.status st
			FROM recipe re
			WHERE re.status = 'active'
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
			SET rcp.status = 'inactive' 
			WHERE rcp.id = '$id'
		");
	}
}

