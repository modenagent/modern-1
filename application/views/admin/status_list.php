
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
            <div class="clearfix"></div>
            <div class="row-fluid">
            <h2>Manage Status</h2 >
            </div>
           
     </div>
        
        <div class="panel">
    

      <div class="panel-heading">

                        <h4 class="pull-left">Manage Status</h4>  <a href="#add_new_form" class="btn btn-success pull-right"  data-toggle="modal"> Add New</a>                             
                    <div class="clearfix">
                    
                    </div>
                    </div>
                    <div class="panel-body">
                        <!-- Search/Filter Bar -->
                        <div class="admin-table-search">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status-search" class="sr-only">Search status</label>
                                        <input type="text" id="status-search" class="form-control" placeholder="Search status by name..." aria-label="Search status">
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-primary" onclick="searchStatus()">
                                        <i class="fa fa-search" aria-hidden="true"></i> Search
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="clearStatusSearch()">
                                        <i class="fa fa-times" aria-hidden="true"></i> Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="admin-table-container">
                            <table class="table admin-table table-striped table-hover" id="status-table" role="table" aria-label="Status management table">
                                <thead>
                                    <tr role="row">
                                        <th tabindex="0" role="columnheader" aria-sort="none">
                                            <span class="sr-only">Serial number column</span>
                                            Sr. no.
                                        </th>
                                        <th tabindex="0" role="columnheader" aria-sort="none">Status name</th>
                                        <th class="no-sort" role="columnheader">
                                            <span class="sr-only">Actions for each status</span>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php $i = 1; foreach($status_list as $info) { 
                                        if($info->id != 0) {
                                      ?> 
                                        <tr role="row">
                                            <td data-label="Sr. no."><?php echo $i; ?></td>
                                            <td data-label="Status name" id="name<?=$info->id?>"><?php echo htmlspecialchars($info->status_name); ?></td>
                                            <td data-label="Actions">
                                                <div class="btn-group" role="group" aria-label="Status actions">
                                                    <a class="btn btn-sm btn-warning" 
                                                       href="#edit_form" 
                                                       onclick="status_edit(<?=$info->id?>)" 
                                                       data-toggle="modal"
                                                       aria-label="Edit status <?php echo htmlspecialchars($info->status_name); ?>">
                                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                                    </a>
                                                    <a class="btn btn-sm btn-danger" 
                                                       href="delete_status/<?=$info->id?>" 
                                                       onclick="return confirm('Are you sure you want to delete this status?')"
                                                       aria-label="Delete status <?php echo htmlspecialchars($info->status_name); ?>">
                                                        <i class="fa fa-times" aria-hidden="true"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; } } ?>                                
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
<div id="add_new_form" class="modal fade" tabindex="-1" role="dialog" >
         <div class="modal-dialog">
          <div class="modal-content">
       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add New Status</h3>
        </div>        
        <div class="panel-body">
                                             
               <form action="" method="post">
                <div class="form-group clearfix">
                            <label>Status Name</label>
                           <input class="form-control" type="text" name = "status_name" value="" required>
                </div>

                
                <input type="submit"  class="btn btn-success" value="Add">
                </form>
                                               
        </div> 


    </div>
  </div>
</div>






    <div id="edit_form" class="modal fade" tabindex="-1" role="dialog" >
      <div class="modal-dialog">
          <div class="modal-content">
       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Edit Status</h3>
        </div>        
        <div class="modal-body">
                                         
               <form action="" method="post">
                <div class="form-group">
                            <label>Status Name</label>
                           
                              <input class="form-control" type="text" id = "status_val" name = "status_name_edit" value="" required>
                              <input type="hidden" id = "status_id" name = "id" value="" >
                          
                </div>

                
                <input type="submit"  class="btn btn-success" value="Add">
                </form>
                                                
        </div> 
      </div>


    </div>
</div>


<script>
function status_edit (id) 
{
  var a = $("#name"+id).html();
  $("#status_val").val(a);
  $("#status_id").val(id);
}

// Search functionality for status
function searchStatus() {
    var searchTerm = document.getElementById('status-search').value;
    if (window.AdminTables && $('#status-table').DataTable()) {
        $('#status-table').DataTable().search(searchTerm).draw();
    }
}

function clearStatusSearch() {
    document.getElementById('status-search').value = '';
    if (window.AdminTables && $('#status-table').DataTable()) {
        $('#status-table').DataTable().search('').draw();
    }
}

// Allow Enter key to trigger search
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('status-search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchStatus();
            }
        });
    }
});





</script>