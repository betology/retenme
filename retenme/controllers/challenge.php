<?php
class Challenge extends CI_Controller {
	
	public function view($id, $skip = 0) {
		if (is_logged()) {
			$this->load->helper('date');
			$this->load->model('challengemodel');
			
			$challenge = $this->challengemodel->get($id);
			
			// solo un amigo puede ver el reto
			$this->load->model('friendmodel');
			$user_id = $this->session->userdata('user_id');
			if (! $this->friendmodel->is_friend($user_id, $challenge['user_id']) && $challenge['user_id'] !== $user_id){
				redirect('home');
			}
			
			if ($challenge){
				$this->load->model('commentmodel');
				
				$this->challengemodel->registerView($challenge['id']);
				
				$this->load->library('pagination');
				
				$config['base_url'] = site_url('challenge/view/' . $id);
				$config['total_rows'] = $this->commentmodel->countByChallenge($id);
				$config['per_page'] = $limit = 10;
				
				$config['uri_segment'] = 4;
				$config['full_tag_open'] = '<div class="well">';
				$config['full_tag_close'] = '</div>';
				$config['first_link'] = 'Primeros';
				$config['last_link'] = 'Últimos';
				$config['num_links'] = 5;
				$this->pagination->initialize($config);
				
				$link_pagination['pagination'] = $this->pagination->create_links();

				$comments['comments'] = $this->commentmodel->getByChallenge($id, $limit, $skip);
				
				$render['sidebar'] = $this->load->view('tools', NULL, TRUE);
				$render['content'] = $this->load->view('challenge', array_merge($challenge, $comments, $link_pagination), TRUE);
				$layout = $this->load->view('layouts/sidebar', $render, true);
				$this->load->view('layouts/site', array('content'=> $layout));
			}
			else {
				show_404();
			}
		}
		else {
			redirect('home');
		}
	}
	
	public function friend(){
		$friend = $this->input->post('friend');
		$this->load->model('friendmodel');
		$friends = $this->friendmodel->search($friend);
		
		$this->load->model('usermodel');
		$users = $this->usermodel->searchStranges($friend);
		
		if ( is_logged() ){
			$render['sidebar'] = $this->load->view('tools', NULL, TRUE);
		}
		else {
			$render['sidebar'] = $this->load->view('login', array('show_signup' => TRUE), TRUE);
		}
		$render['content'] = $this->load->view('lists/profiles', array('friends' => $friends) , TRUE);
		$render['content'] .= $this->load->view('lists/users', array('users' => $users) , TRUE);
		$layout = $this->load->view('layouts/sidebar', $render, true);
		$this->load->view('layouts/site', array('content'=> $layout));
	}
	
	public function add() {
		if ( ! is_logged()){
			redirect('home');
		}
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'un nombre', 'required');
		$this->form_validation->set_rules('description', 'una descripción', 'required');
		
		$this->form_validation->set_message('required', 'Necesitas escribir %s');
		
		$user_id = $this->input->post('user_id');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->model('challengemodel');
			$this->load->model('friendmodel');
			$this->load->model('usermodel');
			
			$profile = $this->usermodel->getById($user_id);
			$challenges = $this->challengemodel->getByUser($user_id, CHALLENGE_STATUS_HECHO);
			
			$render['sidebar'] = $this->load->view('tools', NULL, TRUE);

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
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			
			$this->load->model('challengemodel');
			$this->challengemodel->save($name, $description, $user_id);
			$this->session->set_flashdata('alert', '¡Bien! tu amigo ha recibido el reto, ¿lo aceptará?');
			$this->session->set_flashdata('alert_type', 'success');
			redirect('home');
		}
	}
	
	public function accept($id){
		if ( ! is_logged()) {
			redirect('/');
		}
		
		$this->load->model('challengemodel');
		$challenge = $this->challengemodel->get($id);
		if ($challenge && $this->session->userdata('user_id') === $challenge['user_id']) {
			if ($challenge['status'] === CHALLENGE_STATUS_NUEVO){
			$this->challengemodel->accept($id);
			}
			redirect('challenge/view/' . $id);
		}
		else {
			show_404();
		}
	}
	
	public function done($id){
		if ( ! is_logged()) {
			redirect('/');
		}
		
		$this->load->model('challengemodel');
		$challenge = $this->challengemodel->get($id);
		if ($challenge && $this->session->userdata('user_id') === $challenge['user_id']) {
			if ($challenge['status'] === CHALLENGE_STATUS_ACEPTADO){
			$this->challengemodel->done($id);
			}
			redirect('challenge/view/' . $id);
		}
		else {
			show_404();
		}
	}
}