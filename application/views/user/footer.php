<!-- footer -->

  <footer>
    <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1 col-xxl-8 offset-xxl-2">
            <div class="footer_content">
              <div>
                <a href="index.html"><img src="<?php echo base_url(); ?>assets/new_site/img/logo.png" alt="Modern Agent"></a>
                <p class="mt-3 mb-0">We are all about helping real estate agents <br> make the perfect impression.</p>
              </div>
              <a href="<?php echo base_url(); ?>" target="_blank" class="d-block text-center web_link"><?php echo base_url(); ?></a>
              <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a href="#"><img src="<?php echo base_url(); ?>assets/new_site/img/facebook-logo.svg" alt="..."></a></li>
                  <li class="list-inline-item"><a href="#"><img src="<?php echo base_url(); ?>assets/new_site/img/twitter.svg" alt="..."></a></li>
                  <li class="list-inline-item"><a href="#"><img src="<?php echo base_url(); ?>assets/new_site/img/instagram.svg" alt="..."></a></li>
              </ul>
            </div>
          </div>
      </div>
        <div class="row">
            <div class="col-md-12">
                <p class="mb-0 copyright">© <?php echo date('Y');?>. MODERN AGENT. ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </div>
  </footer>
<!-- Start modals -->
<div id="forward-report" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content ">
        <form action="<?php echo base_url('user/formward_report'); ?>" method="post" id="forward-report-form">
            <div class="modal-header">
              <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
              <h4 class="modal-title">Forward Report</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="project-id" name="project_id">
              <div class="form-group mb-3">
                  <label for="email_to">Send to Email:</label>
                  <input type="email" class="form-control" required name="email_to">
              </div>
              <div class="form-group">
                  <input type="checkbox" name="cc" id="cc_me"> 
                  <label for="cc_me">CC to me</label>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-lp external">Send</button>              
            </div>
        </form>
    </div>

  </div>
</div>
<div id="sms-report" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content ">
        <form action="<?php echo base_url('user/sms_report'); ?>" method="post" id="sms-report-form">
            <div class="modal-header">
              <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
              <h4 class="modal-title">Send Report to SMS</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="sms-report-id" name="sms_report_id">
              <div class="form-group mb-3">
                  <label for="sms_email_to">Enter Phone Number:</label>
                  <input type="text" class="form-control" required name="sms_to" id="sms_to">
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-lp external">Send</button>              
            </div>
        </form>
    </div>

  </div>
</div>
<div id="select-comps" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            <h4 class="modal-title">Select Minimum 4 and up to 8 Comparables</h4>
            <a href="#" class="hide" id="refresh">Refresh Selection</a>
        </div>
        <div class="modal-body">
            <select id='pre-selected-options_old-temp' multiple='multiple'>
            </select>
        </div>
        <div class="modal-footer text-center">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Save</button>
        </div>
    </div>
  </div>
</div>
<!-- END Modals -->

<style type="text/css">
  
  input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
    background-color: none !important;
      background-image: none;
      color: rgb(0, 0, 0);
  }

</style>



<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  // This identifies your website in the createToken call below
  // Stripe.setPublishableKey("pk_live_kWtXKplBdNqXQMeBWHuHYZDx");
  Stripe.setPublishableKey("<?=getStripeKey()?>");

  
  // ...
</script>

<!-- Bootstrap Core JavaScript --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_site/js/bootstrap.bundle.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_site/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_site/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_site/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.localscroll-1.2.7-min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.flexslider.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/carousel.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.prettyphoto.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nav.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartWizard-2.0.min.js?v=0.1"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script> 
<script src="<?php echo base_url("assets/js/jquery.multi-select.js"); ?>"></script>
<script type="text/javascript">
  // run pre selected options
  var _max = 8;
  var _min = 4;
  var firstOpen = true;
  $('#refresh').on('click', function(){
      console.log("refreshing");
    $('#pre-selected-options').multiSelect('refresh');
    return false;
  });
  $('#select-comps').on('shown.bs.modal', function() {
      // $('#pre-selected-options').multiSelect({
      //     selectableHeader: "<div class='multiselect-header2'>Available Comparables</div>",
      //     selectionHeader: "<div class='multiselect-header'>Comparables You Want To Use</div>",
      // });  
      // if(firstOpen) {
      //     // If received list is not greater than min value than set our min value to received list length
      //     var pre_selected_options = $.trim($('#pre-selected-options').html());
      //     if (pre_selected_options!='') {
      //       if(_min>$('#pre-selected-options').val().length){
      //           _min = $('#pre-selected-options').val().length;
      //       }
      //     }
      //     firstOpen = false;
      // }
      /*
      var last_valid_selection = $('#pre-selected-options').val();
      $('#pre-selected-options').change(function(event) {
        if ($(this).val().length > _max) {
          //$(this).val(last_valid_selection);
        } else {
          //last_valid_selection = $(this).val();$(this).trigger('change');
        }
      });
      */
  });
  $('#select-comps').on('hide.bs.modal', function(event) {
    // var pre_selected_options = $.trim($('#pre-selected-options').html());
    // if (pre_selected_options!='') {
    //   if ($('#pre-selected-options').val()==null) {
    //       alert('Please select '+_min+' comparables');
    //       event.stopPropagation();
    //       return false;
    //   } else if ($('#pre-selected-options').val().length < _min){
    //       alert('Please select '+_min+' comparables');
    //       event.stopPropagation();
    //       return false;
    //   }
    //   if($('#pre-selected-options').val().length > _max){
    //       alert('Please do not select more than '+_max+' comparables');
    //       event.stopPropagation();
    //       return false;
    //   }
    // } 
  });
