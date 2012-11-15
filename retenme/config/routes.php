<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['signup'] = 'session/signup';
$route['login'] = 'session/login';
$route['logout'] = 'session/logout';
$route['profile/(:any)'] = 'profile/index/$1';
$route['friend/request'] = 'friend/request';
$route['friend/accept/(:any)'] = 'friend/accept/$1';
$route['friend/(:any)'] = 'friend/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */