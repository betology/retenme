<?php
class Commentmodel extends CI_Model {
	const table = 'comments';
	
	public function getByChallenge($challenge_id, $limit, $skip) {
		$this->load->database();
		$this->db->select('comments.id, comments.comment, comments.created, users.username');
		$this->db->from(self::table);
		$this->db->where('comments.challenge_id', $challenge_id);
		$this->db->join('users', 'users.id = comments.user_id');
		$this->db->order_by('created', 'desc');
		$this->db->limit($limit, $skip);
		
		return $this->db->get()->result_array();
	}
	
	public function countByChallenge($id, $time = NULL) {
		$this->load->database();
		$this->db->from(self::table);
		$this->db->where('comments.challenge_id', $id);
		if ($time != NULL) {
			$this->db->where('created >', $time);
		}
		return $this->db->count_all_results();
	}
	
	public function save($user_id, $comment, $challenge_id) {
		$this->load->database();
		$data = array(
			'user_id' => $user_id,
			'comment' => $comment,
			'challenge_id' => $challenge_id
		);
		return $this->db->insert(self::table, $data);
	}
}