<!DOCTYPE html>
<html style="width: 100%">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KK | Branch Manager</title>
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

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo site_url('user');?>" class="logo">
        <span class="logo-mini"><b>RLC</b></span>    
        <span class="logo-lg"><b>Kitchen Kits: </b>Branch</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle Navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning" id="notif_count"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header"></li>
                <li>
                  <ul class="menu">
                    
                  </ul>
                </li>
                <li class="footer"><a href="<?php echo site_url('admin/branch_report');?>">View all</a></li>
              </ul>
            </li>
            <li class="dropdown user user-menu">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <!-- <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="user-image" alt="User Image"> -->
                <span class="hidden-xs"><?php echo $_SESSION['user'];?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <!-- <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image"> -->
                  <p><?php echo $_SESSION['name'];?><small><?php echo $_SESSION['user'];?></small></p>
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