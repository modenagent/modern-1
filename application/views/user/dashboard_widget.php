<!DOCTYPE html>
<html>
   <head>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
      <!-- <script type="text/javascript" src="<?php // echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script> -->
      <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=getGoogleMapKey()?>"></script>
      <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />
      <!-- Custom Fonts -->
      <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Bootstrap Core CSS -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flexslider.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/carousel.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/carousel.theme.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prettyphoto.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/smart_wizard_widget.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/smart_tab_vertical_widget.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
      <!-- Custom CSS -->
      <link href="<?php echo base_url(); ?>assets/css/lp-style-widget.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/multi-select.css"); ?>">
      <link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />

      <style type="text/css">
        #cma-widget-container .invoice .invoice-table tbody td {
           text-align: center !important; 
        }
        #cma-widget-container .invoice .invoice-table tbody tr td:last-child {
          text-align: left !important;
        }
      </style>
   </head>
   <body>
      <div id="cma-widget-container" style="margin: 0 auto;max-width: 95%;">
      <div id="loadingPlugin" style="color: #fff;">
         <div class="loading"></div>
         <div class="loadingText">Loading Widget</div>
      </div>
      <!-- widget contents in the tab format -->
      <div class="container" id="widgetContent" style="display: none;">
    <ul class="nav nav-tabs" id="mainTabMenu">
        <li class="active"><a data-toggle="tab" href="#stepsBox" id="createReportTab">Create Report</a></li>
        <li><a data-toggle="tab" href="#reports" id="recentReportsTab">Recent Reports</a></li>
    </ul>
    <div class="tab-content">
        <div id="stepsBox" class="tab-pane fade in active">
            <!--Features section -->
            <section id="steps">
                <!-- Smart Wizard -->
                <div class="">                         
                    <div id="choose-presentation"class="clearfix" style="">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="step-0-content clearfix">
                                    <h2>Create Your Presentation</h2>
                                    <div class="buttonholder">
                                        <span class="input-group-btn">
                                            <button class="btn btn-lp" type="button" id="buyerPresentationButton" style="" onclick="choose_presentation('buyer');"> Buyers Presentation </button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button class="btn btn-lp" id="sellerPresentationButton" type="button" style="" onclick="choose_presentation('seller');"> Sellers Presentation </button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button class="btn btn-lp" type="button" id="marketUpdatePresentationButton" style="" onclick="choose_presentation('marketUpdate');"> Market Update </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                    <div id="wizard" class="swMain loader-back" style="display:none;">
                        <ul>
                            <li id="step-1-link">
                                <a href="#step-1"> 
                                    <span class="stepNumber">01</span> 
                                    <span class="stepDesc"> Step 1<br /><small class="little">Find Your Property</small></span> 
                                </a>
                            </li>
                            <li id="step-2-link">
                                <a href="#step-2"> 
                                    <span class="stepNumber">02</span> 
                                    <span class="stepDesc"> Step 2<br /><small class="little">Enter Your Information</small></span>
                                </a>
                            </li>
                            <li id="step-3-link">
                                <a href="#step-3"> 
                                    <span class="stepNumber">03</span> 
                                    <span class="stepDesc marketUpdateHide"> Step 3<br /><small class="little">Review Pages</small></span>
                                    <span class="stepDesc marketUpdateShow"> Step 3<br /><small class="little">Branding</small></span>
                                </a>
                            </li>
                            <li id="step-4-link">
                                <a href="#step-4"> 
                                    <span class="stepNumber">04</span> 
                                    <span class="stepDesc marketUpdateHide"> Step 4<br /><small class="little">Download</small></span>
                                </a>
                            </li>
                        </ul>
                        <div id="step-1" class="clearfix">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p>&nbsp;</p>
                                    <div class="step-1-content clearfix">
                                        <h2>Enter Address to Start</h2>
                                        <p>Search By Property Address or APN</p>

                                        <form accept-charset="UTF-8" action="" class="huge-search" method="get">
                                            <div class="form-group">
                                                <input name="utf8" type="hidden" value="✓">
                                                <div class="input-group">
                                                    <input class="form-control" name="term" id="searchbox" placeholder="e.g. ‘123 Success Ave’" type="search">
                                                    <input type="text" id="searchboxcity" class="citynames" placeholder="Choose City">
                                                    <input type="hidden" id="neighbourhood">
                                                    <input type="hidden" id="state">

                                                    <span class="input-group-btn">
                                                        <button class="btn btn-lp" type="button" id="search-btn"> Search </button>
                                                    </span> 
                                                </div>
                                            </div>
                                            <div class="pma-error alert alert-danger payment-errors" style="display:none"></div>
                                            <div class="search-result hidden">
                                                <div class="search-loader"></div>
                                                <table class="table-responsive hidden">
                                                    <thead>
                                                        <tr>
                                                            <th width="15%">APN</th>
                                                            <th width="15%">Unit #</th>
                                                            <th width="25%">Address</th>
                                                            <th width="20%">Owner Name</th>
                                                            <th width="10%">City</th>
                                                            <th width="15%">Run Listing</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12" >
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <!-- step 1 ends -->
                        <div id="step-2" class="clearfix">
                            <form id="run-pma-form" >
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-6 col-md-6">
                                          <!-- <h2><strong>Agent:</strong> Upload Pic &amp; Enter Info</h2> -->
                                          <div class="row">
                                            <div class="col-md-3">
                                              <div class="leftpic"> <a href="javascript:;">
                                                <?php
                                                if(empty($user['profile_image'])){
                                                ?>
                                                <i class="icon-camera"></i>
                                                <br>
                                                Upload Picture
                                                <?php
                                                }
                                                else{
                                                ?>
                                                <img  src="<?php echo base_url().$user['profile_image']; ?>" width="100%" >
                                                <?php
                                                }
                                                ?>
                                              </a>
                                              <input type="file"  class="file-type hidden" >
                                              <input type="text" id="fileimage" class="hidden file-path" name="user[profile_image]" value="<?php echo $user['profile_image']; ?>" >
                                            </div>
                                          </div>
                                          <div class="col-md-9">
                                            <input type="hidden" class="form-control"   name="user_image"      id="user_image" value=""    />
                                            <input type="text" class="form-control"   name="user[fullname]"   id="" placeholder="Name"    value="<?php echo $user['first_name'].' '.$user['last_name']; ?>" />
                                            <input type="text" class="form-control"   name="user[title]"      id="" placeholder="Title"   value="<?php echo $user['title']; ?>"/>
                                            <input type="text" class="form-control"   name="user[phone]"      id="" placeholder="Phone"   value="<?php echo $user['phone']; ?>"/>
                                            <input type="text" class="form-control"   name="user[email]"      id="" placeholder="Email"   value="<?php echo $user['email']; ?>"/>
                                            <input type="text" class="form-control"   name="user[licenceno]"  id="" placeholder="CA BRE#" value="<?php echo $user['license_no']; ?>"/>
                                            <input type="hidden" class="form-control"   name="presentation"  id="presentation" value=""/>
                                          </div>
                                        </div>
                                      </div>
                                    <div class="col-xs-12 col-lg-6 col-md-6">
                                      <!-- <h2><strong>Company:</strong> Upload Logo &amp; Enter Info</h2> -->
                                      <div class="row">
                                        <div class="col-md-3">
                                          <div class="rightpic"> <a href="javascript:void(0);">
                                            <?php
                                            if(empty($company['company_logo'])){
                                            ?>
                                            <i class="icon-camera"></i>
                                            <br>
                                            Upload Picture
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <img src="<?php echo base_url().$company['company_logo']; ?>" width="100%" >
                                            <?php
                                            }
                                            ?>
                                          </a>
                                          <input type="file" class="file-type hidden">
                                          <input type="text" class="hidden file-path" name="user[company_logo]" value="<?php echo $company['company_logo']; ?>" >
                                        </div>
                                      </div>
                                      <div class="col-md-9">
                                        <input type="hidden" class="form-control"   name="company_image"      id="company_image" value=""    />
                                        <input type="text" class="form-control"   name="user[companyname]"  id="" placeholder="Company Name"    value="<?php echo $company['company_name'] ?>"/>
                                        <input type="text" class="form-control"   name="user[street]"       id="" placeholder="Street Address"  value="<?php echo $company['company_add'] ?>"/>
                                        <input type="text" class="form-control"   name="user[city]"         id="" placeholder="City"            value="<?php echo $company['company_city'] ?>"/>
                                        <input type="text" class="form-control"   name="user[zip]"          id="" placeholder="ZIP"             value="<?php echo $company['comapny_zip'] ?>"/>
                                        <input type="text" class="form-control"   name="user[state]"        id="" placeholder="State"           value="<?php echo $company['company_state'] ?>"/>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix">
                                <p></p>
                                </div>
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                  <div class="row">
                                    <div class="col-xs-6 col-md-offset-3 col-sm-6 col-md-6 col-lg-6">
                                    </div>
                                  </div>
                                </div>
                                </div>
                                <div class="clearfix">
                                <p></p>
                                </div>
                                </div>
                            </form>
                        </div>
                        <!-- step 2 -->
                        <div id="step-3" class="clearfix">
                          <div class="loader1 hidden">
                            <img src="<?php echo base_url(); ?>assets/images/gears.gif">
                            <p class="loader-text">Preparing list of comparable properties ...</p>
                          </div>
                          <div class="backwrap hidden"></div>
                          <div class="col-md-12">
                            <div class="col-md-12">
                          <div class="col-md-6">
                            <h2><strong>Review Pages</strong></h2>
                          </div>
                          <div class="col-md-6 marketUpdateHide" id="butcomp">
                            <?php $_email = $this->session->userdata('user_email');?>
                            <a id="btn-bio" class="" data-toggle="modal" data-target="#update-bio" title="Bio" >Bio
                            </a> &nbsp | &nbsp
                            <a id="btn-testimonial" class="" data-toggle="modal" data-target="#update-testimonial" title="Testimonial" >Testimonials</a>

                            <a id="config-comps-btn" class="pull-right comps" style="" target="_blank" data-toggle="modal" data-target="#select-comps" title="configure comparables" >Review Comparables</a> | &nbsp
                          </div>
                            </div>
                            <div class="carousel-container">
                          <div id="owl-example" class="owl-carousel">
                            <?php
                            // $reportTemplates = array();
                            if(isset($reportTemplates) && !empty($reportTemplates))
                            {
                              foreach ($reportTemplates as $key => $report) {
                                // if($report->template_color != ''){
                            ?>
                              <div class="item">
                                <!-- <input type="checkbox" class="custom-checkbox" id="c21" value="" name="cover"> -->
                                 <input type="checkbox" class="custom-checkbox" name="page[]" value="<?php echo $key+1; ?>">
                                <label class="user-heading alt gray-bg" for="pb">
                                  <div class="text-center"> 
                                    <img class="seller_template" src="<?php echo base_url().$report->template_icon; ?>" alt=""> 
                                    <img class="buyer_template" style="display:none;" src="<?php echo base_url().$report->template_icon_buyer; ?>" alt=""> 
                                  </div>

                                </label>
                              </div>
                            <?php 
                                  // }
                                }
                            }
                            ?>
                            <input type="hidden" name="pdf_pages" value="" id="pdf_pages">
                          </div>
                            </div>
                          </div>
                        </div>
                        <!-- step 3 -->
                        <div id="step-4" class="clearfix">
                            <div class="loader1 hidden"><img src="<?php echo base_url(); ?>assets/images/gears.gif">
                                <p class="loader-text">Please wait</p>
                            </div>
                            <div class="backwrap hidden"></div>
                            <div class="alert alert-success" id="apply-coupan-alert"  style="display:none"></div>
                            <p class="clearfix">&nbsp;</p>
                            <div class="panel panel-body order-detail">
                                <section class="invoice ">
                                    <header class="clearfix">
                                        <div id="logo">
                                          <img src="<?php echo base_url(); ?>assets/images-2/logo.png"/>
                                        </div>
                                        <div id="company">
                                        </div>
                                    </header>
                                    <article>
                                        <div id="details" class="clearfix">
                                          <div id="client">
                                            <div class="to">INVOICE TO:</div>
                                            <h2 class="name"><?php  echo $user['first_name'].' '.$user['last_name']; ?></h2>
                                            <!-- <div class="address"><?php // echo $user['address_line_1'].' '.$user['state_code'].' '.$user['country_code']; ?></div> -->
                                          </div>
                                          <div id="invoice">
                                            <div class="date invoice-date">Date of Invoice: <?php echo date("m-d-Y"); ?></div>
                                          </div>
                                        </div>
                                        <table border="0" cellspacing="0" cellpadding="0" class="invoice-table" style="margin-bottom: 30px;">
                                            <thead>
                                                <tr>
                                                  <th class="no">#</th>
                                                  <th class="desc">DESCRIPTION</th>
                                                  <!-- <th class="unit">UNIT PRICE</th> -->
                                                  <!-- <th class="total">TOTAL</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="lp_invoice" >
                                                <tr>
                                                  <td class="no">01</td>
                                                  <td class="desc"></td>
                                                  <!-- <td class="unit" style="text-align: right;">$<?php // echo number_format($report_price,2,".",""); ?></td> -->
                                                  <!-- <td class="total" style="text-align: right;">$<?php // echo number_format($report_price,2,".",""); ?></td> -->
                                                </tr>
                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                  <td colspan=""></td>
                                                  <td colspan="2">SUBTOTAL</td>
                                                  <td>$<?php // echo number_format($report_price,2,".",""); ?></td>
                                                </tr>
                                                <tr id="coupandiscount" style="display:none">
                                                  <td colspan=""></td>
                                                  <td colspan="2">Discount</td>
                                                  <td>$0.00</td>
                                                </tr>
                                                <tr id="totalInvoiceAmount">
                                                  <td colspan="" style="border-top:1px solid #fff;"></td>
                                                  <td colspan="2">GRAND TOTAL</td>
                                                  <td>$<?php // echo number_format($report_price,2,".",""); ?></td>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">
                                                <div class="input-group">
                                                  <input class="from-field form-control" type="text" id="coupon_code" placeholder="Coupon Code" >
                                                  <span class="input-group-btn">
                                                  <a href="#javascript:;" class="btn btn-lp"  id="apply_coupon">Apply coupon</a>
                                                  </span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="clearfix"></div>
                                    </article>
                                </section>                            
                            </div>
                            <!-- <div class="order-summary panel panel-body" style="display:none;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr class="invoice-header">
                                        <td width="45%" bgcolor="#fff"><img src="<?php echo base_url(); ?>assets/images/logo.png"/></td>
                                        <td width="40%" bgcolor="#fff"  align="right" id="payment_total"><strong>Total: $<?php echo number_format($report_price,2,".",""); ?></strong></td>
                                        <td width="15%" class="text-right" bgcolor="#fff"><button class="btn btn-sm btn-gray btn-review">Review Order</button></td>
                                    </tr>
                                </table>
                                <p>&nbsp;</p>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Payment Information</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form action="<?php echo base_url(); ?>user/cart_payment" method="POST" id="payment-form" class="form-horizontal" role="form">
                                            <div class="alert alert-danger payment-errors" style="display:none"></div>
                                            <input type="hidden" size="80" id="invoice-amount" data-stripe="amount" name="amount" class="form-control" placeholder="Amount" value="<?php echo $report_price; ?>">
                                            <input type="hidden" id="coupon-id" name="coupon_id">
                                            <input type="hidden" id="coupon-amount" name="coupon_amount">
                                            <input type="hidden" id="order-amount" name="order_amount" value="<?php echo $report_price; ?>">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="card-holder-name">Name on Card:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" size="80" data-stripe="name" class="form-control" placeholder="Card Holder's Name" id="cardname">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="card-number">Card Number:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" size="20" data-stripe="number" class="form-control" placeholder="Card Number." id="cardno">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="cvv">Card CVV:</label>
                                                <div class="col-sm-2">
                                                    <input type="text" size="4" data-stripe="cvc" class="form-control" placeholder="CVV" id="cardcvv">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="expiry-month">Expiration Date:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <input type="text" size="2" data-stripe="exp-month" class="form-control" placeholder="Month" id="expmonth">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <input type="text" size="4" data-stripe="exp-year" class="form-control" placeholder="Year" id="expyear">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9" id="paynow">
                                                    <button type="button" class="btn btn-lp pay" id="paynow">Checkout & Download</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="loaders" style="opacity:1!important;"><img src="<?php // echo base_url(); ?>assets/images/gears.gif"></div>
                            </div> -->
                            <div class=" clearfix text-right  ">
                                <a href="javascript:void(0);" class="btn btn-lp btn-checkout">Download</a>
                            </div>
                        </div>
                        <!-- step 4 -->
                    </div>
                    <div id="checkout"></div>
                </div>
            <!-- End SmartWizard Content --> 
            </section>
            <!-- Features section -->
        </div>
        <div id="reports" class="tab-pane fade">
            <!-- Recent LP's section -->
            <section id="recent-lp">
                <div class="">
                    <h1 class="page-header">Recently Created Presentations</h1>
                    <p>We have stored all of your recently created reports so you can access them at anytime. From here you can download, print, and email them.</p>
                    <p>&nbsp;</p>
                    <?php $this->load->view('user/listing_table',array('reports'=>$reports)); ?>
                </div>
            </section>
            <!-- Screenshots section -->
        </div>
    </div>
    <div style="color:white;clear:both;margin:10px;">Powered By <a href="<?php echo site_url(); ?>" target="_blank">ModernAgent.io</a></div>
    <!-- modal for selecting the comparables starts here -->
    <div id="select-comps" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Minimum 4 and up to 8 Comparables</h4>
                    <a href="#" class="hide" id="refresh">Refresh Selection</a>
                </div>
                <div class="modal-body">
                    <select id='pre-selected-options' multiple='multiple'>
                    </select>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for selecting the comparables ends here -->

    <!-- modal for testimonials -->
    <div id="update-testimonial" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Testimonials</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <textarea class="form-control" rows="5" id="testimonial-1">Excellent. They walked me through the entire home selling process. From the list of things to repair, the importance of staging and daily contact once the for sale sign went up.</textarea>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="5" id="testimonial-2">As a first time home buyer he was very patient with all of our questions and took time to explain the process every step of the way. Always willing to show us any property we were interested at a time the worked best for our schedules. Overall very friendly and helpful. I am so glad he was able to help us find our first home with very little stress, I will definitely be recommending him to family and friends.</textarea>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6">
                            <textarea class="form-control" rows="5" id="testimonial-3">Showed us a bunch of homes for months until we found the right one. Gave us a ton of contacts to help us throughout the process. And even now after the home has already been closed on he is still helping with any problems or questions we have. Extremely helpful and knowledgeable in any facet of home buying/owning.</textarea>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="5" id="testimonial-4">They were a great team and extremely helpful with selling my house quickly. I was able to do everything online with them. They facilitated repairs and getting rid of things in the house. This was so helpful since I live out of the area.</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for testimonials -->

    <!-- modal for bio -->
    <div id="update-bio" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bio</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control" rows="5" id="agent-bio">Ad renatuasta, con vignonferor horum in dem morunt. Scibull atiam. Uli, conlostil ta iti, quod di sentem mum, sentesimis?Patis etili, quo aperfi nia viricii speriore noverem eretius cus, vis etemquem dent? Ici ine audees parbemus, consulistra consis. Aritra acre faciendius et? que furi tum non. Tion cus periate ctatemolut laute quam as ea coribearum quam, autate si tem quiae porrundionet quas etur sequatur moloreperum sequost.</textarea>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for bio -->
