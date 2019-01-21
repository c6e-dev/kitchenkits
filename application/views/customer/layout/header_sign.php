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
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/popper.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/customer_header.css');?>">

</head>

<body class="hold-transition skin-red-light layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
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
              <a class="nav-link" id="white-color" href="#">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="white-color">Order</a>
            </li>
          </ul>
          <ul class="navbar-nav nav-des" id="left-float">
            <li class="nav-item">
              <a id="white-color" class="nav-link" href="<?php echo site_url('user');?>">Sign In</a>
            </li>
            <li id="sign-up" class="nav-item">
              <a id="white-color" class="nav-link" href="<?php echo site_url('user/register_view');?>">Sign Up</a>
            </li>

          </ul>
        </div>
      </nav>

    </header>
