  <style>
  .grid-container {
    display: grid;
    grid-template-columns: auto auto;
  }
  .grid-item {
    /*text-align: center;*/
    padding: 5px;
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
      <h1>Order Details<small><?php echo $detail[0]->od_code?></small></h1>
    </section>

    <!-- <section class="content container-fluid">
      <div><?php echo $detail[0]->od_status?></div>
    </section> -->

    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="grid-container">
            <?php
            if ($detail!=NULL) {
              $var = 0;
              foreach ($detail as $de) {
                ?>
                  <div class="grid-item">
                    <div class="col-md-24">
                      <div class="box box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title"><?php echo $de->od_quantity." x ".$de->od_recipe?></h3>
                        </div>
                        <div class="box-body">
                          <div class="box-body table-responsive no-padding">
                            <table class="table table-condensed">
                              <tr>
                                <th >Name</th>
                                <th style="text-align: right;">Amount</th>
                              </tr>
                              <?php
                                foreach ($ingredient[$var] as $ing) {
                                  ?>
                                    <tr>
                                      <td><?php echo $ing->ri_ingredient;?></td>
                                      <td style="text-align: right;"><?php echo $ing->ri_amount;?></td>
                                    </tr>
                                  <?php
                                }
                              ?>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                $var += 1;
              }
            }
            ?>
          </div>
        </div>
      </div>
    </section>
  </div>