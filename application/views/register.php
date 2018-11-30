<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Kitchen Kits</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new account</p>

    <form method="post" id="registrationform">
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
        <input type="email" name="emailadd" id="emailaddr" class="form-control" placeholder="Email">
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
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    

    <a href="<?php echo site_url('user'); ?>" class="text-center">I already have an account</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
  // $('#changepasswordform').submit( function(){
  //   var srnm = $('#username').val();
  //   var pswrd = $('#password').val();
  //   var cpswrd = $('#cpassword').val();
  //   var fnm = $('#fname').val();
  //   var lnm = $('#lname').val();
  //   var mlddr = $('#emailaddr').val();
  //   var hddrss = $('#haddress').val();
  //   $.ajax({
  //     url: "<?php echo site_url('user/register'); ?>",
  //     method: 'POST',
  //     data: {
  //         username: srnm,
  //         password: pswrd,
  //         cpassword: cpswrd,
  //         fnm: fname,
  //         lnm: lname,
  //         mlddr: emailaddr,
  //         hddrss: haddress
  //     },
  //     dataType: 'JSON',
  //     success: function(data){
  //         if (data.status) {
  //             alert("Password successfully updated!");
              
  //             // location.reload();
  //         }else{
  //             $('.alert').css('display', 'block');
  //             $('.alert').html(data.notif);
  //         }
  //     },
  //     error: function(){
  //         alert('ERROR!');
  //     }
  //   });return false;
  // });
</script>
</body>
</html>
