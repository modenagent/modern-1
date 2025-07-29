<div class="login-btn pull-right"><a href="<?php echo base_url('frontend/login'); ?>"><i class="flaticon-user"></i>Got Account? Click Here</a></div>
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
                            <h2>Create Account</h2>
                            <p>Fill the fields below to create your account.</p>
                        </div>
                        <?php if (isset($errors) && $errors !== ''): ?>
                            <div class="alert alert-danger">
                                <?php echo $errors; ?>
                            </div>
                        <?php endif; ?>
                        <div class="login-form">
                            <form id="register-form" method="post">
                                <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class=" alphanumeric" name="fname"  id="fname" placeholder="First Name" value="<?=set_value('fname');?>">
                                <span class="register-alert-danger"><?=form_error('fname');?></span>
                            </div>
                            <div class="form-group">
                                <label for="userName">Last Name</label>
                                <input type="text" class=" alphanumeric" name="lname"  id="lname" placeholder="Last Name" value="<?=set_value('lname');?>">
                                <span class="register-alert-danger"><?=form_error('lname');?></span>
                            </div>
                            <div class="form-group">
                                <label for="uemail">Email Address</label>
                                <input type="text" class=""  name="uemail" id="uemail" placeholder="Email" value="<?=set_value('uemail');?>">
                                <span class="register-alert-danger"><?=form_error('uemail');?></span>
                            </div>
                            <div class="form-group">
                                <label for="uphone">Phone</label>
                                <input type="text" maxlength="14" class="numeric"  name="uphone" id="uphone" placeholder="Phone no." data-mask="(999) 999-9999" value="<?=set_value('uphone');?>">
                                <span class="register-alert-danger"><?=form_error('uphone');?></span>
                            </div>
                            <div class="form-group">
                                <label for="userName">Referral Code</label>
                                <input type="text" class=""  name="ref_code" id="ref_code" placeholder="Referral Code" value="<?=set_value('ref_code');?>">
                                <span class="register-alert-danger"><?=form_error('ref_code');?></span>
                            </div>
                            <div class="form-group">
                                <label for="userName">Company Name</label>
                                <input type="text" class=" alphanumeric"   name="cname" id="cname"  placeholder="Company Name" value="<?=set_value('cname');?>">
                            </div>
                            <div class="form-group">
                                <label for="userName">Company Street Address</label>
                                <input type="text" class="" name="caddress" id="caddress" placeholder="Company Street Address" value="<?=set_value('caddress');?>">
                            </div>
                            <div class="form-group">
                                <label for="userName">Company City</label>
                                <input type="text" class=" alphanumeric" name="ccity" id="ccity" placeholder="Company City" value="<?=set_value('ccity');?>">
                            </div>
                            <div class="form-group">
                                <label for="userName">Company Zipcode</label>
                                <input type="text" class=" numeric" maxlength="6" name="czipcode" id="czipcode" placeholder="Company Zipcode" value="<?=set_value('czipcode');?>">
                            </div>

                            <div class="form-group">
                                <label for="Password1">Password</label>
                                <input type="password" class="" name="user_pass" id="user_pass" placeholder="Password">
                                <span class="register-alert-danger"><?=form_error('user_pass');?></span>
                            </div>
                            <div class="form-group">
                                <label for="Password1">Confirm Password</label>
                                <input type="password" class="" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                <span class="register-alert-danger"><?=form_error('cpassword');?></span>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" class="col-sm-1" name="do_subscribe" style="height:25px; width:25px; margin-bottom:10px; margin-top:0px; border: 2px solid #ffffff;" id="do_subscribe" value="1" >
                                <label for="do_subscribe" class="col-sm-10" style="display: block;color:#000; font-size:13.5px;top: 2px;">Check Box Monthly Plan</label>
                            </div> -->

                            <div class="form-group">

                                <button type="submit" name="Register" id="create-account" class="theme-btn">Create Account</button>
                            </div>
                                <input type="hidden" name="package" value="<?php echo $package; ?>" />
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
