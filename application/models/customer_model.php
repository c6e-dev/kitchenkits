<?php
class customer_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function view_profile($id){ //MODIFY FOR CUSTOMER IMAGE
		$query = $this->db->query("
			SELECT cs.id AS cs_id,  cs.code AS cs_code, cs.first_name AS cs_fname, cs.last_name AS cs_lname, cs.email_address AS cs_email, cs.home_address AS cs_address, u.id AS cs_uid, u.username AS cs_username, u.password AS cs_password, u.created_date AS cs_create, u.updated_date AS cs_update
			FROM customer cs
			INNER JOIN user u ON cs.user_id = u.id
			WHERE cs.id = '$id'
		");
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else
			return NULL;
		}
	}

	public function edit_profile(){
		$customer_id = $this->input->post('cs_id');
		$user_id = $this->input->post('u_id');
		$first_name = $this->input->post('cs_fname');
		$last_name = $this->input->post('cs_lname');
		$home_address = $this->input->post('cs_address');
		$email_address = $this->input->post('cs_email');
		$username = $this->input->post('cs_username');
		$this->db->query("
			UPDATE customer cs, user u
			SET cs.first_name = '$first_name', cs.last_name = '$last_name', cs.home_address = '$home_address', cs.email_address = '$email_address', u.username = '$username'
			WHERE cs.id ='$customer_id' AND u.id = '$user_id'
		");
	}

	// public function view_cart(){
	// 	$query = $this->db->query("

	// 	");
	// 	if ($query->num_rows() > 0){
	// 		return $query->result();
	// 	}
	// 	else{
	// 		return NULL;
	// 	}
	// }

}