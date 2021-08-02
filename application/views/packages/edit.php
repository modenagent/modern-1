<style type="text/css">
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>
<div class="breadLine">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a> </li>
        <li class="active">Manage Packages</li>
    </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">Edit Package</h4>
    </div>

    <div class="well">
        
      <form action="" method="POST" role="form" id="edit_package" autocomplete="off">
        <legend>Edit Package</legend>        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Package Name</label>                
                <input type="text" class="form-control " required id="package_name" name="title" placeholder="Package Name" value="<?php echo $package->title; ?>">                
              </div>
            
              <div class="form-group">
                <label for="">Price (per use)</label>                
                  <input type="text" class="form-control " required  id="price" name="price" placeholder="Package Price" value="<?php echo $package->price; ?>">             
              </div>
              <div class="form-group">
                <label for="">Monthly subscription price</label>
                 
                  <input type="text" class="form-control" required id="price_per_month" name="price_per_month" placeholder="Monthly subscription price" value="<?php echo $package->price_per_month; ?>">
                
              </div>
              <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control"><?php echo $package->description; ?></textarea>
                
              </div>
              <div ><label for="package_active">Active ?</label></div>
              <div class="row">
                  <div class="col-sm-2">
                    <label class="switch">
                      <input type="checkbox" class="form-control" id="package_active" name="is_active" <?php echo ($package->is_active == 1)?'checked':''; ?> value='1' style="height: 20px">
                      <span class="slider round"></span>
                    </label>
                    
                </div>
              </div>
              <div ><label for="referral_active">Refferal Status</label></div>
              <div class="row">
                  <div class="col-sm-2">
                    <label class="switch">
                      <input type="checkbox" class="form-control" id="referral_active" name="refferral_status" <?php echo ($package->refferral_status == 1)?'checked':''; ?> value='1' style="height: 20px">
                      <span class="slider round"></span>
                    </label>
                    
                </div>
              </div>
              <div class="form-group">
                
                  
                
              </div>
            </div>
        </div>
        <div class="row">
         
            <div class="col-md-offset-2 col-md-2">
              
              <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </div>
            <div class="col-md-2">
              <a href="<?php echo site_url().'/admin/packages'; ?>" class="btn btn-block btn-default">Back</a>
            </div>
        </div>
      </form>
    </div>

    
</div>
