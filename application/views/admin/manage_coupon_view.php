<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li class="active">Coupon</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel">
  <div class="panel-body">
    <div class="coupon-code">
      <div class="row">      
          <label class="col-md-4 text-right">Coupon Name :</label>
          <label class="col-md-6"><?php echo $coupon->coupon_name; ?></label>
      </div>
      <div class="row">      
          <label class="col-md-4 text-right">Coupon Code :</label>
          <label class="col-md-6"><?php echo $coupon->coupon_code; ?></label>
      </div>
      <div class="row">      
          <label class="col-md-4 text-right">Start date :</label>
          <label class="col-md-6"><?php echo $coupon->start_date; ?></label>
      </div>
      <div class="row">      
          <label class="col-md-4 text-right">End Date :</label>
          <label class="col-md-6"><?php echo $coupon->end_date; ?></label>
      </div>
      <div class="row">      
          <label class="col-md-4 text-right">Description :</label>
          <label class="col-md-6"><?php echo $coupon->coupon_descr; ?></label>
      </div>
      
      
    </div> 
    <hr>
    <div class="text-center">
        <p>         
        <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>index.php?/admin/manage_coupon">See All Coupons</a>
        </p>
      </div>   
  </div>
</div>
</div>