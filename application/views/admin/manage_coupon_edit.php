<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a> </li>
    <li class="active">Manage Coupons</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Manage Coupons
      
    </h4>
  </div>
 
    <div class="well">
      <form action="" method="POST" role="form" id="edit_coupon" autocomplete="off">
        <legend>Edit Coupon</legend>        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Coupon Name</label>                
                <input type="text" class="form-control" id="coupon_name" name="coupon_name" placeholder="Coupon Name" value="<?php echo $coupon->coupon_name; ?>">                
              </div>
            
              <div class="form-group">
                <label for="">Coupon Code</label>                
                  <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" value="<?php echo $coupon->coupon_code; ?>">                
              </div>
              <div class="form-group">
                <label for="">Coupon Start Date</label>
                 
                  <input type="text" class="form-control" id="startdate" name="startdate" placeholder="Start Date" value="<?php echo date('d-m-Y', strtotime($coupon->start_date)); ?>">
                
              </div>
            </div>
         <div class="col-md-6">
                <div class="form-group">
                   <label for="">Coupon Amount</label>                    
                  <input type="text" class="form-control" id="coupon_amt" name="coupon_amt" placeholder="Coupon Amount" value="<?php echo $coupon->coupon_amt; ?>">
                </div>

              <div class="form-group">
                <label for="">Coupon Description</label>
                
                  <input type="text" class="form-control" id="coupon_des" name="coupon_des" placeholder="Coupon Description" value="<?php echo $coupon->coupon_descr; ?>">
                
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" >Coupon End Date</label>                
                  <input type="text" class="form-control" id="enddate" name="enddate" placeholder="End Date" value="<?php echo date('d-m-Y', strtotime($coupon->end_date)); ?>" >
                
              </div>
            </div>
            <div class="col-md-offset-10 col-md-2">
              <input type="hidden" name="cid" id="cid" value="<?php echo $coupon->coupon_id_pk; ?>">
              <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </div>
        </div>
      </form>
    </div>
  
  
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    var startDate = new Date('01/01/2012');
    var FromEndDate = new Date();
    var ToEndDate = new Date();
    ToEndDate.setDate(ToEndDate.getDate() + 365);
    $('#startdate').datepicker({
      format: "dd-mm-yyyy",
      weekStart: 1,
      startDate: '01/01/2012',
      /*endDate: FromEndDate,*/
      autoclose: true
    })
    .on('changeDate', function (selected) {
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#enddate').datepicker('setStartDate', startDate);
    });
    $('#enddate').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        startDate: startDate,
        endDate: ToEndDate,
        autoclose: true
    })
    .on('changeDate', function (selected) {
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#startdate').datepicker('setEndDate', FromEndDate);
    });

  });
</script>