   
    <div class="content">
        
        
        <div class="breadLine">
            
            <ul class="breadcrumb">
                                
                 <li><a href="<?=base_url()?>index.php/admin/dashboard">Dashboard</a> <span class="divider">></span></li>  
                <li class="active">Manage deals</li>
            </ul>
     </div>
        
        <div class="workplace">
        <?php if(isset($_GET['msg']))
                { 
                  if($_GET['msg'] == "removed"){
                  ?>
                  <div class='alert alert-success fade-in span4'>
                    <button data-dismiss='alert' class='close' type='button'>×</button>
                         <strong id = 'success'>Product has been removed from deals.</strong>
                         </div>                  
           <?php } }?>
            <?php if(isset($_GET['msg']))
                { 
                  if($_GET['msg'] == "deals_update"){
                  ?>
                  <div class='alert alert-success fade-in span4'>
                    <button data-dismiss='alert' class='close' type='button'>×</button>
                         <strong id = 'success'>Product has been Updated.</strong>
                         </div>                  
           <?php } }?>

            <div class="clearfix"></div>
            <div class="row-fluid">
            <h2>Manage deals</h2 >
            </div>
           
             <?php //$info = $info[0];
             //echo "<pre>";print_r($orders); ?>

      <div class="row-fluid">
                
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Manage deals</h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    
                                    <th width="5%">Sr. no.</th>
                                        <th width="20%" >Product Name</th>
                                        <th width="15%">Store Name</th>
                                        <th width="25%">Actual Price (<b>$</b>) / Offer price(<b>$</b>)</th>
                                        <th width="35%">Actions</th>
                                        
                                        
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php

                               
                             
                                 $i = 1; foreach($deals as $info)   { 
                                   ?>
                                    <tr>
                                        <td> <?php print_r($i);?>   </td>
                                        <td> <?php print_r($info->product_name);?>   </td>
                                       
                                        <td> <?php print_r($info->store_name);?></td>
                                         <!--
                                        <td><a href="<?=base_url()?>index.php/admin/deleteproduct/<?php print_r($info->product_id);?>">Delete</a>||
										<?php if($info->status==0){?>
										<a href="<?=base_url()?>index.php/admin/verifyproduct/<?php print_r($info->product_id);?>">Active</a>
										<?php }else{?>
										<a href="<?=base_url()?>index.php/admin/unverifyproduct/<?php print_r($info->product_id);?>">Deactive</a>
										<?php }?>
										</td> -->
                                       <td> <?php print_r($info->selling_price);?> / <?php print_r($info->offer_price);?> </td> 
                                      <td><a href="<?=base_url()?>index.php/admin/remove_deals/<?php print_r($info->id);?>" onclick="return confirm('confirm to remove from hot deals')" >Remove</a> || 
                                      <a href="#myModal" data-toggle="modal" onclick="edit_deals(<?php print_r($info->id);?>)" >edit</a> 
                    </td>  
                                    </tr>
                                    <?php  $i++;  } ?>                                
                            </tbody>
                        </table>
                    </div>
                </div>                                
                
            </div>   
            </div> 
        </div> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
</div>




<script>
function product_view(id){
    
     $.ajax({
                             url     : "<?=base_url()?>index.php/store/product_detail/"+id,
                             type    : "POST",
                 success : function( data )
                        { 
                       
                         //	alert(data);
                          document.getElementById('myModal').innerHTML = data;
                           
                         
                              return false;                        
                      },
                    error   : function( xhr, err )
                      {
                        alert('Error');
                       
                        return false;    
                      }
        });
    
}

function edit_deals(id){
    
     $.ajax({
                             url     : "<?=base_url()?>index.php/admin/edit_deals/"+id,
                             type    : "POST",
                 success : function( data )
                        { 
                       
                         //	alert(data);
                          document.getElementById('myModal').innerHTML = data;
                           
                         
                              return false;                        
                      },
                    error   : function( xhr, err )
                      {
                        alert('Error');
                       
                        return false;    
                      }
        });
    
}


function view_order(id){
    
     $.ajax({
                             url     : "<?=base_url()?>index.php/admin/order_detail/"+id,
                             type    : "POST",
                 success : function( data )
                        { 
                       
                          //alert(data);
                          document.getElementById('myModal').innerHTML = data;
                           
                         
                              return false;                        
                      },
                    error   : function( xhr, err )
                      {
                        alert('Error');
                       
                        return false;    
                      }
        });
    
}



</script>