
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
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if ($supply!=NULL) {
                  foreach ($supply as $su) {
                  ?>
                    <tr>
                      <td><?php echo $su->bi_name; ?></td>
                      <td><?php echo $su->bi_supply." ".$su->bi_unit?></td>
                      <td><?php echo $su->bi_date; ?></td>
                      <td><center>
                        <?php echo '
                          <button type="button" class="btn btn-xs btn-danger" data-target="#reduce_supply'.$su->bri_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-minus"></i></button>
                          <button type="button" class="btn btn-xs btn-success" data-target="#resupply'.$su->bri_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-plus"></i></button>';
                        ?>
                      </center></td>
                    </tr>
                    <?php echo '
                    <div class="modal fade" id="resupply'.$su->bri_id.'">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><strong>Resupply</strong></h4>
                          </div>
                          <form class="form-horizontal">
                            <div class="modal-body">
                              <div class="box-body">
                                <div class="form-group">
                                  <div class="alert alert-danger" align="center" style="display: none;"></div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-md-5">
                                    <label>Ingredient</label>
                                    <input type="text" name="res_ingr" id="res_ingr" class="form-control input-sm" value="'.$su->bi_name.'" readonly>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="text" name="res_amount" id="res_amount" class="form-control input-sm">
                                  </div>
                                  <div class="col-md-3">
                                    <label>Unit</label>
                                    <input type="text" id="res_unit" class="form-control input-sm" value="'.$su->bi_unit.'" readonly>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" id="crrnt_amnt" value="'.$su->bi_supply.'">
                              <input type="hidden" id="bi_id" value="'.$su->bri_id.'">';?>
                              <button type="button" id="submit_resupply" class="btn btn-sm btn-primary">Confirm</button>
                              <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php echo '
                    <div class="modal fade" id="reduce_supply'.$su->bri_id.'">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><strong>Reduce Supply</strong></h4>
                          </div>
                          <form class="form-horizontal">
                            <div class="modal-body">
                              <div class="box-body">
                                <div class="form-group">
                                  <div class="alert alert-danger" align="center" style="display: none;"></div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-md-5">
                                    <label>Ingredient</label>
                                    <input type="text" name="upt_ingr" id="upt_ingr" class="form-control input-sm" value="'.$su->bi_name.'" readonly>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="text" name="upt_amount" id="upt_amount" class="form-control input-sm">
                                  </div>
                                  <div class="col-md-3">
                                    <label>Unit</label>
                                    <input type="text" id="upt_unit" class="form-control input-sm" value="'.$su->bi_unit.'" readonly>
                                  </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-md-12">
                                    <label>Reason</label>
                                    <textarea style="resize: none" class="form-control" name="reason" id="reason" rows="3"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" id="crrnt_amnt" value="'.$su->bi_supply.'">
                              <input type="hidden" id="bi_id" value="'.$su->bri_id.'">
                              <input type="hidden" id="branch_id" value="'.$supply[0]->branch_id.'">';?>
                              <button type="button" id="submit_redsupply" class="btn btn-sm btn-primary">Confirm</button>
                              <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                            </div>
                          </form>
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
                  <div class="row form-group">
                    <div class="col-md-5">
                      <label>Ingredient</label>
                      <select name="ingr" id="ingr" class="form-control select2" style="width: 100%;">
                        <option value="0" disabled selected>-- Select Ingredient --</option>
                        <?php
                          foreach ($ingredient as $ing) {
                            echo '
                              <option value="'.$ing->ing_id.'" id="'.$ing->ing_un.'">'.$ing->ing_nm.'</option>
                            ';
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label>Amount</label>
                      <input type="text" name="amount" id="amount" class="form-control input-sm">
                    </div>
                    <div class="col-md-3">
                      <label>Unit</label>
                      <input type="text" id="unit" class="form-control input-sm" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" id="branch_id" value="<?php echo $supply[0]->branch_id; ?>">
                <button type="button" id="submit_supply" class="btn btn-sm btn-primary">Confirm</button>
                <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>