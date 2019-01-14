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

    <section class="content container-fluid">
      <div><?php echo $detail[0]->od_status?></div>
    </section>
  </div>