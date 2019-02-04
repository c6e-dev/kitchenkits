<script>
	function get_current_date(){        
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        if(dd<10) { dd = '0'+dd } 
        if(mm<10) { mm = '0'+mm } 
        today = mm + '/' + dd + '/' + yyyy + ' ' + time;
        return today;
  	}

	function load_unseen_notification_branch(){
		$.ajax({
        type: 'POST',
        url: "<?php echo site_url('branch/notify_branch'); ?>",
        dataType : 'json',
        success: function(data){
          if (data.length==null) {
            notif = data.notify;
            $('.header').html(notif);
          }
          today = get_current_date();
          var count = 0;
          var notif = '';
          for(var i=0; i<data.length; i++){
            if (data[i]!=0) {
              count += 1;
              notif += '<li><a href="#"><div class="pull-left"><img src="<?php echo base_url('assets/dist/img/warningSmall.png');?>" class="img-circle" alt="User Image"></div><h4>'+data[i][0].ing_name+'<small><i class="fa fa-clock-o"></i> '+today+'</small></h4><p>Restock ASAP!</p></a>'+'</li>';
            }
          }
          if (count!=0) {
            $('#notif_count').html(count);
            $('.menu').html(notif);
          }
          else{
            $('.header').html('No Notification To View');
          }
        },
        error: function(data){
          alert('ERROR');
          console.log(data);
        }
      });
	}
</script>