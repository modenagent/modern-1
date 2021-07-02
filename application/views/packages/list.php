<div class="breadLine">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a> </li>
        <li class="active">Manage Packages</li>
    </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">Packages List</h4>
    </div>

    <div class="panel-body" >
    <!-- order view -->
    <div class="table-head table-responsive" id="coupon_table">
      <table class="table table-hover" id="package-table">
        <thead>
          <tr>          
            <th class="no-sort">#</th>
            <th>Package Name</th>  
            <th>Price</th> 
            <th>Monthly price</th>  
            <th>Status</th>  
            <th class="no-sort">Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($packages as $package_key=>$package) { ?>
                <tr>
                    <td><?php echo ($package_key+1) ?></td>
                    <td><?php echo $package->title; ?></td>
                    <td><?php echo '$'.number_format($package->price,2); ?></td>
                    <td><?php echo '$'.number_format($package->price_per_month,2); ?></td>
                    <td><?php
                    if($package->is_active == 1):
                        echo '<span class="label-primary badge">Active</span>';
                    else:
                        echo '<span class="label-danger badge">Inactive</span>';
                    endif; 
                    ?>
                    </td>
                    <td><a class="btn btn-xs btn-warning admin-ml-5" href="<?php echo base_url('admin/edit_package/'.$package->id) ?>" data-toggle="tooltip" data-title="Edit"><i class="fa fa-edit"></i></a></td>
                </tr>
            <?php }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    
  
    $('#package-table').DataTable({});
});
</script>