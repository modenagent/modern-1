   
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
                        <!-- Search/Filter Bar -->
                        <div class="admin-table-search">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deals-search" class="sr-only">Search deals</label>
                                        <input type="text" id="deals-search" class="form-control" placeholder="Search deals by product name, store name, or price..." aria-label="Search deals">
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-primary" onclick="searchDeals()">
                                        <i class="fa fa-search" aria-hidden="true"></i> Search
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="clearSearch()">
                                        <i class="fa fa-times" aria-hidden="true"></i> Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="admin-table-container">
                            <table cellpadding="0" cellspacing="0" class="table admin-table table-striped table-hover" id="deals-table" role="table" aria-label="Deals management table">
                                <thead>
                                    <tr role="row">
                                        <th width="5%" tabindex="0" role="columnheader" aria-sort="none">
                                            <span class="sr-only">Serial number column</span>
                                            Sr. no.
                                        </th>
                                        <th width="20%" tabindex="0" role="columnheader" aria-sort="none">Product Name</th>
                                        <th width="15%" tabindex="0" role="columnheader" aria-sort="none">Store Name</th>
                                        <th width="25%" tabindex="0" role="columnheader" aria-sort="none">Actual Price ($) / Offer price($)</th>
                                        <th width="35%" class="no-sort" role="columnheader">
                                            <span class="sr-only">Actions for each deal</span>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php
                                     $i = 1; foreach($deals as $info)   { 
                                       ?>
                                        <tr role="row">
                                            <td data-label="Sr. no."><?php echo $i; ?></td>
                                            <td data-label="Product Name"><?php echo htmlspecialchars($info->product_name); ?></td>
                                            <td data-label="Store Name"><?php echo htmlspecialchars($info->store_name); ?></td>
                                            <td data-label="Price"><?php echo htmlspecialchars($info->selling_price); ?> / <?php echo htmlspecialchars($info->offer_price); ?></td> 
                                            <td data-label="Actions">
                                                <div class="btn-group" role="group" aria-label="Deal actions">
                                                    <a href="<?=base_url()?>index.php/admin/remove_deals/<?php echo $info->id; ?>" 
                                                       class="btn btn-sm btn-danger" 
                                                       onclick="return confirm('Are you sure you want to remove this deal?')"
                                                       aria-label="Remove deal for <?php echo htmlspecialchars($info->product_name); ?>">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                    </a>
                                                    <a href="#myModal" 
                                                       class="btn btn-sm btn-warning" 
                                                       data-toggle="modal" 
                                                       onclick="edit_deals(<?php echo $info->id; ?>)"
                                                       aria-label="Edit deal for <?php echo htmlspecialchars($info->product_name); ?>">
                                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                                    </a>
                                                </div>
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
        </div> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
</div>




<script>
// Search functionality for deals
function searchDeals() {
    var searchTerm = document.getElementById('deals-search').value;
    if (window.AdminTables && $('#deals-table').DataTable()) {
        $('#deals-table').DataTable().search(searchTerm).draw();
    }
}

function clearSearch() {
    document.getElementById('deals-search').value = '';
    if (window.AdminTables && $('#deals-table').DataTable()) {
        $('#deals-table').DataTable().search('').draw();
    }
}

// Allow Enter key to trigger search
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('deals-search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchDeals();
            }
        });
    }
});

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