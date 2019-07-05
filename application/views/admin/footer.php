</div>
</div>
<div class="footer">
  <div class="copyright pull-left">Modern Agent © <?php echo date('Y'); ?></div>
</div>
</div>
</section>
<!-- password change -->
<div id="change_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    Change Password
  </div>
  <form class="form-horizontal" name="form" method="post" id="change_pass">
    <div class="modal-body" >
      <div class="form-group clearfix">
        <label class="col-lg-3 control-label">Old password</label>
        <div class="col-lg-9">
        <input class="form-control" type="password" id = "old_password" name = "old_password"  required>
        </div>
      </div>
      <div class="form-group clearfix">
        <label class="col-lg-3  control-label">New Password</label>
        <div class="col-lg-9">
        <input class="form-control" type="password" id = "password" name = "password"  required>
        </div>
      </div>
      <div class="form-group clearfix">
        <label class="col-lg-3  control-label">Confirm New Password</label>
        <div class="col-lg-9"><input class="form-control" type="password"  id = "pass_confirm" name = "pass_confirm"  required></div>
      </div>
    </div>
    <div class="panel-footer">
      <button type="submit"  class="btn btn-success">Save</button>
    </div>
  </form>
</div>
</div>
</div>
<div id="ref_code_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        Referral Code
      </div>
        <div class="modal-body" >
          Your referral code is REF<?php echo sprintf("%05d", $this->session->userdata('adminid')); ?>
          <br/> It can be used as coupon code up to 10 times by a user.
        </div>
        <div class="panel-footer">
          <button type="submit" data-dismiss="modal"  class="btn">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- common js -->
<script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.js');  ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');  ?>"></script>
<!-- Editor -->
<script src="<?php echo base_url('assets/js/summernote.js'); ?>"></script>
<!-- data table js -->
<script src="<?php echo base_url('assets/js/data-tables/jquery.dataTables.min.js');  ?>"></script>
<script src="<?php echo base_url('assets/js/data-tables/dataTables.tableTools.js');  ?>"></script>
<script src="<?php echo base_url('assets/js/data-tables/bootstrap.datatable.js');  ?>"></script>
<!-- charts js -->
<script src="<?php echo base_url('assets/js/charts/highcharts.js');  ?>"></script>
<script src="<?php echo base_url('assets/js/charts/charts-highchart-line.js');  ?>"></script>
<script src="<?php echo base_url('assets/js/charts/charts-highchart-column-bar.js');  ?>"></script>
<!-- toastr js -->
<script src="<?php echo base_url('assets/js/jquery-toastr/toastr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-toastr/ui-toastr-notifications.js'); ?>"></script>
<!-- validate js -->
<script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<!-- datepicker -->
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
<!-- combobox -->
<script src="<?php echo base_url('assets/js/bootstrap-combobox.js'); ?>"></script>
<!-- bootbox -->
<script src="<?php echo base_url('assets/js/bootbox.min.js'); ?>"></script>




<!-- Drill Down -->
<!--<script src="<?php echo base_url(); ?>assets/js/drilldown.js"></script>
<!-- apps js -->
<script src="<?php echo base_url('assets/js/apps.js');  ?>"></script>
<!-- extra js -->
<script type="text/javascript" src="<?php echo base_url('assets/js/extra.js'); ?>"></script>

