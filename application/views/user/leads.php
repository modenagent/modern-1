<!-- Recent LP's section -->
<section class="impression">

  <div class="container leads-container">
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success! </strong>
        <?php echo $this->session->flashdata('success') ?>
      </div>
    <?php endif;?>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error! </strong>
        <?php echo $this->session->flashdata('error') ?>
      </div>
    <?php endif;?>
    <h1 class="main_title mb-4">Leads</h1>
	<p class="subline">Below you can find your marketing code along with your leads and downloadable QR coded.</p>
     
        <div class="row barcode-wrapper">
          <div class="col-md-6 qr-wrapper border-none ">
            <div class="qr-text">
              <p>
                Use this QR code to direct your prospects to your Market Update landing page.
              </p>
			   <?php if ($ref_code): ?>
      <p class="leads">Your unique referral code: <span id="ref-code">
          <?php echo $ref_code; ?>
        </span></p>
		<p class=""><span class="link-span" >www.modernagent.io/mkt/<?php echo $ref_code; ?></span></p>
            </div>
            <div class="qr-code-container">
<?php
$url = urlencode(base_url("cma/" . $ref_code));
list($r, $g, $b) = sscanf("#ff523d", "#%02x%02x%02x");
$rgb_color_front = urlencode(json_encode(array($r, $g, $b)));
// echo "Hellooooooooo";
// print_r($rgb_color_front);die;
$rgb_color_back = urlencode(json_encode(array(255, 255, 255)));
$image = base_url("user/generate_qr_code/0/5/$rgb_color_back/$rgb_color_front?url=" . $url);
?>
                  <img src="<?php echo $image; ?>">

              </div>
          </div>
          <div class="col-md-6 qr-wrapper ">
            <div class="qr-text">
              <p>
                Use this QR code to direct your prospects to your CMA landing page.
              </p>
			   <?php if ($ref_code): ?>
      <p class="leads">Your unique referral code: <span id="ref-code">
          <?php echo $ref_code; ?>
        </span></p>
		<p class=""><span class="link-span" >www.modernagent.io/cma/<?php echo $ref_code; ?></span></p>
            </div>
            <div class="qr-code-container">
<?php
$url = urlencode(base_url("cma/" . $ref_code));
list($r, $g, $b) = sscanf("#ff523d", "#%02x%02x%02x");
$rgb_color_front = urlencode(json_encode(array($r, $g, $b)));
// echo "Hellooooooooo";
// print_r($rgb_color_front);die;
$rgb_color_back = urlencode(json_encode(array(255, 255, 255)));
$image = base_url("user/generate_qr_code/0/5/$rgb_color_back/$rgb_color_front?url=" . $url);
?>
                  <img src="<?php echo $image; ?>">

              </div>
          </div>
        </div>
    <?php else: ?>
      <p>This feature is not available to you.
      <?php endif;?>

    <div class="table-responsive">
      <table class="table table-hover responsive nowrap" style="width:100%" id="leads-table-dt">
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
    $(document).ready(function () {
      if ($('#leads-table-dt').length) {
        $('#leads-table-dt').DataTable({
          "dom": '<"table_filter"fl>rt<"table_navigation"ip>',
          aaSorting: [],
          responsive: true,
          'columnDefs': [{
            'targets': [4, 4], // column index (start from 0)
            'orderable': false, // set orderable false for selected columns
          }],
          // Processing indicator
          "processing": true,
          // DataTables server-side processing mode
          "serverSide": true,
          // Initial no order.

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
          "drawCallback": function (settings) {
            $("[data-toggle='tooltip']").tooltip({ placement: 'left' });
          }
        });
      }
    });
  </script>
</section>
<!-- Screenshots section -->