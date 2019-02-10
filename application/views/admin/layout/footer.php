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

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/bower_components/chart.js/Chart.js');?>"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js');?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>

  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#image_upload_preview').attr('src', e.target.result).width(350).height(200);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#recipe_image").change(function () {
        readURL(this);
    });
    $(function(){
      $('table.display').DataTable({
        destroy: true,
        "order": [[ 0, 'desc' ]]
      });
      $('#ingredients_tbl').DataTable({
        destroy: true,
        "order": [[ 2, 'desc' ]]
      });
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-purple',
        radioClass: 'iradio_minimal-purple'
      });
      $('.select2').select2();

      $('.modal').on('hidden.bs.modal', function(){
        $('#ingredients').val('0');
        $('.select2').select2();
        $('.alert').css('display', 'none');
        $('input[type="checkbox"].minimal').iCheck('uncheck');
        $(this).find('form')[0].reset();
        $('#pricediv').hide();
      });

      $("#history").on("hide.bs.collapse", function(){
      $("#3gr").html('View History');
      });

      $("#history").on("show.bs.collapse", function(){
        $("#3gr").html('Hide History');
      });

      $("#recipe_image").on('click', function () {
        $("#image_save").show();
        $("#image_cancel").show();
      });   

      $('#addingr').on('change',function(){
        $('#add_ingred').prop('disabled', false);
        var value = $(this).val();
        $('option[value="'+value+'"]').prop('disabled', true);
        $('.select2').select2();
        $('.labels').css('display', 'block');
        var optionText = this[this.selectedIndex].text;
        var optionUnit = this[this.selectedIndex].id;
        $("#ingr-scroll").append($('<div class="row form-group"><div class="col-md-4"><input type="text" class="form-control input-sm" value="'+optionText+'" readonly></div><div class="col-md-2"><span><input type="text" id="'+value+'" class="form-control input-sm"></span></div><div class="col-md-3"><input type="text" class="form-control input-sm" value="'+optionUnit+'" readonly></div><div class="col-md-3"><input type="text" id="method'+value+'" class="form-control input-sm"></div></div>'));
      });

      $('#add_ingred').on('click', function(){
        var re_id = $('#rec_id').val();
        var ing_id = new Array();
        var ing_val = new Array();
        var ing_met = new Array();
        $('#ingr-scroll span input').each( function(){
          ing_id.push(this.id);
          ing_val.push($('#'+this.id).val());
          ing_met.push($('#method'+this.id).val());
        });
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/add_recipe_ingredient'); ?>",
            data: {
              recipe_id: re_id,
              ingredients_id: ing_id,
              ingredients_val: ing_val,
              ingredients_meth: ing_met
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Ingredients Successfully Added!");
                    location.reload();
                    $('#add_ingr').modal('hide');
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

      $('#uptingr').on('change',function(){
        $('#upt_ingred').prop('disabled', false);
        var value = $(this).val();
        $('option[value="'+value+'"]').prop('disabled', true);
        $('.select2').select2();
        $('.label').css('display', 'block');
        var optionText = this[this.selectedIndex].text;
        var optionUnit = this[this.selectedIndex].id;
        $("#ingr1-scroll").append($('<div class="row form-group"><div class="col-md-4"><input type="text" class="form-control input-sm" value="'+optionText+'" readonly></div><div class="col-md-2"><span><input type="text" id="'+value+'" class="form-control input-sm"></span></div><div class="col-md-3"><input type="text" class="form-control input-sm" value="'+optionUnit+'" readonly></div><div class="col-md-3"><input type="text" id="method'+value+'" class="form-control input-sm"></div></div>'));
      });

      $('#upt_ingred').on('click', function(){
        var re_id = $('#reci_id').val();
        var ings_id = new Array();
        var ings_val = new Array();
        var ings_met = new Array();
        $('#ingr1-scroll span input').each( function(){
          ings_id.push(this.id);
          ings_val.push($('#'+this.id).val());
          ings_met.push($('#method'+this.id).val());
        });
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/edit_recipe_ingredient'); ?>",
            data: {
              recipee_id: re_id,
              ingrs_id: ings_id,
              ingrs_val: ings_val,
              ingrs_meth: ings_met
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Ingredients Successfully Updated!");
                    location.reload();
                    $('#upt_ingr').modal('hide');
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

      $('.del_ingr').on('click', function(){
        var in_id = this.id;
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('admin/delete_recipe_ingredient'); ?>",
            data: {
              ingr_id: in_id,
            },
            dataType: 'JSON',
            success: function(data){ 
              location.reload();
            },
            error: function(data){
              console.log(data);
              alert('ERROR!');
            }
        });
      });
      
      $('#ingr-scroll').slimScroll({
        height: '230px'
      });

      $('#ingr1-scroll').slimScroll({
        height: '230px'
      });

      $('#ingred_scroll').slimScroll({
        height: '331px'
      });

      $('#btn_rcp_save').on('click', function(){
        var rcpname = $('#rcpnm').val();
        var cooktime = $('#ctime').val();
        var serves = $('#serves').val();
        var price = $('#price').val();
        var country = $("[name='country']").val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/create_recipe'); ?>",
            data: {
                name: rcpname,
                cooktime: cooktime,
                servings: serves,
                price: price,
                country: country
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Recipe Successfully Added!");
                    location.reload();
                    $('#add_recipe').modal('hide');
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

      $('#btn_rcpupt_save').on('click', function(){
        var rcpname = $('#upt_rcpnm').val();
        var cooktime = $('#upt_ctime').val();
        var serves = $('#upt_serves').val();
        var price = $('#upt_price').val();
        var country = $("[name='upt_country']").val();
        var instruc = $('#instruc').val();
        var id = $('#recipe_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/update_recipe'); ?>",
            data: {
                name: rcpname,
                cooktime: cooktime,
                servings: serves,
                price: price,
                country: country,
                instruc: instruc,
                recipe_id: id
            },
            dataType: 'JSON',
            success: function(data){
              console.log(data);
                if (data.status) {
                    alert("Recipe Successfully Updated!");
                    location.reload();
                    $('#update_recipe').modal('hide');
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

      $('#btn_bradd_save').on('click', function(){
        var brname = $('#brname').val();
        var braddress = $('#braddress').val();
        var brmanager = $("[name='brmanager']").val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/add_branch'); ?>",
            data: {
                name: brname,
                braddress: braddress,
                brmanager: brmanager
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Branch Successfully Added");
                    location.reload();
                    $('#addbranch').modal('hide');
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

      $('#btn_brupt_save').on('click', function(){
        var brname = $('#upt_brname').val();
        var braddress = $('#upt_braddress').val();
        var brmanager = $("[name='upt_brmanager']").val();
        var br_id = $('#branch_id').val();
        var bm_id = $('#mngr_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/edit_branch'); ?>",
            data: {
                brname: brname,
                braddress: braddress,
                brmanager_id: brmanager,
                branch_id: br_id,
                mngr_id: bm_id
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Branch Successfully Updated");
                    location.reload();
                    $('#update_branch').modal('hide');
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

      $('#btn_mngradd_save').on('click', function(){
        var srnm = $('#username').val();
        var pswrd = $('#password').val();
        var cpswrd = $('#cpassword').val();
        var nm = $('#mngr_name').val();
        var muti = $('#mngr_user_type_id').val();
        var br_id = $('#br').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/add_manager'); ?>",
            data: {
                username: srnm,
                password: pswrd,
                cpassword: cpswrd,
                name: nm,
                utid: muti,
                br_id: br_id
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Manager Account Successfully Created!");
                    location.reload();
                    $('#addmanager').modal('hide');
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

      $('#btn_bmupt_save').on('click', function(){
        var mngr_nm = $('#mngr_name').val();
        var manager_id = $('#manager_id').val();
        var br_id = $("[name='upt_br']").val();
        var current_br_id = $('#br_id').val();
        var user_id = $('#user_id').val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/edit_manager'); ?>",
            data: {
                mngr_nm: mngr_nm,
                manager_id: manager_id,
                br_id: br_id,
                cubr_id: current_br_id,
                user_id: user_id
            },
            dataType: 'JSON',
            success: function(data){
                if (data.status) {
                    alert("Branch Manager Successfully Updated");
                    location.reload();
                    $('#update_manager').modal('hide');
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

      $('input[type="checkbox"].minimal').on('ifChecked', function(){
        $('#pricediv').show('slow');
      });

      $('input[type="checkbox"].minimal').on('ifUnchecked', function(){
        $('#pricediv').hide('slow');
      });

      $('#btn_ing_save').on('click', function(){
        var name = $('#ingName').val();
        var unit = $("[name='unit']").val();
        var nunit = $('#newUnit').val();
        var minamnt = $('#minamnt').val();
        var price = $('#price').val();
        var checkBox = document.getElementById("cbox");
        var res = 'No';
        if (checkBox.checked == true){
          res = 'Yes';
        }
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('admin/add_ingredient'); ?>",
            data: {
              name: name,
              unit: unit,
              new_unit: nunit,
              min_amount: minamnt,
              price: price,
              checker: res
            },
            dataType: 'JSON',
            success: function(data){
              if (data.status) {
                alert("Ingredient Successfully Added!");
                location.reload();
                $('#addingredient').modal('hide');
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

      $("#branch_col").hide();
      $("#branch_tri").hover(function(){
        $("#branch_col").slideDown(300);
      });
      $("#branch_tri").mouseleave(function(){
        $("#branch_col").slideUp(300);
      });

      $("#manager_col").hide();
      $("#manager_tri").hover(function(){
        $("#manager_col").slideDown(300);
      });
      $("#manager_tri").mouseleave(function(){
        $("#manager_col").slideUp(300);
      });

      $("#customer_col").hide();
      $("#customer_tri").hover(function(){
        $("#customer_col").slideDown(300);
      });
      $("#customer_tri").mouseleave(function(){
        $("#customer_col").slideUp(300);
      });

      $("#recipe_col").hide();
      $("#recipe_tri").hover(function(){
        $("#recipe_col").slideDown(300);
      });
      $("#recipe_tri").mouseleave(function(){
        $("#recipe_col").slideUp(300);
      });

      $("#order_col").hide();
      $("#order_tri").hover(function(){
        $("#order_col").slideDown(300);
      });
      $("#order_tri").mouseleave(function(){
        $("#order_col").slideUp(300);
      });

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