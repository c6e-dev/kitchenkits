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
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info-circle"></i>

              <h3 class="box-title">Recipe Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
              <div class="col-md-6">
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Name</dt>
                    <dd><?php echo $recipe[0]->re_nm;?></dd>
                    <dt>Price</dt>
                    <dd><?php echo $recipe[0]->re_prc;?></dd>
                    <dt>Region</dt>
                    <dd><?php echo $recipe[0]->rg_nm;?></dd>
                    <dt>Country</dt>
                    <dd><?php echo $recipe[0]->co_nm;?></dd>
                    <dt>Servings</dt>
                    <?php 
                      if ($recipe[0]->re_se != 0) {
                        ?>
                          <dd><?php echo $recipe[0]->re_se;?></dd>
                        <?php
                      }else{
                        ?><dd></dd><?php
                      }
                    ?>
                    <dt>Cooking Time</dt>
                    <dd><?php echo $recipe[0]->re_ct;?></dd>
                    <dt>Creation Date</dt>
                    <dd><?php echo date('M d, Y - g:i a', strtotime($recipe[0]->re_cd));?></dd>
                    <dt>Last Updated Date</dt>
                    <?php
                      if ($recipe[0]->re_ud != NULL) {
                        ?>
                          <dd><?php echo date('M d, Y - g:i a', strtotime($recipe[0]->re_ud));?></dd>
                        <?php
                      }else{
                        ?>
                          <dd></dd>
                        <?php
                      }
                    ?>
                  </dl>
                  <button type="button" class="btn btn-sm bg-purple btn-flat" data-target="#update_recipe" data-toggle="modal" data-backdrop="static">Edit</button>
                  <div class="modal fade" id="update_recipe">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title"><strong>Edit Recipe <?php echo $recipe[0]->re_id;?></strong></h4>
                        </div>
                        <form class="form-horizontal">
                          <div class="modal-body">
                            <div class="box-body">
                              <div class="form-group">
                                <div class="alert alert-danger" align="center" style="display: none;"></div>
                              </div>
                              <div class="row form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-10"><input type="text" name="upt_rcpnm" id="upt_rcpnm" class="form-control input-sm" value="<?php echo $recipe[0]->re_nm;?>"></div>
                              </div>
                              <div class="row form-group" style="margin-bottom: 25px">
                                <div class="col-md-4">
                                  <label>Cooking Time <small style="font-weight: normal;">(Minutes)</small></label>
                                  <input type="text" name="upt_ctime" id="upt_ctime" class="form-control input-sm" value="<?php echo $recipe[0]->re_ct;?>">
                                </div>
                                <div class="col-md-4">
                                  <label>Servings</label>
                                  <input type="text" name="upt_serves" id="upt_serves" class="form-control input-sm" value="<?php echo $recipe[0]->re_se;?>">
                                </div>
                                <div class="col-md-4">
                                  <label>Price</label>
                                  <input type="text" name="upt_price" id="upt_price" class="form-control input-sm" value="<?php echo $recipe[0]->re_prc;?>">
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-md-2">
                                  <label class="control-label">Region</label> 
                                </div>
                                <div class="col-md-2">
                                  <?php 
                                    if ($recipe[0]->rid == 1) {
                                      ?>
                                        <label style="font-weight: normal;"><input type="radio" value="1" name="upt_region" class="minimal-blue" checked> East</label><br>
                                        <label style="font-weight:normal;"><input type="radio" value="2" name="upt_region" class="minimal-blue"> West</label>    
                                      <?php
                                    }
                                    if ($recipe[0]->rid == 2) {
                                      ?>
                                        <label style="font-weight:normal;"><input type="radio" value="1" name="upt_region" class="minimal-blue"> East</label><br>
                                        <label style="font-weight:normal;"><input type="radio" value="2" name="upt_region" class="minimal-blue" checked> West</label>    
                                      <?php
                                    }
                                  ?>
                                  
                                </div>
                                <div class="col-md-2">
                                  <label class="control-label">Country</label>
                                </div>
                                <div class="col-md-6">
                                  <select name="upt_country" id="upt_country" class="form-control select2" style="width: 100%;">
                                    <option value="<?php echo $recipe[0]->cid;?>"><?php echo $recipe[0]->co_nm;?></option>
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
                              <div class="row form-group">
                                <div class="col-md-12">
                                  <label>Instructions</label>
                                  <textarea class="form-control" rows="12" name="instruc" id="instruc"><?php echo $recipe[0]->re_ins;?></textarea>  
                                </div>                            
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="recipe_id" id="recipe_id" value="<?php echo $recipe[0]->re_id;?>">
                            <button type="button" id="btn_rcpupt_save" class="btn btn-sm btn-primary">Save</button>
                            <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
            <!-- /.box-body -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px">
                  <?php 
                    if ($recipe[0]->re_im != NULL) {
                      ?>
                        <?php $ch = "Change Image" ; ?>
                        <img id="image_upload_preview" src="<?php echo base_url('./Recipe_Folder/'.$recipe[0]->re_nm.'/'.$recipe[0]->re_im);?>" alt="<?php echo $recipe[0]->re_nm;?> Image" style="border-radius: 5px;" />
                      <?php
                    }else{
                      ?>
                        <?php $ch = "Upload Image" ; ?>                      
                        <img id="image_upload_preview" src="https://via.placeholder.com/350x200" alt="<?php echo $recipe[0]->re_nm;?> Image" style="border-radius: 5px;" />
                      <?php
                    }
                  ?>
                </div>
                  <div class="form-group">
                    <?php echo form_open_multipart('admin/upload_recipe_image');?>        
                    <div class="row">
                      <div class="col-md-12">
                        <div class="btn btn-sm bg-purple btn-flat btn-file">
                          <i class="fa fa-image"></i> <?php echo $ch ?>
                          <input type="file" id="recipe_image" name="recipe_image">
                        </div>
                        <input type="hidden" name="re_id" id="re_id" value="<?php echo $recipe[0]->re_id;?>">
                        <input type="hidden" name="re_nm" id="re_nm" value="<?php echo $recipe[0]->re_nm;?>">
                        <input type="hidden" name="country_id" id="country_id" value="<?php echo $recipe[0]->cid;?>">
                        <button type="submit" class="btn btn-sm bg-primary btn-flat" style="display: none; margin-left: 5px" id="image_save">Save</button>
                        <button onclick="javascript:window.location.reload()" type="button" class="btn btn-sm bg-default btn-flat" style="display: none;" id="image_cancel">Cancel</button>
                        <p class="help-block">Max. 3MB</p>
                      </div>
                    </div>            
                    </form>
                  </div>
                </div>
              </div>
          <!-- /.box -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-book"></i>

              <h3 class="box-title">Instructions</h3>
            </div>
            <div class="box-body">
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <textarea class="form-control" rows="15" name="instruc" id="instruc"><?php echo $recipe[0]->re_ins;?></textarea>  
                    </div>                            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-list-ul"></i>

              <h3 class="box-title">Ingredients</h3>
            </div>
            <div class="box-body">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-condensed">
                    <tr>
                      <th >Name</th>
                      <th style="width: 80px">Amount</th>
                    </tr>
                    <?php
                      if ($recipe!=NULL) {
                        foreach ($recipe as $rcp) {
                          ?>
                            <tr>
                              <td><?php echo $rcp->in_nm; ?></td>
                              <td><?php echo $rcp->in_am; ?></td>
                            </tr>
                          <?php
                        }
                      }
                    ?>
                  </table>
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