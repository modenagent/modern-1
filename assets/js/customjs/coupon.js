// product list
couponlist();
// product list function
function couponlist(){
  var site_url = window.location.protocol + '://' + window.location.hostname + '/';
  // var site_url = 'http://cardbanana.net/demo/farmingflyers/';
  $.ajax({
        url: site_url+'admin/couponlist_view',
        method:'POST',
        data:{
            type:"couponlist"
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
          var coupon_list = obj.couponlist_table;
          $("#coupon_table").html(coupon_list);  
          $(".table").dataTable();
		  $("[data-toggle='tooltip']").tooltip();
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }                 
    }); 
    return false; 
}
// delete prod
function delete_coupon(str){ 
  var site_url = window.location.protocol + '://' + window.location.hostname + '/'; 
  // var site_url = 'http://cardbanana.net/demo/farmingflyers/';
  var coupon_id = str;
  bootbox.confirm("Are you sure you want to delete?", function(result) {
    if(result){
      $.ajax({
          url: site_url+'/admin/delete_coupon/'+coupon_id,
          method:'POST',
          data:{
              type:"deletecoupon"
          }
      }).success(function(resp){
          var obj = JSON.parse(resp);
          if(obj.status == "success"){          
            couponlist();
            Notify('Success', obj.msg, 'success');
          }else if(obj.status == "coupon_start_error"){
            Notify('Error', obj.msg, 'error');
          }else if(obj.status == "coupon_error"){
            Notify('Error', obj.msg, 'error');
          } else {
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