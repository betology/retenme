<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		if (is_logged()) {
			redirect('home');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->view('firstindex');
	}
	
	public function avisame() {
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		$mensaje = '';
		$this->load->model('aviso');
		if ($email && $this->aviso->save($email)){
			$mensaje = 'Cuando esté listo recibirás la noticia en tu email';
		}
		else {
			$mensaje = '¿En serio?, ¿A eso llamas email?';
		}
		$this->load->view('mensaje', array('mensaje' => $mensaje));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */