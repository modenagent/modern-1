
<a id="top"></a>	
<div id="login-page" class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-md-offset-4">
                <div class="logo-container">
                    <a href="#"><img id="header_logo" class="" width="170px" src="<?php echo base_url(); ?>assets/images-2/logo.png" class="img-responsive" ></a>
                </div>
                <div class="sign-in-container">
                    <form action="#" class="login-wrapper" method="post" id="register-form" >
                        <div class="header">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h3>Register on Modern Agent</h3>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="form-group">
                                <label for="userName">First Name</label>
                                <input type="text" class="form-control" name="fname"  id="fname" placeholder="First Name" value="<?= set_value('fname'); ?>">
                                <span class="alert-danger"><?= form_error('fname'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="userName">Last Name</label>
                                <input type="text" class="form-control" name="lname"  id="lname" placeholder="Last Name" value="<?= set_value('lname'); ?>">
                                <span class="alert-danger"><?= form_error('lname'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="userName">Email Address</label>
                                <input type="text" class="form-control"  name="uemail" id="uemail" placeholder="Email" value="<?= set_value('uemail'); ?>">
                                <span class="alert-danger"><?= form_error('uemail'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="userName">Referral Code</label>
                                <input type="text" class="form-control"  name="ref_code" id="ref_code" placeholder="Referral Code" value="<?= set_value('ref_code'); ?>">
                                <span class="alert-danger"><?= form_error('ref_code'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="userName">Company Name</label>
                                <input type="text" class="form-control"   name="cname" id="cname"  placeholder="Company Name" value="<?= set_value('cname'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="userName">Company Street Address</label>
                                <input type="text" class="form-control" name="caddress" id="caddress" placeholder="Company Street Address" value="<?= set_value('caddress'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="userName">Company City</label>
                                <input type="text" class="form-control" name="ccity" id="ccity" placeholder="Company City" value="<?= set_value('ccity'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="userName">Company Zipcode</label>
                                <input type="text" class="form-control" name="czipcode" id="czipcode" placeholder="Company Zipcode" value="<?= set_value('czipcode'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="Password1">Password</label>
                                <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="Password">
                                <span class="alert-danger"><?= form_error('user_pass'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="Password1">Confirm Password</label>
                                <input type="password" class="form-control" name="cpassword" id="user_pass" placeholder="Confirm Password">
                                <span class="alert-danger"><?= form_error('cpassword'); ?></span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="col-sm-1" name="do_subscribe" style="height:25px; width:25px; margin-bottom:10px; margin-top:0px; border: 2px solid #ffffff;" value="1" >
                                <label for="do_subscribe" class="col-sm-10" style="display: block;color:#000; font-size:13.5px;">Check Box Monthly Plan</label>
                            </div>

                            <div class="form-group m-b-0">
                                <input class="btn btn-lp" name="Register" type="submit" value="Create Account Now">
                            </div>
                        </div>
                        <div class="actions">
                            <span class="reg-btns">Have an account already? | <a href="<?php echo base_url(); ?>frontend/login" class="login-link">Login Here</a></span>
                        </div>
                    </form>
                    <form action="" class="login-wrapper" method="post" id="fp-form" style="display:none;">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h3>Recover Your Password</h3>
                                </div> 
                            </div>
                        </div>
                        <div class="content">
                            <div class="form-group">
                                <label for="userName">Email</label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="Email">
                            </div>
                            <div class="form-group m-b-0">
                                <input class="btn btn-lp" name="Login" type="submit" value="Reset Password">
                            </div>
                        </div>
                        <div class="actions">
                            <span class="reg-btns">Have an account already? | <a href="javascript:;" class="login-link">Login Here</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
	
  