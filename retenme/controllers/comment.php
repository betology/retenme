<?php
class Comment extends CI_Controller {
	public function index () {
		if ( ! is_logged()) {
			redirect('/');
		}
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('comment', 'un comentario', 'required|max_length[200]');
		$this->form_validation->set_rules('challenge_id', 'un reto', 'required');
		
		$this->form_validation->set_message('required', 'Necesitas escribir %s');
		$this->form_validation->set_message('max_lenght', 'El comentario no puede ser más largo que 200 caractéres');
		
		$comment = $this->input->post('comment');
		$challenge_id = $this->input->post('challenge_id');
		$user_id = $this->session->userdata('user_id');
		
		$this->load->model('challengemodel');
		$challenge = $this->challengemodel->get($challenge_id);
		
		if ( $this->form_validation->run() === FALSE) {
			$this->load->helper('date');

			if ($challenge){
				$this->load->model('commentmodel');
				$comments['comments'] = $this->commentmodel->getByChallenge($challenge_id);
			
				$render['sidebar'] = $this->load->view('tools', NULL, TRUE);
				$render['content'] = $this->load->view('challenge', array_merge($challenge, $comments), TRUE);
				$layout = $this->load->view('layouts/sidebar', $render, true);
				$this->load->view('layouts/site', array('content'=> $layout));
			}
			else {
				show_404();
			}
		}
		else {
			$this->load->model('friendmodel');
			$this->load->model('commentmodel');
			if ($this->friendmodel->is_friend($user_id, $challenge['user_id']) || $user_id == $challenge['user_id']) {
				if ($this->commentmodel->save($user_id, $comment, $challenge['id'])){
					echo 'a';
					$this->session->set_flashdata('alert', 'Se escribió tu comentario');
					$this->session->set_flashdata('alert_type', 'success');
					redirect('challenge/view/' . $challenge['id']);
				}
				else{
					echo 'b';
					$this->session->set_flashdata('alert', 'No se pudo escribir tu comentario');
					$this->session->set_flashdata('alert_type', 'error');
					redirect('challenge/view/' . $challenge['id']);
				}
			}
			else {
				echo 'c';
				$this->session->set_flashdata('alert', 'No puedes hacer comentarios en este reto');
				$this->session->set_flashdata('alert_type', 'error');
				redirect('challenge/view/' . $challenge['id']);
			}
		}
	}
}