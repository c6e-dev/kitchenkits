    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li class="active"><a href="<?php echo site_url('admin/view_reports');?>"><i class="fa fa-bar-chart-o"></i> <span>Reports</span></a></li>
          <li><a href="<?php echo site_url('admin/customer_view');?>"><i class="fa fa-users"></i> <span>Customers</span></a></li>
          <li><a href="<?php echo site_url('admin/order_view');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
          <li><a href="<?php echo site_url('admin/feedback_view');?>"><i class="fa fa-comments"></i> <span>Feedback</span></a></li>
          <li><a href="<?php echo site_url('admin/recipe_view');?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a></li>
          <li><a href="<?php echo site_url('admin/branch_view');?>"><i class="ion ion-ios-home"></i> <span>Branches</span></a></li>
          <li><a href="<?php echo site_url('admin/manager_view');?>"><i class="fa fa-user"></i> <span>Managers</span></a></li>
          <li><a href="<?php echo site_url('admin/ingredient_view');?>"><i class="ion ion-ios-home"></i> <span>Ingredients</span></a></li>
        </ul>
      </section>
    </aside>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Reports<small>Kitchen Kits</small></h1>
      </section>
      <section class="content container-fluid">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Sales Report</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="myChart" style="height: 350px;"></canvas>
            </div>
          </div>
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Branch With Most Customers</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="bestbranch" style="height: 350px;"></canvas>
            </div>
          </div>
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Monthly Best Sellers</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="mostOrderedRecipe" style="height: 350px;"></canvas>
            </div>
          </div>
        </div>
      </section>
    </div>