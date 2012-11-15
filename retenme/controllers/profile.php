<?php

class Profile extends CI_Controller {
	public function index($username = NULL) {
		$this->load->model('usermodel');
		$this->load->helper('user');
		
		$profile = $this->usermodel->get($username);
		if ($profile) {
			$this->load->model('challengemodel');
			$this->load->model('friendmodel');
			$challenges = $this->challengemodel->getByUser($profile['id'], CHALLENGE_STATUS_HECHO);
			
			if (is_logged()) {
				
				$render['sidebar'] = $this->load->view('tools', NULL, TRUE);
			}
			else {
				// TODO mostrar login y un enlace para crear cuenta
			}
			
			$render['content'] = $this->load->view('profile', array(
				'profile' => $profile,
				'challenges' => $challenges,
				'is_friendship_requested' => $this->friendmodel->is_friendship_requested(
					$this->session->userdata('user_id'),
					$profile['id']
				),
				'is_friend' => $this->friendmodel->is_friend(
					$this->session->userdata('user_id'),
					$profile['id']
				)
			), TRUE);
			$layout = $this->load->view('layouts/sidebar', $render, true);
			$this->load->view('layouts/site', array('content'=> $layout));
		}
		else {
			show_404();
		}
	}
}