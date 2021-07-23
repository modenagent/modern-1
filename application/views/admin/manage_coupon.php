<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo site_url("admin/dashboard"); ?>">Dashboard</a> </li>
    <li class="active">Manage Coupons</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Manage Coupons
      <a class="pull-right btn-size" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i id="ma-toggle-icon" class="fa fa-plus"></i>
      </a>
    </h4>
  </div>
  <div class="collapse" id="collapseExample">
    <div class="well clearfix">
      <form action="" method="POST" role="form" id="add_coupon" autocomplete="off">
        <legend>Add Coupon</legend> 
          
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" class="form-control alphanumeric" id="coupon_name" name="coupon_name" placeholder="Coupon Name">
                </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">                  
                    <input type="text" class="form-control alphanumeric" id="coupon_code" name="coupon_code" placeholder="Coupon Code">
                  </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" id="coupon_des" name="coupon_des" placeholder="Coupon Description">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">                  
                    <input type="text" class="form-control numeric" id="coupon_amt" name="coupon_amt" placeholder="Coupon Amount">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                    <input type="number" class="form-control" id="limit_all" name="limit_all" placeholder="Overall Max Limit">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <input type="number" class="form-control" id="limit_user" name="limit_user" placeholder="Max Limit / User">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">                  
                    <input type="text" class="form-control" id="startdate" name="startdate" placeholder="Start Date">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    
                    <input type="text" class="form-control" id="enddate" name="enddate" placeholder="End Date">
                  </div> 
              </div>
            </div>
            <div class="col-md-offset-10 col-md-2">      
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div> 
          
          
      </form>
    </div>
  </div>
  <div class="panel-body" >
    <!-- order view -->
    <div class="table-head table-responsive" id="coupon_table">
      <table class="table table-hover" id="coupon-list-table">
        <thead>
          <tr>          
            <th class="no-sort">Sr. no.</th>
            <th>Coupon Code</th>  
            <th>Coupon Name</th> 
            <th>Start Date</th>   
            <th>End Date</th>
            <th>Times Used</th>   
            <th>Value of coupon</th>             
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
    <?php if($this->role_lib->is_admin()): ?>
      couponlist();
    <?php elseif ($this->role_lib->is_sales_rep()): ?>
      couponlist();
    <?php endif; ?>

    $('#collapseExample').on('shown.bs.collapse', function() {
      $("#ma-toggle-icon").addClass('fa-minus').removeClass('fa-plus');
    });

    $('#collapseExample').on('hidden.bs.collapse', function() {
      $("#ma-toggle-icon").addClass('fa-plus').removeClass('fa-minus');
    });

    var startDate = new Date('01/01/2012');
    var FromEndDate = new Date();
    var ToEndDate = new Date();
    ToEndDate.setDate(ToEndDate.getDate() + 3650);
    $('#startdate').datepicker({
      format: "dd-mm-yyyy",
      weekStart: 1,
      startDate: FromEndDate,
      /*endDate: FromEndDate,*/
      autoclose: true,
      clearBtn: true
    })
    .on('changeDate', function (selected) {
        if (selected.dates.length > 0) {
          startDate = new Date(selected.date.valueOf());
          startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
          $('#enddate').datepicker('setStartDate', startDate); 
        }
    }).on('clearDate', function () {
        var FromEndDate = new Date();
        $('#enddate').datepicker('setStartDate', FromEndDate);
    });
    $('#enddate').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        startDate: FromEndDate,
        endDate: ToEndDate,
        autoclose: true,
        clearBtn: true
    })
    .on('changeDate', function (selected) {
        if (selected.dates.length > 0) {
          FromEndDate = new Date(selected.date.valueOf());
          FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
          $('#startdate').datepicker('setEndDate', FromEndDate);
        }
    }).on('clearDate', function () {
        var newToEndDate = new Date();
        newToEndDate.setDate(newToEndDate.getDate() + 3650);
        $('#startdate').datepicker('setEndDate', newToEndDate);
    });
  });
</script>