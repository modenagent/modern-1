<style>      
        body {
            background: url(<?php echo base_url("assets/images-2/home/header3.jpg");?>) no-repeat 0 0;
            background-attachment: scroll;
            background-size: auto auto;
            background-size: cover;
            background-attachment: fixed;
        }
        .overlapping{
            height:auto;
        }
    </style>
<div id="login-pag" class="containe cma-wraper">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
            
                                <?php
                                $currentUrl = $this->uri->uri_string();
                                if (strpos(strtolower($currentUrl), 'market') !== false) {
                                ?>
                                    <h2 class="logh">Generate Your Complimentary Market Update</h2>
                                <?php
                                } else {
                                ?>
                                    <h2 class="logh">Generate Your Complimentary C.M.A.</h2>
                                <?php
                                }
                                ?>
                                <div class="col-md-12">
                                <form class="login-wrapper" method="post" id="ref-form"  style="">
                                    <div class="content">
                                        <input type="hidden" class="form-control" name="form-name"  value="ref-form">
                                        <div class="form-group">
                                            <p>Enter Your Reference Code</p>
                                            <input type="text" style="height:54px;" class="form-control" name="ref_code" id="ref_code" placeholder="Reference code" required>
                                        </div><br>
                                        <div class="form-group">
                                            <p>Enter Valid Phone Number</p>
                                            <input type="text" style="height:54px;" class="form-control" name="phone_number" id="phone_number" placeholder="10 Digit Phone Number" required>
                                        </div><br>
                                        <div class="form-group m-b-0">
                                            <input class="btn btn-lp" style="height:54px;" name="ref-submit" id="ref-submit" type="submit" value="Proceed">
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <div id="user-details" style="display:none;" class="hidden">
                                    <p>Here are the details of user</p>
                                    <p id="email-add"></p>
                                </div>
                                <div id="step-1">
                                    <div class="col-md-10 col-md-offset-1">
                                <div class="step-1-content clearfix" style="display:none;position:relative;">
                                    <h2>Enter Address to Start</h2>
                                   

                                    <form accept-charset="UTF-8" action="" class="huge-search" method="get">
                                        <div class="form-group">
                                            <input name="utf8" type="hidden" value="✓">
                                            <div class="input-group2">
                                                <input class="form-control" name="term" id="searchbox" placeholder="e.g. ‘123 Success Ave’" type="search">
                                                <label id="error_searchbox" style="display:none;"></label>
                                                <input type="text" id="searchboxcity" class="citynames2" placeholder="e.g. 'Los Angeles'">
                                                <input type="hidden" id="neighbourhood">
                                                <input type="hidden" id="state">

                                                
                                                    <button class="btn btn-lp" type="button" id="search-btn"> Search </button>
                                                
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
                                    <form id="run-pma-form" style="display:none;">
                                        <!-- Hidden user details -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <?php
                                                $marketPresentation = '';
                                                $sellerPresentation = '';
                                                $currentUrl = $this->uri->uri_string();
                                                if (strpos(strtolower($currentUrl), 'market') !== false) {
                                                    $marketPresentation = 'selected';
                                                } else {
                                                    $sellerPresentation = 'selected';
                                                }
                                                ?>
                                                <select name="presentation" class="cma hide" style="color:black">
                                                    <option value="marketUpdate" <?php echo $marketPresentation; ?> >Market Update</option>
                                                    <option value="seller" <?php echo $sellerPresentation; ?>>Seller</option>
                                                    <option value="buyer">Buyer</option>
                                                </select>
                                            </div>
                                         <div class="col-md-2">
                                                <select name="report_lang" class="cma hide" style="color:black;">
                                                    <option value="english" selected>English</option>
                                                    <option value="spanish">Spanish</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <input id="profile_image"  name="user[profile_image]" value="<?php echo $agentInfo->profile_image ?>" type="hidden">
                                        <input id="u-image"  name="user_image" value="<?php echo $agentInfo->profile_image ?>" type="hidden">
                                        <input name="user[fullname]" id="u-fullname" value="<?php echo $agentInfo->first_name." ".$agentInfo->last_name ?>" type="hidden">
                                        <input name="user[title]"  id="u-title" value="<?php echo $agentInfo->title ?>" type="hidden">
                                        <input name="user[phone]" id="u-phone" value="<?php echo $agentInfo->phone ?>" type="hidden">
                                        <input name="user[email]"  id="u-email" value="<?php echo $agentInfo->email ?>" type="hidden">
                                        <input name="user[licenceno]" id="u-licenceno" value="<?php echo $agentInfo->license_no ?>" type="hidden">
                                        <input name="user[company_logo]" id="u-company_logo" value="<?php echo $agentInfo->company_logo ?>" type="hidden">
                                        <input name="user[companyname]" id="u-companyname" value="<?php echo $agentInfo->company_name ?>" type="hidden">
                                        <input name="user[street]" id="u-street" value="<?php echo $agentInfo->company_add ?>" type="hidden">
                                        <input name="user[city]" id="u-city" value="<?php echo $agentInfo->company_city ?>" type="hidden">
                                        <input name="user[zip]" id="u-zip" value="<?php echo $agentInfo->comapny_zip ?>" type="hidden">
                                        <input name="user[state]" id="u-state" value="<?php echo $agentInfo->company_state ?>" type="hidden">
                                        <input type="hidden" name="coupon_code" id="coupon_code" value="">
                                        <input type="hidden" name="theme" value="#1BBB9B">
                                        <input type="radio"  class="custom-checkbox hidden" id="c21" value="rgb(0,28,61)" name="cover" checked>
                                        <div id="addNewPartner" style="display:none"></div>
                                        <!-- END -->
                                        
                                    </form>
                                    <form  method="POST" id="payment-form" class="hidden form-horizontal" role="form">
                                        <div class="alert alert-danger payment-errors" style="display:none"></div>
                                        <input type="hidden" size="80" id="invoice-amount" data-stripe="amount" name="amount" class="form-control" placeholder="Amount" value="0">
                                        <input type="hidden" id="coupon_id" name="coupon_id">
                                        <input type="hidden" id="coupon-amount" name="coupon_amount" value="0">
                                        <input type="hidden" id="order-amount" name="order_amount" value="0">
                                        <input type="hidden" id="user-id" name="user-id" value="">
                                        <input type="hidden" id="submit-phone" name="phone_number" value="">
                                        <input type="hidden" name="project_id" id="project_id">
                                        <div class="form-group">
                                          <div class="col-sm-offset-3 col-sm-9" id="paynow">
                                            <button type="submit" class="btn btn-lp pay" id="paynow">Create Complimentary Report</button>
                                          </div>
                                        </div>
                                      </form>
                                    <button type="button" style="display:none;" class="btn btn-lp" id="create-report">Create Complimentary Report</button>
                                    <div class="loader1 hidden" style="top:0;">
                                        <img src="<?php echo base_url(); ?>assets/images/gears.gif">
                                        <p class="loader-text">Please wait while report gets ready ....</p>
                                    </div>
                                    <div class="backwrap hidden"></div>
                                </div>
                                </div>
                                </div>
                                <!-- <br/>
                                <div style="color:white;clear:both;margin:10px;">Powered By <a href="<?php echo site_url(); ?>" target="_blank">ModernAgent.io</a></div> -->
                            </div>
        
    </div>
    <div id="progress" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="progress" aria-hidden="true" style="z-index:5000;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Report Generation progress
                </div>
                <div class="modal-body" >
                    <p>Please wait while report is being generated...</p><br/>
                    <div id="percent_progress_wrap">
                        <p>Preparing content</p>
                        <div id="percent_progress"><div class="progress-label" id="percent_progress_label">0%</div></div> 
                    </div>
                    <br/>
                    <div id="page_progress_wrap">
                        <p>Preparing pages</p>
                        <div id="page_progress"><div class="progress-label" id="page_progress_label"></div></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div style="display: none!important">
    <div class="row">
        <?php
                    foreach ($testimonials as $testimonial_i => $testimonial) : 
                      if($testimonial_i == 2) :
                        echo '<div class="row" style="margin-top:10px;">';
                      endif;
                      ?>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="5" id="testimonial-<?=($testimonial_i+1)?>"><?=$testimonial->content?></textarea>
                            <input type="text" class="form-control" name="testimonial_name_<?=($testimonial_i+1)?>" id="testimonial-name-<?=($testimonial_i+1)?>" style="margin-top: 5px;" placeholder="Enter Name" value="<?=$testimonial->name?>">
                        </div>
                    <?php 
                      if($testimonial_i == 1) :
                        echo '</div>';
                      endif;
                    endforeach;
                  ?>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-6">
            <textarea class="form-control" rows="5" id="testimonial-3">Showed us a bunch of homes for months until we found the right one. Gave us a ton of contacts to help us throughout the process. And even now after the home has already been closed on he is still helping with any problems or questions we have. Extremely helpful and knowledgeable in any facet of home buying/owning.</textarea>
            <input type="text" name="testimonial_name_3" id="testimonial-name-3" style="margin-top: 5px;" placeholder="Enter Name" value="">
        </div>
        <div class="col-md-6">
            <textarea class="form-control" rows="5" id="testimonial-4">They were a great team and extremely helpful with selling my house quickly. I was able to do everything online with them. They facilitated repairs and getting rid of things in the house. This was so helpful since I live out of the area.</textarea>
            <input type="text" name="testimonial_name_4" id="testimonial-name-4" style="margin-top: 5px;" placeholder="Enter Name" value="">
        </div>
    </div>

    <textarea class="form-control" rows="5" id="agent-bio">Ad renatuasta, con vignonferor horum in dem morunt. Scibull atiam. Uli, conlostil ta iti, quod di sentem mum, sentesimis?Patis etili, quo aperfi nia viricii speriore noverem eretius cus, vis etemquem dent? Ici ine audees parbemus, consulistra consis. Aritra acre faciendius et? que furi tum non. Tion cus periate ctatemolut laute quam as ea coribearum quam, autate si tem quiae porrundionet quas etur sequatur moloreperum sequost.</textarea>
