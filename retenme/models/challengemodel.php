<?php
class Challengemodel extends CI_Model {
	const table = 'challenges';
	
	public function get($id) {
		$this->load->database();
		$this->db->select('challenges.id, name, description, user_id, created, status, date_done, username');
		$this->db->from(self::table);
		$this->db->join('users', 'users.id = challenges.user_id');
		$this->db->where('challenges.id', $id);
		
		$result = $this->db->get()->result_array();
		
		if (isset($result[0])) {
			return $result[0];
		}
		else {
			return FALSE;
		}
	}
	
	public function getByFriends($user_id, $status = NULL, $limit = 5) {
		$this->load->model('friendmodel');
		$friends = $this->friendmodel->get_friends();
		if (empty($friends)){
			return array();
		}
		$this->db->select('id, name, description, created');
		$this->db->from(self::table);
		$this->db->where_in('user_id', $friends);
		$this->db->limit($limit);
		if ($status !== NULL) {
			$this->db->where('status', $status);
		}
		
		return $this->db->get()->result_array();
	}
	
	public function getByUser($user_id, $status = NULL, $limit = 5) {
		$this->load->database();
		$this->db->select('id, name, description, created');
		$this->db->from(self::table);
		$this->db->where('user_id', $user_id);
		$this->db->limit($limit);
		if ($status !== NULL) {
			$this->db->where('status', $status);
		}
		
		return $this->db->get()->result_array();
	}
	
	public function count($user_id, $status = NULL) {
		$this->load->database();
		$this->db->from(self::table);
		$this->db->where('user_id', $user_id);
		if ($status !== NULL) {
			$this->db->where('status', $status);
		}
		return $this->db->count_all_results();
	}
	
	public function save($name, $description, $user_id) {
		$this->load->database();
		$data = array(
			'name' => $name,
			'description' => $description,
			'user_id' => $user_id,
			'created' => time(),
			'status' => CHALLENGE_STATUS_NUEVO
		);
		return $this->db->insert(self::table, $data);
	}
	
	public function accept($id) {
		$this->load->database();
		$data = array(
			'status' => CHALLENGE_STATUS_ACEPTADO
		);
		$this->db->where('id', $id);
		return $this->db->update(self::table, $data);
	}
	
	public function done($id) {
		$this->load->database();
		$data = array(
			'status' => CHALLENGE_STATUS_HECHO,
			'date_done' => time()
		);
		$this->db->where('id', $id);
		return $this->db->update(self::table, $data);
	}
	
	/*
	 * FIXME upsert
	 */
	public function registerView($challenge_id){
		$this->load->database();
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'challenge_id' => $challenge_id
		);
		$this->db->insert('challenge_views', $data);
	}
	
	public function lastView($challenge_id) {
		$this->load->database();
		$this->db->select('created');
		$this->db->from('challenge_views');
		$this->db->where('challenge_id', $challenge_id);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->order_by('created', 'DESC');
		
		$result = $this->db->get()->result_array();

		if (isset($result[0])) {
			return $result[0]['created'];
		}
		else{
			return NULL;
		}
	}
}