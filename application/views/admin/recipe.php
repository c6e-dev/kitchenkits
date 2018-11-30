  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Soon</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
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
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="box">
        <!-- <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div> -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Instructions</th>
                <th>Cooking Time</th>
                <th>Servings</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if ($recipe!=NULL) {
                  foreach ($recipe as $rcp) {
                    ?>
                      <tr>
                        <td><?php echo $rcp->id; ?></td>
                        <td><?php echo $rcp->nm; ?></td>
                        <td><?php echo $rcp->prc; ?></td>
                        <td><?php echo $rcp->ins; ?></td>
                        <td><?php echo $rcp->ct; ?></td>
                        <td><?php echo $rcp->se; ?></td>
                        <td><?php echo $rcp->st; ?></td>
                        <td><center>
                          <a href="#" class="btn btn-xs btn-info disabled" data-target="#myModal" data-toggle="modal" data-backdrop="static"><i class="fa fa-eye"></i></a>
                          <a href="#" class="btn btn-xs btn-success disabled" data-target="#myModal" data-toggle="modal" data-backdrop="static"><i class="fa fa-edit"></i></a>
                          <a href="#" class="btn btn-xs btn-danger" data-target="#myModal" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash"></i></a>
                        </center></td>
                      </tr>
                      <div class="container">
                          <form action="<?php echo site_url('admin/delete_recipe/'.$rcp->id.'');?>">
                            <div class="modal fade" id="myModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Delete Recipe</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>Are you sure you want to delete this Recipe?</center></strong>
                                  </div>
                                  <div class="modal-footer">
                                    <!-- <input type="hidden" name="reimbursement_delete" id="reimbursement_delete" class="form-control"> -->
                                    <button type="submit" id="btn_delete" class="btn btn-sm btn-primary">Yes</button>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">No</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->