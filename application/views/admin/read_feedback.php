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
        <li class = "active"><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
        <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
        <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
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
      <h1>Feedback<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
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
              if ($feedback!=NULL) {
                foreach ($feedback as $fb) {
                  $new_date = date('M d, Y', strtotime($fb->fb_cdate));
                  if ($new_date == $current_date) {
                    if ($fb->fb_type == 3) {
                      ?>
                        <li>
                          <i class="fa fa-star bg-yellow"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($fb->fb_cdate));?></span>
                            <h3 class="timeline-header"><a href="#"><?php echo $fb->fb_fname; ?> <?php echo $fb->fb_lname; ?></a> rated <?php echo $fb->fb_rating; ?> stars on <?php echo $fb->fb_recipe; ?></h3>
                          </div>
                        </li>
                      <?php  
                    }
                    if ($fb->fb_type == 4) {
                      ?>
                        <li>
                          <i class="fa fa-comment bg-red"></i>
                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($fb->fb_cdate));?></span>
                            <h3 class="timeline-header"><a href="#"><?php echo $fb->fb_fname; ?> <?php echo $fb->fb_lname; ?></a> commented on <?php echo $fb->fb_recipe; ?></h3>
                            <div class="timeline-body">
                              <?php echo $fb->fb_comment; ?>
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
          <br>
          <button type="button" class="btn btn-sm bg-purple btn-flat active" id="3gr" data-target="#history" data-toggle="collapse">View History</button>
          <hr>
          <div id="history" class="collapse">
            <ul class="timeline">
              <?php 
                for ($i=1; $i <= 7 ; $i++) { 
                  $prev_date = date('M d, Y', strtotime('-'.$i.' day',strtotime($current_date)));
                  ?>
                    <li class="time-label">
                      <span class="bg-gray" style="color: gray;">
                        <?php 
                          echo $prev_date;
                        ?>
                      </span>
                    </li>
                  <?php
                  if ($feedback!=NULL) {
                    foreach ($feedback as $pfb) {
                      $new_date = date('M d, Y', strtotime($pfb->fb_cdate));
                      if ($new_date == $prev_date) {
                        if ($pfb->fb_type == 3) {
                          ?>
                            <li>
                              <i class="fa fa-star bg-yellow"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($pfb->fb_cdate));?></span>
                                <h3 class="timeline-header"><a href="#"><?php echo $pfb->fb_fname; ?> <?php echo $pfb->fb_lname; ?></a> rated <?php echo $pfb->fb_rating; ?> stars on <?php echo $pfb->fb_recipe; ?></h3>
                              </div>
                            </li>
                          <?php  
                        }
                        if ($pfb->fb_type == 4) {
                          ?>
                            <li>
                              <i class="fa fa-comment bg-red"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($pfb->fb_cdate));?></span>
                                <h3 class="timeline-header"><a href="#"><?php echo $pfb->fb_fname; ?> <?php echo $pfb->fb_lname; ?></a> commented on <?php echo $pfb->fb_recipe; ?></h3>
                                <div class="timeline-body">
                                  <?php echo $pfb->fb_comment; ?>
                                </div>
                              </div>
                            </li>
                          <?php  
                        }
                      }
                    }
                  }
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </div>