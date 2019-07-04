 


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
      <table class="actions" id="table-dt">
        <thead>
          <tr>
            <th>DATE</th>
            <th>Phone Number</th>
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
            function _date($format="r", $timestamp=false, $timezone=false)
            {
                $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
                $gmtTimezone = new DateTimeZone('GMT');
                $myDateTime = new DateTime(($timestamp!=false?date("r",(int)$timestamp):date("r")), $gmtTimezone);
                $offset = $userTimezone->getOffset($myDateTime);
                return date($format, ($timestamp!=false?(int)$timestamp:$myDateTime->format('U')) + $offset);
            }
            function _formatPhone($_phoneNumber)
            {//formats phone number like 1234567890 to 123-456-7890
                if(strlen((string)$_phoneNumber)>6){
                    $_phoneNumber = substr_replace(substr_replace($_phoneNumber, "-", 3, 0), "-", 7, 0);
                }
                return $_phoneNumber;
            }
            foreach ($leads as $key => $lead) {
          ?>

            <tr class="">
            <td data-order="<?php echo _date("Ymd",strtotime($lead->project_date)); ?>"><?php echo _date("m-d-Y",strtotime($lead->created_at)); ?></td>
            <td><?php echo _formatPhone($lead->phone_number); ?></td>
            <td><?php echo $lead->project_id_pk."-".$lead->property_owner; ?></td>
              <td><?php echo $lead->project_name; ?></td>
              <td><?php echo ucfirst($lead->report_type); ?></td>
              <td> 
                  <a href="<?php echo base_url().$lead->report_path; ?>" download target="_blank"><i data-toggle="tooltip" title="Download" class="icon icon-download"></i></a>
              </td>
            </tr>

          <?php
            }
          ?>
        </tbody>

      </table>
    </div>
  </div>
</section>
<!-- Screenshots section -->