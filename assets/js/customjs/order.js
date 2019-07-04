// order list
orderlist();
// order list function
function orderlist(){
  var site_url = window.location.protocol + '://' + window.location.hostname + '/';
  // var site_url = 'http://cardbanana.net/demo/farmingflyers/';
  $.ajax({
        url: site_url+'admin/orderlist_view',
        method:'POST',
        data:{
            type:"orderlist"
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
          var order_list = obj.orderlist_table;
          $("#order_table").html(order_list);  
          $(".table").dataTable();
          $("[data-toggle='tooltip']").tooltip();
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }                 
    }); 
    return false; 
}