</div>
<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.jss" type="text/javascript"></script> -->
<script src="<?php echo base_url("assets/js/jquery-ui.1.11.2.min.js") ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/lp_cma_widget.js?v=0.1") ?>"></script>




<script type="text/javascript">
    var percentbar,percentLabel, pagebar, pageLabel ; 
$(document).ready(function(){
setTimeout(function(){
    percentbar = $( "#percent_progress" );
    percentLabel = $( "#percent_progress_label" );
 
    percentbar.progressbar({
      value: false,
      change: function() {
        percentLabel.text( percentbar.progressbar( "value" ) + "%" );
      },
      complete: function() {
        percentLabel.text( "Complete!" );
      }
    });
    percentbar.progressbar( "value", 0 );
    
    //Pages
    pagebar = $( "#page_progress" );
    pageLabel = $( "#page_progress_label" );
 
    pagebar.progressbar({
        max:21,
      value: 0,
      change: function() {
        pageLabel.text( pagebar.progressbar( "value" ) + " of " +  pagebar.progressbar("option",  "max" ));
      },
      complete: function() {
        percentLabel.text( "Complete!" );
      }
    });
    pagebar.progressbar( "value", 0 );
    },1500);
    
});

var partners = [];
var base_url = '<?php echo base_url(); ?>';
var map;
var loc_marker;

