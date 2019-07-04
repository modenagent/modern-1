   
    <div class="content">
        
        
        <div class="breadLine">
            
            <ul class="breadcrumb">
                                
                 <li><a href="<?=base_url()?>index.php/admin/dashboard">Dashboard</a> <span class="divider">></span></li>  
                <li class="active">Shopping centers</li>

            </ul>
                        
                               
                    
               
            
        </div>
        
        <div class="workplace">
        <?php if(isset($_GET['msg']))
                { 
                  if($_GET['msg'] == "true"){
                  ?>
                  <div class='alert alert-success fade-in span4'>
                    <button data-dismiss='alert' class='close' type='button'>×</button>
                         <strong id = 'success'>your Shopping Center has been added.</strong>
                         </div>                  
           <?php } }?>
            <div class="clearfix"></div>
            <div class="row-fluid">
            <h2>Shopping Centers</h2 >
            </div>
           
             <?php //$info = $info[0];
             //echo "<pre>";print_r($products); ?>

      <div class="row-fluid">
                
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Shopping centers </h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    
                                    <th width="5%">Sr. no.</th>
                                        <th width="30%" >Name</th>
                                        <th width="15%">Type</th>
                                        <th width="25%">Country,State</th>
                                        <th width="25%">Actions</th>
                                        
                                        
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php $i = 1;foreach($shopping_centers as $info)   { ?> 
                                    <tr>
                                        <td> <?php print_r($i);?>   </td>
                                        <td> <?php print_r($info->name);?>   </td>
                                        <td> <?php print_r($info->type_name);?>   </td>
                                       
                                        <td> <?php print_r($info->country_name);?>,<?php print_r($info->state_name);?>   </td>
                                        <td><a href="<?=base_url()?>index.php/admin/deleteshopping/<?php print_r($info->id);?>">Delete</a>||
										<?php if($info->verify==0){?>
										<a href="<?=base_url()?>index.php/admin/verify/<?php print_r($info->id);?>">Verify</a>
										<?php }else{?>
										<a href="<?=base_url()?>index.php/admin/unverify/<?php print_r($info->id);?>">UnVerify</a>
										<?php }?>
										</td>
                                       
                                        
                                    </tr>
                                    <?php  $i++;}?>                                
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

function product_edit(id){
    
     $.ajax({
                             url     : "<?=base_url()?>index.php/store/product_edit/"+id,
                             type    : "POST",
                 success : function( data )
                        { 
                       
                         //	alert(data);
                          document.getElementById('myModal2').innerHTML = data;
                           
                         
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