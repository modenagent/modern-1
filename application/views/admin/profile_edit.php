<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
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
  <div class="row">
    <div class="col-sm-5 col-md-4">
      <div class="user-left">
        <div class="text-center">
          <h4><?php echo ucfirst($user->first_name)." ".ucfirst($user->last_name);?></h4>
          <div class="fileupload fileupload-new">
            <div class="user-image"> 
              <?php
                $uimg = '';
                if ($user->profile_image != "" && file_exists($user->profile_image)) {
                    $uimg = $user->profile_image;
                }else{
                    $uimg = 'assets/img/user.jpg';
                }                                    
              ?>                 
              <img class="img-responsive" src="<?php echo base_url().$uimg; ?>">              
            </div>
            <br/>
            <a href="#" class="btn btn-default">Change Profile</a>
          </div>
          <hr>
      </div>
      
    </div>
  </div>
  <div class="col-sm-7 col-md-8">
    <form method="post" role="form" id="user_edit">
      <table class="table-condensed table-hover">
        <thead>
            <tr>
              <th colspan="3">Personal Information 
              <?php if($this->role_lib->is_admin()): ?>
                <a class="btn btn-primary pull-right" href='<?php echo site_url('admin/set_password/'.$user->user_id_pk); ?>'>Set Password</a>
              <?php endif; ?>
              </th>
            </tr>
          </thead>
        <tbody>
          <tr>
            <td>First Name :</td>
            <td><input type="text" class="form-control" placeholder="Enter first name" name="fname" id="fname" value="<?php echo $user->first_name; ?>"></td>
            
          </tr>
          <tr>
            <td>Last Name :</td>
            <td><input type="text" class="form-control" placeholder="Enter last name" name="lname" id="lname" value="<?php echo $user->last_name; ?>"></td>
            
          </tr>
          <tr>
            <td>Email Address :</td>
            <td><input type="email" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php echo $user->email; ?>"></td>
            
          </tr>
          <tr>
              <td>Username :</td>
              <td><input type="text" class="form-control" name="username" id="username" value="<?php echo $user->user_name; ?>" placeholder="User Name"></td>
              
          </tr>

          <tr>
            <td>Phone No. :</td>
            <td><input type="text" class="form-control" placeholder="Phone No" name="phone" id="phone" value="<?php echo $user->phone; ?>"></td>
          </tr>
          
          <tr>
            <td>License No.</td>
            <td><input type="text" class="form-control" placeholder="Enter license no." name="license" id="license" value="<?php echo $user->license_no; ?>"></td>
            
          </tr>

          <tr>
            <td>Company Name</td>
            <td><input type="text" placeholder="" class="form-control" placeholder="Company Name" name="cname" id="cname" value="<?php echo $user->company_name; ?>"></td>            
          </tr>
          <tr>
            <td>Company Address</td>
            <td><input type="text" placeholder="" class="form-control" placeholder="Company Address" name="cadd" id="cadd" value="<?php echo $user->company_add; ?>"></td>
          </tr>
          <?php $_isAdmin = $this->role_lib->is_admin(); ?>
              <?php if($_isAdmin): ?>
              <tr>
                  <td>User Role</td>
                  <td>
                    <select class="form-control" placeholder="User Role" name="role_id" id="user_role">
                        <option <?php echo !$user->role_id_fk?'selected=""selected"':''; ?> value>--Select User Role--</option>
                        <?php foreach($roles as $role): ?>
                            <?php if($role->role_id_pk!=1): ?><!-- Exluding admin Role-->
                            <option value="<?php echo $role->role_id_pk ?>" <?php echo ($user->role_id_fk==$role->role_id_pk)?'selected':'' ?>><?php echo $role->role_name ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                  </td>                
              </tr>
                <?php if(isset($parents)): ?>
                <tr>
                    <td><?php echo $parent_label; ?></td>
                    <td>
                      <select class="form-control" placeholder="<?php echo $parent_label; ?>" name="parent_id" id="parent_id"">
                          <option <?php echo !$user->parent_id?'selected=""selected"':''; ?> value >-- Select one option--</option>
                          <?php foreach($parents as $parent): ?>
                              <option value="<?php echo $parent['user_id_pk']; ?>" <?php echo ($user->parent_id==$parent['user_id_pk'])?'selected':'' ?>>
                              <?php if($this->role_lib->is_sales_rep($user->role_id_fk)): ?>
                              <?php echo $parent['company_name'] ." ". $parent['last_name']; ?>
                              <?php else: ?>
                              <?php echo $parent['first_name'] ." ". $parent['last_name']; ?>
                            <?php endif; ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                    </td>                
                </tr>
                <?php endif; ?>
                <?php if($this->role_lib->is_sales_rep($user->role_id_fk)): ?>
                <tr>
                  <td>Referral Code</td>
                  <td><input type="text" oninput="this.value = this.value.toUpperCase();" maxlength = "8" class="form-control" placeholder="Referral Code" name="ref_code" id="ref_code" value="<?php echo $user->ref_code; ?>"></td>
                  <script type="text/javascript">
                    $('#ref_code').keypress(function(e){ 
                       if (e.which == 48){
                          return false;
                       }
                    });
                  </script>
                </tr>
                <?php endif; ?>
              <?php endif; ?>
          <input type="hidden" name="userid" id="userid" value="<?php echo $user->user_id_pk; ?>">
          <tr>
            <td></td>
            <td><button class="btn btn-primary">Update</button></td>
          </tr>
          
        </tbody>
      </table>
      
    </form>
  </div>
  </div>
  <div class="clearfix">
  
  </div>

  
</div>
</div>
</div>
</div>
<!-- page end-->
</div>
</div>