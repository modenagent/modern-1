<page class="pdf20">
    <h1 class="report_title">BUYER’S REPORT</h1>
    <!-- <img src="<?php echo base_url("assets/reports/english/buyer/2/images/black-logo.png"); ?>" alt="black-logo" class="mx-auto z9"> -->
    <!-- <div class="d-flex no_gutter mmt-90">    
        <div class="col-50">
            <img src="<?php echo base_url("assets/reports/english/buyer/2/images/shutterstock-1060455149.jpg"); ?>" alt="24ad-Traditional" class="img-fluid cat_img">
        </div>
        <div class="col-50">
            <img src="<?php echo base_url("assets/reports/english/buyer/2/images/webaliser-TPTXZd9m-Oo-unsplash.jpg"); ?>" alt="24ad-Traditional" class="img-fluid cat_img">
        </div>
    </div> -->
    <!-- <div class="d-flex no_gutter">
        <div class="col-50">
            <img src="<?php echo base_url("assets/reports/english/buyer/2/images/shutterstock-666248572.jpg"); ?>" alt="24ad-Traditional" class="img-fluid cat_img">
        </div>
        <div class="col-50">
            <img src="<?php echo base_url("assets/reports/english/buyer/2/images/shutterstock-1116862508.jpg"); ?>" alt="24ad-Traditional" class="img-fluid cat_img">
        </div>
    </div> -->
    <div class="mid-img">
        <img src="<?php echo base_url("assets/reports/english/buyer/2/images/resort.png"); ?>" alt="Hero img" class="hero_img">
    </div>
    <hr class="">
    <div class="footer">
        <div class="more_info">For more information, please contact me.</div>
        <div class="d-flex ">
            <div class="signature horizontal_sign">
                <?php 
                    if($user['profile_image'] != '' && $user['profile_image'] != 'no')
                    {
                ?>  
                        <img src="<?php echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                <?php
                    }
                ?>
                <div>
                    <?php 
                    if(!empty($user['first_name']) || !empty($user['last_name'])) {
                    ?>
                        <div class="profile_name"><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></div>
                    <?php } ?>
                    <?php 
                    if(isset($user['title']) && !empty($user['title'])) {
                    ?>
                        <div class="profile_title"><?php echo $user['title']; ?></div>
                    <?php } ?>
                    <!-- <div class="profile_title"><small>Licensed in Oregon & Washington</small></div> -->
                    <?php 
                    if(isset($user['phone']) && !empty($user['phone'])) {
                    ?>
                    <a class="contact_info mt-2" href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a>
                    <?php } ?>
                    <?php 
                    if(isset($user['mobile']) && !empty($user['mobile'])) {
                    ?>
                    <a class="contact_info mt-2" href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?></a>
                    <?php } ?>
                    <?php 
                        if(isset($user['email']) && !empty($user['email'])) {
                    ?>
                    <a href="mailto:<?php echo $user['email']; ?>" class="contact_info"><?php echo $user['email']; ?></a>
                    <?php } ?>
                    <?php 
                            if(isset($user['website']) && !empty($user['website']))
                            {
                                $parsed_url  = parse_url($user['website']);

                                $website = isset($parse_url['scheme']) && !empty($parse_url['scheme']) ? $parse_url['scheme'] : 'javascript:void(0);';
                        ?>
                                <a href="<?php echo $website; ?>" target="_blank"class="contact_info">
                                    <b><?php echo $user['website']; ?></b>
                                </a>
                        <?php
                            }
                        ?>
                    <!-- <a href="https://dawncordiner.com" target="_blank" class="contact_info"><b>dawncordiner.com</b></a> -->
                </div>
            </div>
            <div class="logo">
                <div class="">
                    <img src="<?php echo base_url($user["company_logo"]); ?>" alt="white-logo" border="0">
                    <div class="auth">AUTHENTICITY ABOVE ALL.</div>
                    <div class="info_policy">This is not intended to solicit currently listed properties.<br>
                        This information is deemed reliable, but not guaranteed.</div>
                </div>
                <!-- <img src="<?php echo base_url("assets/reports/english/buyer/2/images/soldera.png"); ?>" alt="soldera" class="smaller_img"> -->
            </div>
        </div>
    </div>
</page>