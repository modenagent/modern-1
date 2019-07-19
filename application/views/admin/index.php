<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modern Agent | <?php echo $title; ?></title>
        <!-- Sets initial viewport load and disables zooming  -->
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- site css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-toastr/toastr.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/extrayellow.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">       
<!--         <link href="<?php echo base_url();  ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
 -->        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/admin-style.css">
        <link href="<?php echo base_url(); ?>assets/css/lp-style.css" rel="stylesheet">

    </head>
    <body style="background-color: #f5f5f5;" id="top">
         
        <div class="container">
          <section class="login-box">
                <section class="text-center">
                  <h1 style="font-size: 17px; color:#ffffff;padding-bottom:10px;"><img style="padding-bottom:5px;" src="<?php echo base_url(); ?>assets/admin/images/logo.png"><br>admin dashboard</h1>           
                </section>
                
                
                    

                        <form method="post" autocomplete="off" action="" class="omb_loginForm" id="adminlogin-form">
                        <div class="row"> 
                        <div class="col-md-12"> 
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" placeholder="Username" class="form-control" name="aname" id="aname">
                          </div>
                          <label id="error_aname" for="aname" generated="true" class="error" style="display:none;"></label>

                          <span class="help-block"></span>

                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" placeholder="Password" class="form-control" name="apass" id="apass">
                          </div>
                          <label id="error_apass" for="apass" generated="true" class="error" style="display:none;"></label>
                        </div>
                        </div>
                          <span class="help-block"></span>
                          <div class="row"> 
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                          <div class="checkbox">
                            <label style="color:#ffffff;">
                              <input type="checkbox" name="rememberme">Remember Me
                            </label>
                          </div>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-md-6 text-right"> 
                            <a style="color:#ffffff;" class="pull-right m-t-xs" href="#" data-toggle="modal" data-target="#modal-id"><small>Forgot password?</small></a>
                          </div>
                          </div>
                          <div class="row"> 
                          <div class="col-md-12"> 
                            <button type="submit" class="btn  btn-lp btn-block admin-signin-btn">Sign in</button>
                          </div>
                         </div>               
                        </form>
                    
                
                              
            </section>
          
        </div>
        <!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->
        <div class="modal fade" id="modal-id">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forget Password?</h4>
              </div>
              <form method="" autocomplete="off" action="" class="omb_loginForm" id="forgot-form">
              <div class="modal-body">
              
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" placeholder="email address" name="useremail" class="form-control" id="useremail">
                  </div>
                  <label id="error_useremail" for="useremail" generated="true" class="error" style="display:none;"></label>
                  <span class="help-block"></span>                 
              
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="forgot_submit">Submit</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <span class="help-block"></span>
      <!-- footer -->

      <!-- / footer -->
      <!-- common js -->
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>      
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
      <!-- toastr js -->
      <script src="<?php echo base_url(); ?>assets/js/jquery-toastr/toastr.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery-toastr/ui-toastr-notifications.js"></script> 
      <!-- validate js -->
      <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> 
      <!-- extra js -->
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/extra.js"></script>
      <script type="text/javascript">
      $(document).ready(function(){          
          function validateAdminLogin()
          {
            var result = true;
            var name = $.trim($("#aname").val());
            var pass = $.trim($("#apass").val());
            if (name == '') {
              $('#error_aname').html('Please enter username.');
              $('#error_aname').show();
              result = false;
            } else {
              $('#error_aname').html('');
              $('#error_aname').hide();
            }
            if (pass == '') {
              $('#error_apass').html('Please enter password.');
              $('#error_apass').show();
              result = false;
            } else {
              $('#error_apass').html('');
              $('#error_apass').hide();
            }
            return result;
          }
          // login form submit
          $("#adminlogin-form").submit(function(){
              if( !validateAdminLogin() ){
                 return false;
              } else {
                  var name = $("#aname").val();
                  var pass = $("#apass").val();
                  $.ajax({
                      url:'<?php echo base_url(); ?>admin/adminlogin/',
                      method:'post',
                      data: {
                          username : name,
                          password : pass
                      }
                  }).success(function(resp){
                      var obj = JSON.parse(resp);
                      if(obj.status == "admin_success"){
                          window.location='<?php echo base_url(); ?>admin/dashboard';
                      }
                      if(obj.status == "error"){
                          var msg = obj.msg;
                          Notify('Login Error', msg, 'error');
                      }
                  }) ;       
                  return false;
              }
          });

          function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
          }

          function validateForgetPassword()
          {
            var result = true;
            var user_email = $.trim($("#useremail").val());
            if (user_email == '') {
              $('#error_useremail').html('Please enter email address.');
              $('#error_useremail').show();
              result = false;
            } else if (!validateEmail(user_email)) {
              $('#error_useremail').html('Please enter valid email address.');
              $('#error_useremail').show();
              result = false;
            } else {
              $('#error_useremail').html('');
              $('#error_useremail').hide();
            }
            return result;
          }
          // forgot form submit
          $("#forgot-form").submit(function(){
              if( !validateForgetPassword() ){
                $('#forgot_submit').attr('disabled',false);
                return false;
              } else {
                  // var postData = $(this).serialize();
                  var user_email = $("#useremail").val();               
                  $.ajax({
                      url:'<?php echo base_url(); ?>admin/forget_password/',
                      method:'post',
                      data: {
                          email : user_email
                      }
                  }).success(function(resp){
                      var obj = JSON.parse(resp);
                      var msg = obj.msg;
                      if(obj.status == "success"){
                        // submit button disable                       
                        $('#forgot_submit').attr('disabled',true);
                        $('#forgot-form').trigger("reset");
                        $("#modal-id").modal("toggle");
                        // $(".omb_login").show();
                        Notify('Password reset', msg, 'success');
                      }
                      if(obj.status == "error"){
                          var msg = obj.msg;
                          Notify('Error', msg, 'error');
                      }
                  }) ;       
                  return false;
              }
          });      
          // document ready ends 
      });
    </script>
    </body>
</html>