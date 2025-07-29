<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?=base_url()?>index.php/admin/dashboard">Dashboard</a></li>
    <li class="active">Transaction</li>
  </ul>
</div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">
    Transaction
    </h4>
  </div>
  
  <div class="panel-body">
    <!-- Search/Filter Bar -->
    <div class="admin-table-search">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="transaction-search" class="sr-only">Search transactions</label>
                    <input type="text" id="transaction-search" class="form-control" placeholder="Search by invoice, type, or address..." aria-label="Search transactions">
                </div>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" onclick="searchTransactions()">
                    <i class="fa fa-search" aria-hidden="true"></i> Search
                </button>
                <button type="button" class="btn btn-default" onclick="clearTransactionSearch()">
                    <i class="fa fa-times" aria-hidden="true"></i> Clear
                </button>
            </div>
        </div>
    </div>
    
    <div class="bs-example bs-example-tabs">
      
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
          <div class="table-head table-responsive admin-table-container" id="transactionlist">
            <table class="admin-table" id="all_transaction_table" role="table" aria-label="Transactions table">
              <thead>
                  <tr style="color: black;" role="row">
                      <th tabindex="0" role="columnheader" aria-sort="none">Invoice Date</th>
                      <th tabindex="0" role="columnheader" aria-sort="none">Invoice No.</th>
                      <th tabindex="0" role="columnheader" aria-sort="none">Type</th>
                      <th class="no-sort" role="columnheader">Property Address</th>
                      <th tabindex="0" role="columnheader" aria-sort="none">Invoice To</th> 
                      <th tabindex="0" role="columnheader" aria-sort="none">Sales Rep</th>                                
                      <th class="no-sort" role="columnheader">
                          <span class="sr-only">Actions for each transaction</span>
                          Action
                      </th>
                  </tr>
              </thead>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  if ($('#all_transaction_table').length) {
    $('#all_transaction_table').DataTable({
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
            "url": "<?php echo base_url('/admin/transactionlist'); ?>",
            "type": "POST"
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

// Search functionality for transactions
function searchTransactions() {
    var searchTerm = document.getElementById('transaction-search').value;
    if ($('#all_transaction_table').DataTable()) {
        $('#all_transaction_table').DataTable().search(searchTerm).draw();
    }
}

function clearTransactionSearch() {
    document.getElementById('transaction-search').value = '';
    if ($('#all_transaction_table').DataTable()) {
        $('#all_transaction_table').DataTable().search('').draw();
    }
}

// Allow Enter key to trigger search
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('transaction-search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchTransactions();
            }
        });
    }
});
</script>