<!-- custom js -->
<?php
switch ($title){
  case 'Dashboard':
  $active = "active";
  break;
  case 'Manage Companies':
  $active3 = "active";
  echo '<script type="text/javascript" src="'.base_url('assets/js/customjs/user.js').'"></script>';
  break;
  case 'Manage Sales Representatives':
  $active3 = "active";
  echo '<script type="text/javascript" src="'.base_url('assets/js/customjs/user.js').'"></script>';
  break;
  case 'Manage Users':
  $active3 = "active";
  echo '<script type="text/javascript" src="'.base_url('assets/js/customjs/user.js').'"></script>';
  break;
  case 'Manage Category':
  $active4 = "active";
  break;
  case 'Manage Orders':
  // echo '<script type="text/javascript" src="'.base_url().'assets/js/customjs/order.js"></script>';
  break;
  case 'Manage Coupons':
  //echo '<script type="text/javascript" src="'.base_url().'assets/js/customjs/coupon.js"></script>';
  break;
  case 'Transactions':
  $active7 = "active";
  break;
  case 'Manage Site Contents':
  $active8 = "active";
  break;
}
?>
<script type="text/javascript">
  	$(document).ready(function(){
            <?php if($this->session->flashdata('success')): ?>
            Notify("Success","<?php echo $this->session->flashdata('success') ?>", 'success');
            <?php elseif($this->session->flashdata('error')): ?>
            Notify("Error","<?php echo $this->session->flashdata('error') ?>", 'error');
            <?php endif; ?>
	    $('#showpass').click(function(){
	        console.log($(this).parents('td').find('input').attr('type'));
	        if($(this).parents('td').find('input').attr('type')=='password'){
	            $(this).parents('td').find('input').attr('type','text');
	            $(this).html('Hide Password');
	        }else{
	            $(this).parents('td').find('input').attr('type','password');
	            $(this).html('Show Password');
	        }
	    });

    // summernote
    $('.summernote').summernote({
      height: 200
    });
    // combobox
    $('.combobox').combobox();
    // datepicker
    $('.datepicker').datepicker({
      format: "dd-mm-yyyy"
    });
    // accordion
    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);
    // datepicker default
    var date = $.datepicker.formatDate('dd-mm-yy', new Date());
    $(".datepicker-default").val(date);
    // User list function call
    //userlist();
    
    transactionlist();
    
    // change password form Validate
    $("#change_pass").validate({
      rules:{
        old_password:{
          required:true
        },
        password:{
          required: true,
          minlength: 3,
          maxlength: 20
        },
        pass_confirm:{
          required: true,
          equalTo: '#password'
        }

      },
      messages:{
        old_password:"Old password is required.",
        password: {
          required: "New password is required.",
        },
        pass_confirm: {
          required: "Confirm password is required.",
          equalTo: "New password and Confirm password should be same."
        }
      }
    });
    // Change password form submit
    $("#change_pass").submit(function(){
      if( !$(this).valid() ){
         return false;
      } else {
        var old = $("#old_password").val();
        var new_pass = $("#password").val();
        var confirm_pass = $("#pass_confirm").val();

        var submit = $('#change_pass').closest('form').find(':submit');
        submit.html('<i class="fa fa-spinner fa-spin"></i>');
        submit.prop('disabled', true);
        $.ajax({
          url     : "<?php echo site_url('admin/get_password/'); ?>",
          method    : "post",
        }).success(function(resp){

          submit.html('Save');
          submit.prop('disabled', false);

          var obj = JSON.parse(resp);
          if(obj.status == "success"){
            if(obj.data == old ){

              var old = $("#old_password").val();
              var new_pass = $("#password").val();
              var confirm_pass = $("#pass_confirm").val();

              $.ajax({
                url     : "<?php echo site_url('admin/update_password/'); ?>",
                method    : "post",
                data:{
                  pass : new_pass
                }
              }).success(function(resp2){

                submit.html('Save');
                submit.prop('disabled', false);

                var obj2 = JSON.parse(resp2);
                if(obj2.status == "success"){
                  $('#change_pass').trigger("reset");
                  Notify('Password Success', obj2.msg, 'success');
                  $("#change_password").modal("toggle");
                }else{
                  Notify('Password Change Error', 'Password could not be update..', 'error');
                }

              });

            }else{
              Notify('Password Error', 'Old password does not match..', 'error');
            }

          }else{
            Notify('Password Error', 'User does not exist..', 'error');
          }

        });
        return false;
      }
    });

    
    $('#user_edit').validate({
      rules:{
        fname:{
          required:true
        },
        lname:{
          required:true
        },
        email:{
          required:true,
          email:true
        },
        phone:{
          required:false,
          number:true,
          minlength: 10,
          maxlength: 10
        },
//        license: "required",
        cname : "required",
        cadd : "required" 
      },
      messages:{
        fname: "Please enter first name.",
        lname: "Please enter last name.",
        email: "Please enter email.",
        phone: "Please use 12 digits.",   
        license: "Please enter license no.",
        cname : "Please enter company name.",
        cadd : "Please enter address."
      }
    });
    // user edit form submit
    $('#user_edit').submit(function(){        
            if(!$(this).valid()){
                return false;
            }else{
                var submit = $('#user_edit').closest('form').find(':submit');
                submit.html('<i class="fa fa-spinner fa-spin"></i>');
                submit.prop('disabled', true);
                var form_data = $(this).serialize();
                $.ajax({
                    url:'<?php echo site_url('admin/user_edit'); ?>',
                    method:'post',
                    data: form_data
                }).success(function(resp){
                    submit.html('Update');
                    submit.prop('disabled', false);
                    var obj = JSON.parse(resp);
                    if(obj.status == "success"){
                      Notify('Success', obj.msg, 'success');
                      setTimeout(function(){ 
                        location.reload();
                      }, 3000);
                    }else{
                      Notify('Error', obj.msg, 'error');
                    }
                });
                return false;
            }
        });

    // coupon add form validate
    $("#add_coupon").validate({
      rules:{
        coupon_name:{
          required:true
        },
        coupon_code:{
          required:true
        },
        coupon_des:{
          required:true
        },
        startdate:{
          required:true
        },
        enddate:{
          required:true
        },
        coupon_amt:{
          required:true
        }

      },
      messages:{
        coupon_name:"Name is required.",
        coupon_code:"Code is required.",
        coupon_des:"Description is required.",
        startdate:"Start date is required.",
        enddate:"End date is required.",
        coupon_amt:"Amount is required."
      }
    });

    // coupon add form submit
    $('#add_coupon').submit(function(){
        if(!$(this).valid()){
            return false;
        }else{
            var submit = $('#add_coupon').closest('form').find(':submit');
            submit.html('<i class="fa fa-spinner fa-spin"></i>');
            submit.prop('disabled', true);
            var form_data = $(this).serialize();
            $.ajax({
                url:'<?php echo site_url('admin/coupon_add'); ?>',
                method:'post',
                data: form_data
            }).success(function(resp){
                var obj = JSON.parse(resp);
                if(obj.status == "success"){
                  submit.html('Submit');
                  submit.prop('disabled', false);
                  $('#add_coupon')[0].reset();
                  $('.collapse').collapse('hide');
                  coupon_list_table_datatable.ajax.reload( null, false );

                  Notify('Success', obj.msg, 'success');
                }else{
                  Notify('Error', obj.msg, 'error');
                }
            });
            return false;
        }
    });

    // coupon edit form validate
    $("#edit_coupon").validate({
      rules:{
        coupon_name:{
          required:true
        },
        coupon_code:{
          required:true
        },
        coupon_des:{
          required:true
        },
        startdate:{
          required:true
        },
        enddate:{
          required:true
        },
        coupon_amt:{
          required:true
        }
      },
      messages:{
        coupon_name:"Name is required.",
        coupon_code:"Code is required.",
        coupon_des:"Description is required.",
        startdate:"Start date is required.",
        enddate:"End date is required.",
        coupon_amt:"Amount is required."
      }
    });

    // coupon edit form submit
    $('#edit_coupon').submit(function(){
        if(!$(this).valid()){
            return false;
        }else{
            var submit = $('#edit_coupon').closest('form').find(':submit');
            submit.html('<i class="fa fa-spinner fa-spin"></i>');
            submit.prop('disabled', true);
            var form_data = $(this).serialize();
            $.ajax({
                url:'<?php echo site_url('admin/coupon_edit'); ?>',
                method:'post',
                data: form_data
            }).success(function(resp){
                var obj = JSON.parse(resp);
                if(obj.status == "success"){
                  Notify('Success', obj.msg, 'success');
                }else{
                  Notify('Error', obj.msg, 'error');
                }          
                submit.html('Submit');
                submit.prop('disabled', false);     
            });
            return false;
        }
    }); 

    $('.numeric').on('input', function (event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

// document end here
});
// Custom Functions
function toggleChevron(e) {
  $(e.target)
    .prev('.panel-heading')
    .find('i.indicator')
    .toggleClass('fa-chevron-down fa-chevron-right');
    // $('#accordion','.panel-heading').css('background-color', 'green');
}
// delete user
function deleteuser(str){  
  var user_id = str;
  bootbox.confirm("Are you sure you want to delete?", function(result) {
    if(result){
      $.ajax({
          url:'<?php echo base_url(); ?>index.php?/admin/deleteuser/'+user_id,
          method:'POST',
          data:{
              type:"deleteuser"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){
            <?php if($this->router->fetch_method() == 'manage_companies'): ?>
            //userlist('2');
            user_table_datatable.ajax.reload( null, false );
            <?php elseif($this->router->fetch_method() == 'manage_sales_reps'): ?>
            //userlist('3');
            user_table_datatable.ajax.reload( null, false );
            <?php else: ?>
            //userlist('4');
            user_table_datatable.ajax.reload( null, false );
            <?php endif; ?>
            Notify('Success', obj.msg, 'success');
          }else{
            Notify('Error', 'Invalid Request.', 'error');
          }
      });
      // return false;
    }
  });
}

// active user
function verifyuser(str){
  var user_id = str;
  bootbox.confirm("Are you sure you want to activate?", function(result) {
    if(result){
      $.ajax({
          url:'<?php echo site_url('admin/verifyuser'); ?>/'+user_id,
          method:'POST',
          data:{
              type:"verifyuser"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){
            <?php if($this->router->fetch_method() == 'manage_companies'): ?>
            //userlist('2');
            user_table_datatable.ajax.reload( null, false );
            <?php elseif($this->router->fetch_method() == 'manage_sales_reps'): ?>
            //userlist('3');
            user_table_datatable.ajax.reload( null, false );
            <?php else: ?>
            //userlist('4');
            user_table_datatable.ajax.reload( null, false );
            <?php endif; ?>
            Notify('Success', obj.msg, 'success');
          }else{
            Notify('Error', 'Invalid Request.', 'error');
          }
      });
      // return false;
    }
  });
}

// inactive user
function unverifyuser(str){
  var user_id = str;
  bootbox.confirm("Are you sure you want to inactivate?", function(result) {
    if(result){
      $.ajax({
          url:'<?php echo site_url('admin/unverifyuser'); ?>/'+user_id,
          method:'POST',
          data:{
              type:"verifyuser"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){
            <?php if($this->router->fetch_method() == 'manage_companies'): ?>
            //userlist('2');
            user_table_datatable.ajax.reload( null, false );
            <?php elseif($this->router->fetch_method() == 'manage_sales_reps'): ?>
            //userlist('3');
            user_table_datatable.ajax.reload( null, false );
            <?php else: ?>
            //userlist('4');
            user_table_datatable.ajax.reload( null, false );
            <?php endif; ?>
            Notify('Success', obj.msg, 'success');
          }else{
            Notify('Error', 'Invalid Request.', 'error');
          }
      });
      // return false;
    }
  });
}


var coupon_list_table_datatable = '';
// coupon list
function couponlist()
{
  if ($('#coupon-list-table').length) {
    coupon_list_table_datatable = $('#coupon-list-table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "paging": true,
        "searching": true,
        "order": [
          [1, "DESC"]
        ],
        // Load data from an Ajax source
        "ajax": {
            "url": '<?php echo site_url('admin/couponlist_view'); ?>',
            "type": "POST",
            "data": {
              type:"couponlist"
            }
        },
        "initComplete": function () {
            var input = $('.dataTables_filter input').unbind(),
                self = this.api(),
                $searchButton = $('<button class="btn btn-primary admin-ml-5 admin-mt-5">')
                .text('Search')
                .click(function () {
                    self.search(input.val()).draw();
                }),
                $clearButton = $('<button class="btn btn-default admin-ml-5 admin-mt-5">')
                .text('Clear')
                .click(function () {
                    input.val('');
                    $searchButton.click();
                })
            $('.dataTables_filter').append($searchButton, $clearButton);
        },
        "language": {
            "processing": "<div class='text-center'><i class='fa fa-spinner fa-spin admin-fa-spin ma-font-24'></i></div>",
            "emptyTable": "<div align='center'>Record(s) not found.</div>"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "orderable": false,
            "targets": "no-sort"
        }],
        "drawCallback": function( settings ) {
          $("[data-toggle='tooltip']").tooltip();
        }
    });
  }
}

