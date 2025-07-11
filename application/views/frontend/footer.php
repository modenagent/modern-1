
            <!-- DIVIDER LINE -->
            <hr class="divider">




            <!-- FOOTER-4
			============================================= -->
			<footer id="footer-4" class="footer division">
				<div class="container">


					<!-- FOOTER CONTENT -->
					<div class="row">


						<!-- FOOTER INFO -->
						<div class="col-lg-3">
							<div class="footer-info mb-40 mt-100">
								<img class="footer-logo" src="<?php echo base_url(); ?>/assets/frontend/images/Logo_dark.jpeg" alt="footer-logo">
							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-2 col-lg-2 col-xl-2 offset-xl-1">
							<div class="footer-links mb-40">

								<!-- Title -->
								<h6 class="h6-xl">About</h6>

								<!-- Footer Links -->
								<ul class="foo-links text-secondary clearfix">
									<li><p class="p-md"><a href="#">About Us</a></p></li>
									<li><p class="p-md"><a href="#">Our Team</a></p></li>
									<li><p class="p-md"><a href="#">Press & Media</a></p></li>

								</ul>

							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-2">
							<div class="footer-links mb-40">

								<!-- Title -->
								<h6 class="h6-xl">Discover</h6>

								<!-- Footer List -->
								<ul class="foo-links text-secondary clearfix">
									<li><p class="p-md"><a href="#">Our Blog</a></p></li>
									<li><p class="p-md"><a href="#">Plans & Pricing</a></p></li>
									<li><p class="p-md"><a href="#">Cookie Policy</a></p></li>
								</ul>

							</div>
						</div>


                        <!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-2">
							<div class="footer-links mb-40">

								<!-- Title -->
								<h6 class="h6-xl">Support</h6>

								<!-- Footer List -->
								<ul class="foo-links text-secondary clearfix">
									<li><p class="p-md"><a href="#">FAQs</a></p></li>
									<li><p class="p-md"><a href="#">Knowledge Base</a></p></li>
									<li><p class="p-md"><a href="#">Contact Us</a></p></li>
								</ul>

							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2">
							<div class="footer-links mb-40">

								<!-- Title -->
								<h6 class="h6-xl">Connect With Us</h6>

								<!-- Social Links -->
								<ul class="footer-socials text-secondary ico-25 text-center clearfix">
									<li><a href="#"><span class="flaticon-facebook"></span></a></li>
									<li><a href="#"><span class="flaticon-twitter"></span></a></li>
									<li><a href="#"><span class="flaticon-instagram"></span></a></li>
									<li><a href="#"><span class="flaticon-youtube"></span></a></li>
								</ul>

							</div>
						</div>


                    </div>  <!-- END FOOTER CONTENT -->


                    <hr>


                    <!-- BOTTOM FOOTER -->
                    <div class="bottom-footer">
                        <div class="row row-cols-1 row-cols-md-2 d-flex align-items-center">


                            <!-- FOOTER COPYRIGHT -->
                            <div class="col">
                                <div class="footer-copyright">
                                    <p>&copy; 2021-2022 CMA. All Rights Reserved</p>
                                </div>
                            </div>


                            <!-- BOTTOM FOOTER LINKS -->
                            <div class="col">
                                <ul class="bottom-footer-list text-secondary text-end">
                                    <li class="first-li"><p><a href="#">Privacy Policy</a></p></li>
                                    <li class="last-li"><p><a href="#">Terms & Conditions</a></p></li>
                                </ul>
                            </div>


                        </div>  <!-- End row -->
                    </div>  <!-- BOTTOM FOOTER -->


                </div>
            </footer>   <!-- FOOTER-4 -->




        </div>  <!-- END PAGE CONTENT -->

        <!-- EXTERNAL SCRIPTS
        ============================================= -->
        <script src="<?php echo base_url(); ?>/assets/frontend/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/modernizr.custom.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/jquery.easing.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/jquery.appear.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/jquery.scrollto.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/menu.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/isotope.pkgd.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/quick-form.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/request-form.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/jquery.ajaxchimp.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/frontend/js/wow.js"></script>

        <!-- Custom Script -->
        <script src="<?php echo base_url(); ?>/assets/frontend/js/custom.js"></script>

<script type="text/javascript">
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
                        $('#login-form').show();
                        $('#forgot-form').hide();
                        $('#forgot-form').trigger("reset");
                        Notify('Password reset', msg, 'success');
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
                $('#login-form-submit-btn').val('Please wait...');
                $.ajax({
                    url: '<?php echo site_url('auth/userlogin/format/json/'); ?>',
                    method: 'post',
                    data: {
                        uemail: uname,
                        upass: upass
                    }
                }).success(function(resp) {
                    $('#login-form-submit-btn').val('Login');
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
            // }
        });

    });
</script>
