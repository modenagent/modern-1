<div class="breadLine">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a> </li>
        <li class="active">Manage Packages</li>
    </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">Manage Packages</h4>
    </div>

    <div class="well">
        <legend>Edit Packages Price</legend>
        <div class="row">
            <?php 
            if (!empty($packages)) {
                foreach ($packages as $key => $value) {
            ?>
                <div class="col-md-6">
                <div class="panel panel-info lp-p-15">
                    <div class="form-group">
                        <p for="">Package Name: </p>
                        <strong><?php echo ucfirst($key); ?></strong>    
                    </div>
                    <div class="form-group">
                        <p for="">Price</p>
                        <input type="text" maxlength="3" onchange="change_price('<?php echo $key; ?>')" class="form-control numeric" id="price_<?php echo $key; ?>" name="price_<?php echo $key; ?>"
                            placeholder="Package Price" value="<?php echo $value; ?>">
                        <label id="error_price_<?php echo $key; ?>" style="display:none;"></label>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="pid_<?php echo $key; ?>" id="pid_<?php echo $key; ?>" value="<?php echo $value; ?>">
                        <button type="button" onclick="change_package_price('<?php echo $key; ?>')" class="btn btn-block btn-primary">Submit</button>
                    </div>
                </div>      
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
function change_package_price(package)
{
    var validated = change_price(package);
    if (validated) {
        var price_id = 'price_'+package;
        var price = $.trim($('#'+price_id).val());
        $.ajax({
            url: '<?php echo site_url('admin/update_package'); ?>',
            method:'POST',
            dataType: 'json',
            data:{
                package: package,
                price: price
            }
        }).success(function(resp) {
            if (resp.status == "success") {
                Notify('Success', resp.message, 'success');
            } else {
                Notify('Error', resp.message, 'error');
            }                 
        }); 
    }
}

function change_price(package)
{
    var result = true;
    var price_id = 'price_'+package;
    var price = $.trim($('#'+price_id).val());
    var error_price_id = 'error_price_'+package;
    if(price=='' || price=='0')
    {
        $('#'+error_price_id).html('Please enter valid price.');
        $('#'+error_price_id).show();
        result = false;
    } else {
        $('#'+error_price_id).html('');
        $('#'+error_price_id).hide();
        result = true;
    }
    return result;
}
</script>