</div>
</div>      
      <!-- footer js and other stuff starts here -->
      <style type="text/css">
         #cma-widget-container {background-attachment: scroll; background-color:black; background-size: auto auto;background-size: cover;background-attachment: fixed;} 
         input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
         background-color: none !importent;
         background-image: none;
         color: rgb(0, 0, 0);
         }
         #mainTabMenu li{
         padding: 15px 0 0;
         }
         #mainTabMenu li a{
         padding: 15px;
         margin: 0px;
         }
         .loading {
         border: 16px solid #f3f3f3; /* Light grey */
         border-top: 16px solid #3498db; /* Blue */
         border-radius: 50%;
         width: 120px;
         height: 120px;
         animation: spin 2s linear infinite;
         margin: 0 auto;
         }
         .loadingText{
         text-align: center;
         margin: 15px;
         color: #fff;
         font-size:20px;
         }
         @keyframes spin {
         0% { transform: rotate(0deg); }
         100% { transform: rotate(360deg); }
         }
         #loadingPlugin{
         padding: 60px;
         }
         #widgetContent{
         /*display: none;*/
         }
         #cma-widget-container a#btn-testimonial,
         #cma-widget-container a#btn-bio {
         padding: 9px 10px;
         background: none;
         border: 1px solid #fff;
         font-weight: 500;
         font-size: 12px;
         color: #fff;
         text-decoration: none;
         font: 11px Montserrat;
         text-transform: uppercase;
         }
         #cma-widget-container a.pull-right {
         padding: 9px 10px;
         background: none;
         border: 1px solid #fff;
         font-weight: 500;
         color: #fff;
         text-decoration: none;
         margin-top: -10px;
         font: 11px Montserrat;
         text-transform: uppercase;
         float: right;
         }
      </style>
      <!-- Bootstrap Core JavaScript --> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/data-tables/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.localscroll-1.2.7-min.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.flexslider.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/carousel.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.prettyphoto.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nav.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartWizard-2.0.min.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/icheck.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script> 
      <script src="<?php echo base_url("assets/js/jquery.multi-select.js"); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lp.js"></script>
      
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  // This identifies your website in the createToken call below
  // Stripe.setPublishableKey("pk_live_kWtXKplBdNqXQMeBWHuHYZDx");
  Stripe.setPublishableKey("<?=getStripeKey()?>");

  
  // ...
