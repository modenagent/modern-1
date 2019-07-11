<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>admin/dashboard">Dashboard</a></li>
    <li class="active">User Profile</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">About
    
    </h4>
  </div>
  <div class="panel-body">
    <div class="col-sm-5 col-md-4">
      <div class="user-left">
        <div class="text-center">
          <h4><?php echo ucfirst($user->first_name)." ".ucfirst($user->last_name);?></h4>
          <div class="fileupload fileupload-new">
            <div class="user-image">  
              <?php
              if ($user->profile_image != "" && file_exists($user->profile_image)) {
                  $uimg = $user->profile_image;
              }else{
                  $uimg = 'assets/img/user.jpg';
              }                                    
              ?>                 
              <img class="img-responsive" src="<?php echo base_url().$uimg; ?>">
            </div>
          </div>
          <hr>
        </div>
        
      </div>
    </div>
    <div class="col-sm-7 col-md-8">
      <form method="post" role="form" id="set_password">      
        <table class="table-condensed table-hover">
          <thead>
            <tr>
              <th colspan="3">Set Password</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td  class="col-md-3">Password :</td>
              <td class="col-md-9">
                <input class="pull left" type="password" class="form-control" name="pass" id="pass" placeholder="Password">
                <div class="pull right"><a href="javascript:;" id="showpass" >Show Password </a></div>
              </td>
            </tr>
            <tr>
              <td  class="col-md-3">Retype Password :</td>
              <td class="col-md-9">
                <input class="pull left" type="password" class="form-control" name="re_pass" id="re_pass" placeholder="Retype Password">
              </td>
              
            </tr>

            
                
              
              <input type="hidden" name="userid" id="userid" value="<?php echo $user->user_id_pk; ?>">
              <tr>
              <td></td>
              <td>
                <button class="btn btn-primary">Update</button>
                <a href="<?php echo site_url().'/admin/profile_edit/'.$user->user_id_pk; ?>" class="btn btn-default">Back</a>
              </td>
              </tr>
              
            </tbody>
        </table>
      </form> 
      </div>
      
    </div>
  </div>
</div>
</div>
<!-- page end-->
</div>
</div>
<script type="text/javascript">
  // user edit form validate
  $(document).ready(function(){

    $('#set_password').validate({
      rules:{
        pass: {
          required: true,
          minlength: 3,
          maxlength: 20
        },
        re_pass: {
          equalTo: "#pass"
        }
      },
      messages:{
        pass: {
          required: "New password is required."
        },
        re_pass: {
          required: "Retype password is required.",
          equalTo: "New password and Retype password should be same."
        }
      }
    });
    // user edit form submit
    $('#set_password').submit(function(){
            if(!$(this).valid()){
                return false;
            }else{
                var form_data = $(this).serialize();
                $.ajax({
                    url:'<?php echo site_url('admin/save_password'); ?>',
                    method:'post',
                    data: form_data
                }).success(function(resp){
                    var obj = JSON.parse(resp);
                    if(obj.status == "success"){
                      Notify('Success', obj.msg, 'success');
                    }else{
                      Notify('Error', obj.msg, 'error');
                    }
                });
                return false;
            }
        });
  });
</script>