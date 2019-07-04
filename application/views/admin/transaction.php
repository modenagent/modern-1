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
    <div class="bs-example bs-example-tabs">
      
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
          <div class="table-head table-responsive" id="transactionlist">
            <table id="all_transaction_table">
              <thead>
                  <tr style="color: black;">
                      <th>Invoice Date</th>
                      <th>Invoice No.</th>
                      <th>Type</th>
                      <th class="no-sort">Property Address</th>
                      <th>Invoice To</th> 
                      <th>Sales Rep</th>                                
                      <th class="no-sort">Action</th>
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
</script>