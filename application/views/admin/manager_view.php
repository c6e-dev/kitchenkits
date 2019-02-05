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
        <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
        <li class = "active"><a href="<?php echo site_url('admin/manager_view');?>"><i class="fa fa-user"></i> <span>Managers</span></a></li>
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
      <!-- <h1><?php echo $manager[0]->bm_name?><small>Under Construction</small></h1> -->
      <h1>Managers<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info-circle"></i>

              <h3 class="box-title">Manager Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd><?php echo $manager[0]->bm_code?></dd>
                <dt>Name</dt>
                <dd><?php echo $manager[0]->bm_name?></dd>
                <?php 
                  if ($manager[0]->bm_status == 'A') {
                    ?>
                      <dt>Branch</dt>
                      <dd><?php echo $manager[0]->br_name?></dd>
                    <?php
                  }
                  if ($manager[0]->bm_status == 'U') {
                    ?>
                      <dt>Branch</dt>
                      <dd></dd>
                    <?php
                  }
                ?>
                <dt>Creation Date</dt>
                <dd><?php echo date('M d, Y - g:i a', strtotime($manager[0]->bm_create));?></dd>
                <dt>Last Update Date</dt>
                <dd><?php echo date('M d, Y - g:i a', strtotime($manager[0]->bm_update));?></dd>
              </dl>
              <button type="button" class="btn btn-sm bg-purple btn-flat" data-toggle="modal" data-target="#update_manager" data-backdrop="static">Edit</button>
              <div class="modal fade" id="update_manager">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><strong>Edit <?php echo $manager[0]->bm_code?></strong></h4>
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
                            <div class="col-12 col-md-10"><input type="text" name="mngr_name" id="mngr_name" class="form-control" value="<?php echo $manager[0]->bm_name?>"></div>
                          </div>
                          <div class="row form-group">
                            <div>
                              <label class="col-md-1 control-label">Branch</label>
                            </div>
                            <label class="col-md-1"></label>
                            <div class="col-12 col-md-10">
                              <select name="upt_br" id="upt_br" class="form-control input-sm select2" style="width: 100%;">
                                <?php
                                  if ($manager[0]->bm_status == 'A') {
                                    ?>
                                      <option value="<?php echo $manager[0]->br_id?>"><?php echo $manager[0]->br_name?></option>
                                      <option value="0">None</option>
                                      <?php 
                                        foreach ($ibranch as $ibm) {
                                          ?>
                                            <option value="<?php echo $ibm->br_id; ?>"><?php echo $ibm->br_name; ?></option>
                                          <?php
                                        } 
                                      ?>
                                    <?php
                                  }else{
                                    ?>
                                      <option value="0">None</option>
                                      <?php
                                        foreach ($ibranch as $ibm) {
                                          ?>
                                            <option value="<?php echo $ibm->br_id; ?>"><?php echo $ibm->br_name; ?></option>
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
                        <input type="hidden" name="manager_id" id="manager_id" value="<?php echo $manager[0]->bm_id?>">
                        <input type="hidden" name="br_id" id="br_id" value="<?php echo $manager[0]->br_id?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $manager[0]->user_id?>">
                        <button type="submit" id="btn_bmupt_save" class="btn btn-sm btn-primary">Save</button>
                        <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- /.box-body -->
            </div>
          <!-- /.box -->
          </div>
        </div>
      </div>
    </section>
  </div>