</script>
      <script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var hexDigits = new Array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");

jQuery(document).ready(function() {
    setTimeout(function(){
        // choosing the seller report type to create
        choose_presentation('seller');
        $('#widgetContent').show();
        $('#loadingPlugin').hide();        
    }, 500);
    // run pre selected options
    var _max = 8;
    var _min = 4;
    var firstOpen = true;
     

    $('#refresh').on('click', function(){
        $('#pre-selected-options').multiSelect('refresh');
        return false;
    });

    $('#select-comps').on('shown.bs.modal', function() {
        $('#pre-selected-options').multiSelect({
        selectableHeader: "<div class='multiselect-header2'>Available Comparables</div>",
        selectionHeader: "<div class='multiselect-header'>Comparables You Want To Use</div>",
        });  
        if(firstOpen)
        // If received list is not greater than min value than set our min value to received list length
        if(_min>$('#pre-selected-options').val().length){
            _min = $('#pre-selected-options').val().length;;
        }
        firstOpen = false;
        var last_valid_selection = $('#pre-selected-options').val();
        $('#pre-selected-options').change(function(event) {
            if ($(this).val().length > _max) {
                //$(this).val(last_valid_selection);
            } 
            else {
            //last_valid_selection = $(this).val();$(this).trigger('change');
            }
        });
    });

    $('#select-comps').on('hide.bs.modal', function(event) {
        if($('#pre-selected-options').val().length < _min){
            alert('Please select '+_min+' comparables');
            event.stopPropagation();
            return false;
        }
        if($('#pre-selected-options').val().length > _max){
            alert('Please do not select more than '+_max+' comparables');
            event.stopPropagation();
            return false;
        }             
    });

    //BEGIN CHECKBOX & RADIO
    $('input[type="checkbox"], input[type="radio"]').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'icheckbox_minimal-grey',
        increaseArea: '20%' // optional
    });

    // Smart Wizard   
    $('#wizard').smartWizard({
        //keyNavigation:false,
        onLeaveStep:function(obj){
            //console.log(obj.attr('rel'));
            if(obj.attr('rel')==1){
              setTimeout(function(){
                $(document).scrollTop(50);
              },500);
              return true;
            }
            /*if(obj.attr('rel')==3){
              var _theme = $('.custom-checkbox:checked').val();
              console.log(_theme);
              console.log(typeof _theme);
              if(typeof _theme==='undefined'){
                  alert("Please choose a theme");
                  return false;
              }
            }*/
            return true;
        },
        onShowStep:function(obj){
            if(obj.attr('rel')==4){
                /*if($('.custom-checkbox:checked').val()){*/
                    /*$.ajax({
                        url:base_url + 'user/generateInvoice',
                        method:'GET'
                    })
                    .success(function(resp){*/
                        widgetRunPMA('','');
                   /* });*/
                /*}*/
                $('.loader1').show();
                $('.loader1').removeClass('hidden');
                $('.backwrap').show();
                $('.backwrap').removeClass('hidden');
                // check_subscription();
            }

            if(obj.attr('rel')!=4){
                $(".actionBar").show("slow");
                $(".btn-checkout").show("slow");
            }
            if(obj.attr('rel')==3){
                $('.loader1').removeClass('hidden');
                $('.backwrap').removeClass('hidden');
                $('.btn-checkout').data("download",1);
                return hasActiveRequest();
            }
            return true;
        }
    });

    $("#owl-example").owlCarousel();

    $('.nav li').localScroll();
    $('.nav').onePageNav({filter: ':not(.external)'});
    if($('#table-dt').length)
    {
        $('#table-dt').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    }

    $(".btn-checkout").click(function(){
        var isDirectDownload = parseInt($(this).data('download'));
        if(isDirectDownload){
            $('.loader1').show();
            $('.loader1').removeClass('hidden');
            $('.backwrap').show();
            $('.backwrap').removeClass('hidden');
            doSubmit();
            return true;
        }
        console.log("Bypassed");
        $(this).parents("#step-4").find('.order-detail').hide("slow");
        $(this).parents("#step-4").find('.order-summary').show("slow");
        $(".actionBar").hide("slow");
        $(".btn-checkout").hide("slow");
        $(".btn-pay").show("slow");
        // window.location.href="#top";
        setTimeout(function(){
            $(document).scrollTop(0);
        },500);
    });
    
    $(".btn-review").click(function(){
        $(this).parents("#step-4").find('.order-detail').show("slow");
        $(this).parents("#step-4").find('.order-summary').hide("slow");
        $(".actionBar").show("slow");
        $(".btn-checkout").show("slow");
        $(".btn-pay").hide("slow");
    });

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    $("#forward-report").on("show.bs.modal", function(e) {
        var projectID = $(e.relatedTarget).data('id');
        $(this).find("#project-id").val(projectID);
    });

    var selected_pdf_pages = [];

    $('.custom-checkbox').on('ifChecked', function (event){
        alert("checked");
        selected_pdf_pages.push($(this).val());
        var pages = selected_pdf_pages.toString();
        $('#pdf_pages').val(pages);        
    });
 
    $('.custom-checkbox').on('ifUnchecked', function (event){
        alert("unchecked");
        var removeItem = $(this).val();
        // selected_pdf_pages.pop($(this).val()); 
        selected_pdf_pages = jQuery.grep(selected_pdf_pages, function(value) {
          return value != removeItem;
        });
        var pages = selected_pdf_pages.toString();
        $('#pdf_pages').val(pages);     
    });

    $('.custom-checkbox').iCheck('check');
});

