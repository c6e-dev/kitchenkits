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
        <li><a href="<?php echo site_url('admin/view_reports');?>"><i class="fa fa-bar-chart-o"></i> <span>Reports</span></a></li>
        <li><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
        <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
        <li class="active"><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
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
      <h1>Branches<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div>
        <button type="button" class="btn btn-sm bg-purple btn-flat" style="margin: 0px 5px 10px 0px" data-toggle="modal" data-target="#addbranch" data-backdrop="static"><i class="fa fa-plus-circle"></i> </button>
        <button type="button" class="btn btn-sm bg-purple btn-flat active" data-toggle="tab" data-target="#active" role="tab" style="margin: 0px 5px 10px 0px">Active Branches</button>
        <button type="button" class="btn btn-sm bg-purple btn-flat" data-toggle="tab" data-target="#inactive" role="tab" style="margin: 0px 5px 10px 0px">Inactive Branches</button>
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
                    <th>Address</th>
                    <!-- <th>Manager</th> -->
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($branch!=NULL) {
                      foreach ($branch as $br) {
                        if ($br->br_status == 'A'){
                        ?>
                          <tr>
                            <td><?php echo $br->br_code; ?></td>
                            <td><?php echo str_replace("’", "'", $br->br_name)?></td>
                            <td><?php echo $br->br_address; ?></td>
                            <!-- <td><?php echo $br->br_mname; ?></td> -->
                            <td><?php echo $br->br_create; ?></td>
                            <td><?php echo $br->br_update; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin_view_branch'.'?id='.$br->br_id);?>" class="btn btn-xs btn-info"><i  class="fa fa-search"></i></a>
                              <!-- <a href="#" class="btn btn-xs btn-warning" data-target="" data-toggle="modal" data-backdrop="static"><i class="fa fa-edit"></i></a> -->
                              <?php echo'
                              <button type="button" class="btn btn-xs btn-danger" data-target="#deacbran'.$br->br_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash"></i></button>';?>
                            </center></td>
                          </tr>

                          <div class="container">
                          <?php echo'
                            <div class="modal fade" id="deacbran'.$br->br_id.'">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Deactivate Branch</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Confirm Branch Deactivation</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/delete_branch'.'?id='.$br->br_id);?>" class="btn btn-sm btn-primary">Confirm</a>
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
                    <th>Address</th>
                    <!-- <th>Manager</th> -->
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($branch!=NULL) {  
                      foreach ($branch as $br) {
                        if ($br->br_status == 'I'){
                        ?>
                          <tr>
                            <td><?php echo $br->br_code; ?></td>
                            <td><?php echo str_replace("’", "'", $br->br_name)?></td>
                            <td><?php echo $br->br_address; ?></td>
                            <!-- <td><?php echo $br->br_mname; ?></td> -->
                            <td><?php echo $br->br_create; ?></td>
                            <td><?php echo $br->br_update; ?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin_view_branch'.'?id='.$br->br_id);?>" class="btn btn-xs btn-info"><i  class="fa fa-search"></i></a>
                              <?php 
                                if ($br->br_mi == 0) {
                                  echo' <button type="button" class="btn btn-xs btn-success" data-target="#acbran'.$br->br_id.'" data-toggle="modal" data-backdrop="static" disabled><i class="fa fa-power-off"></i></button>';
                                }else{
                                  echo' <button type="button" class="btn btn-xs btn-success" data-target="#acbran'.$br->br_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-power-off"></i></button>';
                                }
                              ?>
                            </center></td>
                          </tr>

                          <div class="container">
                          <?php echo'
                            <div class="modal fade" id="acbran'.$br->br_id.'">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Activate Branch</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Confirm Branch Activation</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/activate_branch'.'?id='.$br->br_id);?>" class="btn btn-sm btn-primary">Confirm</a>
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
        <div class="modal fade" id="addbranch">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong>Create Branch</strong></h4>
              </div>
              <form class="form-horizontal">
                <div class="modal-body">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="alert alert-danger" align="center" style="display: none;"></div>
                    </div>
                    <div class="row form-group">
                      <label class="col-md-1 control-label">Name</label>
                      <label class="col-md-1"></label>
                      <div class="col-12 col-md-10"><input type="text" name="brname" id="brname" class="form-control input-sm" required></div>
                    </div>
                    <div class="row form-group">
                      <label class="col-md-1 control-label">Address</label>
                      <label class="col-md-1"></label>
                      <div class="col-12 col-md-10"><input type="text" name="braddress" id="braddress" class="form-control input-sm" required></div>
                    </div>
                    <div class="row form-group">
                      <div>
                        <label class="col-md-1 control-label">Managers</label>
                      </div>
                      <label class="col-md-1"></label>
                      <div class="col-12 col-md-10">
                        <select name="brmanager" id="brmanager" class="form-control select2" style="width: 100%;">
                          <option value="0">None</option>
                          <?php
                            foreach ($b_manager as $bm) {
                              ?>
                                <option value="<?php echo $bm->bm_id; ?>"><?php echo $bm->bm_name; ?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="btn_bradd_save" class="btn btn-sm btn-primary">Save</button>
                  <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>