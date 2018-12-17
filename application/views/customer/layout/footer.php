<footer class="main-footer">
    <div class="pull-right hidden-xs">
      Kitchen Kits
    </div>
    <strong>Copyright &copy; 2019 <a>RLC Co.</a>.</strong> All Rights Reserved.
  </footer>
</div>

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

<script>
  $(function(){

    $('.modal').on('hidden.bs.modal', function(){
      $(this).find('form')[0].reset();
      $('.alert').css('display', 'none');
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

  })
</script>
</body>
</html>