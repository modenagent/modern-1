<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
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
          <h4><?php echo ucfirst($users->first_name)." ".ucfirst($users->last_name);?></h4>
          <div class="fileupload fileupload-new">
            <div class="user-image"> 
             <?php
              if ($users->profile_image != "" && file_exists($users->profile_image)) {
                  $uimg = $users->profile_image;
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
      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th colspan="3">Personal Information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Name</td>
            <td><?php echo ucfirst($users->first_name)." ".ucfirst($users->last_name);?></td>
            
          </tr>
          <tr>
            <td>email:</td>
            <td><a href="#"><?php echo $users->email;?></a></td>
            
          </tr>
          <tr>
            <td>phone:</td>
            <td><?php echo $users->phone; ?></td>
          </tr>
        </tbody>
      </table>
      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th colspan="3">General information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>License No.</td>
            <td><?php echo $users->license_no; ?></td>
            
          </tr>
          <tr>
            <td>Company Name</td>
            <td><?php echo $users->company_name; ?></td>
            
          </tr>
          <tr>
            <td>Company Address</td>
            <td><?php echo $users->company_add; ?></td>
            
          </tr>
          <?php if($this->role_lib->is_sales_rep($users->role_id_fk)): ?>
          <tr>
                <td>Referral Code</td>
                <td>
                    REF<?php echo sprintf("%05d", $users->user_id_pk); ?>
                </td>
          </tr>
          <?php endif; ?>
            <tr>
              <td>Status</td>
              <td><span class="label label-sm label-info">
                <?php
                $status = $users->is_active;
                if($status == "Y"){
                  echo "Active";

                }else{
                  echo "Inactive";
                }
                ?>
              </span></td>
              
            </tr>
          </tbody>
        </table>
        <?php if($subscription_data || $this->role_lib->is_manager_l1($users->role_id_fk)) :?>
        <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th colspan="2" style="text-align:right">Subscription information</th>
          </tr>
        </thead>
        <tbody>
        <?php if($subscription_data) :?>
          <tr>
            <td>Plan</td>
            <td align="right"><?php echo $subscription_data['plan_title']; ?></td>
            
          </tr>
          <tr>
            <td>Period Cycle</td>
            <td align="right"><?php echo $subscription_data['interval']; ?></td>
            
          </tr>
          <tr>
            <td>Current Subscription Ends</td>
            <td align="right"><?php echo date("M d, Y",$subscription_data['current_period_end']); ?></td>
            
          </tr>
          <tr>
            <td>Recurring Subscription</td>
            <td align="right"><?php echo $data['cancel_at_period_end']?'No':'Yes'; ?></td>
          </tr>
        <?php elseif($this->role_lib->is_sales_rep($users->role_id_fk) || $this->role_lib->is_manager_l1($users->role_id_fk)): ?>
          <tr>
            <td>Subscribe from various available monthly plans   </td>
            <td align="right"><a class="btn btn-xs btn-danger" href="<?php echo site_url('admin/subscribe/'.$users->user_id_pk) ?>" data-toggle="tooltip"data-title="Subscription Payment">Pay Subscription <i class="fa fa-credit-card"></i></a></td>
          </tr>
        <?php endif; ?>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
</div>
</div>
<!-- page end-->
</div>
</div>
