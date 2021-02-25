<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="active">User Profile</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">About</h4>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-5 col-md-4">
        <div class="user-left">
          <div class="text-center">
            <h4><?php echo ucfirst($user->first_name) . " " . ucfirst($user->last_name); ?></h4>
            <div class="fileupload fileupload-new">
              <div class="user-image"> 
                <?php
                if ($user->profile_image != "")
                {
                    if (file_exists(FCPATH . '/' . $user->profile_image))
                    {
                        $uimg = $user->profile_image;
                    }
                    else
                    {
                        $uimg = 'assets/img/user.jpg';
                    }
                }
                else
                {
                    $uimg = 'assets/img/user.jpg';
                }
                ?>       
                <a href="javascript:void(0)"><img class="img-responsive" src="<?php echo base_url() . $uimg; ?>" /></a>
                <input type="file" class="file-type hidden" />
                <input type="text" id="fileimage" class="hidden file-path" name="user[profile_image]" value="<?php echo $user->profile_image; ?>" />
              </div>
              <br/>
              <a id="image-change" href="javascript:void(0)" class="btn btn-default">Change Profile</a>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-7 col-md-8">
        <form method="post" role="form" id="user_edit">
          <table class="table-condensed table-hover">
            <thead>
                <tr>
                  <th colspan="3">Personal Information 
                  <?php if ($this->role_lib->is_admin()): ?>
                    <a class="btn btn-primary pull-right" href='<?php echo site_url('admin/set_password/' . $user->user_id_pk); ?>'>Set Password</a>
                  <?php
                  endif; ?>
                  </th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>First Name :</td>
                <td><input type="text" class="form-control alphanumeric" placeholder="Enter first name" name="fname" id="fname" value="<?php echo $user->first_name; ?>"></td>
                
              </tr>
              <tr>
                <td>Last Name :</td>
                <td><input type="text" class="form-control alphanumeric" placeholder="Enter last name" name="lname" id="lname" value="<?php echo $user->last_name; ?>"></td>
                
              </tr>
              <tr>
                <td>Email Address :</td>
                <td><input type="email" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php echo $user->email; ?>"></td>
                
              </tr>
              <tr>
                  <td>Username :</td>
                  <td>
                    <?php echo ($user->user_name) ? $user->user_name : '-'; ?>
                  </td>
              </tr>

              <tr>
                <td>Phone No. :</td>
                <td><input type="text" class="form-control numeric" maxlength="12" placeholder="Phone No" name="phone" id="phone" value="<?php echo $user->phone; ?>"></td>
              </tr>
              
              <tr>
                <td>License No. :</td>
                <td><input type="text" class="form-control" placeholder="Enter license no." name="license" id="license" value="<?php echo $user->license_no; ?>"></td>
                
              </tr>
              <?php
              if ($user->role_id_fk != 3)
              {
              ?>
              <tr>
                <td>Company Name :</td>
                <td>
                  <input type="text" placeholder="" class="form-control alphanumeric" placeholder="Company Name" name="cname" id="cname" value="<?php echo $user->company_name; ?>">
                </td>            
              </tr>
              <?php
              }
              ?>
              <tr>
                <td>Company Address :</td>
                <td>
                  <?php
                  /* if ($user->role_id_fk == 3)
                  {
                      echo $user->company_add;
                  }
                  else
                  { 
                  ?>
                      <input type="text" placeholder="" class="form-control" placeholder="Company Address" name="cadd" id="cadd" value="<?php echo $user->company_add; ?>">
                    <?php
                  } */


                  ?>
                  <input type="text" placeholder="" class="form-control" placeholder="Company Address" name="cadd" id="cadd" value="<?php echo $user->company_add; ?>">

                </td>
              </tr>
              <?php
              if($user->role_id_fk == 3) :
                ?>
                <tr>
                  <td>City</td>
                  <td><input type="text" class="form-control" placeholder="City" name="ccity" id="ccity" value="<?php echo ($user->company_city == '0' ? '' : $user->company_city); ?>"></td>
                </tr>

                <tr>
                  <td>Zip</td>
                  <td><input type="text" class="form-control" placeholder="Zip" name="czip" id="czip" value="<?php echo $user->comapny_zip; ?>"></td>
                </tr>

                <tr>
                  <td>State</td>
                  <td><input type="text" class="form-control" placeholder="State" name="cstate" id="cstate" value="<?php echo $user->company_state; ?>"></td>
                </tr>
                <?php
              endif;
              ?>
              <?php $_isAdmin = $this->role_lib->is_admin(); ?>
              <?php if ($_isAdmin): ?>
              <tr>
                  <td>User Role :</td>
                  <td>
                    <select class="form-control" placeholder="User Role" name="role_id" id="user_role">
                        <option <?php echo !$user->role_id_fk ? 'selected=""selected"' : ''; ?> value>--Select User Role--</option>
                        <?php foreach ($roles as $role): ?>
                            <?php if ($role->role_id_pk != 1): ?><!-- Exluding admin Role-->
                            <option value="<?php echo $role->role_id_pk ?>" <?php echo ($user->role_id_fk == $role->role_id_pk) ? 'selected' : '' ?>><?php echo $role->role_name ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                  </td>                
              </tr>
              <?php if (isset($parents)): ?>
              <tr>
                  <td><?php echo $parent_label; ?> :</td>
                  <td>
                    <select class="form-control" placeholder="<?php echo $parent_label; ?>" name="parent_id" id="parent_id">
                        <option <?php echo !$user->parent_id ? 'selected=""selected"' : ''; ?> value >-- Select one option--</option>
                        <?php foreach ($parents as $parent): ?>
                            <option value="<?php echo $parent['user_id_pk']; ?>" <?php echo ($user->parent_id == $parent['user_id_pk']) ? 'selected' : '' ?>>
                            <?php if ($this->role_lib->is_sales_rep($user->role_id_fk)): ?>
                            <?php echo $parent['company_name']; // ." ". $parent['last_name'];
                            ?>
                            <?php else: ?>
                            <?php echo $parent['first_name'] . " " . $parent['last_name']; ?>
                            <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                  </td>                
              </tr>
              <?php endif; ?>
              <?php if ($user->role_id_fk == '4'): ?>
              <tr>
                <td>Marketing Code :</td>
                <td><input type="text" oninput="this.value = this.value.toUpperCase();" maxlength = "8" class="form-control alphanumeric" placeholder="Marketing Code" name="ref_code" id="ref_code" value="<?php echo $user->ref_code; ?>"></td>
                <script type="text/javascript">
                  $('#ref_code').keypress(function(e){ 
                     if (e.which == 48){
                        return false;
                     }
                  });
                </script>
              </tr>
              <tr>
                <td>Is Enterprise User?</td>
                <td>
                  <?php
                      $enterprise_flag_checked = '';
                      if ($user->is_enterprise_user == '1')
                      {
                          $enterprise_flag_checked = 'checked';
                      }
                  ?>
                  <label class="chk_container">
                    <input type="checkbox" id="enterprise_flag" name="enterprise_flag" value="1" <?php echo $enterprise_flag_checked; ?> />
                    <span class="chk_checkmark"></span>
                  </label>
                </td>
              </tr>
              <?php endif; ?>
              <?php endif; ?>
              <input type="hidden" name="userid" id="userid" value="<?php echo $user->user_id_pk; ?>">
              <tr>
                <td></td>
                <td>
                  <button class="btn btn-primary">Update</button>
                    <?php
                      $back_url = '';
                      switch ($user->role_id_fk)
                      {
                          case '2':
                              $back_url = site_url() . '/admin/manage_companies';
                          break;
                          case '3':
                              $back_url = site_url() . '/admin/manage_sales_reps';
                          break;
                          case '4':
                              $back_url = site_url() . '/admin/manage_user';
                          break;
                      }
                    ?>
                  <a href="<?php echo $back_url; ?>" class="btn btn-default">Back</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div> <!-- panel-->
