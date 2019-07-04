<div class="container-fluid">
  
  <div class="pull-left"><h3>Dashboard</h3></div>
  <?php if($this->role_lib->is_admin()): ?>
<div class="clear-fix"></div>
<div class="row">
<div class="col-sm-6 col-md-4">
<div class="box bg-danger"> <i class="fa fa-dollar icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-dollar"></i> <span id="daily_revenue"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
  </div>
  <p><small>Daily Revenue</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-4">
<div class="box bg-danger"> <i class="fa fa-dollar icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-dollar"></i> <span id="monthly_revenue"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
  </div>
  <p><small>Monthly Revenue</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-4">
<div class="box bg-danger"> <i class="fa fa-dollar icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-dollar"></i> <span id="annual_revenue"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
  </div>
  <p><small>YTD Revenue</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-4">
<div class="box bg-primary"> <i class="fa fa-users icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-users"></i> <span id="user_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
  </div>
  <p><small>Total Users</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-4">
<div class="box bg-primary"> <i class="fa fa-users icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-users"></i> <span id="company_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
  </div>
  <p><small>Total Companies</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-4">
<div class="box bg-primary"> <i class="fa fa-users icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-users"></i> <span id="salesrep_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
  </div>
  <p><small>Total Sales Representatives</small></p>
</div>
</div>
</div>
</div>
<?php endif; ?>
<?php $is_sales_rep = $this->role_lib->is_sales_rep(); ?>
<?php if($is_sales_rep): ?>
  <div class="clear-fix"></div>
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="box bg-success"> <i class="fa fa-users icon-bg"></i>
        <div class="tiles-inner text-center">
          <h1 class="bolded" ><i class="fa fa-users"></i> <span id="user_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
          <div class="progress no-rounded progress-xs">
            <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
          </div>
          <p><small>Active Users</small></p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="box bg-primary"> <i class="fa fa-eye icon-bg"></i>
        <div class="tiles-inner text-center">
          <h1 class="bolded" ><i class="fa fa-eye"></i> <span id="reports_count"> <i class="fa fa-spinner fa-spin"></i></span> </h1>
          <div class="progress no-rounded progress-xs">
            <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-primary"> </div>
          </div>
          <p><small>Total Reports Created</small></p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="box bg-danger"> <i class="fa fa-chevron-circle-left icon-bg"></i>
        <div class="tiles-inner text-center">
          <h1 class="bolded"><i class="fa fa-chevron-circle-left"></i> <span id="deactiveuser_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
          <div class="progress no-rounded progress-xs">
            <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-danger"> </div>
          </div>
          <p><small>Deactived Users</small></p>
        </div>
      </div>
    </div>
  </div>
    <?php endif; ?>
  <?php if($this->role_lib->is_manager_l1()): ?>
<div class="clear-fix"></div>
<div class="row">
<div class="col-sm-6 col-md-3">
<div class="box bg-success"> <i class="fa fa-users icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-users"></i> <span id="user_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"> </div>
  </div>
  <p><small>Active Users</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-3">
<div class="box bg-primary"> <i class="fa fa-eye icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded" ><i class="fa fa-eye"></i> <span id="reports_count"> <i class="fa fa-spinner fa-spin"></i></span> </h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-primary"> </div>
  </div>
  <p><small>Total Reports Created</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-3">
<div class="box bg-danger"> <i class="fa fa-chevron-circle-left icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded"><i class="fa fa-chevron-circle-left"></i> <span id="newuser_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-danger"> </div>
  </div>
  <p><small>New Sign Ups</small></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-3">
<div class="box bg-warning"> <i class="fa fa-users icon-bg"></i>
<div class="tiles-inner text-center">
  <h1 class="bolded"><i class="fa fa-users"></i> <span id="online_users_count"> <i class="fa fa-spinner fa-spin"></i></span></h1>
  <div class="progress no-rounded progress-xs">
    <div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-warning"> </div>
  </div>
  <p><small>Online Users</small></p>
