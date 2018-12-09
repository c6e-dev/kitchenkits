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

    $('#list').on('click','.item_edit',function(){
      var re_id = $(this).data('re_id');
      var date_sched = $(this).data('date_sched');
      var time_sched = $(this).data('time_sched');
      var desc = $(this).data('desc');
      
      // $('#edit').modal({show: true, backdrop : false, keyboard : false});
      $('[name="reimbursement_update"]').val(re_id);
      $('[name="edit_date_sched"]').val(date_sched);
      $('[name="edit_time_sched"]').val(time_sched);
      $('[name="edit_desc"]').val(desc);
    });

    $('#btn_rcpupt_save').on('click', function(){
      var cooktime = $('#uptctime').val();
      var serves = $('#uptserves').val();
      var price = $('#uptprice').val();
      var id = $('#uptrecipe_id').val();
      $.ajax({
          type: 'post',
          url: "<?php echo site_url('admin/update_recipe'); ?>",
          data: {
              cooktime: cooktime,
              servings: serves,
              price: price,
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

    $('#btn_mngradd_save').on('click', function(){
      var srnm = $('#username').val();
      var pswrd = $('#password').val();
      var cpswrd = $('#cpassword').val();
      var nm = $('#mngr_name').val();
      var muti = $('#mngr_user_type_id').val();
      $.ajax({
          type: 'post',
          url: "<?php echo site_url('admin/add_manager'); ?>",
          data: {
              username: srnm,
              password: pswrd,
              cpassword: cpswrd,
              name: nm,
              utid: muti
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
  })
</script>
</body>
</html>