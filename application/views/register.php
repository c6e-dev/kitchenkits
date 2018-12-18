<!-- <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kitchen Kits | Sign Up</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css');?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Kitchen Kits</b></a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Register A New Account</p>
    <?php echo validation_errors(); ?>
    <form action="<?php echo site_url('user/register'.'?id=3'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6" style="padding-right: 5px">
          <div class="form-group">
            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
          </div>
        </div>
        <div class="col-xs-6" style="padding-left: 5px">
          <div class="form-group">
            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
          </div>
        </div>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="emailaddr" id="emailaddr" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="haddress" id="haddress" class="form-control" placeholder="Address">
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I Agree To The <a href="#">Terms</a>
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
      </div>
    </form>
    <a href="<?php echo site_url('user'); ?>" class="text-center">I Already Have An Account</a>
  </div>
</div>

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
</html> -->

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Kitchen Kits | Sign Up</title>
   <link rel="shortcut icon" href="<?=base_url()?>assets/images/kikay_icon.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>"/>
  <link href="assets/css/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>"/>

  
</head>

<body style="background: url('assets/images/bg/bg-10.jpg'); background-repeat: no-repeat; background-size: cover;">

  
<div class="container">
   <section id="formHolder">

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
            <a href="<?php echo base_url('home'); ?>" class="logo">Home</a>

            <div class="heading">
               <h2>Kikay Kit</h2>
               <p>------------</p>
            </div>

            <div class="success-msg">
               <p>Great! You have created your profile</p>
               <a href="#" class="profile">View Profile</a>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">
 
            <!-- Signup Form -->
            <div class="form-piece switched">

               <form action="<?php echo base_url('register'.'?id=2'); ?>" id='login' method='post' style="top: 113%;">
                  <span class="title">Client Registration</span>
                  
                  <div class="form-group">
                     <label for="company">Company Name</label>
                     <input type='text' name='company' required>
                     <span class="error"></span>
                  </div>
                  <div class="form-group">
                     <label for="address">Address</label>
                     <input type='text' name='address' required>
                     <span class="error"></span>
                  </div>
                  <div class="form-group">
                     <label for="mobile">Mobile Number</label>
                     <input type='text' name='mobile' required>
                     <span class="error"></span>
                  </div>
                  <div class="form-group">
                     <label for="telephone">Telephone Number</label>
                     <input type='text' name='telephone' required>
                     <span class="error"></span>
                  </div>
                  <div class="form-group" style="position:relative">
                    <label>Opening Time: <i class="fa fa-clock-o"></i></label>
                    <input type='text' class="form-control" id='open-time'/>
                  </div>
                  <div class="form-group">
                    <label>Closing Time: <i class="fa fa-clock-o"></i></label>
                    <input type='text' class="form-control" id='close-time'/>
                  </div>
                  <?php
                  $day = array("Sunday","Monday","Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                  ?>
                  <div class="row form-group" style="margin-top:50px">
                      <div class="col col-md-4"><label>Open Days:</label></div>
                      <div class="col col-md-8">  
                          <div class="form-check">
                              <div class="checkbox">
                              <?php
                                  for($i=0;$i<count($day);$i++)
                                  {
                              echo    '<div class="row checkbox">
                                        <input type="checkbox" name="days[]" value="'.($i+1).'" class="form-check-input col-sm-3"><span class="col-sm-3" style="font-size:12px">'.$day[$i].'</span>
                                      </div>';
                                  }
                              ?>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                     <label for="username"> Username</label>
                     <input type='text' name='username' required>
                     <span class="error"></span>
                  </div>
                  
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type='password' name='password' required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="confirmpass">Confirm Password</label>
                     <input type='password' name='confirmpass' required>
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                      <input style="cursor:pointer" type='submit' value='Sign Up'>
                     <a href="#" class="switch">Register as Customer</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->

            <!-- Signup Form -->
            <div class="signup form-piece">
               <form action="<?php echo base_url('register'.'?id=4'); ?>" method='post'>
                  <span class="title">Customer Registration</span>
              
                  <div class="form-group">
                     <label for="firstname"> First Name</label>
                     <input type='text' name='firstname' required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="lastname"> Last Name</label>
                     <input type='text' name='lastname' required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="address"> Address</label>
                     <input type='text' name='address' required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="contact">Contact</label>
                     <input type='text' name='contact' required>
                  </div>
                  <div class="form-group">
                     <select name="gender" class="dropdown dropform">
                        <option class="dropdown" value="0" hidden selected>Gender</option>
                        <option class="dropdown" value="male">Male</option>
                        <option class="dropdown" value="female">Female</option>
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="username"> Username</label>
                     <input type='text' name='username' required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type='password' name='password' required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="confirmpass">Confirm Password</label>
                     <input type='password' name="confirmpass" required>
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                    <input style="cursor:pointer" type='submit' value='Sign Up'>
                    <a href="#" class="switch">Register as Client</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>


   <footer>
      <p style="color:white">
        <a>Kikay Kit &copy;2018</a>
      </p>
   </footer>

</div>
   
<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js');?>" ></script>  
<script src="<?php echo base_url('assets/js/popper.js');?>" ></script>  
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" ></script>
<script src="<?php echo base_url('assets/js/datetimepicker/moment/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.min.js');?>"></script>
<!-- INPUT MASK -->
<script src="<?php echo base_url('assets/js/input-mask/jquery.inputmask.js"');?>"></script>
<script src="<?php echo base_url('assets/js/input-mask/jquery.inputmask.extensions.js"');?>"></script>
<script src="<?php echo base_url('assets/js/input-mask/jquery.inputmask.numeric.extensions.js"');?>"></script>
<script src="<?php echo base_url('assets/js/input-mask/jquery.inputmask.date.extensions.js"');?>"></script>
<script src="<?php echo base_url('assets/js/input-mask/jquery.inputmask.phone.extensions.js"');?>"></script>
<script  src="assets/js/index.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
         $('#open-time').datetimepicker({
              format: 'HH:mm',
              stepping: 30,
              useCurrent:'day',
              icons: {
                  up: "fa fa-toggle-up fa-2x",
                  down: "fa fa-toggle-down fa-2x",
                  next: 'fa fa-toggle-right fa-2x',
                  previous: 'fa fa-toggle-left fa-2x'
              }
          });
          $('#close-time').datetimepicker({
              format: 'HH:mm',
              stepping: 30,
              useCurrent:'day',
              icons: {
                  up: "fa fa-toggle-up fa-2x",
                  down: "fa fa-toggle-down fa-2x",
                  next: 'fa fa-toggle-right fa-2x',
                  previous: 'fa fa-toggle-left fa-2x'
              }
          });
          $('#open-time').keypress(function(e){
              return false;
          })
          $('#close-time').keypress(function(e){
              return false;
          })
          $('#open-time').keydown(function(e) {
              if ( event.which == 8 ) {
                 event.preventDefault();
              }
          });
          $('#close-time').keydown(function(e) {
              if ( event.which == 8 ) {
                 event.preventDefault();
              }
          });
          $('input[name="mobile"]').inputmask("(+99)999 999 9999", {"placeholder": "(+XX) XXX XXX XXXX"});
          $('input[name="contact"]').inputmask("(+99)999 999 9999", {"placeholder": "(+XX) XXX XXX XXXX"});
          $('input[name="telephone"]').inputmask("999 99 99", {"placeholder": "XXX XX XX"});
      });
   </script>
</body>

</html>

