<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li class="active">Product</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel">
  <div class="panel-body">
    <div class="row">
      <div class="col-md-4">
        <a href="#" class="thumbnail">
          <img src="<?php echo site_url().$products->product_image; ?>" alt="">
        </a>
      </div>
      <div class="col-md-4 product-detail">
        <h4><strong><?php echo $products->product_name; ?></strong></h4>
        <p>Flyer size is 320*320 and we provide all sizes.</p>
        
        <p>&nbsp;</p>
        <hr>
        
        <div class="">
          <p>
          <a class="btn btn-sm btn-default btn-warning" href="<?php echo site_url().'admin/manage_product_edit/'.$products->product_id_pk; ?> ">Edit</a>
          <a class="btn btn-sm btn-default" href="javascript:;" onclick="deleteproduct2(<?php echo $products->product_id_pk; ?>);">Delete</a>
         
          <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>index.php?/admin/manage_product">See All Products</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>