<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Kitchen Kits | Sign In</title>

  <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/raleway.css');?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css');?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/sanspro.css');?>">

  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/login_style.css')?>">
  <style>
    .bg-image {
      background-image: url(<?php echo base_url('assets/img/Kitchen_BG.jpg');?>);

      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body class="bg-image">

<div class="container">
   <section id="formHolder">
      <div class="row">
         <div class="col-sm-6 brand"> <!-- Brand Box -->
            <!-- <a href="<?php echo base_url('home'); ?>" class="logo">Home</a> -->
            <div class="heading">
               <h2><a style="color:white; text-decoration:none;"href="<?php echo base_url(); ?>">Kitchen Kits</a></h2>
            </div>
            <!-- <div class="success-msg">
               <p>Congratulations! You Are Now Registered</p>
               <a href="#" class="profile">Your Profile</a>
            </div> -->
         </div>
         <div class="col-sm-6 form"><!-- Form Box -->
            <div class="login form-piece">
              <form action="<?php echo site_url('user/login'); ?>" method="post">
                <?php
                  $error_msg = $this->session->flashdata('error_msg');
                  if ($error_msg) {
                    ?>
                      <div style="font-size: 12px; color: red; text-align: center;">
                        <?php echo $error_msg; ?>
                      </div>
                    <?php
                  }
                ?>
                <div class="form-group has-feedback">
                  <input type="text" name="username" class="" placeholder="Username">
                  <span class="glyphicon glyphicon-envelope form-control-feedback" style="color: gray"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" name="password" class="" placeholder="Password">
                  <span class="glyphicon glyphicon-lock form-control-feedback" style="color: gray"></span>
                </div>
                <br>
                <div class="row">
                  <div class="col-xs-4">
                    <a href="<?php echo site_url('register'); ?>" class="btn btn-info btn-block btn-flat text-center">Sign Up</a>
                  </div>
                  <div class="col-xs-4"></div>
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                  </div>
                </div>
                <div class="row s-media">
                  <div class="col-xs-12">
                    <a href="<?=$authUrl?>" class="btn btn-primary btn-block btn-flat fb">Log in with Facebook</a>
                  </div>
                </div>
             
              </form>
            </div><!-- End Login Form -->
         </div>
      </div>
   </section>
   <footer>
      <p>
        <a style="color: white">Kitchen Kits &copy; 2018</a>
      </p>
   </footer>
</div>

  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script src="assets/js/index.js"></script> -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>

</body>
</html>
