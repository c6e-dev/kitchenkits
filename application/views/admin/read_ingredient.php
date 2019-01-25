  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
        <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
        <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
        <li><a href="<?php echo site_url('admin/manager_view');?>"><i class="fa fa-user"></i> <span>Managers</span></a></li>
        <li class = "active"><a href="<?php echo site_url('admin/ingredient_view');?>"><i class="ion ion-ios-home"></i> <span>Ingredients</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Ingredients<small>Kitchen Kits</small></h1>
    </section>
    <section class="content container-fluid">
      <div>
        <button type="button" class="btn btn-sm bg-purple btn-flat" style="margin: 0px 5px 10px 0px" data-toggle="modal" data-target="#addingredient" data-backdrop="static"><i class="fa fa-plus-circle"></i> </button>
      </div>
      <div class="box">
        <div class="box-body table-responsive">
          <table id="ingredients_tbl" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if ($ingredient!=NULL) {
                  foreach ($ingredient as $in) {
                    ?>
                      <tr>
                        <td><?php echo $in->ing_nm; ?></td>
                        <td><?php echo $in->ing_un; ?></td>
                        <td><?php echo $in->ing_cd; ?></td>
                        <td><center>
                          <?php echo'
                            <button type="button" class="btn btn-xs btn-danger" data-target="#delIn'.$in->ing_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash"></i></button>';
                          ?>
                        </center></td>
                      </tr>
                    <?php
                    ?>
                      <div class="container">
                        <?php echo'
                        <div class="modal fade" id="delIn'.$in->ing_id.'">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5><center>Delete Ingredient #'.$in->ing_id.'</center></h5>
                              </div>
                              <div class="modal-body">
                                <strong><center>Ingredient will be removed</center></strong>
                              </div>';?>
                              <div class="modal-footer">
                                <a href="<?php echo site_url('admin/delete_ingredient'.'?id='.$in->ing_id);?>" class="btn btn-sm btn-primary">Confirm</a>
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
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
        <div class="modal fade" id="addingredient">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong>Add Ingredient</strong></h4>
              </div>
              <form class="form-horizontal">
                <div class="modal-body">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="alert alert-danger" align="center" style="display: none;"></div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-4">
                        <label>Name</label>
                        <input type="text" name="ingName" id="ingName" class="form-control input-sm">
                      </div>
                      <div class="col-md-4">
                        <label>Unit</label>
                        <select name="unit" id="unit" class="form-control select2" style="width: 100%;">
                          <?php
                            foreach ($unit as $un) {
                              ?>
                                <option value="<?php echo $un->id; ?>"><?php echo $un->name; ?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label>Other</label>
                        <input type="text" name="newUnit" id="newUnit" class="form-control input-sm" placeholder="Specify Here...">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="btn_ing_save" class="btn btn-sm btn-primary">Save</button>
                  <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>