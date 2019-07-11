<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="active"><?php echo $title; ?></li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  
  <div class="panel-heading">
    <h4 class="panel-title">
      <?php echo $title; ?>
      <?php if($this->role_lib->has_access('add_user')): ?>
        <a class="pull-right btn-size" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          <i id="ma-toggle-icon" class="fa fa-plus"></i>
        </a>
      <?php endif; ?>
      <?php if($this->router->fetch_method() == 'manage_user'): ?>
        <a class="pull-right btn-size"  href="<?php echo site_url('admin/export_excel')?>" data-toggle="tooltip" title="Export Excel" >
         Download Client List
        </a>
      <?php endif; ?>
    </h4>
  </div>
  <div class="collapse" id="collapseExample">
    <div class="well clearfix">
      <form action="" method="POST" role="form" id="add_user_form" autocomplete="off">
        <legend><?php echo $add_title; ?></legend> 
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" placeholder="First Name" name="fname" class="form-control alphanumeric" id="fname">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" placeholder="Last Name" name="lname" class="form-control alphanumeric" id="lname">
                </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">                  
                    <input type="text" placeholder="Email" name="uemail" class="form-control" id="uemail">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">                  
                    <input type="text" placeholder="User Name" name="uname" class="form-control alphanumeric" id="uname">
                  </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-3">
                  <div class="form-group">
                    <input type="password" placeholder="Password" name="password" class="form-control" id="user_pass">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <input type="password" placeholder="Confirm Password" name="cpassword" class="form-control" id="cpass">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">                  
                    <input type="text" placeholder="Phone No." name="uphone" class="form-control numeric" id="uphone" maxlength="12">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" placeholder="License No." name="ulicence" class="form-control" id="ulicence">
                  </div> 
              </div>
            </div>
            <div class="col-md-12">
              <?php if($add_form=='sales_rep'): ?>
              <div class="col-md-3">
                  <div class="form-group">
                    <select placeholder="Choose <?php echo $choose; ?>" name="parent_id" class="form-control choose_option" id="parent_id">
                      <option selected="selected" disabled=""> --Select Company Name-- </option>
                      <?php foreach ($parents as $key => $parent): ?>
                          <option value="<?php echo $parent['user_id_pk']; ?>"><?php echo $parent['company_name']; ?></option>
                          
                      <?php endforeach; ?>
                    </select>
                  </div> 
                  <input type="hidden" name="cname" id="cname">
              </div>
              <?php elseif ($add_form=='end_user'): ?>
              <div class="col-md-3">
                  <div class="form-group">
                    <select placeholder="Choose <?php echo $choose; ?>" name="parent_id" class="form-control choose_option" id="parent_id">
                      <option selected="selected" disabled=""> --Select Sales Rep-- </option>
                      <?php foreach ($parents as $key => $parent): ?>
                          <option value="<?php echo $parent['user_id_pk']; ?>"><?php echo $parent['first_name'] ." ". $parent['last_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div> 
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" placeholder="Company Name" name="cname" class="form-control alphanumeric" id="cname" readonly="readonly">
                  </div> 
              </div>
              <?php elseif ($add_form=='company'): ?>
                  <input type="hidden" name="parent_id" value="<?php echo $admin_id ?>" id="parent_id">
                  <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" placeholder="Company Name" name="cname" class="form-control alphanumeric" id="cname">
                      </div> 
                  </div>
              <?php endif; ?>
              <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Company Address" name="caddress" class="form-control" id="caddress" <?php echo ($add_form!=='company')?'readonly="readonly"':''; ?>>
                  </div> 
              </div>
            </div>
            <input type="hidden" name="role_id" value="<?php echo $newUserRoleId; ?>" id="role_id">
            <input type="hidden" name="backend" value="1">
            <div class="col-md-offset-10 col-md-2">      
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div> 
          </div>
          
      </form>
    </div>
  </div>
  <div class="panel-body">
<!--  <button id="btnExExcel" class="btn btn-info">Export Excel</button>-->
    <!-- user list shows here -->
    <div class="table-head table-responsive" id="user_table">
      <table class="" id="user-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Creation Date</th>
                <th class="no-sort">Actions</th>
            </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#btnExExcel').click(function(){
        $.ajax({
                url: '<?php echo site_url('admin/export_excel'); ?>',
                method: 'post',
                data: {
                }
            }).success(function(resp) {
                var obj = JSON.parse(resp);
                window.location = '<?php echo site_url();?>/'+obj.filename;
            });
    });
    <?php if($this->router->fetch_method() == 'manage_companies'): ?>
    userlist('2');
    <?php elseif($this->router->fetch_method() == 'manage_sales_reps'): ?>
    userlist('3');
    <?php else: ?>
    userlist('4');
    <?php endif; ?>

    $("#add_user_form").validate({
        rules: {
            uname:"required",
            password: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            cpassword: {
                required: true,
                minlength: 3,
                maxlength: 20,
                equalTo: '#user_pass'
            },
            fname: "required",
            lname: "required",
            uemail: {
                required: true,
                email: true,
            },
            uphone: {
                required: true,
                minlength: 10,
                maxlength: 12,
                number: true
            },
            //ulicence: "required",
            cname: "required",
            caddress: "required"
        },
        messages: {
            password: "Please enter password.",
            cpassword: "Password does not match.",
            fname: "Please enter first name.",
            lname: "Please enter last name.",
            uemail: {
              required: "Please enter email.",
            },
            uphone: {
              required: "Please enter Phone No."
            },
            ulicence: "Please enter license no.",
            cname: "Please enter company name.",
            caddress: "Please enter company address.",
            uname: "Please enter username.",
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });
    // register form submit
    $("#add_user_form").submit(function() {
        if (!$(this).valid()) {
            return false;
        } else {
            // var postData = $(this).serialize();
            var uname = $("#uname").val();
            var upass = $("#user_pass").val();
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var uemail = $("#uemail").val();
            var uphone = $("#uphone").val();
            var ulicence = $("#ulicence").val();
            var cname = $("#cname").val();
            var caddress = $("#caddress").val();
            var parent_id = $("#parent_id").val();
            var role_id = $("#role_id").val();

            var submit = $('#add_user_form').closest('form').find(':submit');
            submit.html('<i class="fa fa-spinner fa-spin"></i>');
            submit.prop('disabled', true);

            $.ajax({
                url: '<?php echo site_url('auth/userregister/format/json/'); ?>',
                method: 'post',
                data: {
                    uname : uname,
                    upass: upass,
                    fname: fname,
                    lname: lname,
                    uemail: uemail,
                    uphone: uphone,
                    ulicence: ulicence,
                    cname: cname,
                    caddress: caddress,
                    role_id: role_id,
                    parent_id:parent_id,
                    backend:"1",
                }
            }).success(function(resp) {

                submit.html('Submit');
                submit.prop('disabled', false);

                var obj = resp;
                if (obj.status == "success") {
                    var msg = obj.msg;
                    Notify('Register Success', msg, 'success');
                    $('#add_user_form')[0].reset();
                    $('.collapse').collapse('hide');
                    //location.reload();
                    user_table_datatable.ajax.reload( null, false );
                }
                if (obj.status == "error") {
                    var msg = obj.msg;
                    Notify('Login Error', msg, 'error');
                }
            });
            return false;
        }
    });
    $(".choose_option").change(function(){
        var selected = $(this).val();
        autofillCompany(selected);
    });

    $('#collapseExample').on('shown.bs.collapse', function() {
      $("#ma-toggle-icon").addClass('fa-minus').removeClass('fa-plus');
    });

    $('#collapseExample').on('hidden.bs.collapse', function() {
      $("#ma-toggle-icon").addClass('fa-plus').removeClass('fa-minus');
    });

});
function autofillCompany(user_id){
    var companies = <?php echo $companies?$companies:"''"; ?>;
    $.each(companies,function(key,data){
        if(key===user_id) {
            $("#caddress").val(data.cadd);
            $("#cname").val(data.cname);
        }
    });
}
</script>