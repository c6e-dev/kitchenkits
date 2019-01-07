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
			<a href="javascript:unhide('trigger-a')" id="override" class="west-east-panel"><span></span></a>
				<div id= "trigger-a" class="hidden">
					<div id="fill_height" class="row">
							<div id="France" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1 class="odd-b">France</h1>
								<img src="<?php echo base_url('/assets/img/countries/west/France.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Greece" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1>Greece</h1>
								<img src="<?php echo base_url('/assets/img/countries/west/Greece.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Italy" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1 class="odd-b">Italy</h1>
								<img src="<?php echo base_url('/assets/img/countries/west/Italy.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Mexico" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1>Mexico</h1>
								<img src="<?php echo base_url('/assets/img/countries/west/Mexico.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Spain" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1 class="odd-b">Spain</h1>
								<img src="<?php echo base_url('/assets/img/countries/west/Spain.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="States" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1>USA</h1>
								<img src="<?php echo base_url('/assets/img/countries/west/US.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
					</div>
				</div>
		</div>


		<div class="split right">
			<h1>Eastern Cuisines</h1>
			<a href="javascript:unhide('trigger-b')" id="override" class="west-east-panel"><span></span></a>
				<div id="trigger-b" class="hidden">
					<div id="fill_height" class="row">
							<div id="China" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1 class="odd-b">China</h1>
								<img id="for-center" src="<?php echo base_url('/assets/img/countries/east/China.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="India" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1>India</h1>
								<img id="for-center" src="<?php echo base_url('/assets/img/countries/east/India.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Japan" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h1 class="odd-b">Japan</h1>
								<img id="for-center" src="<?php echo base_url('/assets/img/countries/east/Japan.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Phil" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h2>Philippines</h2>
								<img id="for-center" src="<?php echo base_url('/assets/img/countries/east/Phil.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Korea" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h2 class="odd-b">South Korea</h2>
								<img id="for-center" src="<?php echo base_url('/assets/img/countries/east/SK.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
							<div id="Thailand" class="col-lg-2 region">
								<a href="#"><span></span></a>
								<h2>Thailand</h2>
								<img id="for-center" src="<?php echo base_url('/assets/img/countries/east/Thailand.jpg'); ?>" alt="" width="100px" height="100px;">
							</div>
					</div>
				</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/getstarted.js"></script>
</body>
</html>
