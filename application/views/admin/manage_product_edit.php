<div class="breadLine">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
        <li class="active">Manage Product</li>
    </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
    <div class="panel-heading">
        Manage Products 
    </div>
<div>
    <div class="row-padding clearfix">
        <form action="" method="POST" role="form" id="product_edit">
            <legend><h4>Edit Product</h4></legend>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="pname" name="pname" placeholder="Product Name" value="<?php echo $products[0]->product_name;?>">
                </div>
                <div class="form-group">
                    <select class="combobox input-large form-control" name="cname" id="cname">
                        <option value="">Choose a Category</option>
                        <?php
                        foreach ($category as $value) {
                            if($products[0]->category_id_ck == $value->category_id_pk){
                                $sel = ' selected = "selected" ';
                            }else{
                                $sel = ' ';
                            }
                        ?>
                        <option value="<?php echo $value->category_id_pk;?>" <?php echo $sel; ?> ><?php echo $value->category_name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group input-group">
                <input  type="text" placeholder="click to Show Date"  id="" class="form-control datepicker" name="adddate" value="<?php echo date('d-m-Y', strtotime($products[0]->active_from)); ?>">
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
                        <span class="fileupload-process">
                        <!-- <img src="<?php echo site_url().$products[0]->product_image; ?>" width="40px" height="40px"> -->
                        </span>
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
            <div class="col-md-12 form-group input-group">                           
                <textarea class="summernote" name="flyer_html"><?php echo $products[0]->product_content; ?></textarea>                              
            </div>
            <input type="hidden" class="form-control" id="pid" name="pid" value="<?php echo $products[0]->product_id_pk;?>">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm btn-block">Update Product</button>
            </div>
        </form>
    </div>
</div>

</div>
</div>