<!DOCTYPE html>
<html>
<head>
	<title>Kitchen Kits</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  	<link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/fontawesome-stars-o.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/styles.css">
</head>
<body>
	<nav id="nav-shadow" class="navbar navbar-expand-md flex-column fixed-top bg-white">
		<a class="navbar-brand align-self-center m-0 pb-3 position-md-absolute pb-md-0" href="#">
			<img id="c-logo" src="<?php echo base_url();?>/assets/img/logo-lg.png" width="900px" height="120px">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
			aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-md-center w-100" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a id="nav-link" href="<?php echo site_url();?>">HOME<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a id="nav-link" href="<?php echo site_url('customer/view_region'); ?>">RECIPES</a>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link" href="#order">ORDER</a>
				</li> -->
				<?php
					if (isset($_SESSION['logged_in'])) {
						if ($_SESSION['utype'] == 1) {
							?>
								<li class="nav-item">
									<a id="nav-link" href="<?php echo site_url('admin');?>">DASHBOARD</a>
								</li>
								<li class="nav-item">
									<a id="nav-link" href="<?php echo site_url('user/logout');?>">LOG OUT</a>
								</li>
							<?php
						}elseif ($_SESSION['utype'] == 2) {
							?>
								<li class="nav-item">
									<a id="nav-link" href="<?php echo site_url('branch');?>">DASHBOARD</a>
								</li>
								<li class="nav-item">
									<a id="nav-link" href="<?php echo site_url('user/logout');?>">LOG OUT</a>
								</li>
							<?php
						}else{
							?>
								<li class="nav-item">
									<a id="nav-link" href="<?php echo site_url('customer/view_profile');?>">PROFILE</a>
								</li>
								<li class="nav-item">
									<a id="nav-link" href="<?php echo site_url('user/logout');?>">LOG OUT</a>
								</li>
							<?php
						}
					}
					else{
						?>
							<li class="nav-item">
								<a id="nav-link" href="<?php echo site_url('login');?>">SIGN IN</a>
							</li>
							<li class="nav-item">
								<a id="nav-link" href="<?php echo site_url('register');?>">SIGN UP</a>
							</li>
						<?php
					}
				?>
			</ul>
		</div>
	</nav>

	<div>
		<div class="v-header last-content">
			<video autoplay="true" loop="true">
				<source src="<?php echo base_url();?>/assets/vid/video-bg.mp4" type="video/mp4">
			</video>
		</div>
		<div class="v-header-content">
			<a class="btn btn-default" href="<?php echo site_url('customer/view_region'); ?>"><span>GET STARTED</span></a>
		</div>
	</div>

	<!-- Wekkly Favorites -->
	<?php
		if ($top_of_the_month!=NULL) {
			?>
				<h1 class="title-designs">Monthly Favorites</h1>
				<div class="container-fluid new-div padding last-content" id="top-scroll">
					<div class="card-content">
						<?php
							foreach ($top_of_the_month as $top) {
								if ($top[0]->re_stat == 'A') {
									?>
									<div class="card wew">
										<a href="<?php echo site_url('view_recipe/'.'?id='.$top[0]->re_id); ?>"><img class="card-img-top" src="<?php echo base_url('Recipe_Folder/'.$top[0]->re_name.'/'.$top[0]->re_img); ?>" height="180px"></a>
										<div id="ddingpa" class="card-body">
											<h4 class="card-title title-design"><?php echo $top[0]->re_name;?></h4>
										</div>
										<div id="ddingpa" class="card-footer">
											<div class="row">
												<div class="col-12 rating-center" style="padding-top:0.5rem;">
													<select class="top_recipe_rating" id="toprating<?php echo $top[0]->re_id;?>" topreview-id="<?php echo $top[0]->re_id;?>" data-top-rating="<?php echo round($top[0]->average, 1);?>" autocomplete="off">
							                            <option value="1">1</option>
							                            <option value="2">2</option>
							                            <option value="3">3</option>
							                            <option value="4">4</option>
							                            <option value="5">5</option>
						               </select>
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
			<?php
		}
	?>
	<!-- Recommendation -->
	<?php
		if (isset($_SESSION['logged_in']) && $_SESSION['utype'] == 3 && $recommended_recipe!=NULL) {
			?>
				<h1 class="title-designs">Recommended for You</h1>
				<div class="container-fluid new-div padding last-content" id="recommend-scroll">
					<div class="card-content">
						<?php
							foreach ($recommended_recipe as $rec) {
								if ($customerdata[0]->cs_religion != '') {
									if ($rec[0]->re_stat == 'A' && $rec[0]->re_rel != $customerdata[0]->cs_religion) {
										?>
										<div class="card wew">
											<a href="<?php echo site_url('view_recipe/'.'?id='.$rec[0]->re_id); ?>"><img class="card-img-top" src="<?php echo base_url('Recipe_Folder/'.$rec[0]->re_name.'/'.$rec[0]->re_img); ?>" height="180px"></a>
											<div id="ddingpa" class="card-body">
												<h4 class="card-title title-design"><?php echo $rec[0]->re_name;?></h4>
											</div>
											<div id="ddingpa" class="card-footer">
												<div class="row">
													<div class="col-12 rating-center" style="padding-top:0.5rem;">
														<select class="recipe_rating" id="rating<?php echo $rec[0]->re_id;?>" review-id="<?php echo $rec[0]->re_id;?>" data-rating="<?php echo round($rec[0]->average, 1);?>" autocomplete="off">
								                            <option value="1">1</option>
								                            <option value="2">2</option>
								                            <option value="3">3</option>
								                            <option value="4">4</option>
								                            <option value="5">5</option>
							                          	</select>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
								}else{
									if ($rec[0]->re_stat == 'A') {
										?>
										<div class="card wew">
											<a href="<?php echo site_url('view_recipe/'.'?id='.$rec[0]->re_id); ?>"><img class="card-img-top" src="<?php echo base_url('Recipe_Folder/'.$rec[0]->re_name.'/'.$rec[0]->re_img); ?>" height="180px"></a>
											<div id="ddingpa" class="card-body">
												<h4 class="card-title title-design"><?php echo $rec[0]->re_name;?></h4>
											</div>
											<div id="ddingpa" class="card-footer">
												<div class="row">
													<div class="col-12 rating-center" style="padding-top:0.5rem;">
														<select class="recipe_rating" id="rating<?php echo $rec[0]->re_id;?>" review-id="<?php echo $rec[0]->re_id;?>" data-rating="<?php echo round($rec[0]->average, 1);?>" autocomplete="off">
								                            <option value="1">1</option>
								                            <option value="2">2</option>
								                            <option value="3">3</option>
								                            <option value="4">4</option>
								                            <option value="5">5</option>
							                          	</select>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
								}
							}
						?>
					</div>
				</div>
			<?php
		}
	?>

	<footer>
		<div class="container">
			<h6>Copyright &copy; 2019 RLC Company. All Rights Reserved</h6>
		</div>
	</footer>
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/js/jquery.barrating.js');?>"></script>
	<script src="<?php echo base_url('assets/js/kitchenkitsrating.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
	<script type="text/javascript">
	    $(function(){
	      $('#top-scroll').slimScroll({
	        height: '400px'
	      });
	      $('#recommend-scroll').slimScroll({
	        height: '400px'
	      });
	    });
	  </script>
</body>
</html>
