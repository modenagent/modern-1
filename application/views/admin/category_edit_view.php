<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li class="active">Manage Category</li>
  </ul>
</div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Manage Category
  
  </h4>
  </div>
    <div class="well clearfix">
      <form action="" method="POST" role="form" id="edit_cat">
        <legend>Edit Category</legend>
        <div class="col-md-6">        
          <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Category Name" value="<?php echo $category->category_name; ?>">
          </div>
        </div>
        <div class="col-md-6"> 
          <div class="form-group">
            <label for="">Parent Category</label>
            <select name="parent_cat" id="parent_cat" class="form-control">
              <option value="">-- Select One --</option>
              <?php 
              foreach ($parent_cat as $value) {
                if($category->parent_category == $value->category_id_pk){
                   $sel = ' selected = "selected" ';
                }else{
                   $sel = '';
                }
                ?>
                <option value="<?php echo $value->category_id_pk; ?>" <?php echo $sel; ?> ><?php echo $value->category_name; ?></option>
                <?php
              }
              ?>
              
            </select>
          </div>
        </div>
        <div class="col-md-offset-10 col-md-2">
        <input type="hidden" name="catid" id="catid" value="<?php echo $category->category_id_pk; ?>">
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
      </form>
    </div>
  <div class="panel-body" >
    
  </div>
</div>
</div>