function choose_presentation(presentation)
{
    if(presentation === 'buyer'){
        $("#config-comps-btn").hide();
        $("#presentation").val("buyer");
        $('#wizard').smartWizard("buyer");
        $('.seller_template').hide(function(){
            $('.buyer_template').show();
        });
    }else if(presentation === 'marketUpdate'){
        $("#presentation").val("marketUpdate");
        $('#wizard').smartWizard("marketUpdate");
        // adding class marketUpdate so that we can manipulate the visibility of different steps
        $('#wizard').addClass('marketUpdate');

        $('.buyer_template').hide(function(){
            $('.seller_template').show();
        });
        $("#config-comps-btn").show();
    }else {
        $("#presentation").val("seller");
        $('#wizard').smartWizard("seller");
        $('.buyer_template').hide(function(){
            $('.seller_template').show();
        });
        $("#config-comps-btn").show();
    }
    //Set classes
    $("#search-btn").addClass(presentation);
    $('#choose-presentation').hide(function(){
        $('#wizard').show(function(){
            $(".swMain ul.anchor li a").addClass(presentation);
        });
    });
} 

//Function to convert hex format to a rgb color
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function delete_lp(lp_id, from)
{
    if(confirm('Sure to Delete?')){
      window.location = base_url+'user/delete_lp/'+lp_id +'/' + from;
    }
}

