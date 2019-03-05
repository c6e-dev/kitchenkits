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

<div class="content-wrapper">
  <?php 
    if ($cart!=NULL) {
      ?>
        <section class="content-header">
          <h1>
            Your Cart
          </h1>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-md-8">
              <div class="box box-danger">
                <div class="box-body">
                  <ul class="products-list product-list-in-box" >
                    <?php
                      foreach ($cart as $item) {
                        ?>
                          <li class="item">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="product-img" style="margin-left: 15px">
                                  <img src="<?php echo base_url('Recipe_Folder/'.$item->re_name.'/'.$item->re_img); ?>" alt="Item Image">
                                </div>
                                <div class="product-info" style="margin-left: 120px">
                                  <a href="<?php echo site_url('customer/view_recipe'.'?id='.$item->re_id); ?>" class="product-title a-item"><?php echo $item->re_name; ?><span class="info-box-number pull-right">₱<?php echo $item->re_price; ?></span></a>
                                  <?php echo '
                                    <span class="product-description">
                                      <button type="button" class="btn btn-xs btn-flat" data-target="#cartitem'.$item->oc_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash-o"></i>
                                      </button>
                                    </span>';?>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <form class="form-horizontal">
                                  <div class="input-group" style="margin-left: 140px">
                                    <?php
                                      if ($item->qntty!=1) {
                                        ?>
                                          <span class="input-group-btn"><button class="btn btn-md btn-flat itemdec" data-id="<?php echo $item->oc_id; ?>"><i class="fa fa-minus"></i></button></span>
                                        <?php
                                      }else{
                                        ?>
                                          <span class="input-group-btn"><button class="btn btn-md btn-flat itemdec" data-id="<?php echo $item->oc_id; ?>" style="pointer-events: none; cursor: default; opacity: 0.7;"><i class="fa fa-minus"></i></button></span>
                                        <?php
                                      }
                                    ?>
                                    <input type="text" id="itemcount<?php echo $item->oc_id; ?>" data-id="<?php echo $item->oc_id; ?>" value="<?php echo $item->qntty; ?>" class="form-control itemcount" style="width: 40px;text-align: center;">
                                    <button class="btn btn-md btn-flat iteminc" data-id="<?php echo $item->oc_id; ?>"><i class="fa fa-plus"></i></button>
                                  </div>
                                </form>
                                <span class="product-description" style="margin-left: 140px">Quantity</span>
                              </div>
                            </div>
                          </li>
                          <div class="container">
                            <?php echo'
                            <div class="modal fade" id="cartitem'.$item->oc_id.'">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Remove From Cart</h5>
                                  </div>
                                  <div class="modal-body">
                                    <strong><center>This Recipe Will Be Removed From Your Cart</center></strong>
                                  </div>';?>
                                  <div class="modal-footer">
                                    <a href="<?php echo site_url('customer/delete_cart_item/'.$item->oc_id.'/'.$item->od_id.'/'.$count[0]->od_id_count);?>" class="btn btn-sm btn-primary">Confirm</a>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                      }
                    ?>
                  </ul>
                </div>
              </div>
              <button type="button" data-target="#add_ingredient" data-toggle="modal" class="btn btn-sm btn-flat btn-danger pull-right" data-backdrop="static">Additional Ingredients</button>
            </div>
            <div class="col-md-4">
              <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Order Summary</h3>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td>Item/s</td>
                          <td class="pull-right">Total</td>
                        </tr>
                        <?php
                          foreach ($cart as $item) {
                            echo '
                              <tr>
                                <td>'.$item->qntty.' '.$item->re_name.' @ '.$item->re_price.'</td>
                                <td class="pull-right">₱'.round($item->re_price*$item->qntty, 2).'</td>
                              </tr>
                            ';
                          }
                          if ($additional!=NULL) {
                            foreach ($additional as $adt) {
                              echo '
                                <tr>
                                  <td>
                                    <button class="btn btn-xs btn-info btn-flat" style="background-color: transparent;border-color: transparent;color: #17a2b8;padding:0px 0px 0px 0px;" data-target="#edit_adt_ingr'.$adt->ai_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-xs btn-warning btn-flat" style="background-color: transparent;border-color: transparent;color: #ffc107;padding:0px 0px 3px 0px;margin:0px 5px 0px 0px" data-target="#del_adt_ingr'.$adt->ai_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash-o"></i>
                                    </button> '.$adt->ig_name.' ~ '.$adt->ig_amnt.' '.$adt->ig_unit.'
                                  </td>
                                  <td class="pull-right">₱'.round($adt->ig_amnt*$adt->ig_prc, 2).'</td>
                                </tr>
                              ';
                              ?>
                                <?php echo '
                                <div class="modal fade" id="edit_adt_ingr'.$adt->ai_id.'">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title"><strong>Edit Ingredients</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
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
                                                <input type="text" id="adt_nm'.$adt->ai_id.'" class="form-control input-sm" value="'.$adt->ig_name.'" readonly>
                                              </div>
                                              <div class="col-md-4">
                                                <label>Amount</label>
                                                <input type="text" id="adt_amount'.$adt->ai_id.'" class="form-control input-sm" value="'.$adt->ig_amnt.'">
                                              </div>
                                              <div class="col-md-3">
                                                <label>Unit</label>
                                                <input type="text" class="form-control input-sm" readonly value="'.$adt->ig_unit.'" readonly>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" data-id="'.$adt->ai_id.'" class="btn btn-sm btn-primary update_adt_ingr">Confirm</button>
                                          <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                                        </div>';?>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <?php echo'
                                <div class="modal fade" id="del_adt_ingr'.$adt->ai_id.'">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5>Remove '.$adt->ig_name.'</h5>
                                      </div>
                                      <div class="modal-body">
                                        <strong><center>'.$adt->ig_name.' Will Be Removed</center></strong>
                                      </div>';?>
                                      <div class="modal-footer">
                                        <a href="<?php echo site_url('customer/delete_additional_item'.'?id='.$adt->ai_id);?>" class="btn btn-sm btn-primary">Confirm</a>
                                        <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php
                            }
                          }
                          $subtotal = round($stotalprice[0]->stotalprice+$additional_ttl[0]->additionaltotal, 2);
                          $vat = round($subtotal*0.13, 2);
                          $shipercent = $stotal[0]->stotalcount*0.005;
                          $sfee = round($subtotal*$shipercent, 2);
                          $total = round($subtotal+$vat+$sfee, 2);
                            echo '
                              <tr>
                                <th class="text">Subtotal ('.$stotal[0]->stotalcount.' Items)</th>
                                <td><span class="info-box-number pull-right">₱'.$subtotal.'</span></td>
                              </tr>
                              <tr>
                                <th class="text">VAT</th>
                                <td><span class="info-box-number pull-right">₱'.$vat.'</span></td>
                              </tr>
                              <tr>
                                <th class="text">Shipping Fee</th>
                                <td><span class="info-box-number pull-right">₱'.$sfee.'</span></td>
                              </tr>
                              <tr>
                                <th>Total</th>
                                <td><span class="info-box-number pull-right text-green">₱'.$total.'</span></td>
                              </tr>
                          ';
                        ?>
                      </table>
                    </div>
                    <button data-target="#confirm_order" data-toggle="modal" class="btn btn-block btn-danger" data-backdrop="static"><b style="color:white;">Confirm Order</b></button>
                  </div>
                </div>
            </div>
          </div>
        </section>
      <?php
    }
    else{
      ?>
        <section class="content">
          <div class="container">
            <div style="position: absolute;top: 35%;left: 50%;transform: translate(-50%,-50%);text-align: center">
              <h5><b>There Are No Items In This Cart</b></h5>    
            </div>
          </div>
        </section>
      <?php
    }
  ?>
  <div class="modal fade" id="confirm_order">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><strong><center>Order Confirmation</center></strong></h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <center><b>Reminders</b></center>
            <br>
            <center><b>When Checking Out: </b></center>
            <center>You Cannot Cancel Your Order Once You Checkout.</center>
            <br>
            <center><b>When Deliveries Are Late: </b></center>
            <center>If The Delivery Is 10 Minutes Late, You Are No Longer Required To Pay The Delivery Fee.</center>
          </div>
        </div>
        <div class="modal-footer">
          <button data-id="<?php echo $cart[0]->od_id;?>" total="<?php echo $total;?>" type="button" id="checkout" class="btn btn-sm btn-danger">Checkout</button>
          <button type="button" class="btn btn-sm" data-dismiss="modal" id="cancelcheckout">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="add_ingredient">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><strong>Additional Ingredients</strong></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
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
                  <select name="adt_ingr" id="adt_ingr" class="form-control select2" style="width: 100%;">
                    <option value="0" disabled selected>-- Select Ingredient --</option>
                    <?php
                      foreach ($condiments as $con) {
                        echo '
                          <option value="'.$con->ig_id.'" id="'.$con->ig_unit.'">'.$con->ig_name.'</option>
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
            <input type="hidden" id="od_id" value="<?php echo $cart[0]->od_id; ?>">
            <button type="button" id="add_adt_ingr" class="btn btn-sm btn-primary">Confirm</button>
            <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>