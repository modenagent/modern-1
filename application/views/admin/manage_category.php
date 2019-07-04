<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li class="active">Manage Category</li>
  </ul>
</div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Manage Category
    <a class="pull-right btn-size" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i  class="fa fa-plus"></i>
  </a>
  </h4>
  </div>
  
  <div class="collapse" id="collapseExample">
    <div class="well">
      <form action="" method="POST" role="form" id="add_cat">
        <legend>Add Category</legend>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
          <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Category Name">
        </div>
        </div>        
        <div class="col-md-6">
        <div class="form-group">
          
          <select name="parent_cat" id="parent_cat" class="form-control">
            <option value="">-- Select One --</option>
            <?php 
            foreach ($parent_cat as $value) {
              ?>
              <option value="<?php echo $value->category_id_pk; ?>"><?php echo $value->category_name; ?></option>
              <?php
            }
            ?>
            
          </select>
        </div>
        </div>
        <div class="col-md-offset-10 col-md-2">
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <div class="panel-body" >
    <!-- category list view -->
     <div class="table-head table-responsive" id="cat_table">
      
    </div>
  </div>
</div>
</div>