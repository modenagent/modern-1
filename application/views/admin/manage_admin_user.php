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
      <?php if ($this->role_lib->has_access('add_admin_user')): ?>
        <a class="pull-right btn-size" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          <i id="ma-toggle-icon" class="fa fa-plus"></i>
        </a>
      <?php endif;?>
      <?php if ($this->router->fetch_method() == 'manage_admin_user'): ?>
        <a class="pull-right btn-size"  href="<?php echo site_url('admin/export_excel') ?>" data-toggle="tooltip" title="Export Excel" >
         Download Client List
        </a>
      <?php endif;?>
    </h4>
  </div>
  <div class="collapse" id="collapseExample">
    <div class="well clearfix">
      <form action="" method="POST" role="form" id="add_admin_user_form" autocomplete="off">
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
    <div class="table-head table-responsive" id="admin_user_table">
      <table class="" id="admin-user-table">
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=getGoogleMapKey();?>"></script>
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
                window.location = '<?php echo site_url(); ?>/'+obj.filename;
            });
    });
    userlist('1');

    $("#add_admin_user_form").validate({
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
    $("#add_admin_user_form").submit(function() {
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
            var role_id = $("#role_id").val();

            var submit = $('#add_admin_user_form').closest('form').find(':submit');
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
                    role_id: role_id,
                    backend:"1",
                }
            }).success(function(resp) {

                submit.html('Submit');
                submit.prop('disabled', false);

                var obj = resp;
                if (obj.status == "success") {
                    var msg = obj.msg;
                    Notify('Register Success', msg, 'success');
                    $('#add_admin_user_form')[0].reset();
                    $('.collapse').collapse('hide');
                    //location.reload();
                    admin_user_table_datatable.ajax.reload( null, false );
                }
                if (obj.status == "error") {
                    var msg = obj.msg;
                    Notify('Login Error', msg, 'error');
                }
            });
            return false;
        }
    });


    $('#collapseExample').on('shown.bs.collapse', function() {
      $("#ma-toggle-icon").addClass('fa-minus').removeClass('fa-plus');
    });

    $('#collapseExample').on('hidden.bs.collapse', function() {
      $("#ma-toggle-icon").addClass('fa-plus').removeClass('fa-minus');
    });

});

</script>