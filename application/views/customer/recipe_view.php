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
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url();?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('customer/browse_recipe'.'?id='.$recipe_info[0]->re_cid);?>">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
          </li>
        </ul>
        <ul class="navbar-nav nav-des">
          <?php
            if (isset($_SESSION['logged_in'])) {
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('customer/view_profile');?>"><?php echo $_SESSION['user']; ?></a>
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
      <div class="container-fluid">
        <h5><a href="<?php echo site_url('customer/browse_recipe'.'?id='.$recipe_info[0]->re_cid);?>" class="back-arrow"><span class="fa fa-arrow-left"></span> Back to Recipe Selection</a></h5>
      </div>
      <div class="row">
        <div class="col-lg-5 food-img">
          <img src="<?php echo base_url('/assets/img/food/east/japan.jpg'); ?>" alt="" width="500px" height="520px">
        </div>
        <div class="col-lg-6  offset-lg-1 desc-styles">
          <h2><?php echo $recipe_info[0]->re_name; ?></h2>
          <h5>By: User-Name</h5>
          <hr>
          <p>"Short Description about the recipe Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
          <hr>
          <p><strong>SERVES</strong>&nbsp;&nbsp;&nbsp;<?php echo $recipe_info[0]->re_serves; ?>&nbsp;&nbsp;&nbsp;<strong>COOKS IN</strong>&nbsp;&nbsp;&nbsp;<?php echo $recipe_info[0]->re_cooktime; ?>&nbsp;&nbsp;&nbsp;<strong>DIFFICULTY</strong>&nbsp;&nbsp;&nbsp;EASY-PEASY</p>
          <hr>
        </div>
      </div>
    </div>
    <div class="container-fluid alternate">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h4>Ingredients</h4>
              <ul class="list-group">
                <?php 
                  if ($recipe_ings!=NULL) {
                    foreach ($recipe_ings as $rings) {
                      echo '<li class="list-group-item">'.$rings->ig_amount.' + '.$rings->ig_name.'</li>';
                    }
                  }
                ?>
              </ul>
            </div>
            <div class="col-lg-8 offset-lg-1">
              <h4>Directions</h4>
              <p><?php echo $recipe_info[0]->re_instruc; ?></p>
            </div>
          </div>
        </div>
    </div>
    <div class="container padding">
      <h4>Share your Feedback</h4>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h5><strong>Reviews</strong></h5>
            <?php
              if ($recipe_revs!=NULL) {
                foreach ($recipe_revs as $revs) {
                  echo '<div class="container-fluid shade">
                    <h6>review by: '.$revs->cu_fname.' '.$revs->cu_lname.'</h6>
                    <p>'.$revs->cdate.'</p>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <p>'.$revs->co_me.'</p>
                  </div>';
                }
              }
            ?>
          </div>
          <div class="col-md-6">
            <div class="container-fluid border">
              <h5><strong>Write a Review</strong></h5>
              <h6 id="pads">Ratings</h6>
              <span class="rating">
                  <input type="radio" class="rating-input"
                         id="rating-input-1-5" name="rating-input-1">
                  <label for="rating-input-1-5" class="rating-star"></label>
                  <input type="radio" class="rating-input"
                         id="rating-input-1-4" name="rating-input-1">
                  <label for="rating-input-1-4" class="rating-star"></label>
                  <input type="radio" class="rating-input"
                         id="rating-input-1-3" name="rating-input-1">
                  <label for="rating-input-1-3" class="rating-star"></label>
                  <input type="radio" class="rating-input"
                         id="rating-input-1-2" name="rating-input-1">
                  <label for="rating-input-1-2" class="rating-star"></label>
                  <input type="radio" class="rating-input"
                         id="rating-input-1-1" name="rating-input-1">
                  <label for="rating-input-1-1" class="rating-star"></label>
              </span>
              <h6>Comment Down Below</h6>
              <form>
                <div class="form-group">
                   <textarea class="form-control" id="comment" rows="3">Type here...</textarea>
                </div>
                <button type="button" class="btn btn-dark post-btn" id="submit_review">Publish</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="container-fluid navbar-fixed-bottom">
      <div class="container">
        <h6>Copyright &copy; 2019 RLC Company. All Rights Reserved</h6>
      </div>
    </footer>
</body>
</html>
