<?php
class Sessionmodel extends CI_Model {
	const table = 'users';
	
	public function login($username, $password) {
		$this->db->select('id as user_id, username, password');
		$this->db->from(self::table);
		$this->db->where('username', $username);
		
		$result = $this->db->get()->result_array();
		if (empty($result)) {
			return FALSE;
		}
		else {
			$stored_password = $result[0]['password'];
			if (crypt($password, $stored_password) == $stored_password) {
				unset($result[0]['password']);
				echo 'si';
				return $result[0];
			}
		}
	}
	
	public function save($email, $username, $password) {
		$data = array(
			'email' => $email,
			'username' => $username,
			'password' => $password
		);
		return $this->db->insert(self::table, $data);
	}
	
	public function activate($id){
		$data['first'] = '1';
		$this->db->where('id', $id);
		$this->db->update(self::table, $data);
	}
}