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
        <li class = "active"><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
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
      <!-- <h1><?php echo $customer[0]->cs_fname." ".$customer[0]->cs_lname?><small>Under Construction</small></h1> -->
      <h1>Customers<small>Kitchen Kits</small></h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info-circle"></i>

              <h3 class="box-title">Customer Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd><?php echo $customer[0]->cs_code?></dd>
                <dt>Name</dt>
                <dd><?php echo $customer[0]->cs_fname." ".$customer[0]->cs_lname?></dd>
                <dt>Address</dt>
                <dd><?php echo $customer[0]->cs_address?></dd>
                <dt>Creation Date</dt>
                <dd><?php echo $customer[0]->cs_create?></dd>
                <dt>Last Update Date</dt>
                <dd><?php echo $customer[0]->cs_update?></dd>
              </dl>
            <!-- /.box-body -->
            </div>
          <!-- /.box -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box-header">
            <i class="fa fa-history"></i>
            <h3 class="box-title">Activity</h3>
          </div>
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
                    if ($c_activity!=NULL) {
                      foreach ($c_activity as $cact) {
                        $new_date = date('M d, Y', strtotime($cact->fb_cdate));
                        if ($new_date == $current_date) {
                          if ($cact->fb_type == 1) {
                            ?>
                              <li>
                                <i class="fa fa-shopping-cart bg-blue"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($cact->fb_cdate));?></span>
                                  <h3 class="timeline-header"><a href="#"><?php echo $cact->fb_fname; ?> <?php echo $cact->fb_lname; ?></a> ordered <?php echo $cact->fb_recipe; ?></h3>
                                </div>
                              </li>
                            <?php  
                          }
                          if ($cact->fb_type == 3) {
                            ?>
                              <li>
                                <i class="fa fa-star bg-yellow"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($cact->fb_cdate));?></span>
                                  <h3 class="timeline-header"><a href="#"><?php echo $cact->fb_fname; ?> <?php echo $cact->fb_lname; ?></a> rated <?php echo $cact->fb_rating; ?> stars on <?php echo $cact->fb_recipe; ?></h3>
                                </div>
                              </li>
                            <?php  
                          }
                          if ($cact->fb_type == 4) {
                            ?>
                              <li>
                                <i class="fa fa-comment bg-red"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($cact->fb_cdate));?></span>
                                  <h3 class="timeline-header"><a href="#"><?php echo $cact->fb_fname; ?> <?php echo $cact->fb_lname; ?></a> commented on <?php echo $cact->fb_recipe; ?></h3>
                                  <div class="timeline-body">
                                    <?php echo $cact->fb_comment; ?>
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
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-shopping-cart"></i>

              <h3 class="box-title">Order History</h3>
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
                            <th>Branch</th>
                            <th>Created Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if ($c_order!=NULL) {
                              foreach ($c_order as $cod) {
                                if($cod->od_status == 'I') {
                                ?>
                                  <tr>
                                    <td><?php echo $cod->od_code; ?></td>
                                    <td><?php echo $cod->od_branch; ?></td>
                                    <td><?php echo $cod->od_create; ?></td>
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
                            <th>Branch</th>
                            <th>Created Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if ($c_order!=NULL) {
                              foreach ($c_order as $cod) {
                                if($cod->od_status == 'C') {
                                ?>
                                  <tr>
                                    <td><?php echo $cod->od_code; ?></td>
                                    <td><?php echo $cod->od_branch; ?></td>
                                    <td><?php echo $cod->od_create; ?></td>
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