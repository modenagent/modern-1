<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a> </li>
    <li class="active">Order History</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Order History</h4>
  </div>
  <div class="panel-body">
    <div class="table-responsive" id="user_order_history">
      <label>Name: <?php echo $userDetails['first_name'] . ' ' . $userDetails['last_name']; ?></label>
      <table class="table table-hover" id="user-order-history-table">
        <thead>
          <tr>          
            <th class="no-sort">Sr. No.</th> 
            <th>Order date</th>  
            <th>Order Name</th> 
            <th>Order Description</th>   
            <th>Order Amount</th>
            <th>Order Status</th>
            <th class="no-sort">Action</th>
          </tr>
        </thead>
      </table>
    </div>    
  </div>
</div>
<script>
// order history list function
$(document).ready(function(){

  if ($('#user-order-history-table').length) {
    $('#user-order-history-table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "paging": true,
        "searching": true,
        "order": [
          [1, "DESC"]
        ],
        // Load data from an Ajax source
        "ajax": {
            "url": '<?php echo site_url('admin/user_order_history_list_view'); ?>',
            "type": "POST",
            "data": {
              "user_id": '<?php echo $userId; ?>'
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
});
</script>