<?php
class Home extends CI_Controller {
	public function index() {
		$this->load->helper(array('user', 'form'));
		if ( ! is_logged()) {
			redirect('/');
		}
		
		$render['sidebar'] = $this->load->view('tools', NULL, TRUE);
		$render['content'] = $this->load->view('home', NULL, TRUE);
		$layout = $this->load->view('layouts/sidebar', $render, true);
		$this->load->view('layouts/site', array('content'=> $layout));
	}
}