<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// USER
$route['dashboard'] = 'admin';
$route['register'] = 'user/register_view';
$route['login'] = 'user';

$route['default_controller'] = 'customer';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
