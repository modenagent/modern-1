<div class="user-footer">
  <div class="section upper-footer">
        <div class="container">
            <div class="row">
                <div class="upper-footer-wrapper">
                    <div class="col-md-3">
                        <div class="md_agent">
                            <h3 id="modern">MODERN AGENT</h3>
                            <p id="mod_para"><small>we are all about helping real estate agents make the perfect impression.</small></p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        
                        <ul class="nav navbar-nav below_main pull-right">
                            <li class="below"><a href="#">AFFILIATE</a></li>
                            <li class="below"><a href="#">CONTACT</a></li>
                            <li class="below"><a href="#">RELEASE NOTES</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section lower-footer section-alternate">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="left">
                        <p class="font">www.modernagent.io</p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center">
                        <p class="font fontc">&COPY; 2017. MODERN AGENT. ALL RIGHTS RESERVED.</p>
                    </div>
                </div>
                <div class="col-md-1 col-md-offset-1">
                    <ul class="social-links">
                        <a href="#">
                            <li class="fb" aria-hidden="true"></li>
                        </a>
                        <a href="#">
                            <li class="twitter" aria-hidden="true"></li>
                        </a>
                        <a href="#">
                            <li class="insta" aria-hidden="true"></li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--toastr js-->
<script src="<?php echo base_url(); ?>assets/js/jquery-toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-toastr/ui-toastr-notifications.js"></script> `
<script type="text/javascript">
    // stopping form from submitting on enter key press
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
        });
    });
    // show the forgot password form
    $('.fp-link').click(function(){
        $('#login-form').hide();
        $('#forgot-form').show();
    });
    // show the login form
    $('#login-link').click(function(){
        $('#login-form').show();
        $('#forgot-form').hide();
    });
    // forgot form submit
    $("#forgot_submit").click(function() {
         $('#forgot_submit').val('Processing Request...');
         $('#forgot_submit').attr('disabled',true);

         var postData = $('#forgot-form').serialize();
         var user_email = $("#f_uemail").val();

         $.ajax ( {url: "<?php echo site_url('auth/userforgotpass/format/json/'); ?>",method: 'post',data: {uemail: user_email}}).success(function(resp) {
                 var obj = resp;var msg = obj.msg;
                 if (obj.status == "success") {
                     // submit button disable 
                     $('#login-form').show();
                     $('#forgot-form').hide();
                     $('#forgot-form').trigger("reset");
                     Notify('Password reset', msg, 'success');
                 }
                 if (obj.status == "error") {
                    var msg = obj.msg;
                    Notify('Error', msg, 'error');
                 }
                $('#forgot_submit').val('Recover Password');
                $('#forgot_submit').attr('disabled',false);
         });

         return false;
    });
    $(document).ready(function() {
    // login form submit
        $("#login-form").submit(function() {
            var uname = $("#uemail").val();
            var upass = $("#upass").val();
            if ($.trim(uname) == '' || $.trim(upass) == '') {
                return false;
            }
            $.ajax({
                url: '<?php echo site_url('auth/userlogin/format/json/'); ?>',
                method: 'post',
                data: {
                    uemail: uname,
                    upass: upass
                }
            }).success(function(resp) {
                var obj = resp;
                if (obj.status == "success") {
                    window.location = '<?php echo site_url('user/dashboard'); ?>';
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
