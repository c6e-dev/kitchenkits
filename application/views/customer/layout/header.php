<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kitchen Kits</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <!-- Added Styles for New Header -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/pace/pace.min.css');?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/customer_header.css');?>">
  <style type="text/css">
    .pace-running{
      opacity: 0.4;
      background-color: #000;
    }
  </style>
</head>

<body class="hold-transition skin-red-light layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <!-- Old Header
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
      -->
      <!-- New Header-->
      <nav class="navbar navbar-expand-lg navbar-light" id="navig">
        <a class="navbar-brand" href="<?php echo base_url();?>">
          <img src="<?php echo base_url('/assets/img/newNav.png'); ?>" alt="" width="140px" height="50px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto nav-des">
            <li class="nav-item">
              <a class="nav-link" id="white-color" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="white-color" href="<?php echo site_url('customer/view_region'); ?>">Menu</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#" id="white-color">Order</a>
            </li> -->
          </ul>
          <ul class="nav navbar-nav" id="left-float">
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
                <!-- <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="user-image" alt="User Image"> -->
                <span class="hidden-xs"><?php echo $_SESSION['user'];?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li class="user-header">
                  <!-- <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image"> -->
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
