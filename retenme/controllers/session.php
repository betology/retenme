<?php
class Session extends CI_Controller {
	public function signup() {
		if(is_logged()) {
			redirect('home');
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'un email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('username', 'un usuario', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'una contraseña', 'required|min_length[6]');
		$this->form_validation->set_rules('password_verification', 'la verificación de la contraseña', 'required|matches[password]');

		$this->form_validation->set_message('required', 'Necesitas escribir %s');
		$this->form_validation->set_message('valid_email', 'El email no es válido');
		$this->form_validation->set_message('is_unique', 'Ya tenemos este dato registrado');
		$this->form_validation->set_message('min_length', 'La contraseña debe por lo menos tener 6 letras o números');
		$this->form_validation->set_message('matches', 'La contraseña no es igual a la verificación');

		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$plain_password = $this->input->post('password');
		
		// Let's hash that password
		$password = crypt($plain_password);
		
		if ($this->form_validation->run() == FALSE) {
			$content = $this->load->view('session/signup', NULL, TRUE);
			$this->load->view('layouts/site', array(
			'content' => $content,
			'title' => 'Crear cuenta',
			'subtitle' => 
				'Para empezar una vida legendaria hay que elegir una contraseña',
			));
		}
		else {
			$this->load->model('sessionmodel');
			if ($this->sessionmodel->save($email, $username, $password)){
				$session = $this->sessionmodel->login($username, $plain_password);
				$this->session->set_userdata($session);
				redirect('home');
			}
		}
	}
	
	public function login() {
		if (is_logged()) {
			redirect('home');
		}
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$this->load->model('sessionmodel');
		if ($this->form_validation->run() != FALSE 
			&& $session = $this->sessionmodel->login($username, $password)) {
			$this->session->set_userdata($session);
			$this->sessionmodel->activate($this->session->userdata('user_id'));
			redirect('home');
		}
		else {
			$this->session->set_flashdata('alert', 'El usuario y la contraseña no son correctos');
			$this->session->set_flashdata('alert_type', 'error');
			redirect('/');
		}
	}
	
	public function logout () {
		$this->session->sess_destroy();
		redirect('/');
	}
}