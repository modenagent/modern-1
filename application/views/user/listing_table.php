<div class="table-responsive">
  <table class="actions" id="table-dt">
    <thead>
      <tr>
        <th>DATE</th>
        <th>OWNER</th>
        <th>PROPERTY ADDRESS</th>
        <th>Report Type</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        // first line of PHP
        $defaultTimeZone='UTC';

        // somewhere in the code
        function _date($format="r", $timestamp=false, $timezone=false){
            $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
            $gmtTimezone = new DateTimeZone('GMT');
            $myDateTime = new DateTime(($timestamp!=false?date("r",(int)$timestamp):date("r")), $gmtTimezone);
            $offset = $userTimezone->getOffset($myDateTime);
            return date($format, ($timestamp!=false?(int)$timestamp:$myDateTime->format('U')) + $offset);
        }
        foreach ($reports as $key => $report) {
      ?>

        <tr class="<?php echo $this->input->get('id')?($this->input->get('id')==$report->project_id_pk?'active':''):''; ?>">
          <td data-order="<?php echo _date("Ymd",strtotime($report->project_date)); ?>"><?php echo _date("m-d-Y",strtotime($report->project_date)); ?></td>
          <td><?php echo $report->project_id_pk."-".$report->property_owner; ?></td>
          <td><?php echo $report->project_name; ?></td>
          <td><?php echo ucfirst($report->report_type); ?></td>
          <td> 
            <a href="<?php echo base_url().$report->report_path; ?>" download target="_blank"><i data-toggle="tooltip" title="Download" class="icon icon-download"></i></a>
            <a href="javascript:void(0);" target="_blank" data-toggle="modal" data-target="#forward-report" title="Forward" data-id="<?php echo $report->project_id_pk; ?>"><i data-toggle="tooltip" title="Email" class="icon icon-share"  ></i></a>
		        <a href="javascript:void(0);" onclick="delete_lp('<?php echo $report->project_id_pk; ?>', '1')"><i data-toggle="tooltip" title="Delete" class="icon icon-remove-circle"></i></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>