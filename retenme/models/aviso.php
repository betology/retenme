<?php
class Aviso extends CI_Model {
	public function save($email){
		$data['email'] = $email;
		$this->load->database();
		return $this->db->insert('emails', $data);
	}
}