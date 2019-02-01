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
        <li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
        <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
        <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
        <li><a href="<?php echo site_url('admin/manager_view');?>"><i class="fa fa-user"></i> <span>Managers</span></a></li>
        <li><a href="<?php echo site_url('admin/ingredient_view');?>"><i class="ion ion-ios-home"></i> <span>Ingredients</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Branch Reports<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info-circle"></i>

              <h3 class="box-title">Report Details</h3>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Date</dt>
                    <dd><?php echo date('M d, Y - g:i a', strtotime($report_details[0]->br_rep_cd));?></dd>
                    <dt>Manager</dt>
                    <dd><?php echo $report_details[0]->bm_name;?></dd>
                    <dt>Branch</dt>
                    <dd><?php echo $report_details[0]->br_name;?></dd>
                    <dt>Branch Address</dt>
                    <dd><?php echo $report_details[0]->br_addr;?></dd>
                    <dt>Ingredient</dt>
                    <dd><?php echo $report_details[0]->ing_name;?></dd>
                    <dt>Amount Reduced</dt>
                    <dd><?php echo $report_details[0]->br_rep_ar." ".$report_details[0]->un_name;?></dd>
                  </dl>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box-body">
                  <dl class="dl-vertical">
                    <dt>Reason</dt>
                    <dd style="margin-right: 60px"><textarea style="resize: none;" class="form-control" rows="3" readonly><?php echo $report_details[0]->br_rep_rsn;?></textarea></dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->