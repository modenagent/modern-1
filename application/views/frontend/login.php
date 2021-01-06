
<div id="login-page" class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-md-offset-4">
                <div id="errorMessage" class="login-error-msg text-center"><span><?php echo $err_message;?></span></div>
               
                <div class="sign-in-container">
                    <form class="login-wrapper" method="post" id="login-form" style="">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                     <div class="logo-container">
                                     <center><a href="#"><img id="header_logo" class="" src="<?php echo base_url(); ?>assets/images-2/logo.png" class="img-responsive" ></a></center>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="form-group">
                                <input type="email" class="form-control" name="uemail" id="uemail" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="upass" id="upass" placeholder="Password">
                            </div>
                            <div class="form-group m-b-0">
                                <input id="login-form-submit-btn" class="btn btn-lp" name="Login" type="submit" value="Login">
                            </div>
                        </div>
                        <div class="actions">
                            <span class="login-btns"><a href="javascript:;" class="fp-link">Forgot Password?</a> | <a href="<?php echo base_url() ?>frontend/register" class="reg-link">Register</a></span>
                        </div>
                    </form>
                    <form action="" class="login-wrapper" method="post" id="forgot-form" style="display:none;">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h3>Forgot Password ?</h3>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="form-group">
                                <label for="userName">Email</label>
                                <input type="text" class="form-control" name="f_uemail" id="f_uemail" placeholder="Email">
                            </div>
                            <div class="form-group m-b-0">
                                <input class="btn btn-lp" id="forgot_submit" name="forgot" type="button" value="Recover Password">
                            </div>
                        </div>
                        <div class="actions">
                            <span class="login-btns"><a href="javascript:;" id="login-link">Login</a> | <a href="<?php echo base_url() ?>frontend/register" class="reg-link">Register</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var img = "<?php echo base_url(); ?>"+ '/assets/images-2/home/header3.jpg';
        $('body').css('background', 'url('+img+')');
    });
</script>