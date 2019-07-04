   
    <div class="content">
        
        
        <div class="breadLine">
            
            <ul class="breadcrumb">
                                
                 <li><a href="<?=base_url()?>index.php/admin/dashboard">Dashboard</a> <span class="divider">></span></li>  
                <li class="active">Manage sales</li>
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
            <h2>Manage sales</h2 >
            </div>
           
             

      <div class="row-fluid">
                
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Manage sales</h1>
                        <a class="btn-info btn pull-right label-fix" href="<?=base_url()?>index.php/store/orders"><i class="icon icon-refresh"></i> Refresh</a>
                        <div  class="btn-group label-fix pull-right"  >

                      <a  class="success btn btn-success " href="<?=base_url()?>index.php/store/orders?stat=Approved" >Approved</a> 
                      <a class="btn-warning btn " href="<?=base_url()?>index.php/store/orders?stat=Pending">Pending</a>
                      <a class="btn-danger btn " href="<?=base_url()?>index.php/store/orders?stat=Declined">Declined</a>
                      
                    </div>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    
                                    <th width="5%">Sr. no.</th>
                                        <th width="20%" >Store Name</th>
                                        <th width="15%">Total sale</th>
                                        <th width="25%">status</th>
                                        <th width="35%">Actions</th>
                                        
                                        
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php

                                
                              //print_r($price);
                                 $detail = array();
                                 $i = 1;foreach($order_sales as $info)   { 
                                  if(!in_array($info->store_id,$detail))
                                {
                                  ?> 
                                    <tr>
                                        <td> <?php print_r($i);?>   </td>
                                        <td> <?php print_r($info->store_name);?>   </td>
                                        
                                       <td><?php print_r($info->pending_amount);?></td>
                                       <td>Pending</td> 
                                      <td>
                                          <a href="#myModal" role="button"  data-toggle="modal"  >View</a>
                                      </td>  
                                    </tr>
                                    <?php  $i++;  array_push($detail, $info->store_id);} }?>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="head clearfix" style="border-radius: 0 0 3px 3px;">
                     <a class="btn-info btn pull-right label-fix" href="<?=base_url()?>index.php/store/orders"><i class="icon icon-refresh"></i> Refresh</a>
                     <div  class="btn-group label-fix pull-right"  >
                      <a  class="success btn btn-success " href="<?=base_url()?>index.php/store/orders?stat=Approved" >Approved</a> 
                      <a class="btn-warning btn " href="<?=base_url()?>index.php/store/orders?stat=Pending">Pending</a>
                      <a class="btn-danger btn " href="<?=base_url()?>index.php/store/orders?stat=Declined">Declined</a>
                      
                    </div>
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