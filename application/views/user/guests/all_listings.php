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
    <h1 class="page-header">My Smart Registries</h1>
    <p class="subhead">Below you will find your active registries.</p>
    <p>&nbsp;</p>
      <div class="table-responsive smart_register">
        <table id="user_transaction_table">
          <thead>
              <tr>
                  <th>DATE</th>
                  <th>PROPERTY ADDRESS</th>
                  <th>URL</th>
                  <th class="no-sort">ACTIONS</th>
              </tr>
          </thead>

        </table>
      </div>


    <h1 class="page-header">My Guests</h1>
    <p class="subhead">Below you will find guests that signed in.</p>
    <p>&nbsp;</p>
      <div class="table-responsive smart_guest">
        <table id="guests_transaction_table">
          <thead>
              <tr>
                  <th>DATE</th>
                  <th>PROPERTY ADDRESS</th>
                  <th>NAME</th>
                  <th>PHONE</th>
                  <th>EMAIL</th>
                  <th class="no-sort">ACTIONS</th>
              </tr>
          </thead>

        </table>
      </div>
    
  </div>
</section>
<!-- Screenshots section -->
<script type="text/javascript">
$(document).ready(function(){
  if ($('#user_transaction_table').length) {
    $('#user_transaction_table').DataTable({
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
            "url": "<?php echo base_url('/user/getGuestsListing'); ?>",
            "type": "POST"
        },
        "initComplete": function () {
            var input = $('.smart_register .dataTables_filter input').unbind(),
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
            $('.smart_register div.dataTables_filter input').addClass('lp-datatable-custom-search');
            $('.smart_register div.dataTables_length select').addClass('lp-datatable-custom-page-length');
            $('.smart_register .dataTables_filter').append($searchButton, $clearButton);
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

  if ($('#guests_transaction_table').length) {
    $('#guests_transaction_table').DataTable({
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
            "url": "<?php echo base_url('/user/getGuestsListing/1'); ?>",
            "type": "POST"
        },
        "initComplete": function () {
            var input = $('.smart_guest .dataTables_filter input').unbind(),
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
            $('.smart_guest div.dataTables_filter input').addClass('lp-datatable-custom-search');
            $('.smart_guest div.dataTables_length select').addClass('lp-datatable-custom-page-length');
            $('.smart_guest .dataTables_filter').append($searchButton, $clearButton);
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