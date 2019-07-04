
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
                        <table class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    
                                    <th >Sr. no.</th>
                                        <th  >Status name </th>
                                        <th>Actions</th>
                                        
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php $i = 1;foreach($status_list as $info)   { 
                                    if($info->id != 0){
                                  ?> 
                                    <tr>
                                        <td> <?php print_r($i);?>   </td>
                                        
                                        <td id="name<?=$info->id?>"><?php print_r($info->status_name);?></td>
                                       
                                       
                                        <td >
<div class="btn-group">
                                         <a class="btn btn-warning" href="#edit_form"   onclick = "status_edit(<?=$info->id?>)" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                          <a class="btn btn-danger" href = "delete_status/<?=$info->id?>" onclick="return confirm('Really want to delete ??')"><i class="fa fa-times"></i> </a>
</div>
                                       </td>
                                       
                                        
                                    </tr>
                                    <?php  $i++;} }?>                                
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





</script>