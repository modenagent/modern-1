<!--Features section -->
<section id="steps" class="impression">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Smart Wizard -->
            <div id="choose-presentation">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="main_title">How Can We Help You Make an Impression?</h1>
                        <div class="impression_block_list">
                            <button class="impression_block" type="button" onclick="choose_presentation('buyer');">
                              <img src="<?php echo base_url(); ?>assets/new_site/img/buyer_presentation.png" alt="..." class="img-fluid d-block mx-auto">
                              Buyers Presentation 
                            </button>
                            <button class="impression_block" type="button" onclick="choose_presentation('seller');">
                              <img src="<?php echo base_url(); ?>assets/new_site/img/seller_presentation.png" alt="..." class="img-fluid d-block mx-auto">
                              Sellers Presentation
                            </button>
                            <button class="impression_block" type="button" onclick="choose_presentation('marketUpdate');">
                              <img src="<?php echo base_url(); ?>assets/new_site/img/market_update.png" alt="..." class="img-fluid d-block mx-auto">
                              Market Update
                            </button>
                            <button class="impression_block" type="button" onclick="choose_presentation('registry');">
                              <img src="<?php echo base_url(); ?>assets/new_site/img/smart_registry.png" alt="..." class="img-fluid d-block mx-auto">
                              Smart Registry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
        
        <div id="wizard" class="swMain loader-back wizard_block" style="display:none;">
            <ul>
                <li id="step-1-link">
                    <a href="#step-1">
                        <b>Step 1</b>Find Your Property
                    </a>
                </li>
                <li id="step-2-link">
                    <a href="#step-2">
                        <b>Step 2</b>Enter Your Information
                    </a>
                </li>
                <li id="step-3-link">
                    <a href="#step-3">
                        <b>Step 3</b>
                        <span class="marketUpdateHide">Branding & Options</span>
                        <span class="marketUpdateShow">Branding</span>
                    </a>
                </li>
                <li id="step-4-link">
                    <a href="#step-4">
                        <b>Step 4</b>
                        <span class="marketUpdateHide">Checkout &amp; Download</span>
                        <span class="marketUpdateShow">Download</span>
                    </a>
                </li>
            </ul>
            <div id="step-1">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="main_title text-start">Enter Address to Start</h2>
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
            </div>
            <!-- step 1 ends -->
            <div id="step-2" class="clearfix">
                <div class="loader1 hidden">
                    <img src="<?php echo base_url(); ?>assets/images/gears.gif">
                    <p class="loader-text">Please wait</p>
                </div>
                <div class="backwrap hidden"></div>
                <form id="run-pma-form" >
                    <div class="col-md-12">
                        <div class="row"  style="display: none">
                            <div class="col-sm-12">
                                <h2 class="text-center"><strong>Select Minimum 4 and up to 8 Comparables</strong></h2>
                            </div>
                            <div class="col-sm-12" id="config-comps-btn">
                                <select id='pre-selected-options' multiple='multiple'></select>
                            </div>
                        </div>
                        <div class="row justify-content-between buyer-cls" >
                            <div class="col-xs-12 col-lg-5 col-md-6">
                                <h2><strong>Agent:</strong> <span> Upload Pic &amp; Enter Info</span></h2>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="leftpic"> <a href="javascript:;">
                                            <?php
                                                if(empty($users[0]['profile_image'])){
                                                ?>
                                            <i class="icon-camera"></i>
                                            <br>
                                            Upload Picture
                                            <?php
                                                }
                                                else{
                                                ?>
                                            <img  src="<?php echo base_url().$users[0]['profile_image']; ?>" width="100%" >
                                            <?php
                                                }
                                                ?>
                                            </a>
                                            <input type="file"  class="file-type hidden" >
                                            <input type="text" id="fileimage" class="hidden file-path" name="user[profile_image]" value="<?php echo $users[0]['profile_image']; ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="hidden" class="form-control"   name="user_image"      id="user_image" value=""    />
                                        <input type="text" class="form-control"   name="user[fullname]"   id="" placeholder="Name"    value="<?php echo $users[0]['first_name'].' '.$users[0]['last_name']; ?>" />
                                        <input type="text" class="form-control"   name="user[title]"      id="" placeholder="Title"   value="<?php echo $users[0]['title']; ?>"/>
                                        <input type="text" class="form-control"   name="user[phone]"      id="" placeholder="Phone"   value="<?php echo $users[0]['phone']; ?>"/>
                                        <input type="text" class="form-control"   name="user[email]"      id="" placeholder="Email"   value="<?php echo $users[0]['email']; ?>"/>
                                        <input type="text" class="form-control"   name="user[licenceno]"  id="" placeholder="CA BRE#" value="<?php echo $users[0]['license_no']; ?>"/>
                                        <input type="hidden" class="form-control"   name="presentation"  id="presentation" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-5 col-md-6">
                                <h2><strong>Company:</strong><span> Upload Logo &amp; Enter Info</span></h2>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="rightpic"> <a href="javascript:;">
                                            <?php
                                                if(empty($users[0]['company_logo'])){
                                                ?>
                                            <i class="icon-camera"></i>
                                            <br>
                                            Upload Picture
                                            <?php
                                                }
                                                else{
                                                ?>
                                            <img  src="<?php echo base_url().$users[0]['company_logo']; ?>" width="100%" >
                                            <?php
                                                }
                                                ?>
                                            </a>
                                            <input type="file" class="file-type hidden">
                                            <input type="text" class="hidden file-path" name="user[company_logo]" value="<?php echo $users[0]['company_logo']; ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="hidden" class="form-control"   name="company_image"      id="company_image" value=""    />
                                        <input type="text" class="form-control"   name="user[companyname]"  id="" placeholder="Company Name"    value="<?php echo $users[0]['company_name'] ?>"/>
                                        <input type="text" class="form-control"   name="user[street]"       id="" placeholder="Street Address"  value="<?php echo $users[0]['company_add'] ?>"/>
                                        <input type="text" class="form-control"   name="user[city]"         id="" placeholder="City"            value="<?php echo $users[0]['company_city'] ?>"/>
                                        <input type="text" class="form-control"   name="user[zip]"          id="" placeholder="ZIP"             value="<?php echo $users[0]['comapny_zip'] ?>"/>
                                        <input type="text" class="form-control"   name="user[state]"        id="" placeholder="State"           value="<?php echo $users[0]['company_state'] ?>"/>
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
                    <div class="clearfix" id="addNewPartner">
                    </div>
                </form>
            </div>
            <!-- step 2 ends-->
            <div id="step-3" class="clearfix">
                <div class="loader1 hidden">
                    <img src="<?php echo base_url(); ?>assets/images/gears.gif">
                    <p class="loader-text">Preparing list of comparable properties ...</p>
                </div>
                <div class="backwrap hidden"></div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <h2>
                                <strong class="common_cls">Choose Your Branding</strong>
                                <strong class="subscribe_cls" style="display: none;">Preview Pages</strong>
                                <span style="display: block; font-size: 12px; text-transform: initial;">Select theme from <a href="<?php echo base_url('user/myaccount');?>">My Account</a></span>
                            </h2>
                        </div>

                        <div class="col-md-8 common_template" id="butcomp">
                            <?php $_email = $this->session->userdata('user_email');?>
                            <div class="row  pull-right">
                                <div class="col-sm-4" style="display: none !important">
                                    <div class="pull-right1 report_lang_div" style="">
                                        Language: 
                                        <select name="report_lang" style="background-color:transparent; border:none;">
                                            <option  style="color:#000000;" value="english">English</option>
                                            <option style="color:#000000;" value="spanish">Spanish</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-2" style="display: none !important">
                                    <?php if($packages['buyer']['active'] == 1 || $packages['marketupdate']['active'] == 1 || $packages['seller']['active'] == 1 || $packages['all']['active'] == 1) : ?>
                                        <div class="color-selection" >
                                            <div class="pull-right1 mu-theme-default-color" id="mu_report_select">
                                                <?php
                                                if(count($reportTemplates)): ?>
                                                    Color
                                                    <select id="report_color" name="report_color" style="background: transparent;">
                                                        <?php foreach($reportTemplates as $key=>$reportTemplate): ?>
                                                        <option <?php echo $key==0 ? 'selected' : '' ?>  style="color:<?php echo $reportTemplate->template_color ?>;" value="<?php echo $reportTemplate->template_color ?>"> <?php echo $reportTemplate->template_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php endif; ?>
                                               
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <a href="javascript:void(0);" id="config-comps-btn-a" class="comps" style="" target="_blank" data-bs-toggle="modal" data-bs-target="#select-comps" title="configure comparables" >Review Comparables</a>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="carousel-container common_template">
                        <div id="owl-example" class="owl-carousel">
                            <?php
                                foreach ($reportTemplates as $key => $report) {
                                  if($report->template_color != ''){
                                ?>
                            <div class="item">
                                <input type="radio"  
                                    <?php 
                                        if($report->report_templates_id_pk==$agentInfo->default_template){
                                          echo 'checked';
                                        }
                                        ?> class="custom-checkbox" id="def-temp-<?php echo $report->report_templates_id_pk; ?>" value="<?php echo $report->template_color; ?>" name="cover">
                                <label class="user-heading alt gray-bg" for="def-temp-<?php echo $report->report_templates_id_pk; ?>">
                                    <div class="text-center"> 
                                        <?php if(!($packages['seller']['active'] == 1 || $packages['all']['active'] == 1)) : ?>
                                        <img class="seller_template" src="<?php echo base_url().$report->template_icon; ?>" alt="<?php echo $report->template_name; ?>"> 
                                        <?php endif; ?>
                                        <?php if(!($packages['buyer']['active'] == 1 || $packages['all']['active'] == 1)) : ?>
                                        <img class="buyer_template" style="display:none;" src="<?php echo base_url().$report->template_icon_buyer; ?>" alt="<?php echo $report->template_name; ?>">
                                        <?php endif; ?>
                                        <?php if(!($packages['marketupdate']['active'] == 1 || $packages['all']['active'] == 1)) : ?>
                                        <img class="marketUpdate_template" style="display:none;" src="<?php echo base_url($report->template_icon_market); ?>" alt="<?php echo $report->template_name; ?>">
                                        <?php endif; ?>
                                        <img class="registry_template" style="display:none;" src="<?php echo base_url($report->template_icon_market); ?>" alt="<?php echo $report->template_name; ?>">
                                    </div>
                                </label>
                            </div>
                            <?php 
                                }
                                }
                                ?>
                        </div>
                    </div>
                    <?php if($packages['marketupdate']['active'] == 1 || $packages['all']['active'] == 1) : ?>
                        <input type="checkbox" class="subscribe_temp" name="subscribe_temp" value="marketUpdate" checked="" style="display: none !important">
                        <input type="hidden" class="mu_radio" id="mu_page_1" value="<?php echo $default_sub_type['mu']; ?>" name="cover_mu">
                    <div class="carousel-container marketUpdate_template" style="display: none">
                        <div id="owl-example-marketUpdate" class="owl-carousel">
                            <?php /*
                                for ($mu_i=1; $mu_i <=3 ; $mu_i++) {
                                ?>
                            <div class="item">
                                <input type="radio"  
                                    <?php 
                                        if($mu_i == 1){
                                          echo 'checked';
                                        }
                                        ?> class="mu_radio" id="mu_page_<?php echo $mu_i; ?>" value="<?php echo $mu_i; ?>" name="cover_mu">
                                <label class="user-heading alt gray-bg" for="mu_page_<?php echo $mu_i; ?>">
                                    <div class="text-center">
                                        <img class="registry_template1" src="<?php echo base_url("assets/reports/english/marketUpdate/preview/{$mu_i}.jpg"); ?>" alt="Market Update">
                                    </div>
                                </label>
                            </div>
                            <?php 
                                } */
                                $type = 'marketUpdate';
                                $sub_type = $default_sub_type['mu'];
                                $check_dir = "assets/reports/english/$type/preview/$sub_type/";
                                $load_dir = FCPATH.$check_dir;

                                if(is_dir($load_dir)) :

                                  $images = glob($load_dir . "*.jpg");

                                  $count_imgs = count($images);

                                  for ($img_cnt=1; $img_cnt <= $count_imgs ; $img_cnt++) : ?>

                                    <div class="item">
                                        
                                        <div class="text-center">
                                            <img class="registry_template1" src="<?php echo base_url($check_dir.$img_cnt.'.jpg'); ?>" alt="Market Update">
                                        </div>
                                        
                                    </div>

                                
                                <?php

                                  endfor;
                                endif;
                                ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($packages['seller']['active'] == 1 || $packages['all']['active'] == 1) : ?>
                        <input type="checkbox" class="subscribe_temp" name="subscribe_temp" value="seller" checked="" style="display: none !important">
                        <input type="hidden" class="seller_radio" id="seller_page_1" value="<?php echo $default_sub_type['seller']; ?>" name="cover_seller">
                    <div class="carousel-container seller_template" style="display: none">
                        <div id="owl-example-seller" class="owl-carousel">
                            <?php
                            /*
                                for ($mu_i=1; $mu_i <=3 ; $mu_i++) {
                                ?>
                            <div class="item">
                                <input type="radio"  
                                    <?php 
                                        if($mu_i == 1){
                                          echo 'checked';
                                        }
                                        ?> class="seller_radio" id="seller_page_<?php echo $mu_i; ?>" value="<?php echo $mu_i; ?>" name="cover_seller">
                                <label class="user-heading alt gray-bg" for="seller_page_<?php echo $mu_i; ?>">
                                    <div class="text-center">
                                        <img class="registry_template1" src="<?php echo base_url("assets/reports/english/seller/preview/{$mu_i}.jpg"); ?>" alt="Seller Report Preview">
                                    </div>
                                </label>
                            </div>
                            <?php 
                                } */
                                $type = 'seller';
                                $sub_type = $default_sub_type['seller'];
                                $check_dir = "assets/reports/english/$type/preview/$sub_type/";
                                $load_dir = FCPATH.$check_dir;

                                if(is_dir($load_dir)) :

                                  $images = glob($load_dir . "*.jpg");

                                  $count_imgs = count($images);

                                  for ($img_cnt=1; $img_cnt <= $count_imgs ; $img_cnt++) : ?>

                                    <div class="item">
                                        
                                        <div class="text-center">
                                            <img class="registry_template1" src="<?php echo base_url($check_dir.$img_cnt.'.jpg'); ?>" alt="Seller">
                                        </div>
                                        
                                    </div>

                                
                                <?php

                                  endfor;
                                endif;
                                
                                ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($packages['buyer']['active'] == 1 || $packages['all']['active'] == 1) : ?>
                        <input type="checkbox" class="subscribe_temp" name="subscribe_temp" value="buyer" checked="" style="display: none !important">
                        <input type="hidden"  class="buyer_radio" id="buyer_page_1" value="<?php echo $default_sub_type['buyer']; ?>" name="cover_buyer">
                    <div class="carousel-container buyer_template" style="display: none">
                        <div id="owl-example-buyer" class="owl-carousel">
                            <?php
                            /*
                                for ($mu_i=1; $mu_i <=3 ; $mu_i++) {
                                ?>
                            <div class="item">
                                <input type="radio"  
                                    <?php 
                                        if($mu_i == 1){
                                          echo 'checked';
                                        }
                                        ?> class="buyer_radio" id="buyer_page_<?php echo $mu_i; ?>" value="<?php echo $mu_i; ?>" name="cover_buyer">
                                <label class="user-heading alt gray-bg" for="buyer_page_<?php echo $mu_i; ?>">
                                    <div class="text-center">
                                        <img class="registry_template1" src="<?php echo base_url("assets/reports/english/buyer/preview/{$mu_i}.jpg"); ?>" alt="Buyer report">
                                    </div>
                                </label>
                            </div>
                            <?php 
                                }
                                */
                                $type = 'buyer';
                                $sub_type = $default_sub_type['buyer'];
                                $check_dir = "assets/reports/english/$type/preview/$sub_type/";
                                $load_dir = FCPATH.$check_dir;

                                if(is_dir($load_dir)) :

                                  $images = glob($load_dir . "*.jpg");

                                  $count_imgs = count($images);

                                  for ($img_cnt=1; $img_cnt <= $count_imgs ; $img_cnt++) : ?>

                                    <div class="item">
                                        
                                        <div class="text-center">
                                            <img class="registry_template1" src="<?php echo base_url($check_dir.$img_cnt.'.jpg'); ?>" alt="Seller">
                                        </div>
                                        
                                    </div>

                                
                                <?php

                                  endfor;
                                endif;
                                ?>
                        </div>
                    </div>
                    <?php endif; ?>


                    <div class="carousel-container registry_template" style="display: none">
                        <div id="owl-example-registry" class="owl-carousel">
                            <?php
                                for ($regsitry_i=1; $regsitry_i <=6 ; $regsitry_i++) {
                                ?>
                            <div class="item">
                                <input type="radio"  
                                    <?php 
                                        if($regsitry_i == 1){
                                          echo 'checked';
                                        }
                                        ?> class="registry_page" id="registry_page_<?php echo $regsitry_i; ?>" value="<?php echo $regsitry_i; ?>" name="cover_registry">
                                <label class="user-heading alt gray-bg" for="pb">
                                    <div class="text-center">
                                        <img class="" src="<?php echo base_url("assets/reports/english/registry/preview/{$regsitry_i}.jpg"); ?>" alt="<?php echo $report->template_name; ?>">
                                    </div>
                                </label>
                            </div>
                            <?php 
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- step 3 ends-->
            <div id="step-4" class="clearfix">
                <div class="loader1 hidden">
                    <img src="<?php echo base_url(); ?>assets/images/gears.gif">
                    <p class="loader-text">Please wait</p>
                </div>
                <div class="backwrap hidden"></div>
                <div class="alert alert-success" id="apply-coupan-alert"  style="display:none"></div>
                <p class="clearfix">&nbsp;</p>
                <div class="panel panel-body order-detail">
                  <section class="invoice ">
                        <header class="clearfix">
                            <div id="logo">
                                <img src="<?php echo base_url(); ?>assets/new_site/img/logo.png"/>
                            </div>
                            <div id="company">
                            </div>
                        </header>
                        <article>
                            <div id="details" class="clearfix">
                                <div id="client">
                                    <div class="to">INVOICE TO:</div>
                                    <h2 class="name"><?php  echo $users[0]['first_name'].' '.$users[0]['last_name']; ?></h2>
                                    <div class="address"><?php echo $users[0]['address_line_1'].' '.$users[0]['state_code'].' '.$users[0]['country_code']; ?></div>
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
                                        <th class="unit">UNIT PRICE</th>
                                        <th class="total">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody id="lp_invoice" >
                                    <tr>
                                        <td class="no">01</td>
                                        <td class="desc">
                                            <h4 class="selected_pkg_title"></h4>
                                        </td>
                                        <td class="unit" style="text-align: right;">$<span class="selected_pkg_val"><?php echo number_format($report_price,2,".",""); ?></span></td>
                                        <td class="total" style="text-align: right;">$<span class="selected_pkg_val"><?php echo number_format($report_price,2,".",""); ?></span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan=""></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>$<span class="selected_pkg_val"><?php echo number_format($report_price,2,".",""); ?></span></td>
                                    </tr>
                                    <tr id="coupandiscount" style="display:none">
                                        <td colspan=""></td>
                                        <td colspan="2">Discount</td>
                                        <td>$0.00</td>
                                    </tr>
                                    <tr id="totalInvoiceAmount">
                                        <td colspan="" style="border-top:1px solid #fff;"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>$<span class="selected_pkg_val"><?php echo number_format($report_price,2,".",""); ?></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row coupon_div">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">
                                    <div class="input-group">
                                        <input class="from-field form-control" type="text" id="coupon_code" placeholder="Coupon Code" >
                                        <span class="input-group-btn">
                                        <a href="#javascript:;" class="btn btn-lp"  id="apply_coupon">Apply coupon</a>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </div>
                            <hr>
                            <div class="clearfix" >
                            </div>
                        </article>
                    </section>
                </div>
                <div class="order-summary panel panel-body" style="display:none;">
                    <table width="100%" border="0" style="background-color:transparent;" cellspacing="0" cellpadding="0">
                        <tr class="invoice-header">
                            <td width="45%" bgcolor=""><img src="<?php echo base_url(); ?>assets/new_site/img/logo.png"/></td>
                            <td width="40%"  style="color:#ffffff;"  align="right" id="payment_total"><strong>Total: $<span class="selected_pkg_val"><?php echo number_format($report_price,2,".",""); ?></span></strong></td>
                            <td width="15%" style="color:#ffffff;" class="text-right" ><button class="btn btn-sm btn-gray btn-review">Review Order</button></td>
                        </tr>
                    </table>
                    <p>&nbsp;</p>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payment Information</h3>
                        </div>
                        <div class="panel-body stripe-div">
                            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stripe.css') ?>">
                            <form action="<?php echo base_url(); ?>index.php?/user/cart_payment" method="POST" id="payment-form" class="form-horizontal" role="form">
                                <div class="alert alert-danger payment-errors" style="display:none"></div>
                                <input type="hidden" size="80" id="invoice-amount" data-stripe="amount" name="amount" class="form-control selected_pkg_val" placeholder="Amount" value="<?php echo $report_price; ?>">
                                <input type="hidden" id="coupon-id" name="coupon_id">
                                <input type="hidden" id="coupon-amount" name="coupon_amount">
                                <input type="hidden" id="order-amount" name="order_amount" class="selected_pkg_val" value="<?php echo $report_price; ?>">
                                <input type="hidden" name="payment_intent_id" id="payment_intent_id">
                                <div id="card-element">
                                    <!-- Elements will create input elements here -->
                                </div>
                                <!-- <button id="stripe-submit">
                                    <div class="spinner hidden" id="spinner"></div>
                                    <span id="button-text">Pay now</span>
                                    </button> -->
                                <!-- We'll put the error messages in this element -->
                                <p id="card-error"  a class="alert alert-danger" role="alert" style="display: none;"></p>
                                <p id="payment-success" class="alert alert-success" role="alert" style="display: none;"></p>
                                <div class="form-group">
                                    <div class="col-sm-12" id="paynow">
                                        <button type="button" class="btn btn-lp pay" id="stripe-submit">
                                            <div class="spinner hidden" id="spinner"></div>
                                            <span id="button-text">Pay now</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="loaders" style="opacity:1!important;"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>
                </div>
                <div class=" clearfix pull-right  ">
                    <a href="javascript:void(0);" class="btn btn-lp btn-checkout">Checkout &amp; Download</a>
                    <button type="button" style="display: none;!important;" id="stripe_chk_btn"></button>
                </div>
            </div>
            <!-- step 4 ends-->
        </div>
        <div id="checkout">
        </div>
    </div>
    <!-- End SmartWizard Content -->
</section>
<!-- Features section -->
<!-- Recent LP's section -->
<section id="" class="presentation">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
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
</section>
<!-- Screenshots section -->
<script src="https://js.stripe.com/v3"></script>
<script type="text/javascript">

    var default_color = '<?php echo json_encode($default_color); ?>';
    default_color = JSON.parse(default_color);
    console.log(default_color);
    $(document).ready(function(){
        // $('input[type=radio][name=cover_mu]').on('ifChecked', function () {
        //     if($(this).val() == 1) {
        //          $("#mu_report_select").show();
        //     }
        //     else {
        //         $("#mu_report_select").hide();
        //     }
        // })
        
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
        $(".dataTables_filter input").attr("placeholder", "Search here").css({
                  width: "452px",
                  display: "inline-block"
              });
      }
    });
    var pkg_prices_str = '<?php echo json_encode($packages)?>';
    pkg_prices = JSON.parse(pkg_prices_str);
    var stripe = Stripe('<?php echo getStripeKey(); ?>');
    function manage_checkout_btn() {
        var presentation_type = $("#presentation").val().toLowerCase();
        $('.selected_pkg_val').text(pkg_prices[presentation_type].val);
        $('.selected_pkg_val').val(pkg_prices[presentation_type].val);
        // $('.selected_pkg_title').html(pkg_prices[presentation_type].title);
        if(pkg_prices[presentation_type].referral_status == 1) {
            $('.coupon_div').show();
        }
        else {
            $('.coupon_div').hide();
        }
        if(pkg_prices[presentation_type].active == 1 || pkg_prices['all'].active == 1) {
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
            // var info = resp.data;
            var msg = pkg_prices[presentation_type].title+" plan(monthly) membership subscription";
            if(pkg_prices['all'].active == 1) {
                msg = 'All '+" plan(monthly) membership subscription";
            }
            $('#apply-coupan-alert').html(msg).removeClass('alert-danger').addClass('alert-success').show();
            $('.btn-checkout').html("Download");
            $('.btn-checkout').data("download",1);
            $('.loader1').hide();
            $('.loader1').addClass('hidden');
            $('.backwrap').hide();
            $('.backwrap').addClass('hidden');
        } else {
            $('.loader1').hide();
            $('.loader1').addClass('hidden');
            $('.backwrap').hide();
            $('.backwrap').addClass('hidden');
        }
        
    }
    function choose_presentation(presentation){
        console.log(pkg_prices);
        if(presentation === 'buyer'){
            $("#config-comps-btn").parent().hide();
            $("#presentation").val("buyer");
            $('#wizard').smartWizard("buyer");
            $('.seller_template').hide(function(){
                $('.buyer_template').show();
                $('.marketUpdate_template').hide();
                $('.registry_template').hide();
                $('.common_template').show();
                $(".custom-checkbox[value='"+default_color.buyer+"']").prop("checked",true);
                $(".custom-checkbox").iCheck('update');
                <?php if($packages['buyer']['active'] == 1 || $packages['all']['active'] == 1) : ?>
                        $('.carousel-container.common_template').hide();
                        $('.report_lang_div').parent().hide();
                        $('#report_color').val(default_color.buyer);
                        $('.common_cls').hide();
                        $('.subscribe_cls').show();
                        // $('.color-selection').parent().show();
                        //
                    <?php endif; ?>
    
            });

            
    
        }else if(presentation === 'marketUpdate'){
            $("#presentation").val("marketUpdate");
            $('#wizard').smartWizard("marketUpdate");
            // adding class marketUpdate so that we can manipulate the visibility of different steps
            $('#wizard').addClass('marketUpdate');
    
            $('.buyer_template').hide(function(){
                $('.seller_template').hide();
                $('.marketUpdate_template').show();
                $('.registry_template').hide();
                $('.common_template').show();
                $(".custom-checkbox[value='"+default_color.mu+"']").prop("checked",true);
                $(".custom-checkbox").iCheck('update');
                <?php if($packages['marketupdate']['active'] == 1 || $packages['all']['active'] == 1) : ?>
                    $('.carousel-container.common_template').hide();
                    $('.report_lang_div').parent().hide();
                    $('#report_color').val(default_color.mu);
                    $('.common_cls').hide();
                    $('.subscribe_cls').show();
                    // $('.color-selection').parent().show();
                <?php endif; ?>
    
            });
    
            $("#config-comps-btn").parent().show();
            
    
        }
        else if(presentation === 'registry') {
            // $("#presentation").val("marketUpdate");
            $("#presentation").val("registry");
            $('#wizard').smartWizard("registry");
            // adding class marketUpdate so that we can manipulate the visibility of different steps
            $('#wizard').addClass('marketUpdate');
    
            $('.buyer_template').hide(function(){
                $('.seller_template').hide();
                $('.marketUpdate_template').hide();
                $('.registry_template').show();
                $('.common_template').hide();
    
            });
            $("#config-comps-btn").parent().hide();
            
    
    
        }
        else {
            $("#presentation").val("seller");
            $('#wizard').smartWizard("seller");
            $('.buyer_template').hide(function(){
                $('.seller_template').show();
                $('.marketUpdate_template').hide();
                $('.registry_template').hide();
                $('.common_template').show();
                $(".custom-checkbox[value='"+default_color.seller+"']").prop("checked",true);
                $(".custom-checkbox").iCheck('update');
                
                
                <?php if($packages['seller']['active'] == 1 || $packages['all']['active'] == 1) : ?>
                        $('.carousel-container.common_template').hide();
                        $('.report_lang_div').parent().hide();
                        $('#report_color').val(default_color.seller);
                        $('.common_cls').hide();
                        $('.subscribe_cls').show();
                        // $('.color-selection').parent().show();
                    <?php endif; ?>
            });
            $("#config-comps-btn").parent().show();

    
    
        }
        //Set classes
        $("#search-btn").addClass(presentation);
        $('#choose-presentation').hide(function(){
            $('#wizard').show(function(){
                $(".swMain ul.anchor li a").addClass(presentation);
            });
        });    
    }
    
    // Show the customer the error from Stripe if their card fails to charge
    var showError = function(errorMsgText) {
      loading(false);
      var errorMsg = document.querySelector("#card-error");
      $("#card-error").show();
      errorMsg.textContent = errorMsgText;
    };
    
    // Show a spinner on payment submission
    var loading = function(isLoading) {
      if (isLoading) {
        $("#card-error").html('');
        $("#card-error").hide();
        $('.loader1').hide();
        $('.loader1').addClass('hidden');
        $('.backwrap').hide();
        $('.backwrap').addClass('hidden');
        // Disable the button and show a spinner
        document.querySelector("#stripe-submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
      } else {
        document.querySelector("#stripe-submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
      }
    };
</script>