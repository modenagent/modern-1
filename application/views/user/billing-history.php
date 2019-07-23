
<!-- BillingHistory section -->
<div id="billing">
  <div class="container">
  	<h1 class="page-header">Billing History</h1>
    <p class="subhead">We have gathered all of your invoices here for your convenience. You can print and download anytime.</p>
    <p>&nbsp;</p>
      <div class="table-responsive">
        <table  class="actions" id="billing-table-dt">
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
</div>
<!-- Pricing section --> 
<script type="text/javascript">
$(document).ready(function(){
  if ($('#billing-table-dt').length) {
    $('#billing-table-dt').DataTable({
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
            "url": "<?php echo base_url('/user/getBillingHistory'); ?>",
            "type": "POST"
        },
        "initComplete": function () {
            var input = $('.dataTables_filter input').unbind(),
                self = this.api(),
                $searchButton = $('<button class="btn lp-datatable-custom-btn lp-ml-5 lp-mb-5">')
                .text('Search')
                .click(function () {
                    self.search(input.val()).draw();
                }),
                $clearButton = $('<button class="btn lp-datatable-custom-btn lp-ml-5 lp-mb-5">')
                .text('Clear')
                .click(function () {
                    input.val('');
                    $searchButton.click();
                })
            $('div.dataTables_filter input').addClass('lp-datatable-custom-search');
            $('div.dataTables_length select').addClass('lp-datatable-custom-page-length');
            $('.dataTables_filter').append($searchButton, $clearButton);
        },
        "language": {
            "processing": "<div class='text-center'><i class='fa fa-spinner fa-spin admin-fa-spin ma-font-24'></div>",
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