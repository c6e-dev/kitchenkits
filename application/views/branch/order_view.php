  <style>
  .grid-container {
    display: grid;
    grid-template-columns: auto ;
  }
  .grid-item {
    /*text-align: center;*/
  }
  </style>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">NAVIGATION</li> -->
        <li class="active"><a href="<?php echo site_url('branch');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('branch/supply_view');?>"><i class="fa fa-cubes"></i> <span>Supply</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Orders<small>Kitchen Kits</small></h1>
    </section>

    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="grid-container">
            <?php
            if ($order!=NULL) {
              foreach ($order as $od) {
                if ($od->od_status == 'P') {
                  ?>
                  <div class="grid-item">
                    <div class="col-sm-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"></span>
                        <div class="info-box-content">
                          <span class="info-box-text"><?php echo str_replace("’", "'", $od->od_fname." ".$od->od_lname)?></span>
                          <span class="info-box-number"><?php echo date('M d, Y - g:i a', strtotime($od->od_create));?></span>
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
        <div class="col-md-6">
          <div class="grid-container">
            <?php
            if ($order!=NULL) {
              foreach ($order as $od) {
                if ($od->od_status == 'I') {
                  ?>
                  <div class="grid-item">
                    <div class="col-sm-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"></span>
                        <div class="info-box-content">
                          <span class="info-box-text"><?php echo str_replace("’", "'", $od->od_fname." ".$od->od_lname)?></span>
                          <span class="info-box-number"><?php echo date('M d, Y - g:i a', strtotime($od->od_create));?></span>
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
      </div>
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->