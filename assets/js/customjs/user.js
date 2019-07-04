// User list 
<<<<<<< HEAD
function userlist(role_id){       
    $.ajax({
        url:site_url('admin/userlist_view'),
        method:'POST',
        data:{
            type:"userlist",
            role_id: role_id
        }
    }).success(function(resp){
        var obj = JSON.parse(resp);
        if(obj.status == "success"){
          var users_list = obj.userlist_table;
          $("#user_table").html(users_list);  
          $("#user-table").dataTable({
            // paging:   false,
            // "iDisplayLength": 10,
            // "aLengthMenu":false,
            // 'bLengthChange': false,
            // "bFilter": false,
            "order": [[ 3, "desc" ]],
            "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4 ] } ]
          });
          $("[data-toggle='tooltip']").tooltip();
        }else{
          Notify('Error', 'Invalid Request.', 'error');
        }                 
    }); 
    return false;   
=======
var user_table_datatable = '';
function userlist(role_id){     
  
  if ($('#user-table').length) {
    user_table_datatable = $('#user-table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "paging": true,
        "searching": true,
        "order": [
          [0, "DESC"]
        ],
        // Load data from an Ajax source
        "ajax": {
            "url": site_url('admin/userlist_view'),
            "type": "POST",
            "data": {
              type:"userlist",
              role_id: role_id
            }
        },
        "initComplete": function () {
            var input = $('.dataTables_filter input').unbind(),
                self = this.api(),
                $searchButton = $('<button class="btn btn-primary admin-ml-5 admin-mt-5">')
                .text('Search')
                .click(function () {
                    self.search(input.val()).draw();
                }),
                $clearButton = $('<button class="btn btn-default admin-ml-5 admin-mt-5">')
                .text('Clear')
                .click(function () {
                    input.val('');
                    $searchButton.click();
                })
            $('.dataTables_filter').append($searchButton, $clearButton);
        },
        "language": {
            "processing": "<div class='text-center'><i class='fa fa-spinner fa-spin admin-fa-spin ma-font-24'></i></div>",
            "emptyTable": "<div align='center'>Record(s) not found.</div>"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "orderable": false,
            "targets": "no-sort"
        }],
        "drawCallback": function( settings ) {
          $("[data-toggle='tooltip']").tooltip();
        }
    });
  }
>>>>>>> master
}