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
        <li class = "active"><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
        <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
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
      <h1>Feedback<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="box">
        <div class="box-body table-responsive">
          <table id="" class="display table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Customer</th>
                <th>Recipe</th>
                <th>Comment</th>
                <th>Rating</th>
                <th>Created Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if ($feedback!=NULL) {
                  foreach ($feedback as $fb) {
                    ?>
                      <tr>
                        <td><?php echo str_replace("’", "'", $fb->fb_fname." ".$fb->fb_lname)?></td>
                        <td><?php echo $fb->fb_recipe; ?></td>
                        <td><?php echo $fb->fb_message; ?></td>
                        <td><?php echo $fb->fb_rating; ?></td>
                        <td><?php echo $fb->fb_create; ?></td>
                        <td><center>
                          <?php echo'
                          <a href="#" class="btn btn-xs btn-info" data-target="#viewfeed'.$fb->fb_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-search"></i></a>';?>
                        </center></td>
                      </tr>

                      <div class="container"> <!-- CHANGE LAYOUT  -->
                      <?php echo'
                        <div class="modal fade" id="viewfeed'.$fb->fb_id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <div class="post">
                                  <div class="user-block">
                                    <span>
                                      <header><font size="3">'.$fb->fb_fname." ".$fb->fb_lname.'  -  '.$fb->fb_recipe.'</font></header>
                                    </span>
                                    <span>
                                      <header>Commented On - '.$fb->fb_create.'</header>
                                    </span>
                                    <span>
                                      <header>Rating: '.$fb->fb_rating.'</header>
                                    </span>
                                  </div>
                                  <p>
                                    '.$fb->fb_message.'
                                  </p>
                                </div>
                              </div>';?>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
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
    </section>
  </div>