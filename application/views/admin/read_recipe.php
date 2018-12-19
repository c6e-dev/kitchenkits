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
        <li class="active"><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
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
      <h1>Recipes<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="nav" role="tablist">
        <button href="#" class="btn btn-sm bg-purple btn-flat" style="margin: 0px 5px 10px 0px" data-toggle="modal" data-target="#add_recipe" ><i class="fa fa-plus-circle"></i> </button>
        <button type="button" class="btn btn-sm bg-purple btn-flat"  data-toggle="tab" data-target="#active_recipe" style="margin: 0px 5px 10px 0px">Active Recipes</button>
        <button type="button" class="btn btn-sm bg-purple btn-flat" data-toggle="tab" data-target="#inactive_recipe" style="margin: 0px 5px 10px 0px">Inactive Recipes</button>
      </div>
      <div class="box">
        <div class="box-body table-responsive">
          <div class="tab-content">
            <div class="tab-pane active" id="active_recipe">
              <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Region</th>
                    <th>Country</th>
                    <th>Cooking Time</th>
                    <th>Servings</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($recipe!=NULL) {
                      foreach ($recipe as $rcp) {
                        if ($rcp->st == 'A') {
                          ?>
                            <tr>
                              <td><?php echo $rcp->id; ?></td>
                              <td><?php echo $rcp->nm; ?></td>
                              <td><?php echo $rcp->prc; ?></td>
                              <td><?php echo $rcp->rnm; ?></td>
                              <td><?php echo $rcp->cnm; ?></td>
                              <td><?php echo $rcp->ct; ?></td>
                              <td><?php echo $rcp->se; ?></td>
                              <td><center>
                                <a href="<?php echo site_url('admin/view_recipe/'.$rcp->id.'/'.$rcp->cid); ?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                                <?php echo '
                                  <button type="button" class="btn btn-xs btn-danger" data-target="#Irecipe'.$rcp->id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash"></i></button>';
                                ?>
                              </center></td>
                            </tr>
                          <?php
                        }
                        ?>
                          <div class="container">
                            <?php echo'
                            <div class="modal fade" id="Irecipe'.$rcp->id.'">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Delete Recipe</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Are you sure you want to deactivate this Recipe?</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/delete_recipe'.'?id='.$rcp->id);?>" class="btn btn-sm btn-primary">Cofirm</a>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> 
                        <?php
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="inactive_recipe">
              <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Region</th>
                    <th>Country</th>
                    <th>Cooking Time</th>
                    <th>Servings</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if ($recipe!=NULL) {
                      foreach ($recipe as $rcp) {
                        if ($rcp->st == 'I') {
                          ?>
                            <tr>
                              <td><?php echo $rcp->id; ?></td>
                              <td><?php echo $rcp->nm; ?></td>
                              <td><?php echo $rcp->prc; ?></td>
                              <td><?php echo $rcp->rnm; ?></td>
                              <td><?php echo $rcp->cnm; ?></td>
                              <td><?php echo $rcp->ct; ?></td>
                              <td><?php echo $rcp->se; ?></td>
                              <td><center>
                                <a href="<?php echo site_url('admin/view_recipe/'.$rcp->id.'/'.$rcp->cid); ?>" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                                <?php 
                                  if ($rcp->prc == '' || $rcp->ct == ''|| $rcp->se == 0 || $rcp->ins == '') {
                                    echo '<button type="button" class="btn btn-xs btn-success" data-target="#Arecipe'.$rcp->id.'" data-toggle="modal" data-backdrop="static" disabled><i class="fa fa-power-off"></i></button>';
                                  }else{
                                    echo '<button type="button" class="btn btn-xs btn-success" data-target="#Arecipe'.$rcp->id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-power-off"></i></button>';  
                                  }
                                ?>
                              </center></td>
                            </tr>
                          <?php
                        }
                        ?>
                          <div class="container">
                            <?php echo'
                            <div class="modal fade" id="Arecipe'.$rcp->id.'">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Delete Recipe</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Are you sure you want to activate this Recipe?</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('admin/activate_recipe'.'?id='.$rcp->id);?>" class="btn btn-sm btn-primary">Cofirm</a>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div> 
          </div>
        </div>
        <div class="modal fade" id="add_recipe">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong>Add Recipe</strong></h4>
              </div>
              <form class="form-horizontal">
                <div class="modal-body">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="alert alert-danger" align="center" style="display: none;"></div>
                    </div>
                    <div class="row form-group">
                      <label class="col-md-1 control-label">Name</label>
                      <div class="col-md-11"><input type="text" name="rcpnm" id="rcpnm" class="form-control input-sm" required></div>
                    </div>
                    <div class="row form-group" style="margin-bottom: 25px">
                      <div class="col-md-4">
                        <label>Cooking Time <small style="font-weight: normal;">(minutes)</small></label>
                        <input type="text" name="ctime" id="ctime" class="form-control input-sm">
                      </div>
                      <div class="col-md-4">
                        <label>Servings</label>
                        <input type="text" name="serves" id="serves" class="form-control input-sm">
                      </div>
                      <div class="col-md-4">
                        <label>Price</label>
                        <input type="text" name="price" id="price" class="form-control input-sm">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-2">
                        <label class="control-label">Region</label> 
                      </div>
                      <div class="col-md-2">
                        <label style="font-weight: normal;"><input type="radio" value="1" name="region" class="minimal-blue" checked> East</label><br>
                        <label style="font-weight:normal;"><input type="radio" value="2" name="region" class="minimal-blue"> West</label>    
                      </div>
                      <div class="col-md-2">
                        <label class="control-label">Country</label>
                      </div>
                      <div class="col-md-6">
                        <select name="country" id="country" class="form-control select2" style="width: 100%;">
                          <?php
                            foreach ($country as $con) {
                              ?>
                                <option value="<?php echo $con->cid; ?>"><?php echo $con->cnm; ?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="btn_rcp_save" class="btn btn-sm btn-primary">Save</button>
                  <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->