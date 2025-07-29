<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a> </li>
    <li class="active">Manage Orders</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Manage Orders</h4>
  </div>
  <div class="panel-body" >
    <!-- Search/Filter Bar -->
    <div class="admin-table-search">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="orders-search" class="sr-only">Search orders</label>
                    <input type="text" id="orders-search" class="form-control" placeholder="Search orders by customer, order ID, or status..." aria-label="Search orders">
                </div>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" onclick="searchOrders()">
                    <i class="fa fa-search" aria-hidden="true"></i> Search
                </button>
                <button type="button" class="btn btn-default" onclick="clearOrdersSearch()">
                    <i class="fa fa-times" aria-hidden="true"></i> Clear
                </button>
            </div>
        </div>
    </div>
    
    <!-- Orders table view -->
    <div class="table-head table-responsive admin-table-container" id="order_table">
      <table class="table admin-table table-striped table-hover" id="orders-table" role="table" aria-label="Orders management table">
        <thead>
          <tr role="row">
            <th tabindex="0" role="columnheader" aria-sort="none">Order ID</th>
            <th tabindex="0" role="columnheader" aria-sort="none">Customer</th>
            <th tabindex="0" role="columnheader" aria-sort="none">Date</th>
            <th tabindex="0" role="columnheader" aria-sort="none">Status</th>
            <th tabindex="0" role="columnheader" aria-sort="none">Total</th>
            <th class="no-sort" role="columnheader">
              <span class="sr-only">Actions for each order</span>
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <!-- Orders will be loaded here via AJAX or server-side rendering -->
          <tr>
            <td colspan="6" class="text-center">
              <div class="alert alert-info" role="alert">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                No orders data available. This table is ready for server-side implementation.
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

<script>
// Search functionality for orders
function searchOrders() {
    var searchTerm = document.getElementById('orders-search').value;
    if (window.AdminTables && $('#orders-table').DataTable()) {
        $('#orders-table').DataTable().search(searchTerm).draw();
    }
}

function clearOrdersSearch() {
    document.getElementById('orders-search').value = '';
    if (window.AdminTables && $('#orders-table').DataTable()) {
        $('#orders-table').DataTable().search('').draw();
    }
}

// Allow Enter key to trigger search
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('orders-search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchOrders();
            }
        });
    }
});

// Placeholder for future server-side AJAX implementation
// TODO: Implement AJAX endpoint for order data
// Example endpoint: site_url('admin/orders_ajax')
// This would replace the static table with dynamic server-side processing
</script>
</div>
</div>
</div>
</div>