
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
                    <?php 
                      $abri_id = $su->bri_id;
                      echo '
                    <div class="modal fade" id="resupply'.$abri_id.'">
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
                                    <input type="text" class="form-control input-sm" value="'.$su->bi_name.'" readonly>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="text" id="res_amount'.$abri_id.'" class="form-control input-sm">
                                  </div>
                                  <div class="col-md-3">
                                    <label>Unit</label>
                                    <input type="text" class="form-control input-sm" value="'.$su->bi_unit.'" readonly>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" id="crrnt_amnt'.$abri_id.'" value="'.$su->bi_supply.'">
                              <button type="button" data-id="'.$abri_id.'" class="btn btn-sm btn-primary submit_resupply">Confirm</button>';?>
                              <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php 
                      $bri_id = $su->bri_id;
                      echo '
                    <div class="modal fade" id="reduce_supply'.$bri_id.'">
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
                                    <input type="text" class="form-control input-sm" value="'.$su->bi_name.'" readonly>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="text" id="upt_amount'.$bri_id.'" class="form-control input-sm">
                                  </div>
                                  <div class="col-md-3">
                                    <label>Unit</label>
                                    <input type="text" class="form-control input-sm" value="'.$su->bi_unit.'" readonly>
                                  </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-md-12">
                                    <label>Reason</label>
                                    <textarea style="resize: none" class="form-control" id="reason'.$bri_id.'" rows="3"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" id="crrnt_amnt'.$bri_id.'" value="'.$su->bi_supply.'">
                              <input type="hidden" id="branch_id'.$bri_id.'" value="'.$supply[0]->branch_id.'">
                              <button type="button" data-id="'.$bri_id.'" class="btn btn-sm btn-primary submit_redsupply">Confirm</button>';?>
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