<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kitchen Kits | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <link rel="shortcut icon" href="<?php echo base_url('assets/img/KKIcon.png');?>">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <section class="invoice">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-cutlery"></i> Kitchen Kits, Inc.
          <small class="pull-right">Date: <?php echo date('F d, Y'); ?></small>
        </h2>
      </div>
    </div>
    <div class="row invoice-info">
      <?php echo '
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>'.$detail[0]->br_name.'</strong><br>'.$detail[0]->bm_name.'<br>'.$detail[0]->br_addr.'
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>'.$detail[0]->cs_fname.' '.$detail[0]->cs_lname.'</strong><br>'.$detail[0]->cs_haddr.'<br>Email: '.$detail[0]->cs_eaddr.'
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Order ID:</b> '.$detail[0]->od_code.'<br>
      </div>';?>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead" style="margin-bottom: 0px;">Recipes:</p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th><center>Quantity</center></th>
              <th><center>Price</center></th>
              <th><center>Total</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $shipercent = 0;
              foreach ($detail as $values) {
                echo '
                  <tr>
                    <td>'.$values->od_recipe.'</td>
                    <td><center>'.$values->od_quantity.'</center></td>
                    <td><center>'.$values->re_price.'</center></td>
                    <td><center>'.$values->od_quantity*$values->re_price.'</center></td>
                  </tr>
                ';
                $shipercent += $values->od_quantity;
                
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
        <?php 
          if ($additional!=NULL) {
            ?>
              <p class="lead" style="margin-bottom: 0px;">Additional Ingredients:</p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th><center>Amount</center></th>
                    <th><center>Price</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      foreach ($additional as $values) {
                        echo '
                          <tr>
                            <td>'.$values->ig_name.'</td>
                            <td><center>'.$values->ig_amnt.' '.$values->ig_unit.'</center></td>
                            <td><center>'.round($values->ig_amnt*$values->ig_prc, 2).'</center></td>
                          </tr>
                        ';
                      }
                  ?>
                </tbody>
              </table>
            <?php
          }
        ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        
      </div>
      <div class="col-xs-6">
        <div class="table-responsive">
          <table class="table">
            <?php
              $subtotal = round($stotalprice[0]->stotalprice+$additional_ttl[0]->additionaltotal, 2);
              $vat = round($subtotal*0.13, 2);
              $percent = $shipercent*0.005;
              $sfee = round($subtotal*$percent, 2);
              $total = round($subtotal+$vat+$sfee, 2);
              echo '
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>'.$subtotal.'</td>
                </tr>
                <tr>
                  <th>VAT (13%)</th>
                  <td>'.$vat.'</td>
                </tr>
                <tr>
                  <th>Delivery Fee:</th>
                  <td>'.$sfee.'</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>'.$total.'</td>
                </tr>
              ';?>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ./wrapper -->
</body>
</html>
