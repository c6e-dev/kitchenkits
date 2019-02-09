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

  <?php 
    include 'ajaxscript.php';
  ?>

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
        $('#resingr').val('0');
        $('.select2').select2();
        $(this).find('form')[0].reset();
        $('.alert').css('display', 'none');

      });

      $('.select2').select2();

      $('#ingr-scroll').slimScroll({
        height: '230px'
      });

      $('#resingr').on('change',function(){
        $('#submit_resupply').prop('disabled', false);
        var value = $(this).val();
        $('option[value="'+value+'"]').prop('disabled', true);
        $('.select2').select2();
        $('.labels').css('display', 'block');
        var optionText = this[this.selectedIndex].text;
        var optionUnit = this[this.selectedIndex].id;
        var bri_id = $("#resingr option:selected").data('id');
        $("#ingr-scroll").append($('<div class="row form-group"><div class="col-md-5"><input type="text" class="form-control input-sm" value="'+optionText+'" readonly></div><div class="col-md-4"><span><input type="text" id="'+value+'" data-id="'+bri_id+'" class="form-control input-sm"></span></div><div class="col-md-3"><input type="text" class="form-control input-sm" value="'+optionUnit+'" readonly></div></div>'));
      });

      $('#submit_resupply').on('click', function(){
        var ing_id = new Array();
        var ing_val = new Array();
        var bri_ids = new Array();
        $('#ingr-scroll span input').each( function(){
          bri_ids.push($(this).attr('data-id'));
          ing_id.push(this.id);
          ing_val.push($('#'+this.id).val());
        });
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('branch/update_supply'); ?>",
            data: {
              branch_ingr_id: bri_ids,
              ingredients_id: ing_id,
              ingredients_val: ing_val
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Supply Successfully Updated!");
                    location.reload();
                    $('#restock').modal('hide');
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
            error: function(data){
              console.log(data);
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

      load_unseen_notification_branch();

    })
  </script>

</body>
</html>