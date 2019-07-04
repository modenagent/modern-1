   

        
        <div class="breadLine">
            
            <ul class="breadcrumb">
                                
                 <li><a href="<?=base_url()?>index.php/admin">Dashboard</a></li>  
                <li class="active">Add Entity</li>

            </ul>
                        
                               
                    
               
            
        </div>
        <div class="clearfix">
        
        </div>
        
        <div class="panel">
                                    
           
            
            <div class="panel-heading">
           Add Entity
            </div>
            <div class="panel-body">
           

      <div class="position-center">
                
                       <div class="prf-contacts sttng">
                                        <h2>  Add New Entry</h2>
                                    </div>     
                 
                    
                       
                      <form name="form" id="" class="form-horizontal" action="<?=base_url()?>index.php/admin/add_entity/" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                     
                            <label class="col-lg-2 control-label">Name:</label>
                            <div class="col-md-10"><input type="text" class="form-control" name = "name" value="" required></div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Type</label>
                            <div class="col-md-10">
                            <select class="form-control" name = "type_id"  required>
                                <option value="">Select Type</option>
                             <?php foreach($shopping_center_type as $shoptype){
                                if($shoptype->id != 0){
                              ?>
                            <option value="<?php echo $shoptype->id; ?>"><?php echo $shoptype->type_name; ?></option>
                        <?php } }?>
                            </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Address:</label>
                            <div class="col-md-10">
                              
                             <textarea  name="address" class="form-control" rows="5"  name="text" ></textarea>
                            
                             </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Country:</label>
                            <div class="col-md-10">
                            <select class="form-control" name = "country"  onchange="get_sub_list(this.value)" required>
                            <option value="0">Select Country</option>
                        <?php foreach($countries as $country){ ?>
                            <option value="<?php echo $country->id; ?>" ><?php echo $country->country; ?></option>
                        <?php } ?>
                        </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">State:</label>
                            <div class="col-md-10">
                            <select class="form-control" name = "state" id="sub_select" required>
                            <option value="">Select State</option>
                        
                        </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">City:</label>
                            <div class="col-md-10"><input type="text" class="form-control" name = "city" value="" required></div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Pincode:</label>
                            <div class="col-md-10"><input type="text" class="form-control" name = "pincode" value="" required></div>
                        </div>
                        
                       <input type="submit"  class="btn btn-success" value="Add" >
                            </form>


                    </div>
                                              
                
            </div>   
            </div> 
        </div> 


        <script type="text/javascript">
        function get_sub_list(id){
          
          
           $.ajax({
                             url     : "<?=base_url()?>index.php/admin/get_sub_list/"+id,
                             type    : "POST",

                 success : function( data )
                        { 
                       
                        $("#sub_select").html(data);
                            
                      },
                    error   : function( xhr, err )
                      {
                        alert('Error');
                       
                        return false;    
                      }
        });
            
        }
        </script>
