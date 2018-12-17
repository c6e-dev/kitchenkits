<!DOCTYPE html>
<html>
<head>
	<title>Kitchen Kits</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/styles.css">
</head>
<body>
	<nav class="navbar navbar-expand-md flex-column fixed-top navbar-light bg-white">
		<a class="navbar-brand align-self-center m-0 pb-3 position-md-absolute pb-md-0" href="#"><img id="c-logo" src="<?php echo base_url();?>/assets/img/KKLogo.png" width="900" height="120"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-md-center w-100" id="navbarNav">
			<ul class="navbar-nav text-center">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home<span class="sr-only">(Current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Menu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Order Now</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('user/load_login');?>">Log In</a>
				</li>
			</ul>
		</div>
	</nav>
	<div>
		<div class="v-header">
			<video autoplay="true" loop="true">
				<source src="<?php echo base_url();?>/assets//vid/video-bg.mp4" type="video/mp4">
			</video>
			<div class="v-header-content">
				<h2>Insert Tagline</h2>
				<button type="button" class="btn btn-primary">Get Started</button>
			</div>
		</div>
	</div>
</body>
</html>