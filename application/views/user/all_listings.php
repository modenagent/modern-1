 <section id="" class="impression">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
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
            <h1 class="main_title mb-4">Recently Created Presentations</h1>
            <p class="text-center">We have stored all of your recently created reports so you can access them at anytime. From here you can download, print, and email them.</p>
            
            <table id="user_transaction_table" class="table table-hover responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>OWNER</th>
                        <th>PROPERTY ADDRESS</th>
                        <th>REPORT TYPE</th>
                        <th class="no-sort">ACTIONS</th>
                    </tr>
                </thead>
            </table>
            
            <?php //$this->load->view('user/listing_table',array('reports'=>$reports)); ?>
          </div>
      </div>
        
    </div>

<!-- Screenshots section -->
<script type="text/javascript">
$(document).ready(function(){
  if ($('#user_transaction_table').length) {
    $('#user_transaction_table').DataTable({
        "dom": '<"table_filter"fl>rt<"table_navigation"ip>',
        aaSorting: [],
        responsive: true,
        'columnDefs': [ {
            'targets': [4,4], // column index (start from 0)
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
            "url": "<?php echo base_url('/user/getReportsListing'); ?>",
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