var hexDigits = new Array
        ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

//Function to convert hex format to a rgb color
function rgb2hex(rgb) {
 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
 return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
  return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function initialize() {
  if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(results){
          var latlng = new google.maps.LatLng(results.coords.latitude, results.coords.longitude);
          map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 8,
            center: latlng
          });    
          marker = new google.maps.Marker({
              position: latlng,
              map: map,
              // title: 'Hello World!'
          });
        });
  }else{
      map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
      });
    
  }
  google.maps.event.addDomListener(window, 'load', initialize);
}


$(document.body).on('submit', '#ref-form' ,function(){
//     if( !$(this).valid() ){
//         return false;
//    }else{
      $("#ref-submit").val("Please wait...");
      var form_data = $(this).serializeArray();
      $.ajax({
              url: '<?php echo base_url(); ?>widgetcma/get_user_by_ref', // point to server-side PHP script 
              data: form_data,
              method: 'post',
              xhrFields: { 
        withCredentials: true 
    },
              success: function(php_script_response) {
                  var object = JSON.parse(php_script_response);
                  if (object.status=="success") {
                      $("#email-add").html(object.user.email);
                      $("#user-details").show();
                      $(".step-1-content").show();
                      
                      $("#profile_image").val(object.user.agent.profile_image);
                      $("#u-image").val(object.user.agent.profile_image);
                      $("#u-fullname").val(object.user.agent.first_name+" "+object.user.agent.last_name);
                      $("#u-title").val(object.user.agent.title);
                      $("#u-phone").val(object.user.agent.phone);
                      $("#u-email").val(object.user.agent.email);
                      $("#u-licenceno").val(object.user.agent.license_no);
                      $("#u-company_logo").val(object.user.agent.company_logo);
                      $("#u-company_name").val(object.user.agent.company_name);
                      $("#u-street").val(object.user.agent.company_add);
                      $("#u-city").val(object.user.agent.company_city);
                      $("#u-zip").val(object.user.agent.comapny_zip);
                      $("#u-state").val(object.user.agent.company_state);
                      $("#user-id").val(object.user.user_id_pk);
                      var phoneNumber = $("#phone_number").val();
                      phoneNumber = phoneNumber.replace(/ /g,"");
                      phoneNumber = phoneNumber.replace(/-/g,"");
                      $("#submit-phone").val(phoneNumber);
                      if((object.method) != null && object.method.indexOf("REF")===0){
                          $("#coupon_code").val(object.method);
                      }
                  } else {
                      alert(object.msg);
                      $("#user-details").hide();
                      $(".step-1-content").hide();
                  }
                  $("#ref-submit").val("Proceed");
              }
      });
    //}
    return false;
  });
  $('#payment-form').submit(function(){
     if( !$(this).valid() ){
         return false;
    }else{
      var form_data = $(this).serializeArray();
      $.ajax({
              url: '<?php echo site_url("widgetcma/cart_payment") ?>', // point to server-side PHP script 
              data: form_data,
              method: 'post',
              xhrFields: { 
                    withCredentials: true 
                },
              success: function(php_script_response) {
                  
                  console.log(JSON.parse(php_script_response));
                  var object = JSON.parse(php_script_response);
                  if (object.status=="success") {
                      alert("Sent report link in sms to your phone");
                      
                  } else {
                      alert(object.msg);
                  }
                  $('.loader1').hide();
                    $('.backwrap').hide();
              }
      });
    }
    return false;
  });
