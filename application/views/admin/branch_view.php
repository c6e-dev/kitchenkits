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
        <li class="active"><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
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
      <h1>Branches<small>Kitchen Kits</small></h1>
      <!-- <h1><?php echo $branch[0]->br_name?><small>Under Construction</small></h1> -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info-circle"></i>

              <h3 class="box-title">Branch Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd><?php echo $branch[0]->br_code?></dd>
                <dt>Name</dt>
                <dd><?php echo $branch[0]->br_name?></dd>
                <dt>Address</dt>
                <dd><?php echo $branch[0]->br_address?></dd>
                <?php 
                  if ($branch[0]->mngr_id == '0') {
                    ?>
                      <dt>Manager</dt>
                      <dd></dd>
                    <?php
                  }else{
                    ?>
                      <dt>Manager</dt>
                      <dd><?php echo $branch[0]->br_manager?></dd>
                    <?php
                  }
                ?>
                <dt>Creation Date</dt>
                <dd><?php echo date('M d, Y - g:i a', strtotime($branch[0]->br_create));?></dd>
                <dt>Last Update Date</dt>
                <?php
                  if ($branch[0]->br_update != NULL) {
                    ?>
                      <dd><?php echo date('M d, Y - g:i a', strtotime($branch[0]->br_update));?></dd>
                    <?php
                  }else{
                    ?>
                      <dd></dd>
                    <?php
                  }
                ?>
              </dl>
              <button type="button" class="btn btn-sm bg-purple btn-flat" data-target="#update_branch" data-toggle="modal" data-backdrop="static">Edit</button>
              <div class="modal fade" id="update_branch">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><strong>Edit <?php echo $branch[0]->br_code?></strong></h4>
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
                            <div class="col-12 col-md-10"><input type="text" name="upt_brname" id="upt_brname" class="form-control input-sm" value="<?php echo $branch[0]->br_name?>"></div>
                          </div>
                          <div class="row form-group">
                            <label class="col-md-1 control-label">Address</label>
                            <label class="col-md-1"></label>
                            <div class="col-12 col-md-10"><input type="text" name="upt_braddress" id="upt_braddress" class="form-control input-sm" value="<?php echo $branch[0]->br_address?>"></div>
                          </div>
                          <div class="row form-group">
                            <div>
                              <label class="col-md-1 control-label">Manager</label>
                            </div>
                            <label class="col-md-1"></label>
                            <div class="col-12 col-md-10">
                              <select name="upt_brmanager" id="upt_brmanager" class="form-control select2" style="width: 100%;">
                                <?php
                                  if ($branch[0]->mngr_id == 0) {
                                    ?>
                                      <option value="0">None</option>
                                      <?php 
                                        foreach ($b_manager as $bm) {
                                          ?>
                                            <option value="<?php echo $bm->bm_id; ?>"><?php echo $bm->bm_name; ?></option>
                                          <?php
                                        }
                                      ?>
                                    <?php
                                  }else{
                                    ?>
                                      <option value="<?php echo $branch[0]->mngr_id; ?>"><?php echo $branch[0]->br_manager?></option>
                                      <option value="0">None</option>
                                      <?php
                                        foreach ($b_manager as $bm) {
                                          ?>
                                            <option value="<?php echo $bm->bm_id; ?>"><?php echo $bm->bm_name; ?></option>
                                          <?php
                                        }
                                      ?>
                                    <?php
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch[0]->br_id?>">
                        <input type="hidden" name="mngr_id" id="mngr_id" value="<?php echo $branch[0]->mngr_id?>">
                        <button type="submit" id="btn_brupt_save" class="btn btn-sm btn-primary">Save</button>
                        <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Branch Orders</h3>
            </div>
            <div class="box-body">
              <div>
                <a class="btn btn-sm bg-purple btn-flat active" data-toggle="tab" href="#incomplete" role="tab" style="margin: 0px 5px 10px 0px">Incomplete Orders</a>
                <a class="btn btn-sm bg-purple btn-flat" data-toggle="tab" href="#complete" role="tab" style="margin: 0px 5px 10px 0px">Complete Orders</a>
              </div>
              <div class="box">
                <div class="box-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="incomplete">
                      <table id="" class="display table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Created Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if ($b_order!=NULL) {
                              foreach ($b_order as $bod) {
                                if($bod->od_status == 'I') {
                                ?>
                                  <tr>
                                    <td><?php echo $bod->od_code; ?></td>
                                    <td><?php echo str_replace("’", "'", $bod->od_fname." ".$bod->od_lname)?></td>
                                    <td><?php echo $bod->od_create; ?></td>
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
                            <th>Created Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if ($b_order!=NULL) {
                              foreach ($b_order as $bod) {
                                if($bod->od_status == 'C') {
                                ?>
                                  <tr>
                                    <td><?php echo $bod->od_code; ?></td>
                                    <td><?php echo str_replace("’", "'", $bod->od_fname." ".$bod->od_lname)?></td>
                                    <td><?php echo $bod->od_create; ?></td>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>