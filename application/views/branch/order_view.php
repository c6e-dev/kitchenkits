  <style>
  .grid-container {
    display: grid;
    grid-template-columns: auto;
  }
  .grid-item {
    /*text-align: center;*/
  }
  .a-item {
    color: black;
  }
  .a-item:hover {
    color: black;
  }
  .a-item:active {
    color: black;
  }
  </style>

  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active"><a href="<?php echo site_url('branch');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li><a href="<?php echo site_url('branch/supply_view');?>"><i class="fa fa-cubes"></i> <span>Supply</span></a></li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Orders<small>Kitchen Kits</small></h1>
    </section>
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="grid-container">
            <?php
            if ($order!=NULL) {
              $var = 0;
              foreach ($order as $od) {
                ?>
                  <div class="grid-item">
                    <div class="col-md-24">
                      <a class="a-item" href="<?php echo site_url('branch_detail_view/'.'?id='.$od->od_id);?>">
                        <div class="info-box">
                          <span class="info-box-icon bg-green"><?php echo $count[$var][0]->qty?></span>
                          <div class="info-box-content">
                            <span class="info-box-text"><?php echo str_replace("’", "'", $od->od_fname." ".$od->od_lname)?></span>
                            <span class="info-box-number"><?php echo date('M d, Y - g:i a', strtotime($od->od_create));?></span>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                <?php
                $var += 1;
              }
            }
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="grid-container">
            <?php
            if ($inc_order!=NULL) {
              $ivar = 0;
              foreach ($inc_order as $iod) {
                ?>
                  <div class="grid-item">
                    <div class="col-md-24">
                      <a class="a-item" href="<?php echo site_url('branch_detail_view/'.'?id='.$iod->od_id);?>">
                        <div class="info-box">
                          <span class="info-box-icon bg-red"><?php echo $icount[$ivar][0]->qty?></span>
                          <div class="info-box-content">
                            <span class="info-box-text"><?php echo str_replace("’", "'", $iod->od_fname." ".$iod->od_lname)?></span>
                            <span class="info-box-number"><?php echo date('M d, Y - g:i a', strtotime($iod->od_create));?></span>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                <?php
                $ivar += 1;
              }
            }
            ?>
          </div>
        </div>
      </div>
    </section>
  </div>