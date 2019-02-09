<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Your Profile
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-danger">
          <div class="box-body box-profile">
            <!-- <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" alt="User profile picture"> -->

            <h3 class="profile-username text-center"><?php echo $v_profile[0]->cs_fname." ".$v_profile[0]->cs_lname?></h3>
            <p class="text-muted text-center"><?php echo $v_profile[0]->cs_code?></p>
            <hr>
            <strong><i class="fa fa-envelope margin-r-5"></i> E-Mail</strong>
            <p class="text-muted"><?php echo $v_profile[0]->cs_email?></p>
            <hr>
            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
            <p class="text-muted"><?php echo $v_profile[0]->cs_address?></p>
            <hr>
            <button data-target="#update_profile" data-toggle="modal" class="btn btn-danger btn-block" data-backdrop="static"><b style="color:white;">Update Profile</b></button>
          </div>
        </div>
        <?php
          if ($v_recent_order!=NULL) {
            ?>
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Recent Order</h3>
                </div>
                <?php 
                  if ($order_count>=5) {
                    ?><div class="box-body" id="recent_order-scroll"><?php
                  }else{
                    ?><div class="box-body"><?php
                  }
                ?>
                  <ul class="products-list product-list-in-box">
                  <?php
                    foreach ($v_recent_order as $ror) {
                      ?>
                        <li class="item">
                          <div class="product-img">
                            <img src="<?php echo base_url('Recipe_Folder/'.$ror->rname.'/'.$ror->rimg); ?>" alt="Item Image" style="border-radius: 5px;">
                          </div>
                          <div class="product-info">
                            <a href="<?php echo site_url('customer/view_recipe'.'?id='.$ror->rid); ?>" class="product-title"><?php echo $ror->rname; ?>
                              <span class="label label-info pull-right">₱<?php echo $ror->total; ?></span></a>
                            <span class="product-description">
                              <?php echo date('M d, Y g:i a', strtotime($ror->cdate));?>
                            </span>
                          </div>
                        </li>
                      <?php
                    }
                  ?>
                  </ul>
                </div>
              </div>
            <?php
          }
        ?>
      </div>

      <div class="modal fade" id="update_profile">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><strong>Update Profile</strong></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

            </div>
            <form>
              <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <div class="alert alert-danger" align="center" style="display: none;"></div>
                  </div>
                  <div class="row form-group">
                    <label class="col-sm-3 control-label">Username</label>
                    <!-- <label class="col-md-1"></label> -->
                    <div class="col-12 col-md-9"><input type="text" class="form-control" id="cs_username" class="form-control input-sm" value="<?php echo $v_profile[0]->cs_username?>"></div>
                  </div>
                  <div class="row form-group">
                    <label class="col-sm-3 control-label">First Name</label>
                    <div class="col-12 col-md-9"><input type="text" class="form-control" id="cs_fname" class="form-control input-sm" value="<?php echo $v_profile[0]->cs_fname?>"></div>
                  </div>
                  <div class="row form-group">
                    <label class="col-sm-3 control-label">Last Name</label>
                    <div class="col-12 col-md-9"><input type="text" class="form-control" id="cs_lname" class="form-control input-sm" value="<?php echo $v_profile[0]->cs_lname?>"></div>
                  </div>
                  <div class="row form-group">
                    <label class="col-sm-3 control-label">E-Mail</label>
                    <div class="col-12 col-md-9"><input type="text" class="form-control" id="cs_email" class="form-control input-sm" value="<?php echo $v_profile[0]->cs_email?>"></div>
                  </div>
                  <div class="row form-group">
                    <label class="col-sm-3 control-label">Address</label>
                    <div class="col-12 col-md-9"><input type="text" class="form-control" id="cs_address" class="form-control input-sm" value="<?php echo $v_profile[0]->cs_address?>"></div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="cs_id" id="cs_id" value="<?php echo $v_profile[0]->id?>">
                <input type="hidden" name="u_id" id="u_id" value="<?php echo $_SESSION['id']; ?>">
                <button type="button" id="edit_profile" class="btn btn-danger">Save</button>
                <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="box box-danger">
          <div class="box-header with-border">
            <i class="fa fa-history"></i>
            <h3 class="box-title">Activity Feed</h3>
          </div>
          <section class="content" style="min-height: auto;">
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
                    if ($v_history!=NULL) {
                      foreach ($v_history as $cact) {
                        $new_date = date('M d, Y', strtotime($cact->fb_cdate));
                        if ($new_date == $current_date) {
                          if ($cact->fb_type == 3) {
                            ?>
                              <li>
                                <i class="fa fa-star bg-yellow"></i>
                                <div class="timeline-item"  style="background-color: #f5f5f5">
                                  <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($cact->fb_cdate));?></span>
                                  <h3 class="timeline-header"><a href="#">You</a> rated <?php echo $cact->fb_rating; ?> stars on <?php echo $cact->fb_recipe; ?></h3>
                                </div>
                              </li>
                            <?php
                          }
                          if ($cact->fb_type == 4) {
                            ?>
                              <li>
                                <i class="fa fa-comment bg-red"></i>
                                <div class="timeline-item"  style="background-color: #f5f5f5">
                                  <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($cact->fb_cdate));?></span>
                                  <h3 class="timeline-header"><a href="#">You</a> commented on <?php echo $cact->fb_recipe; ?></h3>
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
                <br>
                <button type="button" class="btn btn-sm bg-red btn-flat active" id="3gr" data-target="#history" data-toggle="collapse">View History</button>
                <hr>
                <div id="history" class="collapse" style="margin-bottom: 0px; padding-bottom: 0px; box-sizing: border-box;">
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
                        foreach ($v_history as $cact) {
                          $new_date = date('M d, Y', strtotime($cact->fb_cdate));
                          if ($new_date == $prev_date) {
                            if ($cact->fb_type == 3) {
                              ?>
                                <li>
                                  <i class="fa fa-star bg-yellow"></i>
                                  <div class="timeline-item " style="background-color: #f5f5f5">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($cact->fb_cdate));?></span>
                                    <h3 class="timeline-header"><a href="#">You</a> rated <?php echo $cact->fb_rating; ?> stars on <?php echo $cact->fb_recipe; ?></h3>
                                  </div>
                                </li>
                              <?php
                            }
                            if ($cact->fb_type == 4) {
                              ?>
                                <li>
                                  <i class="fa fa-comment bg-red"></i>
                                  <div class="timeline-item" style="background-color: #f5f5f5">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('g:i a', strtotime($cact->fb_cdate));?></span>
                                    <h3 class="timeline-header"><a href="#">You</a> commented on <?php echo $cact->fb_recipe; ?></h3>
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
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>
