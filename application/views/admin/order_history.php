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
    <!-- Search/Filter Bar -->
    <div class="admin-table-search">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="order-history-search" class="sr-only">Search order history</label>
                    <input type="text" id="order-history-search" class="form-control" placeholder="Search by name or status..." aria-label="Search order history">
                </div>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" onclick="searchOrderHistory()">
                    <i class="fa fa-search" aria-hidden="true"></i> Search
                </button>
                <button type="button" class="btn btn-default" onclick="clearOrderHistorySearch()">
                    <i class="fa fa-times" aria-hidden="true"></i> Clear
                </button>
            </div>
        </div>
    </div>
    
    <div class="table-responsive admin-table-container" id="order_history">
      <table class="table table-hover admin-table" id="order-history-count-table" role="table" aria-label="Order history table">
        <thead>
          <tr role="row">          
            <th class="no-sort" role="columnheader">
                <span class="sr-only">Serial number column</span>
                Sr. No.
            </th> 
            <th tabindex="0" role="columnheader" aria-sort="none">Name</th>  
            <th tabindex="0" role="columnheader" aria-sort="none">Status</th> 
            <th tabindex="0" role="columnheader" aria-sort="none">Total Orders</th>   
            <th class="no-sort" role="columnheader">
                <span class="sr-only">Actions for each order</span>
                Action
            </th>
          </tr>
        </thead>
      </table>
    </div>    
  </div>
</div>
<script>
// order history list function
$(document).ready(function(){

  if ($('#order-history-count-table').length) {
    $('#order-history-count-table').DataTable({
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
            "url": '<?php echo site_url('admin/orderhistorylist_view'); ?>',
            "type": "POST",
            "data": {
              type: 'orderhistory'
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

// Search functionality for order history
function searchOrderHistory() {
    var searchTerm = document.getElementById('order-history-search').value;
    if ($('#order-history-count-table').DataTable()) {
        $('#order-history-count-table').DataTable().search(searchTerm).draw();
    }
}

function clearOrderHistorySearch() {
    document.getElementById('order-history-search').value = '';
    if ($('#order-history-count-table').DataTable()) {
        $('#order-history-count-table').DataTable().search('').draw();
    }
}

// Allow Enter key to trigger search
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('order-history-search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchOrderHistory();
            }
        });
    }
});
</script>