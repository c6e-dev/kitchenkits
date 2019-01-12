<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>KK | Recipe Viewing</title>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
  	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/popper.min.js"></script>
  	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/recipe-view.css">

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?php echo base_url();?>">
        <img src="<?php echo base_url('/assets/img/newNav.png'); ?>" alt="" width="140px" height="50px">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-des">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
          </li>
        </ul>
        <ul class="navbar-nav nav-des">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('user/load_login');?>">Sign In</a>
          </li>
          <li id="sign-up" class="nav-item">
            <a class="nav-link" href="<?php echo site_url('user/register_view');?>">Sign Up</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container padding">
      <div class="row">
        <div class="col-lg-5 food-img">
          <img src="<?php echo base_url('/assets/img/food/east/japan.jpg'); ?>" alt="" width="500px" height="520px">
        </div>
        <div class="col-lg-6  offset-lg-1 desc-styles">
          <h2>Recipe-Name</h2>
          <h5>By: User-Name</h5>
          <hr>
          <p>"Short Description about the recipe Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
          <hr>
          <p><strong>SERVES</strong>&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;<strong>COOKS IN</strong>&nbsp;&nbsp;&nbsp;55 MINUTES&nbsp;&nbsp;&nbsp;<strong>DIFFICULTY</strong>&nbsp;&nbsp;&nbsp;EASY-PEASY</p>
          <hr>
        </div>
      </div>
    </div>

    <div class="container">
      <hr>
      <div class="row">
        <div class="col-lg-3">
          <h4>Ingredients</h4>
          <ul class="list-group">
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
            <li class="list-group-item">Qty + Ingredients-Name</li>
          </ul>
        </div>
        <div class="col-lg-8 offset-lg-1">
          <h4>Directions</h4>
          <p>1. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p>2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
    </div>

    <div class="container">
      <hr>
      <h4>Comments</h4>
    </div>

    <footer class="container-fluid navbar-fixed-bottom">
      <div class="container">
        <h6>Copyright &copy; 2019 RLC Company. All Rights Reserved</h6>
      </div>
    </footer>
</body>
</html>
