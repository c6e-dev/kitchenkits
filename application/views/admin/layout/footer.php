<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Kitchen Kits
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a>RLC Co.</a>.</strong> All Rights Reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

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
<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
  $(function () {    
    $('table.display').DataTable({
      destroy: true,
      "order": [[ 0, 'desc' ]]
    })
    $('input[type="radio"].minimal-blue').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    $('.select2').select2()

    $('.modal').on('hidden.bs.modal', function(){
      $(this).find('form')[0].reset();
      $('.alert').css('display', 'none');
    });
    
    $('#btn_rcp_save').on('click', function(){
      var rcpname = $('#rcpnm').val();
      var cooktime = $('#ctime').val();
      var serves = $('#serves').val();
      var price = $('#price').val();
      var region = $("[name='region']").val();
      var country = $("[name='country']").val();
      $.ajax({
          type: 'post',
          url: "<?php echo site_url('admin/create_recipe'); ?>",
          data: {
              name: rcpname,
              cooktime: cooktime,
              servings: serves,
              price: price,
              region: region,
              country: country
          },
          dataType: 'JSON',
          success: function(data){
              if (data.status) {
                  alert("Recipe successfully added!");
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
      var region = $("[name='upt_region']").val();
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
              region: region,
              country: country,
              instruc: instruc,
              recipe_id: id
          },
          dataType: 'JSON',
          success: function(data){
              if (data.status) {
                  alert("Recipe successfully updated!");
                  location.reload();
                  $('#update_recipe').modal('hide');
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
      $.ajax({
          type: 'post',
          url: "<?php echo site_url('admin/edit_branch'); ?>",
          data: {
              brname: brname,
              braddress: braddress,
              brmanager_id: brmanager,
              branch_id: br_id
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
      $.ajax({
          type: 'post',
          url: "<?php echo site_url('admin/edit_manager'); ?>",
          data: {
              mngr_nm: mngr_nm,
              manager_id: manager_id,
              br_id: br_id,
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
  })
</script>
</body>
</html>