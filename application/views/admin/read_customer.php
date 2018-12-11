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
        <li class = "active"><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
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
      <h1>Customers<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div>
        <a class="btn btn-sm bg-purple btn-flat active" data-toggle="tab" href="#active" role="tab" style="margin: 0px 5px 10px 0px">Active Customers</a>
        <a class="btn btn-sm bg-purple btn-flat" data-toggle="tab" href="#inactive" role="tab" style="margin: 0px 5px 10px 0px">Inactive Customers</a>
      </div>
      <div class="box">
        <div class="box-body table-responsive">
          <div class="tab-content">
            <div class="tab-pane active" id="active">
              <table class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Address</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($customer!=NULL) {
                      foreach ($customer as $cs) {
                        if ($cs->cs_status == 'A') {
                        ?>
                          <tr>
                            <td><?php echo $cs->cs_code; ?></td>
                            <td><?php echo str_replace("’", "'", $cs->cs_fname." ".$cs->cs_lname)?></td>
                            <td><?php echo $cs->cs_email; ?></td>
                            <td><?php echo $cs->cs_address; ?></td>
                            <td><?php echo $cs->cs_create; ?></td>
                            <td><?php echo $cs->cs_update; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin/view_customer'.'?id='.$cs->cs_id);?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                              <?php echo'
                              <a href="#" class="btn btn-xs btn-danger" data-target="#deaccust'.$cs->cs_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash"></i></a>';?>
                            </center></td>
                          </tr>
                          <div class="container">
                          <?php echo'
                            <div class="modal fade" id="deaccust'.$cs->cs_id.'">  
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Deactivate Customer Account</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Confirm Customer Account Deactivation</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/delete_customer'.'?id='.$cs->cs_id);?>" class="btn btn-sm btn-primary">Confirm</a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="inactive">
              <table class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Address</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($customer!=NULL) {
                      foreach ($customer as $cs) {
                        if ($cs->cs_status == 'I') {
                        ?>
                          <tr>
                            <td><?php echo $cs->cs_code; ?></td>
                            <td><?php echo str_replace("’", "'", $cs->cs_fname." ".$cs->cs_lname)?></td>
                            <td><?php echo $cs->cs_email; ?></td>
                            <td><?php echo $cs->cs_address; ?></td>
                            <td><?php echo $cs->cs_create; ?></td>
                            <td><?php echo $cs->cs_update; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin/view_customer'.'?id='.$cs->cs_id);?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                              <?php echo'
                              <a href="#" class="btn btn-xs btn-success" data-target="#accust'.$cs->cs_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-power-off"></i></a>';?>
                            </center></td>
                          </tr>
                          <div class="container">
                          <?php echo'
                            <div class="modal fade" id="accust'.$cs->cs_id.'">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Activate Customer Account</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Confirm Customer Account Activation</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/activate_customer'.'?id='.$cs->cs_id);?>" class="btn btn-sm btn-primary">Confirm</a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
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