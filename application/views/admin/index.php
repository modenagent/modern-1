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

                          <span class="help-block"></span>

                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" placeholder="Password" class="form-control" name="apass" id="apass">
                          </div>
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
                <h4 class="modal-title">Modal title</h4>
              </div>
              <form method="" autocomplete="off" action="" class="omb_loginForm" id="forgot-form">
              <div class="modal-body">
              
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" placeholder="email address" name="useremail" class="form-control" id="useremail">
                  </div>
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
          // Login form
          // login form validate
          $("#adminlogin-form").validate({
              rules: {
                  aname: "required",
                  apass: "required"
              },
              messages: {
                  aname: "",
                  apass: ""
              }
          });
          // login form submit
          $("#adminlogin-form").submit(function(){
              if( !$(this).valid() ){
                 return false;
              } else {
                  // var postData = $(this).serialize();
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
          // forgot password
          // validate forgot password
          $("#forgot-form").validate({
            rules: {
                useremail: {
                  required:true,
                  email:true
                }              
            },
            messages: {
                useremail: ""              
            }
          });
          // forgot form submit
          $("#forgot-form").submit(function(){
              if( !$(this).valid() ){
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