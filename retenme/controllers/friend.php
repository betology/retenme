<?php
class Friend extends CI_Controller {
	public function index($user_id) {
		$this->load->helper('user');
		if ( ! is_logged()) {
			redirect('/');
		}
		
		$requester_id = $this->session->userdata('user_id');
		$this->load->model('friendmodel');
		$this->friendmodel->request($user_id, $requester_id);
		
		$this->load->model('usermodel');
		$user = $this->usermodel->getName($user_id);
		redirect('profile/' . $user['username']);
	}
	
	public function request() {
		if ( ! is_logged()){
			redirect('/');
		}
		
		$this->load->model('friendmodel');
		$data['friendship_requests'] = $this->friendmodel->get_friendship_requests($this->session->userdata('user_id'));
		
		$render['sidebar'] = $this->load->view('tools', NULL, TRUE);
		$render['content'] = $this->load->view('lists/friendship_requests', $data, TRUE);
		$layout = $this->load->view('layouts/sidebar', $render, true);
		$this->load->view('layouts/site', array('content'=> $layout));
	}
	
	public function accept($requester_id) {
		if ( ! is_logged()){
			redirect('/');
		}
		
		$this->load->model('friendmodel');
		if ($this->friendmodel->is_friendship_requested($requester_id, $this->session->userdata('user_id'))){
			$this->friendmodel->accept_request($this->session->userdata('user_id'), $requester_id);
			$this->load->model('usermodel');
			$username = $this->usermodel->getName($requester_id);
			$this->session->set_flashdata('alert', 'Ahora ' . $username['username'] . ' es tu amigo.');
			$this->session->set_flashdata('alert_type', 'success');
			redirect('profile/' . $username['username']);
		}
		else{
			$this->session->set_flashdata('alert', '¿Qué estás tratando de hacer?');
			$this->session->set_flashdata('alert_type', 'error');
			redirect('home');
		}
	}
}