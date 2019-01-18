<!DOCTYPE html>
<html>
<head>
	<title>Kitchen Kits</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/getstarted.css">
</head>
<body>
	<div class="container-fluid">
		<div class="split left">
			<h1>Western Cuisines</h1>
			<span><img id="west-logo" src="<?php echo base_url('/assets/img/food/west.png'); ?>"></img></span>
			<a href="javascript:unhide('trigger-a')" id="override" class="west-east-panel"><span></span></a>
			<div id= "trigger-a" class="hidden">
				<div id="fill_height" class="row">
					<div id="France" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=7');?>"><span></span></a>
						<h2 class="odd-b">France</h2>
						<img src="<?php echo base_url('/assets/img/food/west/france.jpg'); ?>">
					</div>
					<div id="Greece" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=8');?>"><span></span></a>
						<h2>Greece</h2>
						<img src="<?php echo base_url('/assets/img/food/west/greece.jpg'); ?>">
					</div>
				</div>
				<div id="fill_height" class="row">
					<div id="Italy" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=9');?>"><span></span></a>
						<h2>Italy</h2>
						<img src="<?php echo base_url('/assets/img/food/west/italy.jpg'); ?>">
					</div>
					<div id="Mexico" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=10');?>"><span></span></a>
						<h2 class="odd-b">Mexico</h2>
						<img src="<?php echo base_url('/assets/img/food/west/mexico.jpg'); ?>">
					</div>
				</div>
				<div id="fill_height" class="row">
					<div id="Spain" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=11');?>"><span></span></a>
						<h2 class="odd-b">Spain</h2>
						<img src="<?php echo base_url('/assets/img/food/west/spain.jpg'); ?>">
					</div>
					<div id="States" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=12');?>"><span></span></a>
						<h2>USA</h2>
						<img src="<?php echo base_url('/assets/img/food/west/US.jpg'); ?>">
					</div>
				</div> <!-- End of Fill-height-->
			</div><!-- End of Trigger-A-->
		</div><!-- End of split left -->

		<div class="split right">
			<h1>Eastern Cuisines</h1>
			<span><img id="east-logo" src="<?php echo base_url('/assets/img/food/east.png'); ?>"></img></span>
			<a href="javascript:unhide('trigger-b')" id="override" class="west-east-panel"><span></span></a>
			<div id="trigger-b" class="hidden">
				<div id="fill_height" class="row">
					<div id="China" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=1');?>"><span></span></a>
						<h2 class="odd-b">China</h2>
						<img src="<?php echo base_url('/assets/img/food/east/china.jpg'); ?>">
					</div>
					<div id="India" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=2');?>"><span></span></a>
						<h2>India</h2>
						<img src="<?php echo base_url('/assets/img/food/east/india.jpg'); ?>">
					</div>
				</div>
				<div id="fill_height" class="row">
					<div id="Japan" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=3');?>"><span></span></a>
						<h2>Japan</h2>
						<img src="<?php echo base_url('/assets/img/food/east/japan.jpg'); ?>">
					</div>
					<div id="Phil" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=4');?>"><span></span></a>
						<h2 class="odd-b">Philippines</h2>
						<img src="<?php echo base_url('/assets/img/food/east/phil.jpg'); ?>">
					</div>
				</div>
				<div id="fill_height" class="row">
					<div id="Korea" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=5');?>"><span></span></a>
						<h2 class="odd-b">South Korea</h2>
						<img src="<?php echo base_url('/assets/img/food/east/korea.jpg'); ?>">
					</div>
					<div id="Thailand" class="col-lg-6 region">
						<a href="<?php echo site_url('customer/browse_recipe'.'?id=6');?>"><span></span></a>
						<h2>Thailand</h2>
						<img src="<?php echo base_url('/assets/img/food/east/thai.jpg'); ?>">
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/getstarted.js"></script>
</body>
</html>
