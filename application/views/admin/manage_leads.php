<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="active"><?php echo $title ?></li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  
  <div class="panel-heading">
    <h4 class="panel-title">
      <?php echo $title ?>
    </h4>
  </div>
  
  <div class="panel-body">
<!--  <button id="btnExExcel" class="btn btn-info">Export Excel</button>-->
    <!-- user list shows here -->
    <div class="table-head table-responsive" id="leads_table">
      <table class="table table-hover" id="leads-list-table">
        <thead>
          <tr>          
            <th class="no-sort">Sr. no.</th>
            <th>Phone Number</th>  
            <th>User Name</th> 
            <th>Created Date</th>   
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    
  if ($('#leads-list-table').length) {
    $('#leads-list-table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "paging": true,
        "searching": true,
        "order": [
          [3, "DESC"]
        ],
        // Load data from an Ajax source
        "ajax": {
            "url": '<?php echo site_url('admin/leadsview_list'); ?>',
            "type": "POST",
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
        }]
    });
  }
});
</script>