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
            <h4 class="modal-title"><strong>Change Password</strong></h4>
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
              <button type="button" id="save_change_pass" class="btn btn-sm btn-danger">Save</button>
              <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/PACE/pace.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js');?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>

  <script>
    $(function(){
      $(document).ajaxStart(function() { 
        Pace.restart(); 
      });

      $('.modal').on('hidden.bs.modal', function(){
        $('#adt_ingr').val('0');
        $('.select2').select2();
        $(this).find('form')[0].reset();
        $('.alert').css('display', 'none');
      });

      $('.select2').select2();

      $("#history").on("hide.bs.collapse", function(){
      $("#3gr").html('View History');
      });

      $("#history").on("show.bs.collapse", function(){
        $("#3gr").html('Hide History');
      });

      $('#edit_profile').on('click', function(){
        var cs_username = $('#cs_username').val();
        var cs_fname = $('#cs_fname').val();
        var cs_lname = $('#cs_lname').val();
        var cs_address = $('#cs_address').val();
        var cs_email = $('#cs_email').val();
        var cs_id = $('#cs_id').val();
        var u_id = $('#u_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/edit_profile'); ?>",
            data: {
                cs_username: cs_username,
                cs_fname: cs_fname,
                cs_lname: cs_lname,
                cs_address: cs_address,
                cs_email : cs_email,
                cs_id: cs_id,
                u_id: u_id
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Profile Successfully Updated");
                    location.reload();
                    $('#edit_profile').modal('hide');
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

      $('#save_change_pass').on('click', function(){
        var curr_pass = $('#curr_pass').val();
        var new_pass = $('#new_pass').val();
        var conf_pass = $('#conf_pass').val();
        var u_id = $('#u_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/edit_password'); ?>",
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

      $(".itemcount").keyup( function(e) {
        var content_id = $(this).attr('data-id');
        var item = $('#itemcount'+content_id).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/edit_item_count'); ?>",
            data: {
              itemcount: item,
              oc_id: content_id
            },
            dataType: 'JSON',
            success: function(data){
              if (data.status) {
                location.reload();
              }else{
                alert('Please enter a valid quantity!');
                location.reload();
              }
            },
            error: function(){
              alert('ERROR!');
            }
        });return false;
      });

      $('.itemdec').on('click', function(e){
        var content_id = $(this).attr('data-id');
        var item = $('#itemcount'+content_id).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/item_count_decrease'); ?>",
            data: {
              itemcount: item,
              oc_id: content_id
            },
            dataType: 'JSON',
            success: function(data){
              location.reload();
            },
            error: function(){
              alert('ERROR!');
            }
        });return false;
      });

      $('.iteminc').on('click', function(e){
        var content_id = $(this).attr('data-id');
        var item = $('#itemcount'+content_id).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/item_count_increase'); ?>",
            data: {
              itemcount: item,
              oc_id: content_id
            },
            dataType: 'JSON',
            success: function(data){
              location.reload();
            },
            error: function(){
              alert('ERROR!');
            }
        });return false;
      });

      $('#checkout').on('click', function(e){
        $('#checkout').css('pointer-events', 'none');
        $('#cancelcheckout').css('pointer-events', 'none');
        var id = $(this).attr('data-id');
        var total = $(this).attr('total');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/confirm_order');?>",
            data: { id: id, total: total },
            dataType: 'JSON',
            success: function(data){
              alert('Estimated Time Of Arrival: '+data.toa+' min');
              location.reload();
            },
            error: function(data){
              alert('ERROR');
              console.log(data);
            }
        });
      });

      $('#adt_ingr').on('change',function(){
        $('#unit').val(this[this.selectedIndex].id);
      });

      $('#add_adt_ingr').on('click', function(){
        var ingr = $('#adt_ingr').val();
        var amount = $('#amount').val();
        var od_id = $('#od_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/additional_item'); ?>",
            data: {
              ingredient: ingr,
              amount: amount,
              order_id: od_id
            },
            dataType: 'JSON',
            success: function(data){
              if (data.status) {
                alert("Additional Ingredient Successfully Added!");
                location.reload();
                $('#add_ingredient').modal('hide');
              }else{
                $('.alert').css('display', 'block');
                $('.alert').html(data.notif);
              }
            },
            error: function(data){
              alert('ERROR!');
              console.log(data);
            }
        });return false;
      });

      $('.update_adt_ingr').on('click', function(){
        var ai_id = $(this).attr('data-id');
        var name = $('#adt_nm'+ai_id).val();
        var amount = $('#adt_amount'+ai_id).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('customer/update_additional_item'); ?>",
            data: {
              amount: amount,
              id: ai_id
            },
            dataType: 'JSON',
            success: function(data){
              if (data.status) {
                alert(name+" Successfully Updated!");
                location.reload();
                $('#edit_adt_ingr'+ai_id).modal('hide');
              }else{
                $('.alert').css('display', 'block');
                $('.alert').html(data.notif);
              }
            },
            error: function(data){
              alert('ERROR!');
              console.log(data);
            }
        });return false;
      });

    })
  </script>
</body>
</html>
