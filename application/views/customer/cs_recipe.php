<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>KK | Recipe Browsing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/cs_recipe.css">

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
      <div class="row no-gutters">
      <div class="col-lg-4">
        <h1>Cuisine/Country</h1>
      </div>
      <div class="col-lg-4 dropdown ml-auto text-right">
        <button class="btn btn-dark dropdown-toggle dd-style" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Switch Cuisines
        </button>
        <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item disabled" href="#">Eastern Cuisines</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item only" href="#">China</a>
          <a class="dropdown-item only" href="#">India</a>
          <a class="dropdown-item only" href="#">Japan</a>
          <a class="dropdown-item only" href="#">Philippines</a>
          <a class="dropdown-item only" href="#">South Korea</a>
          <a class="dropdown-item only" href="#">Thailand</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item disabled" href="#">Western Cuisines</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item only" href="#">France</a>
          <a class="dropdown-item only" href="#">Greece</a>
          <a class="dropdown-item only" href="#">Italy</a>
          <a class="dropdown-item only" href="#">Mexico</a>
          <a class="dropdown-item only" href="#">Spain</a>
          <a class="dropdown-item only" href="#">USA</a>
        </div>
      </div><!-- End of Dropdown-->
      </div><!-- End of Row-->
      <div class="container-fluid padding">
        <div class="card-content">
          <div>
        			<div class="card border-dark" style="max-width:17rem;">
                <a href="<?php echo site_url('user/load_recipe'); ?>"><img class="card-img-top" src="img/team1.png"  height="180px"></a>
        				<div class="card-body">
        					<h3 class="card-title">Recipe-Name</h3>
                  <h6 class="card-subtitle">By UserName</h6>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                    </div>
                    <div class="col-6" style="text-align:right;">
                      <span class="fa fa-clock-o">3 h</span>
                    </div>
                  </div>
                </div>
              </div>
          </div><!-- End of A Card -->
        </div><!-- End of Card Wrapper -->
      </div><!-- End of container-fluid -->
    </div><!-- End of Container-->
    <footer class="container-fluid navbar-fixed-bottom">
      <div class="container">
        <h6>Copyright &copy; 2019 RLC Company. All Rights Reserved</h6>
      </div>
    </footer>
  </body>
</html>
