
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
        <button type="button" class="btn btn-sm bg-blue btn-flat" style="margin: 0px 5px 10px 0px" data-toggle="modal" data-target="#restock" data-backdrop="static">RESUPPLY</button>
        <button type="button" class="btn btn-sm bg-blue btn-flat" style="margin: 0px 5px 10px 0px" data-toggle="modal" data-target="#addnew" data-backdrop="static">ADD NEW INGREDIENTS</button>
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
                          <button type="button" class="btn btn-xs btn-danger" data-target="#reduce_supply'.$su->bri_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-minus"></i></button>';
                        ?>
                      </center></td>
                    </tr>
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
      <div class="modal fade" id="restock">
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
                      <select name="resingr" id="resingr" class="form-control select2" style="width: 100%;">
                        <option value="0" disabled selected>-- Select Ingredient --</option>
                        <?php
                          if ($supply!=NULL) {
                            foreach ($supply as $su) {
                              echo '
                                <option value="'.$su->bi_id.'" data-id="'.$su->bri_id.'" id="'.$su->bi_unit.'">'.$su->bi_name.'</option>
                              ';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div id="ingr-scroll">
                    <div class="row form-group labels" style="margin-bottom: 0px;display: none;">
                      <div class="col-md-5">
                        <label>Name</label>
                      </div>
                      <div class="col-md-4">
                        <label>Amount</label>
                      </div>
                      <div class="col-md-3">
                        <label>Unit</label>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="submit_resupply" class="btn btn-sm btn-primary" disabled>Confirm</button>
                <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="addnew">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><strong>Add New Ingredients</strong></h4>
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
                          if ($ingredients!=NULL) {
                            foreach ($ingredients as $ig) {
                              echo '
                                <option value="'.$ig->ig_id.'" id="'.$ig->bi_unit.'">'.$ig->bi_name.'</option>
                              ';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div id="ingr1-scroll">
                    <div class="row form-group label" style="margin-bottom: 0px;display: none;">
                      <div class="col-md-5">
                        <label>Name</label>
                      </div>
                      <div class="col-md-4">
                        <label>Amount</label>
                      </div>
                      <div class="col-md-3">
                        <label>Unit</label>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" id="branch_id" value="<?php echo $supply[0]->branch_id ?>">
                <button type="button" id="submit_adds" class="btn btn-sm btn-primary" disabled>Confirm</button>
                <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>