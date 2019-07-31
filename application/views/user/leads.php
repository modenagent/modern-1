 


<!-- Recent LP's section -->
<section id="recent-lp2">
     
  <div class="container">
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a> 
        <strong>Success! </strong>
        <?php echo $this->session->flashdata('success') ?>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a> 
        <strong>Error! </strong>
    <?php echo $this->session->flashdata('error') ?>
</div>
<?php endif; ?>
    <h1 class="page-header">Leads</h1>
    <?php if($ref_code): ?>
    <p class="subhead">Your unique referral code: <span style="font-size:15px; font-weight:bold;" id="ref-code"><?php echo $ref_code; ?></span></p><br>
	 <p class="subhead">Put this link on your marketing material:  <span style="font-size:15px; font-weight:bold;">www.modernagent.io/cma</span></p>
    <?php else: ?>
    <p>This feature is not available to you.
    <?php endif; ?>
    <p>&nbsp;</p>
    <div class="table-responsive">
      <table class="actions" id="leads-table-dt">
        <thead>
          <tr>
            <th>DATE</th>
            <th>PHONE NUMBER</th>
            <th>OWNER</th>
            <th>PROPERTY ADDRESS</th>
            <th>REPORT TYPE</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <script type="text/javascript">
$(document).ready(function(){
  if ($('#leads-table-dt').length) {
    $('#leads-table-dt').DataTable({
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
            "url": "<?php echo base_url('/user/getLeadListing'); ?>",
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
          $("[data-toggle='tooltip']").tooltip({placement:'left'});
        }
    });
  }
});
</script>
</section>
<!-- Screenshots section -->