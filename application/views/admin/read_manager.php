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
        <li><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
        <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
        <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="fa fa-sitemap"></i> <span>Branches</span></a></li>
        <li class = "active"><a href="<?php echo site_url('admin/manager_view');?>"><i class="fa fa-user"></i> <span>Managers</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Managers<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div>
        <a href="#" class="btn btn-sm bg-purple btn-flat" style="margin: 0px 5px 10px 0px" data-toggle="modal" data-target="#addmanager" ><i class="fa fa-plus-circle"></i> </a>
        <a class="btn btn-sm bg-purple btn-flat active" data-toggle="tab" href="#active" role="tab" style="margin: 0px 5px 10px 0px">Active Managers</a>
        <a class="btn btn-sm bg-purple btn-flat" data-toggle="tab" href="#inactive" role="tab" style="margin: 0px 5px 10px 0px">Inactive Managers</a>
      </div>
      <div class="box">
        <div class="box-body">
          <div class="tab-content">
            <div class="tab-pane active" id="active">
              <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- <th>Branch</th> -->
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($manager!=NULL) {
                      foreach ($manager as $bm) {
                        if($bm->bm_status == 'A'){
                        ?>
                          <tr>
                            <td><?php echo $bm->bm_code; ?></td>
                            <td><?php echo $bm->bm_name; ?></td>
                            <!-- <td><?php echo $bm->bm_branch; ?></td> -->
                            <td><?php echo $bm->bm_assign; ?></td>
                            <td><?php echo $bm->bm_create; ?></td>
                            <td><?php echo $bm->bm_update; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin/view_manager'.'?id='.$bm->bm_id);?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                              <!-- <a href="#" class="btn btn-xs btn-warning" data-target="" data-toggle="modal" data-backdrop="static"><i class="fa fa-edit"></i></a> -->
                              <?php echo'
                              <a href="#" class="btn btn-xs btn-danger" data-target="#deacman'.$bm->bm_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash"></i></a>';?>
                            </center></td>
                          </tr>
                          <div class="container">
                          <?php echo'
                            <div class="modal fade" id="deacman'.$bm->bm_id.'">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Deactivate Manager Account</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Confirm Manager Account Deactivation</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/delete_manager'.'?id='.$bm->bm_id);?>" class="btn btn-sm btn-primary">Confirm</a>
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
              <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- <th>Branch</th> -->
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($manager!=NULL) {
                      foreach ($manager as $bm) {
                        if($bm->bm_status == 'I'){
                        ?>
                          <tr>
                            <td><?php echo $bm->bm_code; ?></td>
                            <td><?php echo $bm->bm_name; ?></td>
                            <!-- <td><?php echo $bm->bm_branch; ?></td> -->
                            <td><?php echo $bm->bm_assign; ?></td>
                            <td><?php echo $bm->bm_create; ?></td>
                            <td><?php echo $bm->bm_update; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin/view_manager'.'?id='.$bm->bm_id);?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                              <!-- <a href="#" class="btn btn-xs btn-warning" data-target="" data-toggle="modal" data-backdrop="static"><i class="fa fa-edit"></i></a> -->
                              <?php echo'
                              <a href="#" class="btn btn-xs btn-success" data-target="#acman'.$bm->bm_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-power-off"></i></a>';?>
                            </center></td>
                          </tr>
                          <div class="container">
                          <?php echo'
                            <div class="modal fade" id="acman'.$bm->bm_id.'">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Activate Manager Account</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Confirm Manager Account Activation</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/activate_manager'.'?id='.$bm->bm_id);?>" class="btn btn-sm btn-primary">Confirm</a>
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