</div>
</div>
</div>
</div>
<!-- highcharts -->
<?php endif; ?>

<!-- highcharts -->
<div class="row">

<div class="col-sm-12 col-md-12">
<div class="panel panel-info">
<div class="panel-heading"><h4 class="panel-title">Total Orders Generated</h4></div>
<div class="panel-body">
  <!-- <div id="basic-column"></div> -->
  <div id="order_chart">
      <div class="text-center">
            <i class="fa fa-spinner fa-spin ma-font-24"></i>
        </div>
  </div>
</div>
</div>
</div>
</div>

<div class="spacer"></div>
<div class="panel panel-info">
  <div class="panel-heading panel-padding" role="tab" id="headingthree">
    
    <a class="panel-title h4">
      Recent Transactions
    </a>
    
  </div>
  <div id="order">
    <div class="panel-body">
      <div class="table-head table-responsive" id="transactionlist" style="min-height:50px;">
        <table id="transaction_table">
          <thead>
              <tr style="color: black;">
                  <th class="no-sort">Invoice Date</th>
                  <th class="no-sort">Invoice No.</th>
                  <th class="no-sort">Type</th>
                  <th class="no-sort">Property Address</th>
                  <th class="no-sort">Invoice To</th> 
                  <th class="no-sort">Sales Rep</th>                                
                  <th class="no-sort">Action</th>
              </tr>
          </thead>

        </table>
      </div>
    </div>
  </div>
</div>
<div class="spacer"></div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

// active user list function
function active_users(user_role_id){
  $.ajax({
        url: '<?php echo site_url('admin/getActiveUser'); ?>',
        method:'POST',
        data:{
          type:"active_user",
          user_role_id: user_role_id
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
          var user_count = obj.active_user;
          if(user_role_id ==2)
            $("#company_count").html(user_count);
          else if (user_role_id ==3) 
            $("#salesrep_count").html(user_count);
          else if(user_role_id ==4)
            $("#user_count").html(user_count);
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }
    });
    return false;
}

// ajax call for chart data
function total_revenue(interval){
    $.ajax({
        url: '<?php echo site_url('dashboard/total_revenue'); ?>',
        method:'POST',
        data:{
            interval:interval
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
          if(interval == 'day')
            $("#daily_revenue").html(obj.inv_amt);
          else if (interval == 'month') 
            $("#monthly_revenue").html(obj.inv_amt);
          else if(interval == 'year')
            $("#annual_revenue").html(obj.inv_amt);
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }
    });
    return false;
}
// order chart
function order(){
    $.ajax({
        url: '<?php echo base_url(); ?>index.php?/dashboard/order',
        method:'POST',
        data:{
            type:"order_chart"
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        
        if(obj.status == "success") {          
          if ((obj.inv_date).length === 0 && (obj.inv_amt).length === 0) {
            $('#order_chart').html('<div align="center">No Data Found</div>');
          } else {
            order_chart(obj.inv_date,obj.inv_amt);
          }
        }else{

        }                 
    }); 
    return false; 
}
function order_chart(invdate,invdata){
  /* Basic column */
    $('#order_chart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        
        xAxis: {
            categories: invdate,
            labels: {
                rotation: -45,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Montserrat'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Reports'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                color:'#00cec9'
            }
        },
    credits:true,
        series: [{
            name: 'Reports',
            data: invdata

        }]
    });
}
$(document).ready(function(){
    <?php if($this->role_lib->is_admin()): ?>
    active_users(2);
    active_users(3);
    active_users(4);
    total_revenue('day');
    total_revenue('month');
    total_revenue('year');
    order();
    <?php elseif ($this->role_lib->is_sales_rep()): ?>
    order();
    reports_count();
    active_users(4);
    deactive_users(4);
    <?php elseif ($this->role_lib->is_manager_l1()): ?>
    order();
    reports_count();
    active_users(4);
    new_signup();
    online_users_count();
    <?php endif; ?>
});

</script>