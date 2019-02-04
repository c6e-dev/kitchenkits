<script>
	function load_unseen_notification_admin(){
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
            notif += '<li><a href="<?php echo site_url(); ?>admin/view_branch_report'+'?id='+data[i].br_rep_id+'"><div class="pull-left"><img src="<?php echo base_url('assets/dist/img/default-img.png');?>" class="img-circle" alt="User Image"></div><h4>'+data[i].bm_name+'<small><i class="fa fa-clock-o"></i> '+data[i].br_rep_cd+'</small></h4><p>Reduced the stock of '+data[i].ing_name+' in '+data[i].br_name+'</p></a>'+'</li>';
          }
          $('.menu').html(notif);
        }
      },
      error: function(data){
        alert('ERROR');
        console.log(data);
      }
    });
	}
</script>