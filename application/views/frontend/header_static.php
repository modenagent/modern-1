<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <!-- Sets initial viewport load and disables zooming  -->
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo site_url(); ?>assets/frontend/images/favicon.ico" type="image/x-icon" />
        <!-- font awesome css -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/font-awesome/css/font-awesome.min.css" />
        <!-- bootstrap css -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap.min.css" />
        <!-- extra yellow css -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/extrayellow.css" />
        <!-- toastr css -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/jquery-toastr/toastr.min.css" />
        <!-- jquery ui css -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/js/jquery-ui/jquery-ui.css" />
        <!-- component css -->
        <link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/component.css" />
        <!-- style css -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/style.css" />
        <!-- default  jquery library -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <script type="text/javascript" src="https://preview.webpixels.ro/boomerang-v2.0.1/js/gmaps/google-maps-default.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.js"></script>
    </head>
    <body id="top">
        <div class="modal fade login" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close btn btn-lg" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="omb_authTitle text-center" id="login" >Login</h3>
                    <h3 class="omb_authTitle text-center" id="signup" >Create New Account</h3>
                    <h3 class="omb_authTitle text-center" id="forget" style="display:none;">Forgot Password?</h3>
                    <div class="modal-body">
                        <!-- login -->
                        <div class="omb_login">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 form-group">
                                    <form method="get" autocomplete="off" action="" class="omb_loginForm" id="login-form">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" placeholder="email address" name="username" class="form-control" id="uname">
                                        </div>
                                        <span class="help-block"></span>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" placeholder="Password" name="password" class="form-control" id="upass">
                                        </div>
                                        <span class="help-block"></span>
                                        <a href="javascript:;"><button type="submit" class="btn btn-lg btn-primary btn-block">Login</button></a>
                                    </form>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label class="checkbox">
                                        <input type="checkbox" name="rememberme">Remember Me
                                    </label>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <p class="omb_forgotPwd">
                                    <a href="#" id="forgot_show">Forgot password?</a>
                                    </p>
                                </div>
                            </div>
                            <div class="row  omb_loginOr">
                                <div class="col-xs-12 col-sm-12">
                                    <hr class="omb_hrOr">
                                    <span class="omb_spanOr">or</span>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-xs-12 form-group">
                                     <a href="#" class="btn btn-signup btn-block btn-lg" id="signup_show">Sign Up</a>
                                </div>
                            </div>
                        </div>
                        <!-- login ends -->
                        <!-- sign up -->
                        <div class="omb_signup" style="display:none;">

                            <form method="get" autocomplete="off" class="omb_loginForm" id="signup-form">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" placeholder="First Name" name="fname" class="form-control" id="fname">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" placeholder="Last Name" name="lname" class="form-control" id="lname">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" placeholder="Email" name="uemail" class="form-control" id="uemail">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" placeholder="Password" name="password" class="form-control" id="user_pass">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" placeholder="Confirm Password" name="cpassword" class="form-control" id="cpass">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 form-group">

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" placeholder="Phone No." name="uphone" class="form-control" id="uphone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                            <input type="text" placeholder="License No." name="ulicence" class="form-control" id="ulicence">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                            <input type="text" placeholder="Company Name" name="cname" class="form-control" id="cname">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-text-o
                                            "></i></span>
                                            <input type="text" placeholder="Company Address" name="caddress" class="form-control" id="caddress">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12 form-group">
                                        <a href="javascript:;"><button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button></a>
                                    </div>
                                </div>

                                <h5 class="omb_authTitle text-left">Already a User? <a href="#" id="login_show">Sign In</a></h5>
                            </form>


                        </div>
                        <!-- sign up end -->
                        <!-- forgot password -->
                        <div class="omb_forget" style="display:none;">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12">
                                    <form method="get" autocomplete="off" action="" class="omb_loginForm" id="forgot-form">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" placeholder="email address" name="useremail" class="form-control" id="useremail">
                                        </div>

                                        <span class="help-block"></span>
                                        <a href="javascript:;"><button type="submit" class="btn btn-lg btn-primary btn-block" id="forgot_submit">Submit</button></a>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- forgot password ends -->
                    </div>
                    </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <header class="">
                        <div class="header-stats">
                            <header id="sliding-header">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <a href="#"> <img src="<?php echo site_url(); ?>assets/img/logo.png"></a>
                                        </div>
                                        <div class="col-xs-6 text-right col-sm-6 col-md-6 col-lg-6">
                                        <?php
if ($this->session->userdata('userid')) {
    $value = site_url() . "user/dashboard";
} else {
    $value = "#modal-id";
}
?>
                                         <ul class="nav navbar-nav pull-right top-nav">
                                            <li><a href="<?php echo site_url(); ?>#how-it-works" >How it Works</a> </li>
                                            <li><a href="<?php echo site_url(); ?>#pricing">Pricing</a></li>
                                            <li><a href="<?php echo site_url(); ?>frontend/faq">FAQ'S</a></li>
                                            <li><a  class="btn btn-login btn-md" data-toggle="modal" href='<?php echo $value; ?>' id="default_login">Login</a></li>
                                         </ul>

                                        </div>
                                    </div>
                                </div>
                            </header>
                            <div class="container">

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </header>
                    <div class="clearfix"></div>