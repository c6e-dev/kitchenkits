<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['facebook_app_id']              = '742360782825845';
$config['facebook_app_secret']          = 'b34ffc9478580a82677559eae21497db';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'Customer';
$config['facebook_logout_redirect_url'] = 'User/logout';
$config['facebook_permissions']         = array('email');
$config['facebook_graph_version']       = 'v2.10';
$config['facebook_auth_on_load']        = TRUE;