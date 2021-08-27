<?php 

Class Registration_model extends CI_Model 
{
	function insertUser($data)
	{
		$query = $this->db->insert('registration', $data);
		return $this->db->insert_id();
	}

	function getUserData($email, $password)
	{
		$this->db->select('*');
		$this->db->where('registration.email', $email);
		$this->db->where('registration.password', sha1($password));

		$query = $this->db->get('registration');
		return $query->result_array();
	}
}