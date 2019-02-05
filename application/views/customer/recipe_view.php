<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Kitchen Kits</title>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width">
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
    <!-- Add icon library -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
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
            <a class="nav-link" href="<?php echo site_url('customer/view_region');?>">Recipes</a>
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
        <div class="col-lg-6">
          <h2><?php echo $recipe_info[0]->re_name; ?></h2>
          <p><strong>COOKS IN</strong>&nbsp;&nbsp;&nbsp;<?php echo $recipe_info[0]->re_cooktime; ?>&nbsp;&nbsp;&nbsp;<strong>RATINGS</strong>&nbsp;&nbsp;&nbsp;<strong>SERVINGS</strong>&nbsp;&nbsp;&nbsp;<?php echo $recipe_info[0]->re_serves; ?>&nbsp;&nbsp;&nbsp;</p>
          <hr>
          <div class="row">
            <div class="col-lg-12">
              <h4>Ingredients</h4>
              <ul class="list-group ingr">
                <?php
                  if ($recipe_ings!=NULL) {
                    foreach ($recipe_ings as $rings) {
                      echo '<li class="list-group-item">'.$rings->ig_amount.' + '.$rings->ig_name.'</li>';
                    }
                  }
                ?>
              </ul>
            </div>
            <h4 id="pads" class="product-description">Order Quantity</h4>
            <div class="col-lg-12 ingr padding">
              <div class="input-group">
                <span class="input-group-btn">
                  <button type="button" id="sub_qty" class="btn btn-md btn-flat btn-margin" disabled><i class="fa fa-minus"></i></button>
                </span>
                <input  type="text" id="val_cont" class="form-control btnn-qty" readonly>
                <button type="button" id="add_qty" class="btn btn-md btn-flat btn-margina"><i class="fa fa-plus"></i></button>
              </div>
              <input type="hidden" id="recipe_id" value="<?php echo $recipe_info[0]->re_id; ?>">
              <button type="button" id="addTo_cart" class="btn btn-dark btn-cart">Add to Cart</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 offset-lg-2 ingr padding">
          <img src="<?php echo base_url('Recipe_Folder/'.$recipe_info[0]->re_name.'/'.$recipe_info[0]->re_img); ?>" alt="" height="228px" width="400px">
        </div>
      </div>
    </div>
    <div class="container-fluid alternate">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h4>Directions</h4>
              <p class="p-style"><?php echo $recipe_info[0]->re_instruc; ?></p>
            </div>
          </div>
        </div>
    </div>
    <div class="container-fluid">
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
              <h4><strong>Write a Review</strong></h4>
              <h5 id="pads">Ratings</h5>
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
              <h5>Comment Down Below</h5>
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
    </div>

    <footer class="container-fluid navbar-fixed-bottom">
      <div class="container">
        <h6>Copyright &copy; 2019 RLC Company. All Rights Reserved</h6>
      </div>
    </footer>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/popper.min.js"></script>
    <script type="text/javascript">
      $(function(){
        document.getElementById("val_cont").value = 1;
        $('#sub_qty').on('click', function(){
          var val = $('#val_cont').val();
          if (val==2) {
            $('#sub_qty').prop("disabled", true);
          }
          var dif = val - 1;
          document.getElementById("val_cont").value = dif;
        });

        $('#add_qty').on('click', function(){
          $('#sub_qty').prop("disabled", false);
          var val = $('#val_cont').val();
          var sum = (val*1) + 1;
          document.getElementById("val_cont").value = sum;
        });

        $('#addTo_cart').on('click', function(){
          var qty = $('#val_cont').val();
          var re_id = $('#recipe_id').val();
          $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/add_to_cart'); ?>",
            data: {
              quantity: qty,
              recipe_id: re_id
            },
            dataType: 'JSON',
            success: function(data){
              console.log(data);
            },
            error: function(data){
              console.log(data);
              alert('ERROR!');
            }
          });
        });
      });
    </script>
</body>
</html>
