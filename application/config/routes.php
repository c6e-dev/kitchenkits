<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// USER
$route['register'] = 'User/register_view';
$route['login'] = 'User';

$route['default_controller'] = 'Customer';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//ADMIN
$route['admin_dashboard'] = 'Admin';
$route['admin_recipe_view'] = 'Admin/recipe_view';
$route['admin_customer_view'] = 'Admin/customer_view';
$route['admin_branch_view'] = 'Admin/branch_view';
$route['admin_manager_view'] = 'Admin/manager_view';
$route['admin_order_view'] = 'Admin/order_view';
$route['admin_feedback_view'] = 'Admin/feedback_view';
$route['admin_ingredient_view'] = 'Admin/ingredient_view';

$route['admin_view_recipe'] = 'Admin/view_recipe';
$route['admin_view_customer'] = 'Admin/view_customer';
$route['admin_view_branch'] = 'Admin/view_branch';
$route['admin_view_manager'] = 'Admin/view_manager';
$route['admin_view_order'] = 'Admin/view_order';
$route['admin_view_feedback'] = 'Admin/view_feedback';
$route['admin_sales_report'] = 'Admin/sales_report';
$route['admin_branch_report'] = 'Admin/branch_report';
$route['admin_supply_report'] = 'Admin/supply_report';

$route['admin_delete_recipe'] = 'Admin/delete_recipe';
$route['admin_delete_customer'] = 'Admin/delete_customer';
$route['admin_delete_branch'] = 'Admin/delete_branch';
$route['admin_delete_manager'] = 'Admin/delete_manager';
$route['admin_delete_ingredient'] = 'Admin/delete_ingredient';

$route['admin_activate_recipe'] = 'Admin/activate_recipe';
$route['admin_activate_customer'] = 'Admin/activate_customer';
$route['admin_activate_branch'] = 'Admin/activate_branch';
$route['admin_activate_manager'] = 'Admin/activate_manager';

$route['admin_create_recipe'] = 'Admin/create_recipe';
$route['admin_add_branch'] = 'Admin/add_branch';
$route['admin_add_manager'] = 'Admin/add_manager';
$route['admin_add_ingredient'] = 'Admin/add_ingredient';

$route['admin_update_recipe'] = 'Admin/update_recipe';
$route['admin_edit_branch'] = 'Admin/edit_branch';
$route['admin_edit_manager'] = 'Admin/edit_manager';
$route['admin_edit_password'] = 'Admin/edit_password';
$route['admin_upload_recipe_image'] = 'Admin/upload_recipe_image';

//BRANCH
$route['branch_order_view'] = 'Branch';
$route['branch_detail_view'] = 'Branch/detail_view';
$route['branch_supply_view'] = 'Branch/supply_view';

$route['branch_order_complete'] = 'Branch/order_complete';

$route['branch_reduce_supply'] = 'Branch/reduce_supply';

$route['branch_add_supply'] = 'Branch/add_supply';

$route['branch_update_supply'] = 'Branch/update_supply';
$route['branch_edit_password'] = 'Branch/edit_password';

//CUSTOMER
$route['home'] = 'customer';
$route['browse_recipe'] = 'Customer/browse_recipe';
$route['choose_region'] = 'Customer/view_region';
$route['view_recipe'] = 'Customer/view_recipe';
$route['view_profile'] = 'Customer/view_profile';
$route['view_cart'] = 'Customer/view_cart';
$route['delete_cart_item'] = 'Customer/delete_cart_item';
$route['count_decrease'] = 'Customer/item_count_decrease';
$route['count_increase'] = 'Customer/item_count_increase';
$route['edit_count'] = 'Customer/edit_item_count';
$route['edit_profile'] = 'Customer/edit_profile';
$route['edit_password'] = 'Customer/edit_password';