// delete coupon
function delete_coupon(str){
  var coupon_id = str;
  bootbox.confirm("Are you sure you want to delete?", function(result) {
    if(result){
      $.ajax({
          url: '<?php echo site_url('admin/delete_coupon'); ?>/'+coupon_id,
          method:'POST',
          data:{
              type:"deletecoupon"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){
            //couponlist();
            coupon_list_table_datatable.ajax.reload( null, false );
            Notify('Success', obj.msg, 'success');
          }else if(obj.status == "coupon_start_error"){
            Notify('Error', obj.msg, 'error');
          }else if(obj.status == "coupon_error"){
            Notify('Error', obj.msg, 'error');
          } else {
            Notify('Error', 'Invalid Request.', 'error');
          }
      });
      // return false;
    }
  });
}

// order list function
function orderlist(){
  $.ajax({
        url: '<?php echo site_url('admin/orderlist_view'); ?>',
        method:'POST',
        data:{
            type:"orderlist"
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
          var order_list = obj.orderlist_table;
          $("#order_table").html(order_list);  
          $(".table").dataTable();
          $("[data-toggle='tooltip']").tooltip();
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }                 
    }); 
    return false; 
}
function online_users_count(){
	$.ajax({
	      url: '<?php echo site_url('admin/getNumOfOnlineUsers'); ?>',
	      method:'POST',
	      data:{
	          type:"number_of_online_users"
	      }
	  }).success(function(resp){
		  console.log(resp);
		  var obj = JSON.parse(resp);
	      if(obj.status == "success"){
	        var num_of_online_users = obj.num_of_online_users;
	        $("#online_users_count").html(num_of_online_users);
	      }else{
	        Notify('Error', 'Invalid Request.', 'error');
	      }
	  });
	  return false;
}
// list of online users
function onlineuserlist(){
	$.ajax({
	    url: '<?php echo site_url('admin/onlineuserlist_view'); ?>',
	    method:'POST',
	    data:{
	        type:"onlineuserlist"
	    }
	}).success(function(resp){
	    var obj = JSON.parse(resp);
	    if(obj.status == "success"){
	      var onlineUsers = obj.onlineUsers_table;
	      $("#online_users_table").html(onlineUsers);
            $("#onlineUsers-table").dataTable({
                "order": [[ 4, "desc" ]],
            });
	    }else{
	      Notify(resp, 'Invalid Request.', 'error');
	    }
	});
	return false;
}

