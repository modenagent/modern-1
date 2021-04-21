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
            <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" placeholder="Company Name" name="cname" class="form-control alphanumeric" id="cname">
                  </div> 
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <input type="text" placeholder="Street Address" name="caddress" class="form-control" id="caddress" >
                  </div> 
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <input type="text" placeholder="City" name="ccity" class="form-control" id="ccity" >
                  </div> 
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <input type="text" placeholder="Zipcode" name="czip" class="form-control" id="czip" >
                  </div> 
              </div>
          </div>
        
          <div class="row">
            
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" placeholder="Primary First" name="fname" class="form-control alphanumeric" id="fname">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" placeholder="Primary Last" name="lname" class="form-control alphanumeric" id="lname">
              </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">                  
                  <input type="text" placeholder="Email" name="uemail" class="form-control" id="uemail">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">                  
                  <input type="text" placeholder="Phone No." name="uphone" class="form-control numeric" id="uphone" maxlength="12">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">                  
                  <input type="text" placeholder="User Name" name="uname" class="form-control alphanumeric" id="uname">
                </div>
            </div>
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
            
            <!-- <div class="col-md-3">
                <div class="form-group">
                  <input type="text" placeholder="License No." name="ulicence" class="form-control" id="ulicence">
                </div> 
            </div> -->
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" placeholder="Company Url" name="company_url" class="form-control" id="company_url">
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <input type="text" placeholder="CMA Url" name="cma_url" class="form-control" id="cma_url">
              </div>
            </div>
           
            <div class="col-sm-9">
                <div class="form-group">
                  <select placeholder="Choose <?php echo $choose; ?>" name="parent_id" class="form-control choose_option" id="parent_id">
                    <option selected="selected" disabled=""> --Select Company Name-- </option>
                    <?php foreach ($parents as $key => $parent): ?>
                        <option value="<?php echo $parent['user_id_pk']; ?>"><?php echo $parent['company_name']; ?></option>
                        
                    <?php endforeach; ?>
                  </select>
                  
                </div> 
            </div>
          </div>
          <input type="hidden" name="role_id" value="<?php echo $newUserRoleId; ?>" id="role_id">
          <input type="hidden" name="backend" value="1">
          <div class="col-md-offset-10 col-md-2">      
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=getGoogleMapKey();?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  addressAutoComplete();
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
            var ulicence = '';
            var cname = $("#cname").val();
            var caddress = $("#caddress").val();
            var parent_id = $("#parent_id").val();
            var role_id = $("#role_id").val();
            var company_url = $("#company_url").val();
            var cma_url = $("#cma_url").val();
            var ccity = $("#ccity").val();
            var czip = $("#czip").val();

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
                    ccity : ccity,
                    czipcode : czip,
                    role_id: role_id,
                    parent_id:parent_id,
                    company_url:company_url,
                    cma_url : cma_url,
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
    // $(".choose_option").change(function(){
    //     var selected = $(this).val();
    //     autofillCompany(selected);
    // });

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

//Google search autocomplete
function addressAutoComplete() {
    var input = document.getElementById('caddress');
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-32.30, 114.8),
        new google.maps.LatLng(-42, 124.24)); // latitude and longitude ranges of California
    var options = {
        componentRestrictions: {
            country: [],
            // country: 'us'
        },
        bounds: defaultBounds
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace(); // get address, without city and state
        var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());

        setTimeout(function() {
            $('#caddress').val(place.formatted_address);
        }, 25); // just display street address

        for (var i = 0; i < place.address_components.length; i++) {
           

                if (place.address_components[i].types[0] === ("locality") && place.address_components[i].types.length>1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1
                    var city = place.address_components[i].long_name;
                    $('#ccity').val(city);
                } else if (place.address_components[i].types[0] === ("administrative_area_level_1") && place.address_components[i].types.length>1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1
                    var state = place.address_components[i].long_name;
                    // $('#cstate').val(state);
                } else if (place.address_components[i].types[0] === "postal_code" ) { //administrative_area_level_1) {
                    var zip_code = place.address_components[i].long_name;
                    $('#czip').val(zip_code);
                }
           
        }

    });
}
</script>