
<!-- BillingHistory section -->
<div id="billing">
  <div class="container">
  	<h1 class="page-header">Billing History</h1>
    <p class="subhead">We have gathered all of your invoices here for your convenience. You can print and download anytime.</p>
    <p>&nbsp;</p>
      <div class="table-responsive">
      <table  class="actions" id="table-dt">
        <thead>
          <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Property Address</th>
            <th>Property-apn</th>
            <th>Print</th>
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
            foreach ($billings as $key => $bill) { ?>
			 <tr>
              <td data-order="<?php echo date("YmdHis",strtotime($bill->invoice_date)); ?>"><?php echo _date("m-d-Y H:i:s",strtotime($bill->invoice_date)); ?></td>
              <td>$ <?php echo number_format($bill->invoice_amount, 2); ?></td>
              <td><?php echo $bill->property_address.', CA 90601'; ?></td>
              <td><?php echo $bill->property_apn; ?></td>
              <td> 
		  		<a href=" <?php echo base_url().$bill->invoice_pdf; ?>" class="btn btn-lp receipt" target="_blank">Print Receipt</a>
              </td>
            </tr>	
         <?php }
          ?>
        </tbody>
      </table>
      
    </div>
  </div>
</div>
<!-- Pricing section --> 
