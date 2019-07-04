// product list
productlist();
// product list function
function productlist(){
  var site_url = window.location.protocol + '://' + window.location.hostname + '/';
  
  $.ajax({
        url: site_url+'admin/productlist_view',
        method:'POST',
        data:{
            type:"productlist"
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
          var prod_list = obj.prodlist_table;
          $("#prod_table").html(prod_list);  
          $(".table").dataTable();
          $("[data-toggle='tooltip']").tooltip();
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }                 
    }); 
    return false; 
}
// delete prod
function deleteproduct(str){ 
  var site_url = window.location.protocol + '://' + window.location.hostname + '/'; 
  // var site_url = 'http://cardbanana.net/demo/farmingflyers/';
  var prod_id = str;
  bootbox.confirm("Are you sure you want to delete?", function(result) {
    if(result){
      $.ajax({
          url: site_url+'/admin/deleteproduct/'+prod_id,
          method:'POST',
          data:{
              type:"deleteprod"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){          
            productlist();
            Notify('Success', obj.msg, 'success');
          }else{
            Notify('Error', 'Invalid Request.', 'error');
          }                 
      }); 
      // return false;
    }
  });   
}
// active product
function verifyproduct(str){  
  var site_url = window.location.protocol + '://' + window.location.hostname + '/'; 
  // var site_url = 'http://cardbanana.net/demo/farmingflyers/';
  var prod_id = str; 
  bootbox.confirm("Are you sure you want to activate?", function(result) {
    if(result){
      $.ajax({
          url: site_url+'admin/verifyproduct/'+prod_id,
          method:'POST',
          data:{
              type:"verifyprod"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){          
            productlist();
            Notify('Success', obj.msg, 'success');
          }else{
            Notify('Error', 'Invalid Request.', 'error');
          }                 
      }); 
      // return false;
    }
  });   
}
// inactive product
function unverifyproduct(str){  
  var site_url = window.location.protocol + '://' + window.location.hostname + '/'; 
  // var site_url = 'http://cardbanana.net/demo/farmingflyers/';
  var prod_id = str;
  bootbox.confirm("Are you sure you want to inactivate?", function(result) {
    if(result){
      $.ajax({
          url: site_url+'admin/unverifyproduct/'+prod_id,
          method:'POST',
          data:{
              type:"unverifyprod"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){          
            productlist();
            Notify('Success', obj.msg, 'success');
          }else{
            Notify('Error', 'Invalid Request.', 'error');
          }                 
      }); 
      // return false;
    }
  });   
}