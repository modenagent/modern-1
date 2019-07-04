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
                                <table class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                                <tr>
                                                            <th class="col-md-1">Sr. no.</th>
                                                            <th class="col-md-9"  >store  type </th>
                                                            <th class="col-md-2">Actions</th>
                                        
                                                </tr>
                                        </thead>
                                        <tbody>
                               
                                              <?php $i = 1;foreach($store_types as $info)   { ?>
                                                    <tr>
                                                        <td> <?php print_r($i);?> </td>
                                                        <td id="name<?=$info->id?>"><?php print_r($info->type);?></td>
                                                        <td > 
                                                          <div class="btn-group">
                                                            <a class="btn btn-warning" href="#edit_form"   onclick = "type_edit(<?=$info->id?>)" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                                            <a class="btn btn-danger" href = "delete_type/<?=$info->id?>" onclick="return confirm('Really want to delete ??')"><i class="fa fa-times"></i> </a>
                                                          </div>
                                                        </td>
                                                    </tr>
                                              <?php  $i++;}?>
                                        </tbody>
                                </table>
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
</script>