// transaction list function
function transactionlist()
{
  if ($('#transaction_table').length) {
    $('#transaction_table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "paging": false,
        "searching": false,
        "order": [
          [0, "DESC"]
        ],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('/admin/transactionlist'); ?>",
            "type": "POST"
        },
        "language": {
            "processing": "<div class='text-center'><i class='fa fa-spinner fa-spin admin-fa-spin ma-font-24'></i></div>",
            "emptyTable": "<div align='center'>Record(s) not found.</div>"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "orderable": false,
            "targets": "no-sort"
        }],
        "drawCallback": function( settings ) {
          $("[data-toggle='tooltip']").tooltip();
        }
    });
  }
}

// deactive user list function
function deactive_users(user_role_id){
    $.ajax({
        url: '<?php echo site_url('admin/getDeactiveUser'); ?>',
        method:'POST',
        data:{
            type:"deactive_user",
            user_role_id: user_role_id
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
            var user_count = obj.deactive_user;
            $("#deactiveuser_count").html(user_count);
        }else{
            Notify('Error', 'Invalid Request.', 'error');
        }
    });
    return false;
}
// count reports created
function reports_count()
{
  $.ajax({
        url: '<?php echo base_url(); ?>index.php?/admin/getReportsCount',
        method:'GET'
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){          
          var count = obj.count;
          $("#reports_count").html(count);          
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }                 
    }); 
    return false; 
}
// new sign up count
// available flyers
function new_signup()
{
  $.ajax({
        url: '<?php echo site_url('admin/getNewSignUp'); ?>',
        method:'POST',
        data:{
            type:"new_signup"
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){          
          var new_user = obj.new_user;
          $("#newuser_count").html(new_user);          
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }                 
    }); 
    return false; 
}

// ajax call for chart data
function revenue(){
    $.ajax({
        url: '<?php echo base_url(); ?>index.php?/dashboard/revenue',
        method:'POST',
        data:{
            type:"revenue_chart"
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        
        if(obj.status == "success"){          
          revenue_chart(obj.inv_date,obj.inv_amt);
        }else{

        }                 
    }); 
    return false; 
}
// revenue chart
function revenue_chart(invdate,invdata){
  /* Ajax loaded data, clickable points */
    $('#revenue_chart').highcharts({
        title: {
            text: '',
            x: -20 //center
        },
        
        xAxis: {
            categories: invdate,
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            title: {
                text: 'Revenue'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '$'
        },
        legend: {
            
        },
    credits:true,
        series: [{
            name: 'Revenue',
            data: invdata
        }]
  
    });
}


$('#ref_code_modal').on('shown.bs.modal', function() {
    //add_referral_code();
    //No Need to add referall code as coupon code anymore. Coupon is created at the time of first use.
});
function add_referral_code(){
    $.ajax({
        url:'<?php echo site_url('admin/add_referral_code') ?>',
        method:'GET',
        dataType: 'json',
        success:function(resp){}
    });
}
</script>
</body>
</html>
