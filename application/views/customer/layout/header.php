<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kitchen Kits</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-red-light layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-header">
          <a href="<?php echo site_url('user')?>" class="navbar-brand"><b>Kitchen Kits</b></a>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo site_url('customer/view_cart'); ?>">
                <?php 
                  if ($cart!=NULL) {
                    ?>
                      <i class="fa fa-shopping-cart"></i>
                      <span class="label label-warning"><?php echo $count[0]->od_id_count;?></span>
                    <?php
                  }else{
                    ?>
                      <i class="fa fa-shopping-cart"></i>
                    <?php
                  }
                ?>
                
              </a>
            </li>
            <li class="dropdown user user-menu">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['user'];?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
                  <p><?php echo $_SESSION['user'];?></p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a class="btn btn-default btn-flat" data-target="#change_pass" data-toggle="modal">Change Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo site_url('user/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>