<div class="clearfix"></div>
<?php if($user->role_id_fk == 2): ?>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">SSO configuration</h4>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <?php
          $unique_id = $sso_record->unique_id;
        ?>
        <form method="post" role="form" id="sso_edit" action="<?=base_url().'admin/sso_edit/'.$sso_record->id;?>">
          <table class="table-condensed table-hover">
           
            <tbody>
              <tr>
                <td width="300px">Unique Id :</td>
                <td>
                  <input type="text" class="form-control alphanumeric"   id="unique_id" readonly="" value="<?=$unique_id?>">
                </td>
                
              </tr>
              <tr>
                <td>idp Metadata Url :</td>
                <td>
                  <input type="text" class="form-control " placeholder="Enter idp meta data Url" name="metadata_url" id="metadata_url" value="<?=$sso_record->metadata_url?>">
                </td>
                
              </tr>
              <tr>
                <td>SP Metadata Entity:</td>
                <td>
                  <input type="text" class="form-control"   value="<?=base_url()?>simplesaml/www/module.php/saml/sp/metadata.php/<?=$unique_id?>" readonly="">
                </td>
                
              </tr>
              <tr>
                <td>SP Metadata AssertionConsumerService:</td>
                <td>
                  <input type="text" class="form-control"   value="<?=base_url()?>simplesaml/www/module.php/saml/sp/saml2-acs.php/<?=$unique_id?>" readonly="">
                </td>
                
              </tr>
              <tr>
                <td>SP Metadata SingleLogoutService:</td>
                <td>
                  <input type="text" class="form-control"  value="<?=base_url()?>simplesaml/module.php/saml/sp/saml2-logout.php/<?=$unique_id?>" readonly="">
                </td>
              </tr>

              
            </tbody>
          </table>

          <table class="table-condensed table-hover" style="margin-top: 15px;">
           
            <thead>
              <tr>
                <th colspan="2">Field Mapping</th>
              </tr>
            </thead>
            <tbody>
              
              
              <tr>
                <td width="300px">Email :</td>
                <td>
                  <input type="text" class="form-control"  value="<?=$sso_record->email?>" name="field[email]">
                </td>
                
              </tr>
              <tr>
                <td>Username:</td>
                <td>
                  <input type="text" class="form-control"   value="<?=$sso_record->username?>" name="field[username]">
                </td>
                
              </tr>
              <tr>
                <td>First Name:</td>
                <td>
                  <input type="text" class="form-control"   value="<?=$sso_record->first_name?>" name="field[first_name]">
                </td>
                
              </tr>
              <tr>
                <td>Last Name:</td>
                <td>
                  <input type="text" class="form-control"   value="<?=$sso_record->last_name?>" name="field[last_name]">
                </td>
                
              </tr>
              <tr>
                <td>Phone:</td>
                <td>
                  <input type="text" class="form-control"   value="<?=$sso_record->phone?>" name="field[phone]">
                </td>
                
              </tr>

              <tr>
                <td>Sales Representative:</td>
                <td>
                  <input type="text" class="form-control"   value="<?=$sso_record->sales_rep?>" name="field[sales_rep]">
                </td>
                
              </tr>

              <tr>
                <td></td>
                <td>
                  <button class="btn btn-primary">Update</button>
                  <?php
                  $back_url = '';
                  switch ($user->role_id_fk)
                  {
                      case '2':
                          $back_url = site_url() . '/admin/manage_companies';
                      break;
                      case '3':
                          $back_url = site_url() . '/admin/manage_sales_reps';
                      break;
                      case '4':
                          $back_url = site_url() . '/admin/manage_user';
                      break;
                  }
                  ?>
                  <a href="<?php echo $back_url; ?>" class="btn btn-default">Back</a>
                </td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" name="userid" id="userid" value="<?php echo $user->user_id_pk; ?>">
          <input type="hidden" name="company_id"  value="<?php echo $user->user_id_pk; ?>">
        </form>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div> <!-- panel -->
<?php endif; ?>
</div>
</div>
<!-- page end-->
</div>
</div>
<script type="text/javascript">
$(".user-image a").click(function() {                                                
  $(".user-image").find(".file-type").trigger("click");
});
$("#image-change").click(function() {                                                
  $(".user-image").find(".file-type").trigger("click");
});
$(".user-image .file-type").change(function(){
  var file_data = $(this).prop('files')[0];
  var form_data = new FormData();
  form_data.append('fileToUpload', file_data)                   
  $.ajax({
      url: '<?php echo base_url(); ?>admin/admin_upload_file/<?php echo $user->user_id_pk; ?>/profile-image',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(object) {
          if (object.status=='success') {
            $('.user-image a').html("<img src='<?php echo base_url(); ?>"+object.fileuri+"' style='width:100%'>");
          } else {
            alert(object.msg);
          }
      }
  });
});
</script>