function check_subscription()
{
    $.ajax({
      url:base_url + 'user/is_subscribed/prem_lp_user/<?php echo $user_id; ?>',
      method:'GET',
      dataType: 'json',
      success:function(resp){
          $(".backwrap").hide();
          $(".backwrap").addClass('hidden');
          $(".loader1").hide();
          $(".loader1").addClass('hidden');
          if(resp.status){
              var discount = parseFloat($('#invoice-amount').val());
              amount  =   0;
              console.log(discount);
              $('#coupandiscount td:last').html('$'+discount.toFixed(2));
              $('#invoice-amount').val(amount);
              if ($('#order-amount').length) {
                $('#order-amount').val(amount);
              }
              $('#totalInvoiceAmount td:last').html('$'+amount.toFixed(2));
              $('#payment_total').html('$'+amount.toFixed(2));
              $('#coupandiscount').show();
              $('#coupon_code').parent(".input-group ").hide();
              var info = resp.data;
              var msg = info.plan_title+" plan("+info.interval+"ly) membership subscription discount";
              $('#apply-coupan-alert').html(msg).removeClass('alert-danger').addClass('alert-success').show();
              $('.btn-checkout').html("Download");
              $('.btn-checkout').data("download",1);
          }
      }
    });
}

function hasActiveRequest()
{
    if(activeRequest){
    setTimeout(function(){
      return hasActiveRequest();
    },500);
    }else{
    $('.loader1').addClass('hidden');
    $('.backwrap').addClass('hidden');
    return true;
    }
}

