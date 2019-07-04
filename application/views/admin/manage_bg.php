   
    <div class="content">
        
        
        <div class="breadLine">
            
            <ul class="breadcrumb">
                                
                 <li><a href="<?=base_url()?>index.php/admin/dashboard">Dashboard</a> <span class="divider">></span></li>  
                <li class="active">Manage Background</li>
            </ul>
     </div>
        
        <div class="workplace">
        <?php if(isset($_GET['msg']))
                { 
                  if($_GET['msg'] == "true"){
                  ?>
                  <div class='alert alert-success fade-in span4'>
                    <button data-dismiss='alert' class='close' type='button'>×</button>
                         <strong id = 'success'>your Gallary  has been updated.</strong>
                         </div>                  
           <?php } if($_GET['msg'] == "update"){
                  ?>
                  <div class='alert alert-success fade-in span4'>
                    <button data-dismiss='alert' class='close' type='button'>×</button>
                         <strong id = 'success'>your Site Image  has been updated.</strong>
                         </div> 



        <?php }   }?>
            <div class="clearfix"></div>
            <div class="row-fluid">
            <h2>Manage Background</h2 >
            </div>
           
             <?php //$info = $info[0];
             //echo "<pre>";print_r($orders); ?>

      <div class="row-fluid">
                
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Manage Background</h1>
                                                      
                    </div>
                  
                   
                     <div class="block thumbs clearfix" > 

                      <h3 onclick="show(1)" style="cursor:pointer"> Choose from gallery available backgrounds</h3>
                          
                    <div id="gallary" style="display:none;">
                        <div class="row-fluid">
                        <?php 
                        
                          
                          $handle = opendir($dirname);
                          while($file = readdir($handle)){
                              if($file !== '.' && $file !== '..'){ ?>
                             
                                  <div class="span3">
                                <a class="fancybox" rel="group" href="<?php echo base_url().$dirname.'/'.$file;?>"><img src="<?php echo base_url().$dirname.'/'.$file;?>" class="img-responsive"/></a>
                                  <div class="caption">
                                
                                
                                <p><a class="btn btn-success" href="#" onclick="select_image('<?=$file?>')">Choose</a> <a class="btn" href="#" onclick="delete_image('<?=$file?>')">delete</a></p>
                            </div>
                        </div> 

                           <?php    }
                          }
                        ?>
                   
                   </div>  
                 </div>
                   <div class="dr"></div>
                    <h3 onclick="show(2)" style="cursor:pointer"> Upload a new background</h3>
                    <div id="upload_photo">
                      <form class="form" method = "post" action="<?=base_url()?>index.php/admin/update_bg" enctype="multipart/form-data">
                        <div class="row-form clearfix">
                            
                            <div class="span6"><input type="file" name = "userfile" accept='image/*'  required></div>
                        </div>
                        <input type="submit" class="btn btn-success" value="upload" >

                      </form>

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

function show (id) {
  if(id == 1)
  {
    $("#gallary").slideToggle(200);
    $("#upload_photo").slideUp(200);
  }
  if(id == 2)
  {
    $("#gallary").slideUp(200);
    $("#upload_photo").slideToggle(200);
  }
}


function delete_image (name) 
{
  //alert(name);
  //return false;
  $.ajax({
                             url     : "<?=base_url()?>index.php/admin/delete_image/"+name,
                             type    : "POST",
                 success : function( data )
                        { 
                            if(data){
                              location.assign("<?=base_url()?>index.php/admin/update_bg?msg=true");
                            }
                            return false;                        
                      },
                    error   : function( xhr, err )
                      {
                        alert('connection error');
                       
                        return false;    
                      }
        });
}


function select_image (name) 
{


  $.ajax({
                             url     : "<?=base_url()?>index.php/admin/update_image/"+name,
                             type    : "POST",
                 success : function( data )
                        { 
                            if(data){
                              location.assign("<?=base_url()?>index.php/admin/update_bg?msg=update");
                            }
                            return false;                        
                      },
                    error   : function( xhr, err )
                      {
                        alert('connection error');
                       
                        return false;    
                      }
        });
  
}
</script>