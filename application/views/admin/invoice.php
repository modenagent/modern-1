<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
    <li><a href="<?php echo base_url(); ?>index.php?/admin/transaction">Transaction</a></li>
    <li class="active">Invoice</li>
  </ul>
</div>
<div class="clearfix"></div>
  
  <div id="invoice-page" class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                            <?php
                            $invNo = $user_invoice['invoice_num'];
                            $invDate = date("F j, Y", strtotime($user_invoice['invoice_date']));
                            $invAmt = $user_invoice['invoice_amount'];
                            ?>
                                <div class="invoice-title pull-right">
                                    <h2>Invoice</h2>
                                    <p class="mbn text-right">Invoice# <?php echo $invNo; ?></p>
                                    <p class="text-right"><?php echo $invDate; ?></p>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="invoice-hr1" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><h3 class="mbn text-center invoice-header">Order & Payment Details</h3></p>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <p>Presentation Address</p>
                                            <p><?php echo $user_invoice['property_address']; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="border-none invoice-table">
                                                <tr class="border-none">
                                                    <td class="text-left"><p>Sub Total</p></td>
                                                    <td class="text-right"><p>$<?php echo number_format($invAmt,2); ?></p></td>
                                                </tr>
                                                <tr class="border-none">
                                                    <td class="text-left"><p>Discount</p></td>
                                                    <td class="text-right"><p>$0.00</p></td>
                                                </tr>
                                                <tr class="border-none">
                                                    <td colspan="2" class="text-center"><hr class="invoice-amount-hr" /></td>
                                                </tr>
                                                <tr class="border-none">
                                                    <td class="text-left"><p>Total</p></td>
                                                    <td class="text-right"><p>$<?php echo number_format($invAmt,2); ?></p></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <hr class="invoice-hr1" />
                                <div class="row" style="display:none;">
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
                                <br/>
                                </div>
                        </div>
                    </div>
                    
                </div>
            
</div>
</div>
</div>