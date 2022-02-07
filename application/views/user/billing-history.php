
<!-- BillingHistory section -->
<section class="impression">
  <div id="">
  <div class="container">
    <h1 class="main_title mb-4">Billing History</h1>
    <p class="text-center">We have gathered all of your invoices here for your convenience. You can print and download anytime.</p>

      <table  class="actions table table-hover responsive nowrap" style="width:100%" id="billing-table-dt">
        <thead>
          <tr>
            <th>DATE</th>
            <th>AMOUNT</th>
            <th>PROPERTY ADDRESS</th>
            <th>PROPERTY-APN</th>
            <th class="no-sort">PRINT</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    
  </div>
</div>
</section>

<!-- Pricing section --> 
<script type="text/javascript">
$(document).ready(function(){
  if ($('#billing-table-dt').length) {
    $('#billing-table-dt').DataTable({
        "dom": '<"table_filter"fl>rt<"table_navigation"ip>',
        aaSorting: [],
        responsive: true,
        'columnDefs': [ {
            'targets': [4], // column index (start from 0)
            'orderable': false, // set orderable false for selected columns
        }],
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        // "paging": true,
        // "searching": true,
        "order": [
          [0, "DESC"]
        ],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('/user/getBillingHistory'); ?>",
            "type": "POST"
        },
        "initComplete": function () {
            var input = $('.dataTables_filter input').unbind(),
                self = this.api(),
                $searchButton = $('<button class="btn_search">')
                .text('Search')
                .click(function () {
                    self.search(input.val()).draw();
                }),
                $clearButton = $('<button class="btn_clear">')
                .text('Clear')
                .click(function () {
                    input.val('');
                    $searchButton.click();
                })
            // $('div.dataTables_filter input').addClass('lp-datatable-custom-search');
            // $('div.dataTables_length select').addClass('lp-datatable-custom-page-length');
            $('.dataTables_filter').append($searchButton, $clearButton);
        },
        "language": {
            "processing": "<div class='text-center'><i class='fa fa-spinner fa-spin admin-fa-spin ma-font-24'></div>",
            "emptyTable": "<div align='center'>Record(s) not found.</div>"
        },
        //Set column definition initialisation properties
        // "columnDefs": [{ 
        //     "orderable": false,
        //     "targets": "no-sort"
        // }],
        "drawCallback": function( settings ) {
          $("[data-toggle='tooltip']").tooltip();
        }
    });
  }
});
</script>