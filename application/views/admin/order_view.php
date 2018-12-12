<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li class = "active"><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
        <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
        <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
        <li><a href="<?php echo site_url('admin/manager_view');?>"><i class="fa fa-user"></i> <span>Managers</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Orders<small>Kikay Kit</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info-circle"></i>
              <h3 class="box-title">Order Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd><?php echo $order[0]->od_code?></dd>
                <dt>Customer Name</dt>
                <dd><?php echo $order[0]->od_fname." ".$order[0]->od_lname?></dd>
                <dt>Branch Name</dt>
                <dd><?php echo $order[0]->od_branch?></dd>
                <dt>Creation Date</dt>
                <dd><?php echo $order[0]->od_create?></dd>
              </dl>
            <!-- /.box-body -->
            </div>
          <!-- /.box -->
          </div>
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-book"></i>
              <h3 class="box-title">Order Content</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Recipes</dt>
                <dd>
                  <?php
                    if ($oc_content!=NULL) {
                      foreach ($oc_content as $oc) {
                        ?>
                        <ul class="list-unstyled">
                          <li><?php echo $oc->oc_recipe; ?></li>
                        </ul>
                        <?php
                      }
                    }
                  ?>
                </dd>
                <dt>Additional Ingredients</dt>
                <!-- <dd>
                  <?php
                    if ($oc_content!=NULL) {
                      foreach ($oc_content as $oc) {
                        ?>
                        <ul class="list-unstyled">
                          <li><?php echo $oc->oc_additional; ?></li>
                        </ul>
                        <?php
                      }
                    }
                  ?>
                </dd> -->
              </dl>
            </div>
            <!-- /.box-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>