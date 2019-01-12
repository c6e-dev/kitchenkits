
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="<?php echo site_url('branch');?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        <li class="active"><a href="<?php echo site_url('branch/supply_view');?>"><i class="fa fa-cubes"></i> <span>Supply</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Supply<small>Kitchen Kits</small></h1>
    </section>

    <section class="content container-fluid">
      <div>
        <button type="button" class="btn btn-sm bg-blue btn-flat" style="margin: 0px 5px 10px 0px" data-toggle="modal" data-target="#add_supply" data-backdrop="static"><i class="fa fa-plus-circle"></i> </button>
      </div>
      <div class="box box-primary">
        <div class="box-body table-responsive">
          <table class="display table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Ingredient Name</th>
                <th>Supply</th>
                <th>Last Resupply Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if ($supply!=NULL) {
                  foreach ($supply as $su) {
                  ?>
                    <tr>
                      <td><?php echo $su->bi_name; ?></td>
                      <td><?php echo str_replace("’", "'", $su->bi_supply." ".$su->bi_unit)?></td>
                      <td><?php echo $su->bi_date; ?></td>
                    </tr>
                  <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal fade" id="add_supply">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><strong>Add Supply</strong></h4>
            </div>
            <form class="form-horizontal">
              <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <div class="alert alert-danger" align="center" style="display: none;"></div>
                  </div>
                  <div class="row form-group" style="margin-bottom: 25px">
                    <div class="col-md-4">
                      <label>Ingredient <small style="font-weight: normal;"></small></label>
                      <select name="ingr" id="ingr" class="form-control select2" style="width: 100%;">
                        <?php
                          foreach ($supply as $su) {
                            ?>
                              <option value="<?php echo $su->bi_name; ?>"><?php echo $su->bi_name; ?></option>
                            <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label>Amount</label>
                      <input type="text" name="amount" id="amount" class="form-control input-sm">
                    </div>
                    <div class="col-md-4">
                      <label>Unit</label>
                      <select name="unit" id="unit" class="form-control select2" style="width: 100%;">
                        <?php
                          foreach ($supply as $su) {
                            ?>
                              <option value="<?php echo $su->bi_unit; ?>"><?php echo $su->bi_unit; ?></option>
                            <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="add_supply" class="btn btn-sm btn-primary">Confirm</button>
                <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>