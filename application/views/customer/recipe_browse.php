<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Kitchen Kits</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/fontawesome-stars.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/fontawesome-stars-o.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/cs_recipe.css">

  </head>
  <body>
  <div class="wrapping">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?php echo base_url();?>">
        <img src="<?php echo base_url('/assets/img/newNav.png'); ?>" alt="" width="140px" height="50px">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-des">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url();?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('customer/view_region');?>">Recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
          </li>
        </ul>
        <ul class="navbar-nav nav-des">
          <?php
            if (isset($_SESSION['logged_in'])) {
              if ($_SESSION['utype'] == 3) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('customer/view_profile');?>"><?php echo $_SESSION['user']; ?></a>
                  </li>
                <?php
              }
              elseif ($_SESSION['utype'] == 2) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('branch');?>"><?php echo $_SESSION['user']; ?></a>
                  </li>
                <?php
              }
              else{
                ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin');?>"><?php echo $_SESSION['user']; ?></a>
                  </li>
                <?php
              }
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
          <h1><?php echo $selected_country[0]->co_name;?></h1>
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
            <a class="dropdown-item disabled">Western Cuisines</a>
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
      <div class="container-fluid padding last-content">
        <div class="card-content">
          <?php
            if ($recipe!=NULL) {
              foreach ($recipe as $rcp) {
                ?>
                  <div class="card border-dark">
                    <a href="<?php echo site_url('customer/view_recipe'.'?id='.$rcp->re_id); ?>"><img class="card-img-top" src="<?php echo base_url('Recipe_Folder/'.$rcp->re_name.'/'.$rcp->re_img); ?>" height="220px"></a>
                    <div class="card-body">
                      <h4 class="card-title"><?php echo $rcp->re_name; ?></h4>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-4" style="padding-top:0.5rem;">
                          <select id="example-fontawesome-o" name="rating" data-current-rating="3.6" autocomplete="off">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>
                        <div class="col-4" style="text-align:right;">
                          <p><span class="fa fa-clock-o"> <?php echo $rcp->re_cooktime; ?> min</span></p>
                        </div>
                        <div class="col-4" style="text-align:center;">
                          <p><span class="fa fa-cutlery"> Serve <?php echo $rcp->re_serves; ?></span></p>
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
    <footer>
      <div class="container">
        <h6>Copyright &copy; 2019 RLC Company. All Rights Reserved</h6>
      </div>
    </footer>
  </div>
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/js/jquery.barrating.js');?>"></script>
    <script src="<?php echo base_url('assets/js/kitchenkitsrating.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/popper.min.js"></script>
  </body>
</html>