function doSubmit()
{
    if(activeRequest)
    {
        setTimeout(function(){
          doSubmit();
        },1500);
    }
    else
    {
        submitFormAndGetReport(); 
    }
}

// processing the form submission for creating the report
function submitFormAndGetReport()
{
    // getting the formData
    var formData = $("#payment-form").serializeArray();
    formData.push(
                    {name: 'widgetType', value: 'user_dashboard'},
                    {name: 'user-id', value: '<?php echo $user_id; ?>'}
                 );
    // submitting the form using ajax
    $.ajax({
        type: "POST",
        // url: "<?php // echo base_url(); ?>user/cart_payment",
        url: "<?php echo base_url(); ?>widget/getPDF",
        data: formData,
        dataType: "json",
        success: function(data) {
            console.log(data);
            var obj = data;                
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd = '0'+dd
            } 

            if(mm<10) {
                mm = '0'+mm
            } 

            today = mm + '/' + dd + '/' + yyyy;

            var new_row = '<tr class="active"><td>'+today+'</td><td>'+obj.project_id_pk+' '+obj.property_owner+'</td><td>'+obj.project_name+'</td><td style="text-transform:capitalize;">'+obj.report_type+'</td><td><a id="downloadReport_'+obj.project_id_pk+'" href="<?php echo base_url(); ?>'+obj.report_path+'" download target="_blank"><i data-toggle="tooltip" title="Download" class="icon icon-download"></i></a><a href="javascript:void(0);" target="_blank" data-toggle="modal" data-target="#forward-report" title="Forward" data-id="'+obj.project_id_pk+'"><i data-toggle="tooltip" title="Email" class="icon icon-share"></i></a><a href="javascript:void(0);" onclick="delete_lp('+obj.project_id_pk+', \'1\')"><i data-toggle="tooltip" title="Delete" class="icon icon-remove-circle"></i></a></td></tr>';

            // removing the active class from all rows
            $('#recent-lp #table-dt tbody tr').each(function(){
                $(this).removeClass('active');
            });

            // prepending a new row in the table and switch to the the tab
            // console.log(new_row);
            $('#recent-lp #table-dt tbody').prepend(new_row);
            
            // making the report download now
            window.open($('#downloadReport_'+obj.project_id_pk).attr('href'), '_blank');

            // switching the tab to show the latest reports
            $('#recentReportsTab').click();

            var jsonp_url = "<?php echo base_url('user/dashboard_widget?callback=dashboard_widget&ac_id='.$user_id); ?>";
            var custom_css = "<style>#cma-widget-container {background: url("+base_url+"/assets/images-2/home/header2.jpg) no-repeat 0 0;background-attachment: scroll;background-size: auto auto;background-size: cover;background-attachment: fixed;}</style>";

            $.getJSON(jsonp_url, function(data) {
                console.log(data);
              $('#cma-widget-container').html(custom_css+data.html);
            });
        },
        error: function() {
            // place error code here
            alert('Oops! Error Occurred while submitting the data.');
        }
    });
}
</script>