</script>
<script type="text/javascript">
  var partners = [];
  var base_url = '<?php echo base_url(); ?>';
  var map;
  var loc_marker;

  function changeCaptcha(){
      $.ajax({
          url:'<?php echo base_url(); ?>index.php?/frontend/change_captcha?&',
          method:'GET',
          success:function(resp){
            var obj = JSON.parse(resp);
            if(obj.status=="success"){
              $('#cimg').attr('src','assets/captcha/image'+obj.timestamp+'.png');
              $('#cflag').attr('value',obj.timestamp);
            }
          }
      });
  }

  function selected_listing()
  { 
    console.log(this.value);
  }
  var hexDigits = new Array
          ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

  //Function to convert hex format to a rgb color
  function rgb2hex(rgb) {
    if(rgb != undefined) {
      
     rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
     return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }
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

  //BEGIN CHECKBOX & RADIO
  // $('input[type="radio"]').iCheck({
  //   checkboxClass: 'icheckbox_minimal-grey',
  //   radioClass: 'icheckbox_minimal-grey',
  //   increaseArea: '20%' // optional
  // });
  $(function() {
    $("a[class^='prettyPhoto']").prettyPhoto({theme:'pp_default'});
    $(".owl-carousel").owlCarousel({
      items:4,
      margin:15,
      autoWidth:true,
      });
    // $("#owl-example").owlCarousel();
    $('.nav li').localScroll();
    $('.nav').onePageNav({filter: ':not(.external)'});

    // Smart Wizard   
    $('#wizard').smartWizard({
      onLeaveStep:function(obj){
        if(obj.attr('rel')==1){
          console.log('Leaving page 1');
          setTimeout(function(){
            $(document).scrollTop(50);
          },500);
          return true;
        }
        if(obj.attr('rel')==2) {
          var presentation = $("#presentation").val();
          console.log('Leaving page 2');
          if(presentation == "seller" || presentation == "marketUpdate") {
            var pre_selected_options = $.trim($('#pre-selected-options').html());
            if (pre_selected_options!='') {
              if ($('#pre-selected-options').val()==null) {
                  alert('Please select '+_min+' comparables');
                  // event.stopPropagation();
                  return false;
              } else if ($('#pre-selected-options').val().length < _min){
                  alert('Please select '+_min+' comparables');
                  // event.stopPropagation();
                  return false;
              }
              if($('#pre-selected-options').val().length > _max){
                  alert('Please do not select more than '+_max+' comparables');
                  // event.stopPropagation();
                  return false;
              }
            }
            if (presentation == "seller") {
              var theme_type = $("#select-theme-type").val();
              var defaultSubType = <?php echo json_encode($default_sub_type); ?>;
              var theme_sub_type = defaultSubType[presentation];
              
              $.ajax({
                url:base_url + 'user/getPreviews',
                method:'POST',
                data : {theme_type:presentation,theme_sub_type,theme_sub_type,displayCheckboxes: true},
                success:function(resp){
                  if(presentation == "seller" && $('#step-3 .carousel-container.seller_template .preview_pages').length > 0){
                    $('#step-3 .carousel-container.seller_template .preview_pages').html(resp)
                  } else {
                    $('#step-3 .carousel-container.common_template .preview_pages').html(resp)
                  }
                }
              });
            }
          }
        }
        if(obj.attr('rel')==3){
          var presentation = $("#presentation").val();
          if (presentation == "seller") {
            var selectedPage = [];
            $('.page-checkbox:checked').each(function(){
              selectedPage.push($(this).val());
            });
            console.log('selectedPage ===', selectedPage);
            console.log('selectedPage length =', selectedPage.length);
            if(selectedPage.length == 0){
              alert("Please select atleast one page");
              return false;
            }
          } else {
            var _theme = $('.custom-checkbox:checked').val();
            console.log(_theme);
            console.log(typeof _theme);
            if(typeof _theme==='undefined'){
                alert("Please choose a theme");
                return false;
            }
          }
        }
        return true;
      },
      onShowStep:function(obj){
        if(obj.attr('rel')==2){
          if($("#presentation").val() == "seller" || $("#presentation").val() == "marketUpdate") {

            $('.buyer-cls').hide();
            
          }
          else {
            $('.buyer-cls').show();
          }
        }
        if(obj.attr('rel')==4){
          var selectedPage = [];
          $('.page-checkbox:checked').each(function(){
            selectedPage.push($(this).val());
          });
          // if(selectedPage.length == 0){
          //   $.ajax({
          //     url:base_url + 'index.php?/user/generateInvoiceWithSelectedPage',
          //     method:'POST',
          //     data: selectedPage
          // })
          if(selectedPage.length > 0){
            $.ajax({
              url:base_url + 'index.php?/user/generateInvoice',
              method:'GET'
          })
            .success(function(resp){
              
              runPMA('','');
            });
          }
          $('.loader1').show();
          $('.loader1').removeClass('hidden');
          $('.backwrap').show();
          $('.backwrap').removeClass('hidden');
          // check_subscription();
          // manage_checkout_btn();
        } 
        if(obj.attr('rel')!=4){
          $(".actionBar").show("slow");
          $(".btn-checkout").show("slow");
        }
        if(obj.attr('rel')==3){
          $('.loader1').removeClass('hidden');
          $('.backwrap').removeClass('hidden');
          return hasActiveRequest();
        }
        return true;
      }
    });

    if($('#table-dt')){
      $('#table-dt').DataTable( {
          "order": [[ 0, "desc" ]]
      } );
    }

      // stripe
    var $form = $('#payment-form');
    // function stripeResponseHandler(status, response) {
    //   if (response.error) {
    //     // Show the errors on the form
    //     console.log(response.error);
    //     $form.find('.payment-errors').text(response.error.message).show();
    //     $form.find('button').prop('disabled', false);
    //     jQuery(".loader1").hide();
    //     jQuery(".backwrap").hide();

    //   } else {
    //     // response contains id and card, which contains additional card details
    //     var token = response.id;
    //     // Insert the token into the form so it gets submitted to the server
    //     $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    //     // blank out the form
    //     // and submit
    //     doSubmit();
    //   }
    // }
    /*
    function doSubmit(){
      if(activeRequest){
        setTimeout(function(){
          doSubmit();
        },1500);
      }else{
        $form.get(0).submit();
      }
    }

    FIX issue that order submitted even PDF not generated
    By Below changes.
    */
    function doSubmit(){
      if(activeRequest && !pdfGenerated){
        setTimeout(function(){
          doSubmit();
        },1500);
      } else if(! pdfGenerated){
        $('.loader1').hide();
        $('.backwrap').hide();
        $('#apply-coupan-alert').html("We did not process your payment as PDF Generation failed. Our team is looking into the matter. Please try again in a bit.").removeClass('alert-success').addClass('alert-danger').show();
        $('.loader1').hide();
        $('.backwrap').hide();
      }else {
        $form.get(0).submit();
      }
    }
    function hasActiveRequest(){
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

    $('#payment-form').submit(function(event) {
              //alert("hell ya");
              $("form#payment-form").find('.payment-errors').text("").hide();
              $(".backwrap").show(function(){
                  $(".loader1").show();
              });
              // var $form = $(this);

              // Disable the submit button to prevent repeated clicks
              $(this).find('button').prop('disabled', true);

              // Stripe.card.createToken($form, stripeResponseHandler);
              
              // Prevent the form from submitting with the default action
              return false;
    });
    
    $('#apply_coupon').click(function(){
      $('.loader1').show();
      $('.loader1').removeClass('hidden');
      $('.backwrap').show();
      $('.backwrap').removeClass('hidden');
      $.ajax({
        url:base_url + 'index.php?/coupon/apply_coupon?&code='+$('#coupon_code').val(),
        method:'GET',
        dataType:'json',
        success:function(resp){
          if(resp.status=='success'){
            var amount  = parseFloat($('#invoice-amount').val());
            if (amount<parseFloat(resp.discount) || resp.discount == 0) {
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

    $('#addNewPartner').hide();
    $('.btn.add-partner').on('click', function (event) {
      var itemHtml = '<div class="col-md-6">\
                                  <h2 ><strong>Partner:</strong> Upload Pic &amp; Enter Info <a href="javascript:void(0);" class="remove-partner"><i data-toggle="tooltip" title="" class="icon icon-remove-circle" data-original-title="Remove"></i></a></h2>\
                                  <div class="row">\
                                    <div class="col-md-3">\
                                      <div class="partnerpic">\
                                        <a href="javascript:;">\
                                          <i class="icon-camera"></i><br>\
                                          Upload Picture\
                                        </a>\
                                        <input type="file" class="file-type hidden" >\
                                        <input type="text" class="hidden file-path p_profile_image" name="partner[profile_image][]" value="" >\
                                      </div>\
                                        <div class="partner_companypic">\
                                        <a href="javascript:;">\
                                          <i class="icon-camera"></i><br>\
                                          Upload Company Logo\
                                        </a>\
                                        <input type="file" class="file-type hidden" >\
                                        <input type="text"  class="hidden file-path p_company_logo" name="partner[company_image][]" value="" >\
                                      </div>\
                                    </div>\
                                    <div class="col-md-9">\
                                      <input type="text" class="form-control" id="partner_search"   name="partner[fullname][]"   id="" placeholder="Name"    value="" />\
                                      <input type="text" class="form-control"   name="partner[title][]"      id="" placeholder="Title"   />\
                                      <input type="text" class="form-control"   name="partner[phone][]"      id="" placeholder="Phone"   value=""/>\
                                      <input type="text" class="form-control"   name="partner[email][]"      id="" placeholder="Email"   value=""/>\
                                      <input type="text" class="form-control"   name="partner[licenceno][]"  id="" placeholder="CA BRE#" value=""/>\
                                    </div>\
                                  </div>\
                              </div>';
      $('#addNewPartner').show('slow');
      $('#addNewPartner').append(itemHtml);
    });
    $('#addNewPartner').on('click','.remove-partner',function(){
        console.log("Tru to remove");
        $(this).closest('div').remove();
    });

    // Smart Tab
    $('#tabs').smartTab({autoProgress: false,stopOnFocus:true,transitionEffect:'vSlide',
      onShowTab:function(obj){
        // var cusrrentTab = obj[0]
        // var id = $(cusrrentTab).attr('href')
        // if(id === "#tabs-5"){
        //   $(".backwrap").show(function(){
        //       $(".backwrap").removeClass('hidden');
        //     $(".loader1").show(function(){
        //         $(".loader1").removeClass('hidden');
        //     });
        //   });
        //   var planId = $(cusrrentTab).data('planid');
        //   $('#subscriptionForm-wraper').hide();
        //   $.ajax({
        //       url:base_url + 'index.php?/user/is_subscribed/'+planId,
        //       method:'GET',
        //       dataType: 'json',
        //       success:function(data) {
        //           $(".backwrap").hide(function(){
        //               $(".backwrap").addClass('hidden');
        //             $(".loader1").hide(function(){
        //                 $(".loader1").addClass('hidden');
        //             });
        //           });
        //           $('#api-token-code').html(data.token);
        //           $('#api-token-wrap').show();
        //           if(data.status==true){
        //               var info = data.data;
        //               $('.plan-title').html(info.plan_title);
        //               $('.plan-interval').html(info.interval);
        //               $('.plan-ends').html(info.current_period_end);
        //               $('#subscribed-wrap').show();
        //               $('#ref-code').html(data.ref_code);
        //               $('#ref-code-wrap').show();
        //               if(info.cancel_at_period_end==0)//check if recurring billing is On
        //                   $('#subscribed-wrap .recurring-billing').show();
        //               //Do not show cancel button when it is compnay's subscription plan
        //               if(data.company_plan !== undefined && data.company_plan){
        //                   $('#cancelBtnWrap').hide();
        //               }
                      
        //           } else {
        //               $('#subscriptionForm-wraper').show();
        //               if(data.message !== undefined){
        //                   $('#plan-msg label').html(data.message);
        //               }
        //           }
        //       }
        //   });
        // }
        // return true;
      }
    });
    /** Tabs content was messedup for a second before smartTab initialization 
     * So hide it initially and show it once smartTab initialized 
     */
    $('#tabs').show();
    
    $(".leftpic a").click(function() {    
        console.log("trigger");                                            
          $(this).parents(".leftpic").find(".file-type").trigger("click");
    });

    $(".rightpic a").click(function() {                                                
          $(this).parents(".rightpic").find(".file-type").trigger("click");
    });
    
    $("#addNewPartner").on('click','.partnerpic a',function() {    
        console.log("trigger partner");                                            
          $(this).parents(".partnerpic").find(".file-type").trigger("click");
    });

    $("#addNewPartner").on('click','.partner_companypic a',function() {    
        console.log("trigger");                                            
          $(this).parents(".partner_companypic").find(".file-type").trigger("click");
    });
    $("#addNewPartner").on('change','.partnerpic .file-type',function(){
      var ele = this;
      var file_data = $(this).prop('files')[0];
      var form_data = new FormData();
      form_data.append('fileToUpload', file_data)
      // alert(form_data);                             
      $.ajax({
          url: '<?php echo base_url(); ?>index.php?/user/upload_file', // point to server-side PHP script 
          dataType: 'text', // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(php_script_response) {
              console.log(JSON.parse(php_script_response));
              var object = JSON.parse(php_script_response);
              var picEle = $(ele).closest('.partnerpic');
              if(object.status == 'success'){
                  $(picEle).find('a').html("<img src='<?php echo base_url(); ?>"+object.fileuri+"' style='width:100%'>");
                  $(picEle).find(".p_profile_image").val(object.fileuri);
              } else {
                  $(picEle).find(".p_profile_image").val('no');
              }
          }
      });
    });
    $("#addNewPartner").on('change',".partner_companypic .file-type",function(){
      var ele = this;
      var file_data = $(this).prop('files')[0];
      var form_data = new FormData();
      form_data.append('fileToUpload', file_data)
      // alert(form_data);                             
      $.ajax({
          url: '<?php echo base_url(); ?>index.php?/user/upload_file', // point to server-side PHP script 
          dataType: 'text', // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(php_script_response) { 
            console.log(JSON.parse(php_script_response));
            var object = JSON.parse(php_script_response);
            var picEle = $(ele).closest('.partner_companypic');
            if(object.status == 'success'){
                $(picEle).find('a').html("<img src='<?php echo base_url(); ?>"+object.fileuri+"' style='width:100%'>");
                $(picEle).find(".p_company_logo").val(object.fileuri);
            } else {
                $(picEle).find(".p_company_logo").val('no');
            }
          }
      });
    });
    
    $(".leftpic .file-type").change(function(){
      var ele = this;
      var file_data = $(this).prop('files')[0];
      var form_data = new FormData();
      form_data.append('fileToUpload', file_data)
      // alert(form_data);                             
      $.ajax({
        url: '<?php echo base_url(); ?>index.php?/user/upload_file/profile-image', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response) {
          var object = JSON.parse(php_script_response);
          if (object.status=='success') {
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
              $(element[0]).val('<?php echo base_url(); ?>'+object.fileuri);
              
              if($('#agent_profile_image')){
                $('#agent_profile_image').attr('value',object.fileuri);
              }
          } else {
            alert(object.msg);
          }
        }
      });
    });

    $(".rightpic .file-type").change(function(){
        var file_data = $(this).prop('files')[0];
          var form_data = new FormData();
          form_data.append('fileToUpload', file_data)                   
          $.ajax({
              url: '<?php echo base_url(); ?>index.php?/user/upload_file/company-image', // point to server-side PHP script 
              dataType: 'text', // what to expect back from the PHP script, if anything
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,
              type: 'post',
              success: function(php_script_response) {
                  var object = JSON.parse(php_script_response);
                  if (object.status=='success') {
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
                    alert(object.msg);
                  }
              }
          });
    });

    $(document).on("focusin", "[name=email]", function(event) {
      $(this).prop('readonly', true);
    });

    $(document).on("focusout", "[name=email]", function(event) {
      $(this).prop('readonly', false);
    });

    $('#loginInfoForm').submit(function(){
      if( !$(this).valid() ){
           return false;
      }else{
        var form_data = $(this).serializeArray();
        $.ajax({
                url: '<?php echo base_url(); ?>index.php?/user/update_password', // point to server-side PHP script 
                // dataType: 'text', // what to expect back from the PHP script, if anything
                // cache: false,
                // contentType: false,
                // processData: false,
                data: form_data,
                method: 'post',
                success: function(php_script_response) {
                    
                    console.log(JSON.parse(php_script_response));
                    var object = JSON.parse(php_script_response);
                    if (object.status=="success") {
                        $('#loginInfoForm .alert').html(object.message).show();
                        setTimeout(function(){
                          $('#loginInfoForm .alert').fadeOut(1500);
                        },2000);
                    } else {
                      $('#loginInfoForm .alert').removeClass('alert-success').addClass('alert-danger').html(object.message).show();
                        setTimeout(function(){
                          $('#loginInfoForm .alert').fadeOut(1500);
                        },2000);
                    }
                }
        });
      }
      return false;
    });

    $("#loginInfoForm").validate({
        rules:{
          old_password:{
            required:true
          },
          new_password:{
            required: true
          },
          confirm_password:{
            required: true,
            equalTo:'#new_password'
          }

        },
        messages:{
          old_password:"Please enter your current password",
          new_password:"Please enter new password",
          confirm_password:"Confirm password should be same as new password"
        }
    });

    $('#agentInfoForm').submit(function(){
      // console.log($(this).serialize());
      if( !$(this).valid() ){
           return false;
      }else{

        var form_data = $(this).serializeArray();
        $.ajax({
                url: '<?php echo base_url(); ?>index.php?/user/update_agentinfo', // point to server-side PHP script 
                // dataType: 'text', // what to expect back from the PHP script, if anything
                // cache: false,
                // contentType: false,
                // processData: false,
                data: form_data,
                method: 'post',
                success: function(php_script_response) {
                    
                    console.log(JSON.parse(php_script_response));
                    var object = JSON.parse(php_script_response);
                    if (object.status=="success") {
                        $('#agentInfoForm .alert').html(object.message).show();
                        setTimeout(function(){
                          $('#agentInfoForm .alert').fadeOut(1500);
                        },2000);
                    } else {

                    }
                }
        });
        return false;
      }
    });

    $("#agentInfoForm").validate({
        rules:{
          first_name:{
            required:true
          },
          last_name:{
            required: true
          },
          phone:{
            required: true,
            minlength: 10,
            maxlength: 10
          },
          email:{
            required: true
          }

        },
        messages:{
          old_password:"",
          password:"",
          pass_confirm:""
        }
    });

    $('#companyInfoForm').submit(function(){
      var form_data = $(this).serializeArray();
      $.ajax({
              url: '<?php echo base_url(); ?>index.php?/user/update_copmpanyinfo', // point to server-side PHP script 
              data: form_data,
              method: 'post',
              success: function(php_script_response) {
                  
                  console.log(JSON.parse(php_script_response));
                  var object = JSON.parse(php_script_response);
                  if (object.status=="success") {
                      $('#companyInfoForm .alert').html(object.message).show();
                      setTimeout(function(){
                        $('#companyInfoForm .alert').fadeOut(1500);
                      },2000);
                  } else {

                  }
              }
      });
      return false;
    });

    $("#agentBillingInfo").validate({
        rules:{
          billing_cvv_code:{
            required:true,
            minlength: 3,
            maxlength: 3
          },
          billing_zipcode:{
            required: true,
            minlength: 5,
            maxlength: 6
          },
          billing_creadit_card_no:{
            required: true,
            creditcard: true
          }

        },
        messages:{
          old_password:"",
          password:"",
          pass_confirm:""
        }
    });

    $('#agentBillingInfo').submit(function(){
      var form_data = $(this).serializeArray();
      $.ajax({
              url: '<?php echo base_url(); ?>index.php?/user/update_copmpanyinfo', // point to server-side PHP script 
              data: form_data,
              method: 'post',
              success: function(php_script_response) {
                  
                  console.log(JSON.parse(php_script_response));
                  var object = JSON.parse(php_script_response);
                  if (object.status=="success") {
                      $('#companyInfoForm .alert').html(object.message).show();
                      setTimeout(function(){
                        $('#companyInfoForm .alert').fadeOut(1500);
                      },2000);
                  } else {

                  }
              }
      });
      return false;
    });

    $('#agentDefaultTheme').click(function(){
      console.log($('.custom-checkbox:checked').val());
      $.ajax({
              url: '<?php echo base_url(); ?>index.php?/user/update_defaulttheme', // point to server-side PHP script 
              data: {theme:$('.custom-checkbox:checked').val()},
              method: 'post',
              success: function(php_script_response) {
                  
                  console.log(JSON.parse(php_script_response));
                  var object = JSON.parse(php_script_response);
                  if (object.status=="success") {
                      $('#agentDefaultThemeForm .alert').html(object.message).show();
                      setTimeout(function(){
                        $('#agentDefaultThemeForm .alert').fadeOut(1500);
                      },2000);
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
    if($('#subscriptionForm').length){
        $('#subscriptionForm').get(0).submit = function() {
            var form_data = $(this).serializeArray();
            $.ajax({
                    url: '<?php echo site_url('user/pay_subscription'); ?>', // point to server-side PHP script 
                    data: form_data,
                    method: 'post',
                    dataType: 'json',
                    success: function(object) {
                        if (object.status) {
                            $('#subscriptionForm .alert').html(object.message).show();
                            $('#subscriptionForm-wraper').hide();
                            var info = object.data;
                            $('.plan-title').html(info.plan_title);
                            $('.plan-interval').html(info.interval);
                            $('.plan-ends').html(info.current_period_end);
                            $('#subscribed-wrap').show();
                            if(info.cancel_at_period_end==0)//check if recurring billing is On
                                $('#subscribed-wrap .recurring-billing').show();
                            setTimeout(function(){
                                $('#subscriptionForm .alert').fadeOut(2000);
                            },2000);
                        } else {
                            $('#subscriptionForm .alert').html(object.message).show();
                            setTimeout(function(){
                                $('#subscriptionForm .alert').fadeOut(2000);
                            },2000);
                        }
                        jQuery(".loader1").hide();
                        jQuery(".loader1").addClass('hidden');
                        jQuery(".backwrap").hide();
                        jQuery(".backwrap").addClass('hidden');
                    }
            });
        }
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
      else {

        $(this).parents("#step-4").find('.order-detail').hide("slow");
        $(this).parents("#step-4").find('.order-summary').show("slow");
        $(".actionBar").hide("slow");
        $(".btn-checkout").hide("slow");
        $(".btn-pay").show("slow");

        // window.location.href="#top";
        setTimeout(function(){
          $(document).scrollTop(0);
        },500);
        //Call Session id
        var presentation_type = $("#presentation").val().toLowerCase();
        $('.selected_pkg_val').text(pkg_prices[presentation_type].val);
        $('.selected_pkg_val').val(pkg_prices[presentation_type].val);
        // $('.selected_pkg_title').html(pkg_prices[presentation_type].title);
        
        if(!(pkg_prices[presentation_type].active == 1 || pkg_prices['all'].active == 1)) {

            // $('.loader1').show();
            // $('.loader1').removeClass('hidden');
            // $('.backwrap').show();
            // $('.backwrap').removeClass('hidden');

            let elements = stripe.elements();

            var style = {
              base: {
                color: "#32325d",
                fontFamily: 'Arial, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                  color: "#32325d"
                }
              },
              invalid: {
                fontFamily: 'Arial, sans-serif',
                color: "#fa755a",
                iconColor: "#fa755a"
              }
            };

            let card = elements.create('card', { style: style });
            card.mount('#card-element');

            card.on('change', function (event) {
              document.querySelector("#stripe-submit").disabled = event.empty;
              document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
              if(event.error) {
                $("#card-error").show();
              }
              else {
                $("#card-error").hide();
              }
            });

            
            document.getElementById("stripe-submit").disabled = true;

            const btn = document.querySelector('#stripe-submit');
            btn.addEventListener('click', async (e) => {
              e.preventDefault();
              loading(true);
              let nameInput = '<?php echo $this->session->userdata('username')?>';
              
              let coupon_id = $("#coupon-id").val();
              fetch('<?php echo base_url("user/createPaymentIntent"); ?>', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                   pkg_id: presentation_type,coupon_id: coupon_id
                }),
              })
              .then(response => response.json())
              .then(data => {
                if(data.status == true) {
                  stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: {
                      card: card,
                      billing_details: {
                        name: nameInput,
                        email : '<?php echo $agentInfo->email; ?>',
                        address : {
                          line1 : '510 Townsend St',
                          postal_code : '98140',
                          city : 'San Francisco',
                          state : 'CA',
                          country : 'US',
                        }
                      },
                    }
                  }).then((result) => {
                    if(result.error) {
                      showError(result.error.message);
                    } else {
                      $("#payment-success").html("Success");
                      $("#payment_intent_id").val(result.paymentIntent.id);
                      doSubmit();
                      // Successful payment
                    }
                  });
                }
                else {
                  showError(data.message);
                }
              })
              .catch((error) => {
                console.error('Error:', error);
              });

            });
            
        }

        //$("#stripe_chk_btn").trigger("click");
      }
      // console.log("Bypassed");
      // $(this).parents("#step-4").find('.order-detail').hide("slow");
      // $(this).parents("#step-4").find('.order-summary').show("slow");
      // $(".actionBar").hide("slow");
      // $(".btn-checkout").hide("slow");
      // $(".btn-pay").show("slow");
      // // window.location.href="#top";
      // setTimeout(function(){
      //   $(document).scrollTop(0);
      // },500);
    });
    
    $(".btn-review").click(function(){
      $(this).parents("#step-4").find('.order-detail').show("slow");
      $(this).parents("#step-4").find('.order-summary').hide("slow");
      $(".actionBar").show("slow");
      $(".btn-checkout").show("slow");
      $(".btn-pay").hide("slow");
    });
  });

  var base_url = '<?php echo base_url(); ?>';

  function delete_lp(lp_id, from){
    if(confirm('Sure to Delete?')){
      window.location = base_url+'index.php?/user/delete_lp/'+lp_id +'/' + from;
    }
  }
  $(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
      // $("body").tooltip({ selector: '[data-bs-toggle=tooltip]', placement:'left' });

      $(window).on("scroll", function () {
          if ($(window).scrollTop() > 50) {
              $("header.overlapping").addClass("overlapping-down");
          } else {
              $("header.overlapping").removeClass("overlapping-down");
          }
      });
  });
  $("#forward-report").on("show.bs.modal", function(e) {
      var projectID = $(e.relatedTarget).data('id');
      $(this).find("#project-id").val(projectID);
  });
  $("#sms-report").on("show.bs.modal", function(e) {
      var projectID = $(e.relatedTarget).data('id');
      $(this).find("#sms-report-id").val(projectID);
  });
  function check_subscription(){
      $.ajax({
          url:base_url + '/user/is_subscribed/prem_lp_user',
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
  //Display Notification/Error/Success
  $(document).ready(function(){
      <?php if ($this->session->flashdata('success')): ?>
      Notify('Success', '<?php echo $this->session->flashdata('success') ?>', 'success');
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')) : ?>
      Notify('Error', '<?php echo $this->session->flashdata('error') ?>', 'error');
      <?php endif; ?>
      $(".btn-user-logout-click").click(function() {
          $.ajax({
              url: '<?php echo site_url('auth/logout/format/json/'); ?>',
              method: 'get'
          }).success(function(resp) {
              var obj = resp;
              if (obj.status == "success") {
                  window.location = '<?php echo site_url(); ?>';
              }
              if (obj.status == "error") {
                  var msg = obj.msg;
                  Notify('Login Error', msg, 'error');
              }
          });
          return false;
      });
  });
</script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        if($('.final-tiles-gallery').length) {
            $('.final-tiles-gallery').finalTilesGallery({
                margin: 20,
                gridSize: 80,
                layout: 'columns'
            });
            $('.final-tiles-gallery').magnificPopup({
                    delegate: '.tile:not(.ftg-hidden) .tile-inner',
                    type: 'image',
                    gallery: {
                            enabled: true,
                            navigateByImgClick: true,
                            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
            });
        }

        if($('.myaccount  #preview_pages ').length) {

          
          $('.myaccount .theme_selection_div .select_change').change(function() {

            if($(this).attr('id') == "select-theme-type") {
              $("#select-theme option[value='2']").prop('disabled', false);
              $("#select-theme option[value='3']").prop('disabled', false);
              $(".subscribe_notice").hide();
              if($(this).val() == 'buyer') {
                $("#select-theme").val(default_sub_type_buyer);
                $("#select-color").val(default_color_buyer);
                if(active_buyer == 0 && active_all == 0) {
                  $("#select-theme").val(1);
                  $("#select-theme option[value='2']").prop('disabled', true);
                  $("#select-theme option[value='3']").prop('disabled', true);
                  $("#rep_type").html('Buyer');
                  $(".subscribe_notice").show();
                }
              }
              else if($(this).val() == 'seller') {
                $("#select-theme").val(default_sub_type_seller);
                $("#select-color").val(default_color_seller);
                if(active_seller == 0 && active_all == 0) {
                  $("#select-theme").val(1);
                  $("#select-theme option[value='2']").prop('disabled', true);
                  $("#select-theme option[value='3']").prop('disabled', true);
                  $("#rep_type").html('Seller');
                  $(".subscribe_notice").show();
                }
              }
              else if($(this).val() == 'marketUpdate') {
                $("#select-theme").val(default_sub_type_mu);
                $("#select-color").val(default_color_mu);
                if(active_mu == 0 && active_all == 0) {
                  $("#select-theme").val(1);
                  $("#select-theme option[value='2']").prop('disabled', true);
                  $("#select-theme option[value='3']").prop('disabled', true);
                  $("#rep_type").html('Market Update');
                  $(".subscribe_notice").show();
                }
              }
            }

            var theme_type = $("#select-theme-type").val();
            var theme_sub_type = $("#select-theme").val();
            $.ajax({
              url:base_url + 'user/getPreviews',
              method:'POST',
              data : {theme_type:theme_type,theme_sub_type,theme_sub_type},
              success:function(resp){
                $('.myaccount #preview_pages').html(resp)
              }
            });
          });

          $('#agentDefaultTheme_save').click(function(){
            $(this).prop('disabled', true);
            var theme_type = $("#select-theme-type").val();
            var theme_sub_type = $("#select-theme").val();
            var theme_color = $("#select-color").val();

            $.ajax({
              url:base_url + 'user/saveTheme',
              method:'POST',
              data : {theme_type:theme_type,theme_sub_type,theme_sub_type,theme_color:theme_color},
              dataType:'json',
              success:function(resp){
                if (resp.status=="success") {
                    $('#theme .alert').html(resp.message).show();
                    setTimeout(function(){
                      $('#theme .alert').fadeOut(1500);
                    },2000);
                } else {

                }
                $('#agentDefaultTheme_save').prop('disabled', false);

              },
              error: function(error) {
                $('#agentDefaultTheme_save').prop('disabled', false);
              }
            });

            if(theme_type == 'buyer') {
              default_sub_type_buyer = theme_sub_type;
              default_color_buyer = theme_color;
            }
            else if(theme_type == 'seller') {
              default_sub_type_seller = theme_sub_type;
              default_color_seller = theme_color;
            }
            else if(theme_type == 'marketUpdate') {
              default_sub_type_mu = theme_sub_type;
              default_color_mu = theme_color;
            }

          });
        }
    });
    </script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lp.js?v=0.20"></script>
</body>
</html>