<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// USER
$route['dashboard'] = 'admin';
$route['register'] = 'user/register_view';
$route['login'] = 'user';

$route['default_controller'] = 'customer';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//ADMIN
$route['admin_dashboard'] = 'admin/index';
$route['admin_recipe_view'] = 'admin/recipe_view';
$route['admin_customer_view'] = 'admin/customer_view';
$route['admin_branch_view'] = 'admin/branch_view';
$route['admin_manager_view'] = 'admin/manager_view';
$route['admin_order_view'] = 'admin/order_view';
$route['admin_feedback_view'] = 'admin/feedback_view';
$route['admin_ingredient_view'] = 'admin/ingredient_view';

$route['admin_view_recipe'] = 'admin/view_recipe';
$route['admin_view_customer'] = 'admin/view_customer';
$route['admin_view_branch'] = 'admin/view_branch';
$route['admin_view_manager'] = 'admin/view_manager';
$route['admin_view_order'] = 'admin/view_order';
$route['admin_view_feedback'] = 'admin/view_feedback';
$route['admin_sales_report'] = 'admin/sales_report';
$route['admin_branch_report'] = 'admin/branch_report';
$route['admin_supply_report'] = 'admin/supply_report';

$route['admin_delete_recipe'] = 'admin/delete_recipe';
$route['admin_delete_customer'] = 'admin/delete_customer';
$route['admin_delete_branch'] = 'admin/delete_branch';
$route['admin_delete_manager'] = 'admin/delete_manager';
$route['admin_delete_ingredient'] = 'admin/delete_ingredient';

$route['admin_activate_recipe'] = 'admin/activate_recipe';
$route['admin_activate_customer'] = 'admin/activate_customer';
$route['admin_activate_branch'] = 'admin/activate_branch';
$route['admin_activate_manager'] = 'admin/activate_manager';

$route['admin_create_recipe'] = 'admin/create_recipe';
$route['admin_add_branch'] = 'admin/add_branch';
$route['admin_add_manager'] = 'admin/add_manager';
$route['admin_add_ingredient'] = 'admin/add_ingredient';

$route['admin_update_recipe'] = 'admin/update_recipe';
$route['admin_edit_branch'] = 'admin/edit_branch';
$route['admin_edit_manager'] = 'admin/edit_manager';
$route['admin_edit_password'] = 'admin/edit_password';
$route['admin_upload_recipe_image'] = 'admin/upload_recipe_image';

//BRANCH
$route['branch_order_view'] = 'branch/index';
$route['branch_detail_view'] = 'branch/detail_view';
$route['branch_supply_view'] = 'branch/supply_view';

$route['branch_order_complete'] = 'branch/order_complete';

$route['branch_reduce_supply'] = 'branch/reduce_supply';

$route['branch_add_supply'] = 'branch/add_supply';

$route['branch_update_supply'] = 'branch/update_supply';
$route['branch_edit_password'] = 'branch/edit_password';

//CUSTOMER
$route['home'] = 'customer/index';
$route['browse_recipe'] = 'customer/browse_recipe';
$route['choose_region'] = 'customer/view_region';
$route['view_recipe'] = 'customer/view_recipe';
$route['view_profile'] = 'customer/view_profile';
$route['view_cart'] = 'customer/view_cart';
$route['delete_cart_item'] = 'customer/delete_cart_item';
$route['count_decrease'] = 'customer/item_count_decrease';
$route['count_increase'] = 'customer/item_count_increase';
$route['edit_count'] = 'customer/edit_item_count';
$route['edit_profile'] = 'customer/edit_profile';
$route['edit_password'] = 'customer/edit_password';