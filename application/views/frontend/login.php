
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
                            <h2>Account Login</h2>
                            <p>Enter your email and password below to login to your account.</p>
                        </div>
                        <div class="login-form">
                            <form id="login-form" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="uemail" id="uemail" placeholder="Email" >
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="upass" id="upass" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <!-- <div class="create-acc">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked="checked">
                                                <span>Remember Password</span>
                                            </label>
                                        </div>
                                    </div> -->
                                    <div class="">
                                        <button id="login-form-submit-btn" type="submit" class="theme-btn">Login Account</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="creat-account">Dont remember password? <a href="<?php echo base_url('frontend/forgot_password') ?>">Click Here</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login-page-section end -->
