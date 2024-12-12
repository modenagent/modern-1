
<div class="login-btn pull-right"><a href="<?php echo base_url('frontend/register') ?>"><i class="flaticon-user"></i>Create Account</a></div>
                </div>
            </div>
        </div>
        <div class="main-content-box">
            <div class="outer-container clearfix">
                <div class="left-column">
                    <div class="inner-box">

                      <a href="<?php echo base_url(); ?>"><img class="loglogo" src="<?php echo base_url(); ?>/assets/login/images/Logo_light.jpeg" alt=""></a>


                    </div>
                </div>
                <div class="right-column clearfix">
                    <div class="inner-box">
                        <div class="sec-title">
                            <h2>Reset Password</h2>
                            <p>Please update your password.</p>
                        </div>
                        <div class="reset-password-form">
                            <form id="reset-password-form" method="post">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
                                    <input type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <button id="reset-password-submit-btn" type="button" class="theme-btn">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="creat-account">Switch to Login? <a href="<?php echo base_url('frontend/login') ?>">Click Here To Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login-page-section end -->
