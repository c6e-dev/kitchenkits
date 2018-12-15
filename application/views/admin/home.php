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
        <li class="active"><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
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
      <h1>Dashboard<small>Kikay Kit</small></h1>
    </section>
    <section class="content container-fluid">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div id="recipe_tri">
            <a href="<?php echo site_url('admin/recipe_view');?>">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo " ".$recipe[0]->rc?></h3>

                  <p>Recipes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cutlery"></i>
                </div>
              </div>
            </a>
          </div>
          <div id="recipe_col">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo " ".$recipe_a[0]->rc_a?></h3>

                <p>Active Recipes</p>
              </div>
              <div class="icon">
                <i class="fa fa-cutlery"></i>
              </div>
            </div>
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo " ".$recipe_i[0]->rc_i?></h3>

                <p>Inactive Recipes</p>
              </div>
              <div class="icon">
                <i class="fa fa-cutlery"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div id="order_tri">
            <a href="<?php echo site_url('admin/order_view');?>">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo " ".$order[0]->od?></h3>

                  <p>Orders</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
              </div>
            </a>
          </div>
          <div id="order_col">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo " ".$order_i[0]->od_i?></h3>

                <p>Incomplete Orders</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
            </div>
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo " ".$order_c[0]->od_c?></h3>

                <p>Complete Orders</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div id="customer_tri">
            <a href="<?php echo site_url('admin/customer_view');?>">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo " ".$customer[0]->cs?></h3>

                  <p>Customers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-people"></i>
                </div>
              </div>
            </a>
          </div>
          <div id="customer_col">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo " ".$customer_a[0]->cs_a?></h3>

                <p>Active Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
            </div>
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo " ".$customer_i[0]->cs_i?></h3>

                <p>Inactive Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div id="recipe_tri">
            <a href="<?php echo site_url('admin/feedback_view');?>">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo " ".$feedback[0]->fb?></h3>

                  <p>Feedback</p>
                </div>
                <div class="icon">
                  <i class="fa fa-comments"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div id="branch_tri">
            <a href="<?php echo site_url('admin/branch_view');?>">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo " ".$branch[0]->br?></h3>

                  <p>Branches</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-home"></i>
                </div>
              </div>
            </a>
          </div>
          <div id="branch_col">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo " ".$branch_a[0]->br_a?></h3>

                <p>Active Branches</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-home"></i>
              </div>
            </div>
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo " ".$branch_i[0]->br_i?></h3>

                <p>Inactive Branches</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-home"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div id="manager_tri">
            <a href="<?php echo site_url('admin/branch_view');?>">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo " ".$manager[0]->bm?></h3>

                  <p>Managers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <div id="manager_col">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo " ".$manager_a[0]->bm_a?></h3>

                <p>Assigned Managers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo " ".$manager_u[0]->bm_u?></h3>

                <p>Unassigned Managers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div id="customer_tri">
            <a href="<?php echo site_url('admin/customer_view');?>">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo " ".$logged_in[0]->li?></h3>

                  <p>Logged-In Users</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </section>
    <section class="content-header">
      <h1>Activity Feed<small>Kikay Kit</small></h1>
    </section>
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <ul class="timeline">
            <li class="time-label">
              <span class="bg-green">
                <?php 
                  $current_date = date('M d, Y');
                  echo $current_date;
                ?>
              </span>
            </li>
            <?php
              if ($act_feed!=NULL) {
                foreach ($act_feed as $af) {
                  $new_date = date('M d, Y', strtotime($af->fb_cdate));
                  if ($new_date == $current_date) {
                    if ($af->fb_type == 1) {
                      ?>
                        <li>
                          <i class="fa fa-shopping-cart bg-blue"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($af->fb_cdate));?></span>
                            <h3 class="timeline-header"><a href="#"><?php echo $af->fb_fname; ?> <?php echo $af->fb_lname; ?></a> ordered <?php echo $af->fb_recipe; ?></h3>
                          </div>
                        </li>
                      <?php  
                    }
                    if ($af->fb_type == 3) {
                      ?>
                        <li>
                          <i class="fa fa-star bg-yellow"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($af->fb_cdate));?></span>
                            <h3 class="timeline-header"><a href="#"><?php echo $af->fb_fname; ?> <?php echo $af->fb_lname; ?></a> rated <?php echo $af->fb_rating; ?> stars on <?php echo $af->fb_recipe; ?></h3>
                          </div>
                        </li>
                      <?php  
                    }
                    if ($af->fb_type == 4) {
                      ?>
                        <li>
                          <i class="fa fa-comment bg-purple"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($af->fb_cdate));?></span>
                            <h3 class="timeline-header"><a href="#"><?php echo $af->fb_fname; ?> <?php echo $af->fb_lname; ?></a> commented on <?php echo $af->fb_recipe; ?></h3>
                            <div class="timeline-body">
                              <?php echo $af->fb_comment; ?>
                            </div>
                          </div>
                        </li>
                      <?php  
                    }
                  }
                }
              }
            ?>
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->