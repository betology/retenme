<?php


function is_logged() {
	$CI =& get_instance();
	if ( $CI->session->userdata('username') !== FALSE
		&& $CI->session->userdata('user_id') !== FALSE ){
		return TRUE;
	}
	else{
		return FALSE;
	}
}
