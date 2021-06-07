<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<style type="text/css">
  #user_transaction_table_filter, #guests_transaction_table_filter {
    display: none
  }
  .leads_tbl {
    margin-top: 75px; 
  }
  div.dt-buttons {
    float: right;
    margin-bottom: 10px;
  }
  .dt-buttons button.dt-button {
    background: #fff;
    padding: 0.5em 1.5em;
    font-size: 1em;
  }
  .dt-buttons button.dt-button:hover {
    color: #fff;
    border-color: #fff;

}
  }
</style>
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

      <div class="leads_tbl">
        <h1 class="page-header">Registration Leads</h1>
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
    
  </div>
</section>
<!-- Screenshots section -->
<?php
$this->load->view('user/footer');
?>
<script src="
https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

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
        "dom": 'Blfrtip',
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
        },
        "buttons": [
             {
                 extend: 'csv',
                 exportOptions: {
                    columns: [0,1,2,3,4]
                },
                title: function () { return 'Registration Leads'; },
                
             } ,
            {
               extend: 'pdf',
               exportOptions: {
                    columns: [0,1,2,3,4]
                },
                title: function () { return 'Registration Leads'; },
           }
        ]
    });
  }
});
$(document).on('click','.copy_url',function(){
  var copy_text = $(this).attr('data-url');
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(copy_text).select();
  document.execCommand("copy");
  $temp.remove();
  console.log($(this).find('i').attr('class'));
  $(this).find('i').attr('title',copy_text);
  $(this).find('i')
          .attr('title', 'Copied!')
          .tooltip('fixTitle')
          .tooltip('show');

});
</script>