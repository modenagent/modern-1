  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li class="active">Manage Product</li>
  </ul>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Manage Products
      <a class="pull-right btn-size" href="<?php echo site_url();?>admin/flyer_add" >
        <i  class="fa fa-plus"></i>
      </a>
    </h4>
  </div>
  <div class="collapse" id="collapseExample">
    <div class="well clearfix">
    <form action="" method="POST" role="form" id="product_add">
        <legend>Add New Product</legend>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" id="pname" name="pname" placeholder="Product Name">
            </div>
            <div class="form-group">
                <select class="combobox input-large form-control" name="cname" id="cname">
                    <option value="">Choose a Category</option>
                    <?php 
                    foreach ($category as $value) {
                    ?>
                    <option value="<?php echo $value->category_id_pk;?>"><?php echo $value->category_name; ?></option>
                    <?php    
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 form-group input-group">                            
            <input  type="text" placeholder="click to Show Date"  id="example1" class="form-control" name="adddate">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        </div>
        <span class="help-block"></span>
            <div class="col-md-4">         

                <div class="fileupload-buttonbar">
                    <div class="fileupload-buttons">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="fileinput-button">
                            <span class="btn btn-info btn-sm">Upload Flyer <i class="fa fa-upload"></i></span>
                            <input type="file" name="files" id="filePhoto">
                        </span>
                        <span class="fileupload-process"></span>
                    </div>
                    <!-- The global progress state -->
                    <div class="fileupload-progress fade" style="display:none">
                        <!-- The global progress bar -->
                        <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        <!-- The extended global progress state -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 form-group input-group">                           
                <textarea class="summernote" name="flyer_html"></textarea>                              
            </div>

            <div class="col-md-2"> 
                <button type="submit" class="btn btn-primary btn-sm btn-block">Add Product</button>
            </div>
                        
    </form>
    </div>
  </div>
  <div class="panel-body">
    <!-- product list -->
    <div class="table-head table-responsive" id="prod_table">      
    </div>  
  </div>
</div>
</div>