$(document.body).on( "click",'.search-result a',function(){
$(this).html("processing...");
isActive();
  });
var pmaRes = {};
$("#create-report").click(function(){
    $('.loader1').show();
    $('.loader1').removeClass('hidden');
    $('.backwrap').show();
    $('.backwrap').removeClass('hidden');
    pmaRes = widgetRunPMA('','');
    doSubmit();
    
});
function isActive(){
    if($.active){
      setTimeout(function(){
        isActive();
        console.log("searching");
      },100);
    }else{
        $(".search-result a").html("Choose");
        $("#create-report").show();
        $("#run-pma-form").show();
    }
}
function doSubmit(){

    <?php
    $report = '';
    $currentUrl = $this->uri->uri_string();
    if (strpos(strtolower($currentUrl), 'market') !== false) {
        $report = 'market';
    } 
    ?>

    if(activeRequest){
      setTimeout(function(){
          $("#progress").modal('show');
          $.ajax({
            url:base_url + 'lp/report_progress',
            method:'POST',
            dataType:'json',
            data: {
                report: '<?php echo $report; ?>'
            },
            success:function(resp){
                if(resp.type=='content_percent'){
                    console.log(resp.percent);
                    percentbar.progressbar( "value", resp.percent );
                } else if(resp.type=='pages_done'){
                    percentbar.progressbar( "value", 100 );
                    console.log(resp.pages);
                    pagebar.progressbar( "option", "max", resp.max );
                    pagebar.progressbar( "value", resp.pages );
                }
            }});
        doSubmit();
      },500);
    }else{
        $("#progress").modal('hide');
        if(typeof pmaRes.status !== 'underfined' && pmaRes.status=='failed'){
            alert(pmaRes.msg);
            location.reload();
        } else {
            $('#payment-form').submit();
        }
    }
}

  
$(function() {

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
      $(this).parents("#step-4").find('.order-detail').hide("slow");
      $(this).parents("#step-4").find('.order-summary').show("slow");
      $(".actionBar").hide("slow");
      $(".btn-checkout").hide("slow");
      $(".btn-pay").show("slow");
      setTimeout(function(){
        $(document).scrollTop(0);
      },500);
    });

    

  });

var base_url = '<?php echo base_url(); ?>';

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});
function check_subscription(){
    $.ajax({
        url:base_url + 'index.php?/user/is_subscribed/prem_lp_user',
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