<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Kitchen Kits</title>
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
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="<?php echo base_url();?>">
        <img src="<?php echo base_url('/assets/img/newNav.png'); ?>" alt="" width="140px" height="50px">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-des">
          <li class="nav-item">
            <a id="white-color" class="nav-link" href="<?php echo site_url();?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a id="white-color" class="nav-link" href="<?php echo site_url('customer/browse_recipe'.'?id='.$recipe[0]->re_cid);?>">Menu</a>
          </li>
          <li class="nav-item">
            <a id="white-color" class="nav-link" href="#">Order</a>
          </li>
        </ul>
        <ul class="navbar-nav nav-des">
          <?php
            if (isset($_SESSION['logged_in'])) {
              ?>
                <li class="nav-item">
                  <a id="white-color" class="nav-link" href="<?php echo site_url('customer/view_profile');?>"><?php echo $_SESSION['user']; ?></a>
                </li>
              <?php
            }
            else{
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('user');?>">Sign In</a>
                </li>
                <li id="sign-up" class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('user/register_view');?>">Sign Up</a>
                </li>
              <?php
            }
          ?>
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
          <a class="dropdown-item disabled">Eastern Cuisines</a>
          <div class="dropdown-divider"></div>
          <?php
            foreach ($country as $qui) {
              if ($qui->cor_id == 1) {
                ?>
                  <a class="dropdown-item only" href="<?php echo site_url('customer/browse_recipe'.'?id='.$qui->co_id);?>"><?php echo $qui->co_name;?></a>
                <?php
              }
            }
          ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item disabled" href="#">Western Cuisines</a>
          <div class="dropdown-divider"></div>
          <?php
            foreach ($country as $qui) {
              if ($qui->cor_id == 2) {
                ?>
                  <a class="dropdown-item only" href="<?php echo site_url('customer/browse_recipe'.'?id='.$qui->co_id);?>"><?php echo $qui->co_name;?></a>
                <?php
              }
            }
          ?>
        </div>
      </div><!-- End of Dropdown-->
      </div><!-- End of Row-->
      <div class="container-fluid padding">
        <div class="card-content">
          <?php
            if ($recipe!=NULL) {
              foreach ($recipe as $rcp) {
                ?>
                  <div class="card border" style="max-width:17rem;">
                    <a href="<?php echo site_url('customer/view_recipe'.'?id='.$rcp->re_id); ?>"><img class="card-img-top" src="img/team1.png"  height="180px"></a>
                    <div class="card-body">
                      <h3 class="card-title"><?php echo $rcp->re_name; ?></h3>
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
                          <span class="fa fa-clock-o"> <?php echo $rcp->re_cooktime; ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
              }
            }
          ?>
        </div>
      </div>
    </div><!-- End of Container-->
    <footer class="container-fluid navbar-fixed-bottom">
      <div class="container">
        <h6>Copyright &copy; 2019 RLC Company. All Rights Reserved</h6>
      </div>
    </footer>
  </body>
</html>