<script type="text/javascript">
  $(function() {
    // stripe
    var $form = $('#payment-form');
    function stripeResponseHandler(status, response) {
      if (response.error) {
        // Show the errors on the form
        console.log(response.error);
        $form.find('.payment-errors').text(response.error.message).show();
        $form.find('button').prop('disabled', false);
        jQuery(".loader1").hide();
        jQuery(".backwrap").hide();

      } else {
        // response contains id and card, which contains additional card details
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // blank out the form
        // and submit
        doSubmit();
      }
    }

    

    
    

    $('#payment-form').submit(function(event) {
      //alert("hell ya");
      $("form#payment-form").find('.payment-errors').text("").hide();
      $(".backwrap").show(function(){
          $(".loader1").show();
      });
      var $form = $(this);

      // Disable the submit button to prevent repeated clicks
      $form.find('button').prop('disabled', true);

      Stripe.card.createToken($form, stripeResponseHandler);
      
      // Prevent the form from submitting with the default action
      return false;
    });
    
    $('#apply_coupon').click(function(){
      $('.loader1').show();
      $('.loader1').removeClass('hidden');
      $('.backwrap').show();
      $('.backwrap').removeClass('hidden');
      $.ajax({
        url:base_url + 'coupon/apply_coupon/<?php echo $user_id; ?>?&code='+$('#coupon_code').val(),
        method:'GET',
        dataType:'json',
        success:function(resp){
          if(resp.status=='success'){
            var amount  = parseFloat($('#invoice-amount').val());
            if (amount<parseFloat(resp.discount)) {
              resp.discount = amount;
            }
            amount  =   amount-parseFloat(resp.discount);
            if (amount<=0) {
              amount = 0;
            }
            $('#coupandiscount td:last').html('$'+(parseFloat(resp.discount).toFixed(2)));
            if ($('#coupon-amount').length) {
                $('#coupon-amount').val(resp.discount);
            }
            $('#invoice-amount').val(amount);
            $('#coupon-id').val(resp.coupon_id);
            $('#totalInvoiceAmount td:last').html('$'+amount.toFixed(2));
            $('#payment_total').html('$'+amount.toFixed(2));
            $('#coupandiscount').show();
            $('#apply-coupan-alert').html(resp.message).removeClass('alert-danger').addClass('alert-success').show();
            $('#apply_coupon').addClass('disabled');
            if(amount<=0){//No need to checkout payment if amount is less than or equal to 0
                $('.btn-checkout').html("Download");
                $('.btn-checkout').data("download",1);
            }
          }else{
            console.log(resp);
            $('#apply-coupan-alert').html(resp.message).removeClass('alert-success').addClass('alert-danger').show();
          }
          $('.loader1').hide();
          $('.backwrap').hide();
        }
      }); 
    });

    

    function onFinishCallback(){
      $('#wizard').smartWizard('showMessage','Finish Clicked');
    }
   
    
    $(".leftpic a").click(function() {    
        console.log("trigger");                                            
          $(this).parents(".leftpic").find(".file-type").trigger("click");
    });

    $(".rightpic a").click(function() {                                                
          $(this).parents(".rightpic").find(".file-type").trigger("click");
    });
    
    $(".leftpic .file-type").change(function(){
      var ele = this;
      var file_data = $(this).prop('files')[0];
      var form_data = new FormData();
      form_data.append('fileToUpload', file_data)                           
      $.ajax({
        url: '<?php echo base_url(); ?>user/upload_file', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response) {
          console.log(JSON.parse(php_script_response));
          var object = JSON.parse(php_script_response);
          if (object.status) {
              $(ele).closest('.leftpic').find('a').html("<img src='<?php echo base_url(); ?>"+object.fileuri+"' style='width:100%'>");
              if(object.status == 'success'){
                          $("#user_image").val(object.fileuri);
              }else{
                $("#user_image").val('no');
              }
              /*
                If user is at my account page will the values
              */
              var element = $(ele).closest('.leftpic' ).find('#fileimage');
              console.log(element);
              console.log(element[0]);
              $(element[0]).val('<?php echo base_url(); ?>'+object.fileuri);
              
              if($('#agent_profile_image')){
                $('#agent_profile_image').attr('value',object.fileuri);
              }
          } else {

          }
        }
      });
    });

    $(".rightpic .file-type").change(function(){
        var file_data = $(this).prop('files')[0];
          var form_data = new FormData();
          form_data.append('fileToUpload', file_data)                    
          $.ajax({
              url: '<?php echo base_url(); ?>user/upload_file', // point to server-side PHP script 
              dataType: 'text', // what to expect back from the PHP script, if anything
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,
              type: 'post',
              success: function(php_script_response) {
                  
                  console.log(JSON.parse(php_script_response));
                  var object = JSON.parse(php_script_response);
                  if (object.status) {
                      $('.rightpic a').html("<img src='<?php echo base_url(); ?>"+object.fileuri+"' style='width:100%'>");
                      
            if(object.status == 'success'){
                        $("#company_image").val(object.fileuri);
            }else{
              $("#company_image").val('no');
            }
            /*
                        If user is at my account page will the values
                      */
                      if($('#agent_company_logo')){
                        $('#agent_company_logo').attr('value',object.fileuri);
                      }

                  } else {

                  }
                  
              }
          });
    });

    var $subs_form = $('#subscriptionForm');
    $('#pay_subscribe').click(function(){
      jQuery(".loader1").show();
      jQuery(".loader1").removeClass('hidden');
      jQuery(".backwrap").show();
      jQuery(".backwrap").removeClass('hidden');
    
      Stripe.card.createToken($subs_form, stripeResponseHandlerSubs);
      // Prevent the form from submitting with the default action
      return false;
    });
    function stripeResponseHandlerSubs(status, response) {
      if (response.error) {
        // Show the errors on the form
        console.log(response.error);
        $('#subscriptionForm .alert').html(response.error.message).show();
        setTimeout(function(){
          $('#subscriptionForm .alert').fadeOut(1500);
        },2000);
        $subs_form.find('button').prop('disabled', false);
        jQuery(".loader1").hide();
        jQuery(".loader1").addClass('hidden');
        jQuery(".backwrap").hide();
        jQuery(".backwrap").addClass('hidden');
      } else {
        var token = response.id;
        $subs_form.append($('<input type="hidden" name="stripeToken" />').val(token));
        subscribeSubmit();
      }
    }
   
    
    
  });

  

  
  
  
  
  //Display Notification/Error/Success
  $(document).ready(function(){
      <?php if ($this->session->flashdata('success')): ?>
      Notify('Success', '<?php echo $this->session->flashdata('success') ?>', 'success');
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')) : ?>
      Notify('Error', '<?php echo $this->session->flashdata('error') ?>', 'error');
      <?php endif; ?>
     
  });
</script>

</body>
</html>