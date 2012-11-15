<?php
class Usermodel extends CI_Model {
	const table = 'users';
	
	public function getName($user_id) {
		$this->load->database();
		$this->db->select('username');
		$this->db->from(self::table);
		$this->db->where('id', $user_id);
		
		$result = $this->db->get()->result_array();
		if (isset($result[0])){
			return $result[0];
		}
		else{
			return FALSE;
		}
	}
	
	public function get($username) {
		$this->load->database();
		$this->db->select('id, username');
		$this->db->from(self::table);
		$this->db->where('username', $username);
		
		$result = $this->db->get()->result_array();
		if (isset($result[0])){
			return $result[0];
		}
		else{
			return FALSE;
		}
	}
	
	public function getById($id) {
		$this->load->database();
		$this->db->select('id, username');
		$this->db->from(self::table);
		$this->db->where('id', $id);
	
		$result = $this->db->get()->result_array();
		if (isset($result[0])){
			return $result[0];
		}
		else{
			return FALSE;
		}
	}
	
	public function search($q, $limit = 20) {
		$this->load->database();
		$this->db->select('id, username');
		$this->db->from(self::table);
		$this->db->like('username', $q);
		$this->db->limit($limit);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function searchStranges($q, $limit = 20) {
		$this->load->database();
		$this->db->select('id, username');
		$this->db->from(self::table);
		$this->db->like('username', $q);
		$this->db->where('id !=', $this->session->userdata('user_id'));
		$this->db->limit($limit);
		$result = $this->db->get()->result_array();
		return $result;
	}
}