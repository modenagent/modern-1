

<!-- jequery plugins -->
<script src="<?php echo base_url(); ?>/assets/login/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>/assets/login/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/login/js/bootstrap.min.js"></script>


<script src="<?php echo base_url(); ?>/assets/login/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>/assets/login/js/appear.js"></script>
<script src="<?php echo base_url(); ?>/assets/login/js/jquery.paroller.min.js"></script>

<!-- main-js -->
<script src="<?php echo base_url(); ?>/assets/login/js/script.js"></script>

<script src="<?php echo base_url(); ?>/assets/js/jquery-toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/jquery-toastr/ui-toastr-notifications.js"></script>
<script src="<?php echo base_url(); ?>/assets/frontend/js/jquery.validate.min.js"></script>

<script type="text/javascript">
	function Notify(title,message,type) {
		var div_id = $.now()+'_alert';
		if(type == 'error') {
			var div_alert = `<div id="`+div_id+`" class="alert alert-danger" role="alert">`+message+`</div>`;
		}
		else {
			var div_alert = `<div id="`+div_id+`" class="alert alert-success" role="alert">`+message+`</div>`;
		}
		$('.sec-title').append(div_alert);
		setTimeout(function(){
		  if ($('#'+div_id).length > 0) {
		    $('#'+div_id).remove();
		  }
		}, 5000);
	}
    // stopping form from submitting on enter key press
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
        });

        $(window).on("scroll", function () {
            if ($(window).scrollTop() > 50) {
                $("header.overlapping").addClass("overlapping-down");
            } else {
                $("header.overlapping").removeClass("overlapping-down");
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
    $(document).ready(function() {

        $("#forgot-form").validate({
            rules:{
                f_uemail:{
                    required:true,
                    email: true
                }
            },
            messages:{
                f_uemail: {
                    required: "Please enter email address",
                    email: "Please enter valid email address"
                }
            }
        });

        // forgot form submit
        $("#forgot_submit").click(function() {
            if ( !$("#forgot-form").valid() ) {
                return false;
            } else {
                $('#forgot_submit').val('Processing Request...');
                $('#forgot_submit').attr('disabled',true);

                var postData = $('#forgot-form').serialize();
                var user_email = $("#f_uemail").val();

                $.ajax ({
                    url: "<?php echo site_url('auth/userforgotpass/format/json/'); ?>",
                    method: 'post',
                    dataType: "json",
                    data: {
                        uemail: user_email
                    }
                })
                .success(function(resp) {
                    var obj = resp;var msg = obj.msg;
                    if (obj.status == "success") {
                        // submit button disable
                        // $('#login-form').show();
                        // $('#forgot-form').hide();
                        // $('#forgot-form').trigger("reset");
                        Notify('Password reset', msg, 'success');
                        location.href="<?php echo base_url('frontend/login'); ?>";
                    }
                    if (obj.status == "error" || obj.status == "failed") {
                        var msg = obj.msg;
                        Notify('Error', msg, 'error');
                    }
                    $('#forgot_submit').val('Recover Password');
                    $('#forgot_submit').attr('disabled',false);
                });

                return false;
            }
        });


        $("#login-form").validate({
            rules:{
                uemail:{
                    required:true,
                    email: true
                },
                upass:{
                    required: true
                }
            },
            messages:{
                uemail: {
                    required: "Please enter email address",
                    email: "Please enter valid email address"
                },
                upass: {
                    required: "Please enter password",
                }
            }
        });

        $('#login-form #uemail').keyup(function(e){
            if(e.keyCode == 13) { $('#login-form-submit-btn').trigger('click'); }
        });
        $('#login-form #upass').keyup(function(e){
            if(e.keyCode == 13) { $('#login-form-submit-btn').trigger('click'); }
        });

        // login form submit
        $("#login-form").submit(function(e) {
            e.preventDefault();
            // if ( !$(this).valid() ) {
            //     return false;
            // } else {
                var uname = $("#uemail").val();
                var upass = $("#upass").val();
                if ($.trim(uname) == '' || $.trim(upass) == '') {
                    return false;
                }
                $('.preloader').fadeIn(200);
                $('#login-form-submit-btn').text('Please wait...');
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
                    $('#login-form-submit-btn').text('Login Account');
                    $('.preloader').fadeOut(200);
                });
                return false;
            // }
        });

        var base_url = '<?php echo base_url(); ?>';
	    $("#register-form").validate({
	        rules:{
	            fname:{
	                required:true
	            },
	            lname:{
	                required: true
	            },
	            uphone:{
	                required: true,
	                number:true,
	                minlength: 10,
	                maxlength: 12
	            },
	            uemail:{
	                required: true,
	                email: true
	            },
	            user_pass:{
	                required: true
	            },
	            cpassword:{
	                required: true,
	                equalTo:'#user_pass'
	            }
	        },
	        messages:{
	            fname: {
	                required: "Please enter first name",
	            },
	            lname: {
	                required: "Please enter last name",
	            },
	            uphone: {
	                required: "Please enter Phone No."
	            },
	            uemail: {
	                required: "Please enter email address",
	                email: "Please enter valid email address"
	            },
	            user_pass: {
	                required: "Please enter password",
	            },
	            cpassword: {
	                required: "Please enter password again",
	                equalTo: "Confirm password should be same as password"
	            }
	        }
	    });

	    $('#create-account').click(function() {
	        if ( !$('#register-form').valid() ) {
	            return false;
	        } else {
                console.log('Register stat');
                $('.preloader').fadeIn(200);
                $('#create-account').prop('disabled', true);
                $('#create-account').text('Please wait...');
                // alert('test registration');
                // return false;
	            $('#register-form').submit();
	        }
	    });

	    $('.numeric').on('input', function (event) {
	        this.value = this.value.replace(/[^0-9]/g, '');
	    });

	    $('.alphanumeric').on('input', function (event) {
	        this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
	    });

    });
</script>


</body><!-- End of .page_wrapper -->
</html>
