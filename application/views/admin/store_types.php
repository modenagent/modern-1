<div class="breadLine">
  
  <ul class="breadcrumb">
    
    <li><a href="<?=base_url()?>index.php/admin/dashboard">Dashboard</a></li>
    <li class="active">Manage Store Types</li>
  </ul>
</div>
<div class="clearfix">
  <?php if(isset($_GET['msg']))
  {
  if($_GET['msg'] == "true"){
  ?>
  <div class='alert alert-success fade-in span4'>
    <button data-dismiss='alert' class='close' type='button'>×</button>
    <strong id = 'success'>your Shopping Center has been added.</strong>
  </div>
  <?php } }?>
  
  
</div>
        <div class="panel">
        
          <div class="panel-heading">
 
          <h4 class="pull-left">Manage types</h4>
          <a href="#add_new_form" class="btn btn-success pull-right"  data-toggle="modal"> Add New</a> 
           <div class="clearfix">
   
           </div>
          </div>
                        <div class="panel-body">
                            <!-- Search/Filter Bar -->
                            <div class="admin-table-search">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="store-types-search" class="sr-only">Search store types</label>
                                            <input type="text" id="store-types-search" class="form-control" placeholder="Search store types..." aria-label="Search store types">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-primary" onclick="searchStoreTypes()">
                                            <i class="fa fa-search" aria-hidden="true"></i> Search
                                        </button>
                                        <button type="button" class="btn btn-default" onclick="clearStoreTypesSearch()">
                                            <i class="fa fa-times" aria-hidden="true"></i> Clear
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="admin-table-container">
                                <table class="table admin-table table-striped table-hover" id="store-types-table" role="table" aria-label="Store types management table">
                                    <thead>
                                        <tr role="row">
                                            <th class="col-md-1" tabindex="0" role="columnheader" aria-sort="none">
                                                <span class="sr-only">Serial number column</span>
                                                Sr. no.
                                            </th>
                                            <th class="col-md-9" tabindex="0" role="columnheader" aria-sort="none">Store type</th>
                                            <th class="col-md-2 no-sort" role="columnheader">
                                                <span class="sr-only">Actions for each store type</span>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                           
                                          <?php $i = 1; foreach($store_types as $info) { ?>
                                                <tr role="row">
                                                    <td data-label="Sr. no."><?php echo $i; ?></td>
                                                    <td data-label="Store type" id="name<?=$info->id?>"><?php echo htmlspecialchars($info->type); ?></td>
                                                    <td data-label="Actions"> 
                                                      <div class="btn-group" role="group" aria-label="Store type actions">
                                                        <a class="btn btn-sm btn-warning" 
                                                           href="#edit_form" 
                                                           onclick="type_edit(<?=$info->id?>)" 
                                                           data-toggle="modal"
                                                           aria-label="Edit store type <?php echo htmlspecialchars($info->type); ?>">
                                                            <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                                        </a>
                                                        <a class="btn btn-sm btn-danger" 
                                                           href="delete_type/<?=$info->id?>" 
                                                           onclick="return confirm('Are you sure you want to delete this store type?')"
                                                           aria-label="Delete store type <?php echo htmlspecialchars($info->type); ?>">
                                                            <i class="fa fa-times" aria-hidden="true"></i> Delete
                                                        </a>
                                                      </div>
                                                    </td>
                                                </tr>
                                          <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                                
                
</div>
</section>
 <div id="edit_form" class="modal  fade" tabindex="-1" role="dialog" >
       <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Edit Type</h3>
              </div>        
            <div class="modal-body">
                                            
                     <form action="" method="post">
                        <div class="form-group clearfix">
                                        <label>Type Name</label>
                            
                              <input class="form-control" type="text" id = "type_val" name = "type_name_edit" value="" required>
                              <input type="hidden" id = "type_id" name = "id" value="" >
                         
                        </div>
                
                        <input type="submit"  class="btn btn-success" value="Edit">
                      </form>
                                                   
            </div> 
        </div>
    </div>
    </div>
<div id="add_new_form" class="modal  fade" tabindex="-1" role="dialog" >
       <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add New Type</h3>
              </div>        
            <div class="modal-body">
                                     
                       <form action="" method="post">
                            <div class="form-group clearfix">
                                            <label>Type Name</label>
                                          <input class="form-control" type="text" name = "type_name" value="" required></div>
                 
                
                            <input type="submit"  class="btn btn-success" value="Add">
                        </form>
                                                     
            </div> 
        </div>
         </div>
    </div>
    
 
   
<script>
function type_edit(id) 
{
  var a = $("#name"+id).html();

  $("#type_val").val(a);
  $("#type_id").val(id);
}

// Search functionality for store types
function searchStoreTypes() {
    var searchTerm = document.getElementById('store-types-search').value;
    if (window.AdminTables && $('#store-types-table').DataTable()) {
        $('#store-types-table').DataTable().search(searchTerm).draw();
    }
}

function clearStoreTypesSearch() {
    document.getElementById('store-types-search').value = '';
    if (window.AdminTables && $('#store-types-table').DataTable()) {
        $('#store-types-table').DataTable().search('').draw();
    }
}

// Allow Enter key to trigger search
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('store-types-search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchStoreTypes();
            }
        });
    }
});
</script>