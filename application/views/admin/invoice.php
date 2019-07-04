<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li><a href="<?php echo base_url(); ?>index.php?/admin/transaction">Transaction</a></li>
    <li class="active">Invoice</li>
  </ul>
</div>
<div class="clearfix"></div>
  
  <div id="invoice-page" class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-body">
                            <?php
                            foreach ($user_invoices as $value) {
                                // echo "<pre>";
                                // print_r($value);
                                $invNo = $value->invoice_num;
                                $invDate = date("F j, Y", strtotime($value->invoice_date));
                                $ShippingAdd = $value->address;
                                if($ShippingAdd != " "){
                                    $showAdd = $ShippingAdd;
                                }else{
                                    $showAdd = "No Address";
                                }
                                $invAmt = $value->invoice_amount;
                            }
                            ?>
                                <div class="invoice-title pull-right"><h2>Invoice</h2>

                                    <p class="mbn text-left">Invoice# <?php echo $invNo; ?></p>

                                    <p class="text-left"><?php echo $invDate; ?></p></div>
                                
                                <div class="clearfix"></div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <address>
                                        <strong>Billed To:</strong><br/>

                                        <?php echo $showAdd; ?>

                                        </address>
                                    </div>
                                    <div class="col-md-3">
                                        <address>
                                        <strong>Shipped To:</strong><br/>
                                        <?php echo $showAdd; ?>
                                        </address>
                                    </div>
                                    <div class="col-md-3">
                                        <address><strong>Date:</strong><br/><?php echo $invDate; ?></address>
                                    </div>
                                    <div class="col-md-3">
                                        <address><strong>Balance:</strong><br/>

                                            <h2 class="text-green"><strong>$ <?php echo $invAmt; ?></strong></h2></address>
                                    </div>
                                </div>
                                <hr/>
                                
                                <hr class="mbm"/>
                                <p>Thank you for your business. Please remit the total amount due within 30 days.</p></div>
                        </div>
                    </div>
                    
                </div>
            
</div>
</div>
</div>