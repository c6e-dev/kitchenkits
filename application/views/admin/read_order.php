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
        <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="fa fa-sitemap"></i> <span>Branches</span></a></li>
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
      <h1>Orders<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div>
        <a class="btn btn-sm bg-purple btn-flat active" data-toggle="tab" href="#incomplete" role="tab" style="margin: 0px 5px 10px 0px">Incomplete Orders</a>
        <a class="btn btn-sm bg-purple btn-flat" data-toggle="tab" href="#complete" role="tab" style="margin: 0px 5px 10px 0px">Complete Orders</a>
      </div>
      <div class="box">
        <div class="box-body table-responsive">
          <div class="tab-content">
            <div class="tab-pane active" id="incomplete">
              <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Branch</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($order!=NULL) {
                      foreach ($order as $od) {
                        if($od->od_status == 'I') {
                        ?>
                          <tr>
                            <td><?php echo $od->od_code; ?></td>
                            <td><?php echo str_replace("’", "'", $od->od_fname." ".$od->od_lname)?></td>
                            <td><?php echo $od->od_branch; ?></td>
                            <td><?php echo $od->od_create; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin/view_order'.'?id='.$od->od_id);?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                            </center></td>
                          </tr>
                        <?php
                        }
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="complete">
              <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Branch</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($order!=NULL) {
                      foreach ($order as $od) {
                        if($od->od_status == 'C') {
                        ?>
                          <tr>
                            <td><?php echo $od->od_code; ?></td>
                            <td><?php echo str_replace("’", "'", $od->od_fname." ".$od->od_lname)?></td>
                            <td><?php echo $od->od_branch; ?></td>
                            <td><?php echo $od->od_create; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin/view_order'.'?id='.$od->od_id);?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                            </center></td>
                          </tr>
                        <?php
                        }
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>