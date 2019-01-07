<!DOCTYPE html>
<html>
<head>
	<title>Get Started</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/getstarted.css">
</head>
<body>
	<div class="container-fluid">
		<div class="split left">
			<h1>Western Cuisines</h1>
			<a href="javascript:unhide('trigger-a')" id="override" class="button">Learn More</a>
				<div id= "trigger-a" class="hidden">
					<div id="fill_height" class="row">
							<div id="Africa" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<img src="<?php echo base_url('/assets/img/regions/Africa.png'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Carribean" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<img src="<?php echo base_url('/assets/img/regions/Carribean.png'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="CA" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<img src="<?php echo base_url('/assets/img/regions/CA.png'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Europe" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<img src="<?php echo base_url('/assets/img/regions/Europe.png'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="NA" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<img src="<?php echo base_url('/assets/img/regions/NA.png'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="SA" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<img src="<?php echo base_url('/assets/img/regions/SA.png'); ?>" alt="" width="100px" height="100px;">
							</div>
					</div>
				</div>
		</div>


		<div class="split right">
			<h1>Eastern Cuisines</h1>
			<a href="javascript:unhide('trigger-b')" id="override" class="button">Learn More</a>
				<div id="trigger-b" class="hidden">
					<div id="fill_height" class="row">
							<div id="Asia" class="col-lg-6 region">
								<a href="#"><span></span></a>
								<img id="for-center" src="<?php echo base_url('/assets/img/regions/Asia.png'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Oceania" class="col-lg-6 region">
								<a href="#"><span></span></a>
								<img id="for-center" src="<?php echo base_url('/assets/img/regions/Oceania.png'); ?>" alt="" width="100px" height="100px;">
							</div>
					</div>
				</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/getstarted.js"></script>
</body>
</html>
