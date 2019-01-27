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
              <button type="button" id="save_change_pass" class="btn btn-sm btn-primary">Save</button>
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
  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js');?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
  <!-- <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script> -->
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>

  <script>
    $(function(){    
    	$('table.display').DataTable({
    	  destroy: true,
    	  "order": [[ 2, 'desc' ]]
    	});

      $('.modal').on('hidden.bs.modal', function(){
        $('#ingr').val('0');
        $('.select2').select2();
        $(this).find('form')[0].reset();
        $('.alert').css('display', 'none');

      });

      $('.select2').select2();

      $('#ingr').on('change',function(){
        $('#unit').val(this[this.selectedIndex].id);
      });

      $('#submit_supply').on('click', function(){
        var amnt = $('#amount').val();
        var ingr = $("[name='ingr']").val();
        var br_id = $('#branch_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('branch/add_supply'); ?>",
            data: {
                amount: amnt,
                ingredient: ingr,
                branch_id: br_id
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Supply Successfully Added!");
                    location.reload();
                    $('#add_supply').modal('hide');
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

      $('.submit_resupply').on('click', function(){
        var bi_id = $(this).attr('data-id');
        var amnt = $('#res_amount'+bi_id).val();
        var crr_amnt = $('#crrnt_amnt'+bi_id).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('branch/update_supply'); ?>",
            data: {
                amount: amnt,
                current_amount: crr_amnt,
                bri_id: bi_id
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Supply Successfully Updated!");
                    location.reload();
                    $('#add_supply'+bi_id).modal('hide');
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

      $('.submit_redsupply').on('click', function(){
        var bi_id = $(this).attr('data-id');
        var amnt = $('#upt_amount'+bi_id).val();
        var rson = $('#reason'+bi_id).val();
        var crr_amnt = $('#crrnt_amnt'+bi_id).val();
        var br_id = $('#branch_id'+bi_id).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('branch/reduce_supply'); ?>",
            data: {
                amount: amnt,
                reason: rson,
                current_amount: crr_amnt,
                bri_id: bi_id,
                branch_id: br_id
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Supply Successfully Updated!");
                    location.reload();
                    $('#reduce_supply'+bi_id).modal('hide');
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
            url: "<?php echo site_url('branch/edit_password'); ?>",
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
    })
  </script>

</body>
</html>