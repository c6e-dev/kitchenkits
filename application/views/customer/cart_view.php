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
                                <div class="product-img">
                                  <img src="<?php echo base_url('assets/dist/img/default-50x50.gif');?>" alt="Product Image">
                                </div>
                                <div class="product-info">
                                  <a href="javascript:void(0)" class="product-title a-item"><?php echo $item->re_name; ?><span class="info-box-number pull-right">₱<?php echo $item->re_price; ?></span></a>
                                  <?php echo '<span class="product-description"><button type="button" class="btn btn-xs btn-flat" data-target="#cartitem'.$item->oc_id.'" data-toggle="modal" data-backdrop="static"><i class="fa fa-trash-o"></i></button></span>';?>
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
                                    <input type="text" id="itemcount<?php echo $item->oc_id; ?>" data-id="<?php echo $item->oc_id; ?>" value="<?php echo $item->qntty; ?>" class="form-control itemcount" style="width: 40px;">
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
                                    <strong><center>Recipe will be removed from cart</center></strong>
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
                          <td>Item</td>
                          <td class="pull-right">Total</td>
                        </tr>
                        <?php 
                          foreach ($cart as $item) {
                            ?>
                              <tr>
                                <td><?php echo $item->qntty; ?> <?php echo $item->re_name; ?> @ ₱<?php echo $item->re_price; ?></td>
                                <td class="pull-right">₱<?php echo $item->re_price*$item->qntty; ?></span></td>
                              </tr>
                            <?php
                          }
                        ?>
                        <?php
                          $subtotal = $stotalprice[0]->stotalprice;
                          $vat = $subtotal*0.015;
                          $total = $subtotal+$vat;
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
                              <th>Total</th>
                              <td><span class="info-box-number pull-right text-green">₱'.$total.'</span></td>
                            </tr>
                          ';
                        ?>
                      </table>
                    </div>
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
</div>