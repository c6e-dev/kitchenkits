    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        Kitchen Kits
      </div>
      <strong>Copyright &copy; 2019 <a>RLC Co.</a>.</strong> All Rights Reserved.
    </footer>
    <div class="modal fade" id="change_pass">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><strong>Change Password</strong></h4>
          </div>
          <form class="form-horizontal">
            <div class="modal-body">
              <div class="box-body">
                <div class="form-group">
                  <div class="alert alert-danger" align="center" style="display: none;"></div>
                </div>
                <div class="row form-group">
                  <label class="col-sm-3 control-label">Current Password</label>
                  <div class="col-12 col-md-9"><input type="password" class="form-control" id="curr_pass" class="form-control input-sm"></div>
                </div>
                <div class="row form-group">
                  <label class="col-sm-3 control-label">New Password</label>
                  <div class="col-12 col-md-9"><input type="password" class="form-control" id="new_pass" class="form-control input-sm"></div>
                </div>
                <div class="row form-group">
                  <label class="col-sm-3 control-label">Confirm New</label>
                  <div class="col-12 col-md-9"><input type="password" class="form-control" id="conf_pass" class="form-control input-sm"></div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="u_id" id="u_id" value="<?php echo $_SESSION['id']?>">
              <button type="button" id="save_change_pass" class="btn btn-sm bg-purple">Save</button>
              <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php 
    // include ($_SERVER['DOCUMENT_ROOT'].'/kitchenkits/application/views/branch/layout/ajaxscript.php'); 
    
  ?>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/bower_components/chart.js/Chart.js');?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>

  <script>
    $(function(){

      $('#save_change_pass').on('click', function(){
        var curr_pass = $('#curr_pass').val();
        var new_pass = $('#new_pass').val();
        var conf_pass = $('#conf_pass').val();
        var u_id = $('#u_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/edit_password'); ?>",
            data: {
                curr_password: curr_pass,
                new_password: new_pass,
                cpassword: conf_pass,
                user_id: u_id,
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Password Successfully Updated");
                    location.reload();
                    $('#change_pass').modal('hide');
                }else{
                    $('.alert').css('display', 'block');
                    $('.alert').html(data.notif);
                }
            },
            error: function(){
              alert('ERROR!');
            }
        });return false;
      });

      $.ajax({
        url: "<?php echo site_url('admin/sales_report'); ?>",
        dataType : 'json',
        success: function(data){
          var monthlysales = new Array();
          var current_year = "Monthly Sales Of "+data[0].currentyear;
          for(var i in data){
            monthlysales.push(data[i].salescost);
          }
          var ctx = document.getElementById("myChart");
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
              datasets: [{
                  label: current_year,
                  data: monthlysales,
                  backgroundColor: 'rgba(96,92,168, 0.7)',
                  borderColor: 'rgba(96,92,168, 1)',
                  borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero:true
                  }
                }],
                xAxes: [{
                  gridLines: {
                    display:false
                  }
                }]
              }
            }
          });
        },
        error: function(data){
          alert('ERROR');
          console.log(data);
        }
      });

      $.ajax({
        url: "<?php echo site_url('admin/most_ordered_recipe'); ?>",
        dataType : 'json',
        success: function(data){
          var recipesales = new Array();
          var recipenames = new Array();
          var current_month = "Most Ordered Recipe of "+data[0].month;
          for(var i in data){
            recipesales.push(data[i].recipe_total_sales);
            recipenames.push(data[i].re_name);
          }
          var ctx = document.getElementById("mostOrderedRecipe");
          var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
              labels: recipenames,
              datasets: [{
                  label: current_month,
                  data: recipesales,
                  backgroundColor: 'rgba(96,92,168, 0.7)',
                  borderColor: 'rgba(96,92,168, 1)',
                  borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero:true
                  }
                }],
                xAxes: [{
                  gridLines: {
                    display:false
                  }
                }]
              }
            }
          });
        },
        error: function(data){
          alert('ERROR');
          console.log(data);
        }
      });

      $.ajax({
        url: "<?php echo site_url('admin/best_branch'); ?>",
        dataType : 'json',
        success: function(data){
          var total_count = new Array();
          var branchnames = new Array();
          var current_month = "Best Branch of "+data[0].month;
          for(var i in data){
            total_count.push(data[i].total_customers);
            branchnames.push(data[i].br_name);
          }
          var ctx = document.getElementById("bestbranch");
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: branchnames,
              datasets: [{
                  label: current_month,
                  data: total_count,
                  backgroundColor: 'rgba(96,92,168, 0.7)',
                  borderColor: 'rgba(96,92,168, 1)',
                  borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero:true
                  }
                }],
                xAxes: [{
                  gridLines: {
                    display:false
                  }
                }]
              }
            }
          });
        },
        error: function(data){
          alert('ERROR');
          console.log(data);
        }
      });

      $.ajax({
        method: 'post',
        url: "<?php echo site_url('admin/supply_report'); ?>",
        dataType : 'json',
        success: function(data){
          var count = data.length;
          var notif = '';
          if (count==null) {
            notif = data.notify;
            $('.header').html(notif);
          }
          else{
            $('#notif_count').html(count); 
            for(var i=0; i<count; i++){
              if (data[i].br_rep_tp == 0) {
                notif += '<li><a href="<?php echo site_url(); ?>admin/view_branch_report'+'?id='+data[i].br_rep_id+'"><div class="pull-left"><img src="<?php echo base_url('assets/dist/img/default-img.png');?>" class="img-circle" alt="User Image"></div><h4>'+data[i].bm_name+'<small><i class="fa fa-clock-o"></i> '+data[i].br_rep_cd+'</small></h4><p>Reduced the stock of '+data[i].ing_name+' in '+data[i].br_name+'</p></a>'+'</li>';
              }else {
                notif += '<li><a href="<?php echo site_url(); ?>admin/view_branch_report1'+'?id='+data[i].br_rep_cd.substring(0,18)+'"><div class="pull-left"><img src="<?php echo base_url('assets/dist/img/default-img.png');?>" class="img-circle" alt="User Image"></div><h4>'+data[i].bm_name+'<small><i class="fa fa-clock-o"></i> '+data[i].br_rep_cd+'</small></h4><p>Added new stocks of ingredients in '+data[i].br_name+'</p></a>'+'</li>';
              }
            }
            $('.menu').html(notif);
          }
        },
        error: function(data){
          alert('ERROR');
          console.log(data);
        }
      });

    })
  </script>
</body>
</html>