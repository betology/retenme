<?php
class Friendmodel extends CI_Model {
	const table = 'friends';
	
	public function search($q, $limit = 20) {
		$this->db->select('users.id, users.username');
		$this->db->from(self::table);
		$this->db->join('users', 'friends.friend_id = users.id', 'inner');
		$this->db->where('friends.user_id', $this->session->userdata('user_id'));
		$this->db->like('users.username', $q);
		$this->db->limit($limit);
		$result = $this->db->get()->result_array();
		return $result;
	}
	
	public function request($user_id, $requester_id) {
		$data = array(
			'user_id' => $user_id,
			'requester_id' => $requester_id
		);
		
		return $this->db->insert('friendship_requests', $data);
	}
	
	public function accept_request($user_id, $requester_id) {
		// double rainbow
		$data = array(
			array(
				'user_id' => $user_id,
				'friend_id' => $requester_id
			),
			array(
				'user_id' => $requester_id,
				'friend_id' => $user_id
			),
		);
		if ($this->db->insert_batch(self::table, $data)){
			$this->db->where('user_id', $user_id);
			$this->db->where('requester_id', $requester_id);
			return $this->db->delete('friendship_requests');
		}
	}
	
	public function is_friendship_requested($user_id, $friend_id) {
		$this->db->select('id');
		$this->db->from('friendship_requests');
		$this->db->where('requester_id', $user_id);
		$this->db->where('user_id', $friend_id);
		
		$result = $this->db->get()->result_array();
		
		if ( empty($result) ) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	public function is_friend($user_id, $friend_id) {
		$this->db->select('id');
		$this->db->from(self::table);
		$this->db->where('user_id', $user_id);
		$this->db->where('friend_id', $friend_id);
		
		$result = $this->db->get()->result_array();
		
		return ! empty($result);
	}
	
	public function get_friends() {
		$user_id = $this->session->userdata('user_id');
		$this->db->select('friend_id');
		$this->db->from(self::table);
		$this->db->where('user_id', $user_id);
		$result = $this->db->get()->result_array();
		
		$return = array();
		if (!empty($result)){
			foreach($result as $record){
				$return[] = $record['friend_id'];
			}
		}
		return $return;
	}
	
	public function get_friendship_requests($user_id) {
		$this->db->select('users.id as id, username');
		$this->db->from('friendship_requests');
		$this->db->where('user_id', $user_id);
		$this->db->join('users', 'users.id = friendship_requests.requester_id');
		
		return $this->db->get()->result_array();
	}
}