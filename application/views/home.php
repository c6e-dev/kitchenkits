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
	<nav class="navbar navbar-expand-md flex-column fixed-top bg-white stroke">
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
					<a class="nav-link" href="<?php echo base_url();?>">HOME<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#menu">MENU</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#order">ORDER</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('user/load_login');?>">SIGN IN</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('user/register_view');?>">SIGN UP</a>
				</li>
			</ul>
		</div>
	</nav>

	<div>
		<div class="v-header">
			<video autoplay="true" loop="true">
				<source src="<?php echo base_url();?>/assets/vid/video-bg.mp4" type="video/mp4">
			</video>
		</div>
		<div class="v-header-content">
			<a class="btn btn-default" href="<?php echo site_url('user/get_started'); ?>"><span>GET STARTED</span></a>
		</div>
	</div>

</body>
</html>