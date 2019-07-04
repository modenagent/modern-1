<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li class="active">Coupon</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel">
  <div class="panel-body">
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
          <th colspan="3">Coupon Details</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Coupon Name:</td>
          <td><?php echo $coupon->coupon_name; ?></td>
        </tr>
        <tr>
          <td>Coupon Code:</td>
          <td><?php echo $coupon->coupon_code; ?></td>
        </tr>
        <tr>
          <td>Start date:</td>
          <td>
            <?php 
              if (isset($coupon->start_date) && !empty($coupon->start_date)) {
                echo date("F j, Y", strtotime($coupon->start_date));
              } else {
                echo '-';
              }
            ?>
          </td>
        </tr>
        <tr>
          <td>End Date:</td>
          <td>
          <?php 
              if (isset($coupon->end_date) && !empty($coupon->end_date)) {
                echo date("F j, Y", strtotime($coupon->end_date));
              } else {
                echo '-';
              }
          ?>
          </td>
        </tr>
        <tr>
          <td>Description:</td>
          <td><?php echo $coupon->coupon_descr; ?></td>
        </tr>
      </tbody>
    </table> 
    <hr>
    <div class="text-center">
        <p>         
        <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>index.php?/admin/manage_coupon">See All Coupons</a>
        </p>
      </div>   
  </div>
</div>
</div>